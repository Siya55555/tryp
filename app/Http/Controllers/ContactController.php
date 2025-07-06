<?php

namespace App\Http\Controllers;

use App\Models\Admin\ContactSettings;
use App\Models\Admin\CaptchaSetting;
use App\Models\ContactSubmission;
use App\Rules\Turnstile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Handle contact form submission
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */    public function submit(Request $request)
    {        // Get contact settings
        $contactSettings = ContactSettings::first();
        
        // Get captcha settings
        $captchaSettings = CaptchaSetting::first();
        
        // Build validation rules
        $rules = [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'package_holder' => 'required|in:yes,no',
            'message' => 'required|string|max:1000',
            'consent' => 'accepted'
        ];
        
        // Add Turnstile validation if enabled
        if ($captchaSettings->enabled && $captchaSettings->enable_on_contact) {
            $rules['cf-turnstile-response'] = ['required', new Turnstile()];
        }
        
        // Validate form data
        $validator = Validator::make($request->all(), $rules, [
            'consent.accepted' => 'You must consent to receive communications.',
            'cf-turnstile-response.required' => 'Please complete the CAPTCHA verification.'
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save to database
        $submission = ContactSubmission::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'package_holder' => $request->input('package_holder'),
            'message' => $request->input('message'),
            'status' => 'new'
        ]);

        // Prepare email data
        $emailData = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'package_holder' => $request->input('package_holder'),
            'message_content' => $request->input('message'),
            'submission_id' => $submission->id
        ];

        // Determine recipient email
        $recipientEmail = $contactSettings->contact_recipient_email 
            ?? config('mail.from.address', 'noreply@freelancerhasib.com');

        // Apply mail configuration from database settings
        if ($contactSettings) {
            $contactSettings->applyMailConfig();
        }

        // Send email
        try {
            Mail::send('emails.contact-form', $emailData, function($message) use ($recipientEmail) {
                $message->to($recipientEmail)
                    ->subject('New Contact Form Submission');
            });

            // Redirect with success message
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            // Log error and redirect with error message
            \Log::error('Contact form email error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an issue sending your message. Please try again later.');
        }
    }
}