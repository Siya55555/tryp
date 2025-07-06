<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get settings by group
        $generalSettings = Setting::where('group', 'general')->get()->keyBy('key');
        $appearanceSettings = Setting::where('group', 'appearance')->get()->keyBy('key');
        $contactSettings = Setting::where('group', 'contact')->get()->keyBy('key');
        $displaySettings = Setting::where('group', 'display')->get()->keyBy('key');
        
        return view('admin.settings.index', compact(
            'generalSettings',
            'appearanceSettings',
            'contactSettings',
            'displaySettings'
        ));
    }

    /**
     * Update the general settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'about_us_short' => 'required|string',
        ]);
        
        // Update settings
        Setting::set('company_name', $request->company_name, 'general');
        Setting::set('about_us_short', $request->about_us_short, 'general');
        
        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'General settings updated successfully.');
    }

    /**
     * Update the appearance settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    /**
     * Update the appearance settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAppearance(Request $request)
    {
        // Validate appearance settings including gradient colors
        $request->validate([
            'primary_button_color' => 'nullable|string',
            'primary_button_hover_color' => 'nullable|string',
            'primary_gradient_from' => 'nullable|string',
            'primary_gradient_to' => 'nullable|string',
            'primary_gradient_hover_from' => 'nullable|string',
            'overlay_bg_color_from' => 'nullable|string',
            'overlay_bg_color_to' => 'nullable|string',
            'page_title_bg_color_from' => 'nullable|string',
            'page_title_bg_color_to' => 'nullable|string',
            'primary_gradient_hover_to' => 'nullable|string',
            'secondary_gradient_from' => 'nullable|string',
            'secondary_gradient_to' => 'nullable|string',
            'secondary_gradient_hover_from' => 'nullable|string',
            'secondary_gradient_hover_to' => 'nullable|string',
            'header_bg_color_from' => 'nullable|string',
            'header_bg_color_to' => 'nullable|string',
            'footer_bg_color_from' => 'nullable|string',
            'footer_bg_color_to' => 'nullable|string',
            'icon_color_primary' => 'nullable|string',
            'hero_heading' => 'nullable|string',
            'hero_subheading' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_logo_mobile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hero_bg_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        // Handle logo uploads
        if ($request->hasFile('site_logo') && $request->file('site_logo')->isValid()) {
            $logoPath = $request->file('site_logo')->store('logos', 'public');
            Setting::set('site_logo', 'storage/' . $logoPath, 'appearance');
        }
        
        if ($request->hasFile('site_logo_mobile') && $request->file('site_logo_mobile')->isValid()) {
            $mobileLogoPath = $request->file('site_logo_mobile')->store('logos', 'public');
            Setting::set('site_logo_mobile', 'storage/' . $mobileLogoPath, 'appearance');
        }
        
        // Handle hero background image upload
        if ($request->hasFile('hero_bg_image') && $request->file('hero_bg_image')->isValid()) {
            $heroBgPath = $request->file('hero_bg_image')->store('hero', 'public');
            Setting::set('hero_bg_image', 'storage/' . $heroBgPath, 'appearance');
        }
        
        // Update color settings - ensure we handle color values properly
        if ($request->has('primary_button_color')) {
            Setting::set('primary_button_color', $request->primary_button_color, 'appearance');
        }
        
        if ($request->has('primary_button_hover_color')) {
            Setting::set('primary_button_hover_color', $request->primary_button_hover_color, 'appearance');
        }
        
        if ($request->has('icon_color_primary')) {
            Setting::set('icon_color_primary', $request->icon_color_primary, 'appearance');
        }
        
        // Update header and footer colors
        if ($request->has('header_bg_color_from')) {
            Setting::set('header_bg_color_from', $request->header_bg_color_from, 'appearance');
        }
        
        if ($request->has('header_bg_color_to')) {
            Setting::set('header_bg_color_to', $request->header_bg_color_to, 'appearance');
        }
        
        if ($request->has('footer_bg_color_from')) {
            Setting::set('footer_bg_color_from', $request->footer_bg_color_from, 'appearance');
        }
        
        if ($request->has('footer_bg_color_to')) {
            Setting::set('footer_bg_color_to', $request->footer_bg_color_to, 'appearance');
        }
        
        // Update overlay and page title colors
        if ($request->has('overlay_bg_color_from')) {
            Setting::set('overlay_bg_color_from', $request->overlay_bg_color_from, 'appearance');
        }
        
        if ($request->has('overlay_bg_color_to')) {
            Setting::set('overlay_bg_color_to', $request->overlay_bg_color_to, 'appearance');
        }
        
        if ($request->has('page_title_bg_color_from')) {
            Setting::set('page_title_bg_color_from', $request->page_title_bg_color_from, 'appearance');
        }
        
        if ($request->has('page_title_bg_color_to')) {
            Setting::set('page_title_bg_color_to', $request->page_title_bg_color_to, 'appearance');
        }
        
        // Update gradient button color settings
        if ($request->has('primary_gradient_from')) {
            Setting::set('primary_gradient_from', $request->primary_gradient_from, 'appearance');
        }
        
        if ($request->has('primary_gradient_to')) {
            Setting::set('primary_gradient_to', $request->primary_gradient_to, 'appearance');
        }
        
        if ($request->has('primary_gradient_hover_from')) {
            Setting::set('primary_gradient_hover_from', $request->primary_gradient_hover_from, 'appearance');
        }
        
        if ($request->has('primary_gradient_hover_to')) {
            Setting::set('primary_gradient_hover_to', $request->primary_gradient_hover_to, 'appearance');
        }
        
        if ($request->has('secondary_gradient_from')) {
            Setting::set('secondary_gradient_from', $request->secondary_gradient_from, 'appearance');
        }
        
        if ($request->has('secondary_gradient_to')) {
            Setting::set('secondary_gradient_to', $request->secondary_gradient_to, 'appearance');
        }
        
        if ($request->has('secondary_gradient_hover_from')) {
            Setting::set('secondary_gradient_hover_from', $request->secondary_gradient_hover_from, 'appearance');
        }
        
        if ($request->has('secondary_gradient_hover_to')) {
            Setting::set('secondary_gradient_hover_to', $request->secondary_gradient_hover_to, 'appearance');
        }
        
        // Update hero section settings
        if ($request->has('hero_heading')) {
            Setting::set('hero_heading', $request->hero_heading, 'appearance');
        }
        
        if ($request->has('hero_subheading')) {
            Setting::set('hero_subheading', $request->hero_subheading, 'appearance');
        }
        
        // Clear cached CSS by adding a version parameter
        Setting::set('css_version', time(), 'appearance');
        
        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Appearance settings updated successfully.');
    }

    /**
     * Update the contact information settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateContact(Request $request)
    {
        $request->validate([
            'company_address' => 'required|string|max:255',
            'company_phone' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'office_hours' => 'required|string|max:255',
        ]);
        
        // Update settings
        Setting::set('company_address', $request->company_address, 'contact');
        Setting::set('company_phone', $request->company_phone, 'contact');
        Setting::set('company_email', $request->company_email, 'contact');
        Setting::set('office_hours', $request->office_hours, 'contact');
        
        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Contact information updated successfully.');
    }

    /**
     * Update the hero section settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateHero(Request $request)
    {
        $request->validate([
            'hero_heading' => 'required|string|max:255',
            'hero_subheading' => 'required|string',
            'hero_bg_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Update text settings
        Setting::set('hero_heading', $request->hero_heading, 'appearance');
        Setting::set('hero_subheading', $request->hero_subheading, 'appearance');
        
        // Handle hero background image upload
        if ($request->hasFile('hero_bg_image') && $request->file('hero_bg_image')->isValid()) {
            $imagePath = $request->file('hero_bg_image')->store('hero', 'public');
            Setting::set('hero_bg_image', 'storage/' . $imagePath, 'appearance');
        }
        
        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Hero section updated successfully.');
    }

    /**
     * Update the display count settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateDisplay(Request $request)
    {
        $request->validate([
            'home_bundles_count' => 'required|integer|min:1|max:12',
            'home_destinations_count' => 'required|integer|min:1|max:12',
            'testimonials_count' => 'required|integer|min:1|max:12',
        ]);
        
        // Update settings
        Setting::set('home_bundles_count', $request->home_bundles_count, 'display');
        Setting::set('home_destinations_count', $request->home_destinations_count, 'display');
        Setting::set('testimonials_count', $request->testimonials_count, 'display');
        
        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Display settings updated successfully.');
    }

    /**
     * Generate dynamic CSS for button colors
     *
     * @return \Illuminate\Http\Response
     */    /**
     * Helper function to convert hex color to RGB components
     * 
     * @param string $hex The hex color code (with or without #)
     * @return string The RGB components as "r, g, b" format
     */
    private function hexToRgb($hex)
    {
        // If the color is already in rgba format, extract the RGB components
        if (strpos($hex, 'rgba') !== false) {
            preg_match('/rgba\s*\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*,\s*([\d.]+)\s*\)/', $hex, $matches);
            if (count($matches) >= 4) {
                return "{$matches[1]}, {$matches[2]}, {$matches[3]}";
            }
        }
        
        // If the color is in rgb format, extract the RGB components
        if (strpos($hex, 'rgb') !== false) {
            preg_match('/rgb\s*\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\)/', $hex, $matches);
            if (count($matches) >= 4) {
                return "{$matches[1]}, {$matches[2]}, {$matches[3]}";
            }
        }
        
        // Handle hex format
        $hex = ltrim($hex, '#');
        if (strlen($hex) == 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }
        
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        
        return "$r, $g, $b";
    }
    
    /**
     * Generate dynamic CSS for button colors
     *
     * @return \Illuminate\Http\Response
     */
    public function generateDynamicCSS()
    {
        $primaryButtonColor = Setting::get('primary_button_color', '#2563eb');
        $primaryButtonHoverColor = Setting::get('primary_button_hover_color', '#1d4ed8');
        
        // Icon color setting
        $iconColorPrimary = Setting::get('icon_color_primary', '#2563eb');
        
        // Gradient color settings
        $primaryGradientFrom = Setting::get('primary_gradient_from', '#2563eb');
        $primaryGradientTo = Setting::get('primary_gradient_to', '#4f46e5');
        $primaryGradientHoverFrom = Setting::get('primary_gradient_hover_from', '#1d4ed8');
        $primaryGradientHoverTo = Setting::get('primary_gradient_hover_to', '#3730a3');
        $secondaryGradientFrom = Setting::get('secondary_gradient_from', '#14b8a6');
        $secondaryGradientTo = Setting::get('secondary_gradient_to', '#0891b2');
        $secondaryGradientHoverFrom = Setting::get('secondary_gradient_hover_from', '#0f766e');
        $secondaryGradientHoverTo = Setting::get('secondary_gradient_hover_to', '#075985');
        
        // Image overlay and page title background colors
        $overlayBgFrom = Setting::get('overlay_bg_color_from', 'rgba(0,0,0,0.7)');
        $overlayBgTo = Setting::get('overlay_bg_color_to', 'rgba(0,0,0,0.4)');
        $pageTitleBgFrom = Setting::get('page_title_bg_color_from', '#2563eb');
        $pageTitleBgTo = Setting::get('page_title_bg_color_to', '#4f46e5');
        
        // Convert colors to RGB format
        $primaryButtonColorRgb = $this->hexToRgb($primaryButtonColor);
        $primaryButtonHoverColorRgb = $this->hexToRgb($primaryButtonHoverColor);
        $iconColorPrimaryRgb = $this->hexToRgb($iconColorPrimary);
        $primaryGradientFromRgb = $this->hexToRgb($primaryGradientFrom);
        $primaryGradientToRgb = $this->hexToRgb($primaryGradientTo);
        $secondaryGradientFromRgb = $this->hexToRgb($secondaryGradientFrom);
        $secondaryGradientToRgb = $this->hexToRgb($secondaryGradientTo);
        
        $css = ":root {
            --primary-button-bg: {$primaryButtonColor};
            --primary-button-bg-rgb: {$primaryButtonColorRgb};
            --primary-button-hover-bg: {$primaryButtonHoverColor};
            --primary-button-hover-bg-rgb: {$primaryButtonHoverColorRgb};
            --icon-color-primary: {$iconColorPrimary};
            --icon-color-primary-rgb: {$iconColorPrimaryRgb};
            --primary-gradient-from: {$primaryGradientFrom};
            --primary-gradient-from-rgb: {$primaryGradientFromRgb};
            --primary-gradient-to: {$primaryGradientTo};
            --primary-gradient-to-rgb: {$primaryGradientToRgb};
            --primary-gradient-hover-from: {$primaryGradientHoverFrom};
            --primary-gradient-hover-to: {$primaryGradientHoverTo};
            --secondary-gradient-from: {$secondaryGradientFrom};
            --secondary-gradient-from-rgb: {$secondaryGradientFromRgb};
            --secondary-gradient-to: {$secondaryGradientTo};
            --secondary-gradient-to-rgb: {$secondaryGradientToRgb};
            --secondary-gradient-hover-from: {$secondaryGradientHoverFrom};
            --secondary-gradient-hover-to: {$secondaryGradientHoverTo};
            --overlay-bg-from: {$overlayBgFrom};
            --overlay-bg-to: {$overlayBgTo};
            --page-title-bg-from: {$pageTitleBgFrom};
            --page-title-bg-to: {$pageTitleBgTo};
        }
        
        /* Override Tailwind blue button classes with custom colors */
        .btn-primary,
        .bg-blue-600,
        .bg-blue-500,
        .bg-blue-700,
        .bg-blue-800 {
            background-color: var(--primary-button-bg) !important;
        }
        
        /* Hover states */
        .btn-primary:hover,
        .hover\\:bg-blue-700:hover,
        .hover\\:bg-blue-600:hover,
        .hover\\:bg-blue-800:hover {
            background-color: var(--primary-button-hover-bg) !important;
        }
        
        .primary-text-color {
            color: var(--primary-button-bg) !important;
        }

        .secondary-text-color {
            color: var(--secondary-gradient-from) !important;
        }
        .hover\\:secondary-text-color:hover {
            color: var(--secondary-gradient-from) !important;
        }
        /* Primary Gradient buttons - Blue to Indigo combinations */
        .bg-gradient-to-r.from-blue-600.to-indigo-700,
        .bg-gradient-to-r.from-blue-600:not(.to-teal-500),
        .bg-gradient-to-br.from-blue-600,
        .bg-gradient-to-l.from-blue-600,
        .bg-gradient-to-t.from-blue-600,
        .bg-gradient-to-b.from-blue-600 {
            background: linear-gradient(to right, var(--primary-gradient-from), var(--primary-gradient-to)) !important;
        }
        
        /* Primary Gradient hover states */
        .hover\\:from-blue-700:hover.hover\\:to-indigo-800:hover,
        .bg-gradient-to-r.from-blue-600.to-indigo-700:hover,
        .bg-gradient-to-r.from-blue-600:not(.to-teal-500):hover {
            background: linear-gradient(to right, var(--primary-gradient-hover-from), var(--primary-gradient-hover-to)) !important;
        }
        
        /* Secondary Gradient buttons - Blue to Teal combinations */
        .bg-gradient-to-r.from-blue-600.to-teal-500,
        .bg-gradient-to-br.from-blue-600.to-teal-500,
        .bg-gradient-to-l.from-blue-600.to-teal-500,
        .bg-gradient-to-t.from-blue-600.to-teal-500,
        .bg-gradient-to-b.from-blue-600.to-teal-500 {
            background: linear-gradient(to right, var(--secondary-gradient-from), var(--secondary-gradient-to)) !important;
        }
        
        /* Secondary Gradient hover states */
        .hover\\:from-blue-700:hover.hover\\:to-teal-600:hover,
        .bg-gradient-to-r.from-blue-600.to-teal-500:hover {
            background: linear-gradient(to right, var(--secondary-gradient-hover-from), var(--secondary-gradient-hover-to)) !important;
        }
          /* Overlay gradients for hero sections and backgrounds */
        .bg-gradient-to-t.from-blue-900\\/90.to-blue-600\\/30,
        .bg-gradient-to-t.from-blue-900.to-blue-600 {
            background: linear-gradient(to top, var(--primary-gradient-from), var(--primary-gradient-to)) !important;
        }
        
        .bg-gradient-to-r.from-blue-900\\/70.to-teal-600\\/70 {
            background: linear-gradient(to right, var(--secondary-gradient-from), var(--secondary-gradient-to)) !important;
        }
          /* Image overlays and page title backgrounds */
        .image-overlay {
            background: linear-gradient(to right, var(--overlay-bg-from), var(--overlay-bg-to)) !important;
            opacity: 1 !important;
        }
        
        .page-title-bg {
            background: linear-gradient(to right, var(--page-title-bg-from), var(--page-title-bg-to)) !important;
        }
          /* Testimonials and component gradients */
        .bg-gradient-to-r.from-blue-50.to-indigo-50,
        .bg-gradient-to-br.from-white.to-blue-50 {
            background: linear-gradient(to right, rgba(var(--primary-gradient-from-rgb), 0.1), rgba(var(--primary-gradient-to-rgb), 0.1)) !important;
        }
        
        /* Pagination active state gradient */
        .bg-gradient-to-r.from-blue-600.to-indigo-700 {
            background: linear-gradient(to right, var(--primary-gradient-from), var(--primary-gradient-to)) !important;
        }
        
        /* Card hover effects with transparency */
        .card-hover:hover {
            box-shadow: 0 10px 15px -3px rgba(var(--primary-button-bg-rgb), 0.3), 0 4px 6px -2px rgba(var(--primary-button-bg-rgb), 0.1) !important;
            border-color: rgba(var(--primary-button-bg-rgb), 0.5) !important;
        }
        
        /* Focus ring colors */
        .focus\\:ring-blue-500:focus {
            --tw-ring-color: var(--primary-button-bg) !important;
        }
        
        .focus\\:border-blue-500:focus {
            --tw-border-opacity: 1 !important;
            border-color: var(--primary-button-bg) !important;
        }
          /* Text colors */
        .text-blue-600,
        .text-blue-500 {
            color: var(--primary-button-bg) !important;
        }
        
        .hover\\:text-blue-700:hover {
            color: var(--primary-button-hover-bg) !important;
        }
        
        /* Icon colors - specific classes for icons */
        .text-blue-600.fa,
        .text-blue-600.fas,
        .text-blue-600.far,
        .text-blue-600.fal,
        .text-blue-600.fab,
        svg.text-blue-600,
        i.text-blue-600,
        .icon-primary {
            color: var(--icon-color-primary) !important;
        }
        
        /* Border colors */
        .border-blue-600 {
            border-color: var(--primary-button-bg) !important;
        }
        
        /* Play button and other circular buttons */
        .bg-blue-600.rounded-full {
            background-color: var(--primary-button-bg) !important;
        }
        ";
          // Get the CSS version for cache busting
        $cssVersion = Setting::get('css_version', time());
        
        return response($css)
            ->header('Content-Type', 'text/css')
            ->header('Cache-Control', 'public, max-age=3600')  // Cache for 1 hour
            ->header('X-CSS-Version', $cssVersion); // Add version header for cache busting
    }
}