<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailSubscription;
use App\Models\Admin\ContactSettings;
use App\Mail\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class EmailSubscriptionController extends Controller
{
    /**
     * Display email subscriptions
     */
    public function index(Request $request)
    {
        $query = EmailSubscription::query();
        
        // Filter by status if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Search by email if provided
        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }
        
        $subscriptions = $query->orderBy('created_at', 'desc')->paginate(15);
        
        $stats = [
            'total' => EmailSubscription::count(),
            'active' => EmailSubscription::active()->count(),
            'unsubscribed' => EmailSubscription::unsubscribed()->count(),
        ];
        
        return view('admin.email-subscriptions.index', compact('subscriptions', 'stats'));
    }

    /**
     * Update subscription status
     */
    public function updateStatus(Request $request, EmailSubscription $subscription)
    {
        $request->validate([
            'status' => 'required|in:active,unsubscribed'
        ]);

        if ($request->status === 'active') {
            $subscription->resubscribe();
        } else {
            $subscription->unsubscribe();
        }

        return redirect()->back()->with('success', 'Subscription status updated successfully.');
    }

    /**
     * Delete subscription
     */
    public function destroy(EmailSubscription $subscription)
    {
        $subscription->delete();
        return redirect()->back()->with('success', 'Subscription deleted successfully.');
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,activate,unsubscribe',
            'subscriptions' => 'required|array',
            'subscriptions.*' => 'exists:email_subscriptions,id'
        ]);

        $subscriptions = EmailSubscription::whereIn('id', $request->subscriptions);

        switch ($request->action) {
            case 'delete':
                $subscriptions->delete();
                $message = 'Selected subscriptions deleted successfully.';
                break;
            case 'activate':
                $subscriptions->get()->each(function ($subscription) {
                    $subscription->resubscribe();
                });
                $message = 'Selected subscriptions activated successfully.';
                break;
            case 'unsubscribe':
                $subscriptions->get()->each(function ($subscription) {
                    $subscription->unsubscribe();
                });
                $message = 'Selected subscriptions unsubscribed successfully.';
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Show newsletter compose form
     */
    public function composeNewsletter()
    {
        $activeSubscriptions = EmailSubscription::active()->count();
        return view('admin.email-subscriptions.compose', compact('activeSubscriptions'));
    }

    /**
     * Send newsletter
     */
    public function sendNewsletter(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'recipients' => 'required|in:all_active,selected',
            'selected_emails' => 'required_if:recipients,selected|array',
            'selected_emails.*' => 'exists:email_subscriptions,id'
        ]);

        DB::beginTransaction();
        try {
            // Get and apply mail settings
            $contactSettings = ContactSettings::first();
            if ($contactSettings) {
                $contactSettings->applyMailConfig();
            } else {
                throw new Exception("Mail configuration not found. Please configure mail settings first.");
            }

            // Log mail configuration for debugging
            Log::info('Mail Configuration:', [
                'mailer' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'from_address' => config('mail.from.address'),
                'from_name' => config('mail.from.name')
            ]);

            $query = EmailSubscription::active();
            
            if ($request->recipients === 'selected') {
                $query->whereIn('id', $request->selected_emails);
            }
            
            $subscriptions = $query->get();
            
            if ($subscriptions->isEmpty()) {
                throw new Exception("No active subscribers found.");
            }

            $sentCount = 0;
            $failedCount = 0;
            $failedEmails = [];

            foreach ($subscriptions as $subscription) {
                try {
                    $unsubscribeToken = base64_encode($subscription->email);
                    
                    Mail::to($subscription->email)
                        ->send(new Newsletter(
                            $request->subject, 
                            $request->content, 
                            $unsubscribeToken
                        ));
                    
                    $sentCount++;
                    Log::info("Newsletter sent successfully to: {$subscription->email}");
                } catch (Exception $e) {
                    $failedCount++;
                    $failedEmails[] = $subscription->email;
                    Log::error("Failed to send newsletter to {$subscription->email}: " . $e->getMessage());
                }
            }

            DB::commit();

            if ($sentCount > 0) {
                $message = "Newsletter sent successfully to {$sentCount} subscribers.";
                if ($failedCount > 0) {
                    $message .= " Failed to send to {$failedCount} subscribers.";
                    Log::warning("Failed emails:", $failedEmails);
                }
                return redirect()->route('admin.email-subscriptions.index')
                    ->with('success', $message);
            } else {
                throw new Exception("Failed to send newsletter to any subscribers. Please check email configuration and try again.");
            }

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Newsletter sending error: " . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to send newsletter: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Get email subscriptions for AJAX
     */
    public function getSubscriptions(Request $request)
    {
        $query = EmailSubscription::active();
        
        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }
        
        $subscriptions = $query->select('id', 'email')
            ->limit(50)
            ->get();
            
        return response()->json($subscriptions);
    }
}
