<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ContactSettings;
use Illuminate\Http\Request;

class ContactSettingsController extends Controller
{
    /**
     * Show the contact settings form
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $contactSettings = ContactSettings::first() ?? new ContactSettings();
        return view('admin.contact-settings.index', compact('contactSettings'));
    }

    /**
     * Update contact settings
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
{
    $validatedData = $request->validate([
        'service_number' => 'nullable|string|max:20',
        'sales_office_number' => 'nullable|string|max:20',
        'po_box_address' => 'nullable|string|max:100',
        'work_hours_weekday' => 'nullable|string|max:50',
        'work_hours_weekend' => 'nullable|string|max:50',
        'contact_email' => 'nullable|string|email|max:100',
        'contact_recipient_email' => 'nullable|string|email|max:100',
        // Mail configuration fields
        'mail_mailer' => 'nullable|string|max:255',
        'mail_host' => 'nullable|string|max:255',
        'mail_port' => 'nullable|string|max:255',
        'mail_username' => 'nullable|string|max:255',
        'mail_password' => 'nullable|string|max:255',
        'mail_encryption' => 'nullable|string|max:255',
        'mail_from_address' => 'nullable|string|email|max:255',
        'mail_from_name' => 'nullable|string|max:255',
    ]);

    // Get first record or create a new one if none exists
    $settings = ContactSettings::first();
    if (!$settings) {
        $settings = new ContactSettings();
    }
    
    // Handle password special case - don't overwrite if empty
    if (empty($validatedData['mail_password'])) {
        unset($validatedData['mail_password']);
    }
    
    $settings->fill($validatedData);
    $settings->save();

    return redirect()->route('admin.contact-settings.index')
        ->with('success', 'Contact settings updated successfully.');
}
}