<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactSubmissionsController extends Controller
{
    /**
     * Display a listing of contact submissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = ContactSubmission::query();
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by search term if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }
        
        // Order by latest first
        $query->orderBy('created_at', 'desc');
        
        // Paginate results
        $submissions = $query->paginate(10);
        
        return view('admin.contact-submissions.index', compact('submissions'));
    }

    /**
     * Display the specified contact submission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        
        // Mark as read if it's new
        if ($submission->status === 'new') {
            $submission->status = 'read';
            $submission->save();
        }
        
        return view('admin.contact-submissions.show', compact('submission'));
    }

    /**
     * Send a reply to the contact submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);
        
        $submission = ContactSubmission::findOrFail($id);
        
        // Get contact settings and apply mail configuration
        $contactSettings = \App\Models\Admin\ContactSettings::getSettings();
        
        // Check if basic mail configuration exists, if not, use env values
        if (empty($contactSettings->mail_mailer) || empty($contactSettings->mail_host)) {
            // Log warning
            \Log::warning('Mail configuration not found in database, using env values');
            
            // Manually set some reasonable defaults based on .env
            config(['mail.mailer' => env('MAIL_MAILER', 'smtp')]);
            config(['mail.mailers.smtp.host' => env('MAIL_HOST', 'smtp.hostinger.com')]);
            config(['mail.mailers.smtp.port' => env('MAIL_PORT', 465)]);
            config(['mail.mailers.smtp.encryption' => env('MAIL_ENCRYPTION', 'tls')]);
            config(['mail.mailers.smtp.username' => env('MAIL_USERNAME', 'noreply@freelancerhasib.com')]);
            config(['mail.mailers.smtp.password' => env('MAIL_PASSWORD', '')]);
            config(['mail.from.address' => env('MAIL_FROM_ADDRESS', 'noreply@freelancerhasib.com')]);
            config(['mail.from.name' => env('MAIL_FROM_NAME', config('app.name'))]);
        } else {
            // Apply configuration from database
            $contactSettings->applyMailConfig();
        }
        
        // Prepare email data
        $emailData = [
            'name' => $submission->first_name . ' ' . $submission->last_name,
            'subject' => $request->subject,
            'messageContent' => $request->message,
            'originalMessage' => $submission->message
        ];
        
        try {
            // Check if the template exists
            if (!view()->exists('emails.contact-reply')) {
                \Log::error('Contact reply email template not found: emails.contact-reply');
                return redirect()->back()
                    ->with('error', 'Email template not found. Please check your application files.')
                    ->withInput();
            }
            
            // Debug info
            \Log::info('Mail configuration being used:', [
                'mailer' => config('mail.mailer'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'username' => config('mail.mailers.smtp.username'),
                'from_address' => config('mail.from.address'),
                'from_name' => config('mail.from.name')
            ]);
            
            // Send the email
            Mail::send('emails.contact-reply', $emailData, function($message) use ($submission, $request) {
                $message->to($submission->email)
                    ->subject($request->subject);
            });
            
            // If we get here, no exception was thrown, so update submission status
            $submission->status = 'replied';
            $submission->replied_at = now();
            $submission->save();
            
            return redirect()->route('admin.contact-submissions.show', $submission->id)
                ->with('success', 'Reply sent successfully!');
                
        } catch (\Swift_TransportException $e) {
            // Mail server connection error
            \Log::error('Contact reply email transport error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Mail server connection error. Please check your mail configuration.')
                ->withInput();
                
        } catch (\Exception $e) {
            // Log detailed error
            \Log::error('Contact reply email error: ' . $e->getMessage());
            \Log::error('Error trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->with('error', 'There was an issue sending your reply: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified contact submission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $submission = ContactSubmission::findOrFail($id);
        $submission->delete();
        
        return redirect()->route('admin.contact-submissions.index')
            ->with('success', 'Contact submission deleted successfully!');
    }
}