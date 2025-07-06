@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Site Settings</h1>
    
    <!-- Tabs -->
    <div class="mb-8 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="settingsTabs" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-blue-600 rounded-t-lg active" id="general-tab" data-tab-target="general-content" type="button" role="tab" aria-controls="general" aria-selected="true">
                    General
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="appearance-tab" data-tab-target="appearance-content" type="button" role="tab" aria-controls="appearance" aria-selected="false">
                    Appearance
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="contact-tab" data-tab-target="contact-content" type="button" role="tab" aria-controls="contact" aria-selected="false">
                    Contact Information
                </button>
            </li>            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="display-tab" data-tab-target="display-content" type="button" role="tab" aria-controls="display" aria-selected="false">
                    Display Settings
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="captcha-tab" data-tab-target="captcha-content" type="button" role="tab" aria-controls="captcha" aria-selected="false">
                    CAPTCHA Settings
                </button>
            </li>

        </ul>
    </div>
    
    <!-- Tab Content -->
    <div id="settingsTabContent">
        <!-- General Settings -->
        <div class="tab-content active" id="general-content" role="tabpanel" aria-labelledby="general-tab">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">General Settings</h2>
                
                <form action="{{ route('admin.settings.update.general') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ $generalSettings['company_name']->value ?? 'MyTravel' }}">
                    </div>
                    
                    <div class="mb-6">
                        <label for="about_us_short" class="block text-sm font-medium text-gray-700 mb-1">About Us (Short)</label>
                        <textarea name="about_us_short" id="about_us_short" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ $generalSettings['about_us_short']->value ?? 'MyTravel has been helping travelers explore the world for over 15 years. We\'re committed to providing unforgettable experiences.' }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">
                            This short description appears in the footer and other places on the site.
                        </p>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Save General Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Appearance Settings -->
        <div class="tab-content hidden" id="appearance-content" role="tabpanel" aria-labelledby="appearance-tab">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Appearance Settings</h2>
                
                <form action="{{ route('admin.settings.update.appearance') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Logo</label>
                        <div class="flex items-center space-x-6">
                            <div class="flex flex-col items-center">
                                @if(isset($appearanceSettings['site_logo']) && $appearanceSettings['site_logo']->value)
                                    <img src="{{ filter_var($appearanceSettings['site_logo']->value, FILTER_VALIDATE_URL) 
                                        ? $appearanceSettings['site_logo']->value 
                                        : asset($appearanceSettings['site_logo']->value) }}" 
                                        alt="Site Logo" 
                                        class="h-20 object-contain mb-2">
                                @else
                                    <div class="h-20 w-60 bg-gray-100 flex items-center justify-center mb-2">
                                        <span class="text-gray-400">No logo uploaded</span>
                                    </div>
                                @endif
                                <span class="text-xs text-gray-500">Main Logo</span>
                            </div>
                            <div class="flex flex-col items-center">
                                @if(isset($appearanceSettings['site_logo_mobile']) && $appearanceSettings['site_logo_mobile']->value)
                                    <img src="{{ filter_var($appearanceSettings['site_logo_mobile']->value, FILTER_VALIDATE_URL) 
                                        ? $appearanceSettings['site_logo_mobile']->value 
                                        : asset($appearanceSettings['site_logo_mobile']->value) }}" 
                                        alt="Mobile Logo" 
                                        class="h-20 object-contain mb-2">
                                @else
                                    <div class="h-20 w-20 bg-gray-100 flex items-center justify-center mb-2">
                                        <span class="text-gray-400">No logo</span>
                                    </div>
                                @endif
                                <span class="text-xs text-gray-500">Mobile Logo</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="site_logo" class="block text-sm font-medium text-gray-700 mb-1">Main Logo</label>
                            <input type="file" name="site_logo" id="site_logo" class="w-full border border-gray-300 px-3 py-2 rounded-md">
                            <p class="mt-1 text-sm text-gray-500">
                                Recommended size: 200x60 pixels. SVG, PNG or JPG.
                            </p>
                        </div>
                        
                        <div>
                            <label for="site_logo_mobile" class="block text-sm font-medium text-gray-700 mb-1">Mobile Logo</label>
                            <input type="file" name="site_logo_mobile" id="site_logo_mobile" class="w-full border border-gray-300 px-3 py-2 rounded-md">
                            <p class="mt-1 text-sm text-gray-500">
                                Recommended size: 40x40 pixels. SVG, PNG or JPG.
                            </p>
                        </div>
                    </div>
                      <h3 class="text-lg font-semibold mb-4 mt-8 border-b pb-2">Color Settings</h3>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="font-medium mb-3">Button Colors</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="primary_button_color" class="block text-sm font-medium text-gray-700 mb-1">Primary Button Color</label>
                                <input type="color" name="primary_button_color" id="primary_button_color" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['primary_button_color']->value ?? '#2563eb' }}">
                                <p class="mt-1 text-sm text-gray-500">Main action buttons color</p>
                            </div>
                            
                            <div>
                                <label for="primary_button_hover_color" class="block text-sm font-medium text-gray-700 mb-1">Primary Button Hover Color</label>
                                <input type="color" name="primary_button_hover_color" id="primary_button_hover_color" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['primary_button_hover_color']->value ?? '#1d4ed8' }}">
                                <p class="mt-1 text-sm text-gray-500">Hover state for primary buttons</p>
                            </div>
                        </div>
                          <div class="mt-4 p-3 bg-white rounded border">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <button type="button" id="button-color-preview" 
                                    class="px-4 py-2 text-white rounded-md font-medium transition-colors" 
                                    style="background-color: {{ $appearanceSettings['primary_button_color']->value ?? '#2563eb' }};">
                                Sample Button
                            </button>
                            <div class="mt-3 pt-3 border-t">
                                <a href="{{ route('test.buttons') }}" target="_blank" 
                                   class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Test Button Colors on Full Page
                                </a>
                            </div>                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="font-medium mb-3">Primary Gradient Button Colors</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="primary_gradient_from" class="block text-sm font-medium text-gray-700 mb-1">Primary Gradient From Color</label>
                                <input type="color" name="primary_gradient_from" id="primary_gradient_from" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['primary_gradient_from']->value ?? '#2563eb' }}">
                                <p class="mt-1 text-sm text-gray-500">Starting color for primary gradient buttons</p>
                            </div>
                            
                            <div>
                                <label for="primary_gradient_to" class="block text-sm font-medium text-gray-700 mb-1">Primary Gradient To Color</label>
                                <input type="color" name="primary_gradient_to" id="primary_gradient_to" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['primary_gradient_to']->value ?? '#4f46e5' }}">
                                <p class="mt-1 text-sm text-gray-500">Ending color for primary gradient buttons</p>
                            </div>
                            
                            <div>
                                <label for="primary_gradient_hover_from" class="block text-sm font-medium text-gray-700 mb-1">Primary Gradient Hover From</label>
                                <input type="color" name="primary_gradient_hover_from" id="primary_gradient_hover_from" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['primary_gradient_hover_from']->value ?? '#1d4ed8' }}">
                                <p class="mt-1 text-sm text-gray-500">Hover starting color for primary gradient</p>
                            </div>
                            
                            <div>
                                <label for="primary_gradient_hover_to" class="block text-sm font-medium text-gray-700 mb-1">Primary Gradient Hover To</label>
                                <input type="color" name="primary_gradient_hover_to" id="primary_gradient_hover_to" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['primary_gradient_hover_to']->value ?? '#3730a3' }}">
                                <p class="mt-1 text-sm text-gray-500">Hover ending color for primary gradient</p>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-white rounded border">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <button type="button" id="gradient-button-preview" 
                                    class="px-6 py-3 text-white rounded-md font-medium transition-all duration-300" 
                                    style="background: linear-gradient(to right, {{ $appearanceSettings['primary_gradient_from']->value ?? '#2563eb' }}, {{ $appearanceSettings['primary_gradient_to']->value ?? '#4f46e5' }});">
                                Primary Gradient Button
                            </button>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="font-medium mb-3">Secondary Gradient Button Colors</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="secondary_gradient_from" class="block text-sm font-medium text-gray-700 mb-1">Secondary Gradient From Color</label>
                                <input type="color" name="secondary_gradient_from" id="secondary_gradient_from" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['secondary_gradient_from']->value ?? '#14b8a6' }}">
                                <p class="mt-1 text-sm text-gray-500">Starting color for secondary gradient buttons</p>
                            </div>
                            
                            <div>
                                <label for="secondary_gradient_to" class="block text-sm font-medium text-gray-700 mb-1">Secondary Gradient To Color</label>
                                <input type="color" name="secondary_gradient_to" id="secondary_gradient_to" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['secondary_gradient_to']->value ?? '#0891b2' }}">
                                <p class="mt-1 text-sm text-gray-500">Ending color for secondary gradient buttons</p>
                            </div>
                            
                            <div>
                                <label for="secondary_gradient_hover_from" class="block text-sm font-medium text-gray-700 mb-1">Secondary Gradient Hover From</label>
                                <input type="color" name="secondary_gradient_hover_from" id="secondary_gradient_hover_from" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['secondary_gradient_hover_from']->value ?? '#0f766e' }}">
                                <p class="mt-1 text-sm text-gray-500">Hover starting color for secondary gradient</p>
                            </div>
                            
                            <div>
                                <label for="secondary_gradient_hover_to" class="block text-sm font-medium text-gray-700 mb-1">Secondary Gradient Hover To</label>
                                <input type="color" name="secondary_gradient_hover_to" id="secondary_gradient_hover_to" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['secondary_gradient_hover_to']->value ?? '#075985' }}">
                                <p class="mt-1 text-sm text-gray-500">Hover ending color for secondary gradient</p>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-white rounded border">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <button type="button" id="secondary-gradient-button-preview" 
                                    class="px-6 py-3 text-white rounded-md font-medium transition-all duration-300" 
                                    style="background: linear-gradient(to right, {{ $appearanceSettings['secondary_gradient_from']->value ?? '#14b8a6' }}, {{ $appearanceSettings['secondary_gradient_to']->value ?? '#0891b2' }});">
                                Secondary Gradient Button
                            </button>
                        </div>
                    </div>                      <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="font-medium mb-3">Header Background Gradient</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="header_bg_color_from" class="block text-sm font-medium text-gray-700 mb-1">Header Gradient From Color</label>
                                <input type="color" name="header_bg_color_from" id="header_bg_color_from" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['header_bg_color_from']->value ?? '#2563eb' }}">
                                <p class="mt-1 text-sm text-gray-500">Starting color for header background gradient</p>
                            </div>
                            
                            <div>
                                <label for="header_bg_color_to" class="block text-sm font-medium text-gray-700 mb-1">Header Gradient To Color</label>
                                <input type="color" name="header_bg_color_to" id="header_bg_color_to" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['header_bg_color_to']->value ?? '#3b82f6' }}">
                                <p class="mt-1 text-sm text-gray-500">Ending color for header background gradient</p>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-white rounded border">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <div class="w-full h-10 rounded-md" id="header_gradient_preview" style="background: linear-gradient(to right, {{ $appearanceSettings['header_bg_color_from']->value ?? '#2563eb' }}, {{ $appearanceSettings['header_bg_color_to']->value ?? '#3b82f6' }});"></div>
                        </div>
                    </div>                      <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="font-medium mb-3">Footer Background Gradient</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="footer_bg_color_from" class="block text-sm font-medium text-gray-700 mb-1">Footer Gradient From Color</label>
                                <input type="color" name="footer_bg_color_from" id="footer_bg_color_from" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['footer_bg_color_from']->value ?? '#1e3a8a' }}">
                                <p class="mt-1 text-sm text-gray-500">Starting color for footer background gradient</p>
                            </div>
                            
                            <div>
                                <label for="footer_bg_color_to" class="block text-sm font-medium text-gray-700 mb-1">Footer Gradient To Color</label>
                                <input type="color" name="footer_bg_color_to" id="footer_bg_color_to" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['footer_bg_color_to']->value ?? '#1e40af' }}">
                                <p class="mt-1 text-sm text-gray-500">Ending color for footer background gradient</p>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-white rounded border">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <div class="w-full h-10 rounded-md" id="footer_gradient_preview" style="background: linear-gradient(to right, {{ $appearanceSettings['footer_bg_color_from']->value ?? '#1e3a8a' }}, {{ $appearanceSettings['footer_bg_color_to']->value ?? '#1e40af' }});"></div>
                        </div>                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="font-medium mb-3">Icon Colors</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="icon_color_primary" class="block text-sm font-medium text-gray-700 mb-1">Primary Icon Color</label>
                                <input type="color" name="icon_color_primary" id="icon_color_primary" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['icon_color_primary']->value ?? '#2563eb' }}">
                                <p class="mt-1 text-sm text-gray-500">Color for icons throughout the site</p>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-white rounded border">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <div class="flex items-center space-x-4">
                                <i class="fas fa-star text-blue-600 text-2xl" id="icon-preview-1"></i>
                                <i class="fas fa-heart text-blue-600 text-2xl" id="icon-preview-2"></i>
                                <i class="fas fa-map-marker-alt text-blue-600 text-2xl" id="icon-preview-3"></i>
                                <svg class="h-6 w-6 text-blue-600" id="icon-preview-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <h3 class="text-lg font-semibold mb-4 mt-8 border-b pb-2">Hero Section Settings</h3>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="font-medium mb-3">Hero Content</h4>
                        <div class="mb-4">
                            <label for="hero_heading" class="block text-sm font-medium text-gray-700 mb-1">Hero Heading</label>
                            <input type="text" name="hero_heading" id="hero_heading" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ $appearanceSettings['hero_heading']->value ?? 'Discover Your Perfect Getaway' }}">
                        </div>
                        
                        <div class="mb-4">
                            <label for="hero_subheading" class="block text-sm font-medium text-gray-700 mb-1">Hero Subheading</label>
                            <textarea name="hero_subheading" id="hero_subheading" rows="2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ $appearanceSettings['hero_subheading']->value ?? 'Explore exclusive vacation packages and create memories that last a lifetime' }}</textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Current Hero Background</label>
                            <div class="border rounded-md p-2 bg-white">
                                @if(isset($appearanceSettings['hero_bg_image']) && $appearanceSettings['hero_bg_image']->value)
                                    <img src="{{ filter_var($appearanceSettings['hero_bg_image']->value, FILTER_VALIDATE_URL) 
                                        ? $appearanceSettings['hero_bg_image']->value 
                                        : asset($appearanceSettings['hero_bg_image']->value) }}" 
                                        alt="Hero Background" 
                                        class="h-32 w-full object-cover rounded">
                                @else
                                    <div class="h-32 w-full bg-gray-200 flex items-center justify-center rounded">
                                        <span class="text-gray-400">Default background image</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="hero_bg_image" class="block text-sm font-medium text-gray-700 mb-1">Upload New Hero Background</label>
                            <input type="file" name="hero_bg_image" id="hero_bg_image" class="w-full border border-gray-300 px-3 py-2 rounded-md">
                            <p class="mt-1 text-sm text-gray-500">
                                Recommended size: 1920x1080 pixels. High quality JPG or PNG.
                            </p>
                        </div>
                    </div>
                    
                    <h3 class="text-lg font-semibold mb-4 mt-8 border-b pb-2">Image Overlay and Title Background Settings</h3>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="font-medium mb-3">Image Overlay Gradient</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="overlay_bg_color_from" class="block text-sm font-medium text-gray-700 mb-1">Image Overlay From Color</label>
                                <input type="color" name="overlay_bg_color_from" id="overlay_bg_color_from" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['overlay_bg_color_from']->value ?? 'rgba(0,0,0,0.7)' }}">
                                <p class="mt-1 text-sm text-gray-500">Starting color for image overlay gradient</p>
                            </div>
                            
                            <div>
                                <label for="overlay_bg_color_to" class="block text-sm font-medium text-gray-700 mb-1">Image Overlay To Color</label>
                                <input type="color" name="overlay_bg_color_to" id="overlay_bg_color_to" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['overlay_bg_color_to']->value ?? 'rgba(0,0,0,0.4)' }}">
                                <p class="mt-1 text-sm text-gray-500">Ending color for image overlay gradient</p>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-white rounded border">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <div class="w-full h-10 rounded-md" id="overlay_gradient_preview" style="background: linear-gradient(to right, {{ $appearanceSettings['overlay_bg_color_from']->value ?? 'rgba(0,0,0,0.7)' }}, {{ $appearanceSettings['overlay_bg_color_to']->value ?? 'rgba(0,0,0,0.4)' }});"></div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h4 class="font-medium mb-3">Page Title Background Gradient</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="page_title_bg_color_from" class="block text-sm font-medium text-gray-700 mb-1">Page Title From Color</label>
                                <input type="color" name="page_title_bg_color_from" id="page_title_bg_color_from" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['page_title_bg_color_from']->value ?? '#2563eb' }}">
                                <p class="mt-1 text-sm text-gray-500">Starting color for page title background gradient</p>
                            </div>
                            
                            <div>
                                <label for="page_title_bg_color_to" class="block text-sm font-medium text-gray-700 mb-1">Page Title To Color</label>
                                <input type="color" name="page_title_bg_color_to" id="page_title_bg_color_to" 
                                       class="w-full h-10 rounded-md border border-gray-300 cursor-pointer" 
                                       value="{{ $appearanceSettings['page_title_bg_color_to']->value ?? '#4f46e5' }}">
                                <p class="mt-1 text-sm text-gray-500">Ending color for page title background gradient</p>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-white rounded border">
                            <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                            <div class="w-full h-10 rounded-md" id="page_title_gradient_preview" style="background: linear-gradient(to right, {{ $appearanceSettings['page_title_bg_color_from']->value ?? '#2563eb' }}, {{ $appearanceSettings['page_title_bg_color_to']->value ?? '#4f46e5' }});"></div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Save Appearance Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Contact Settings -->
        <div class="tab-content hidden" id="contact-content" role="tabpanel" aria-labelledby="contact-tab">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
                
                <form action="{{ route('admin.settings.update.contact') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">Company Address</label>
                            <input type="text" name="company_address" id="company_address" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ $contactSettings['company_address']->value ?? '123 Travel Way, Orlando, FL 32819' }}">
                        </div>
                        
                        <div>
                            <label for="company_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="text" name="company_phone" id="company_phone" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ $contactSettings['company_phone']->value ?? '1-800-MYTRAVEL' }}">
                        </div>
                        
                        <div>
                            <label for="company_email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="company_email" id="company_email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ $contactSettings['company_email']->value ?? 'info@mytravel.com' }}">
                        </div>
                        
                        <div>
                            <label for="office_hours" class="block text-sm font-medium text-gray-700 mb-1">Office Hours</label>
                            <input type="text" name="office_hours" id="office_hours" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ $contactSettings['office_hours']->value ?? 'Mon-Fri: 9AM-9PM EST' }}">
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Save Contact Information
                        </button>
                    </div>
                </form>
            </div>
        </div>

      
<!-- Display Settings Tab Content (Add this to the tab content area in index.blade.php) -->
<div class="tab-content hidden" id="display-content" role="tabpanel" aria-labelledby="display-tab">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Display Count Settings</h2>
        
        <form action="{{ route('admin.settings.update.display') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="home_bundles_count" class="block text-sm font-medium text-gray-700 mb-1">Home Page Bundles</label>
                    <input type="number" min="1" max="12" name="home_bundles_count" id="home_bundles_count" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ $displaySettings['home_bundles_count']->value ?? '6' }}">
                    <p class="mt-1 text-sm text-gray-500">
                        Number of vacation bundles to display on the home page
                    </p>
                </div>
                
                <div>
                    <label for="home_destinations_count" class="block text-sm font-medium text-gray-700 mb-1">Home Page Destinations</label>
                    <input type="number" min="1" max="12" name="home_destinations_count" id="home_destinations_count" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ $displaySettings['home_destinations_count']->value ?? '6' }}">
                    <p class="mt-1 text-sm text-gray-500">
                        Number of destinations to display on the home page
                    </p>
                </div>
                
                <div>
                    <label for="testimonials_count" class="block text-sm font-medium text-gray-700 mb-1">Testimonials Count</label>
                    <input type="number" min="1" max="12" name="testimonials_count" id="testimonials_count" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" value="{{ $displaySettings['testimonials_count']->value ?? '8' }}">
                    <p class="mt-1 text-sm text-gray-500">
                        Number of testimonials to display on the home page
                    </p>
                </div>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Save Display Settings
                </button>
            </div>
        </form>
    </div>
</div>

        <!-- Captcha Settings Tab Content -->
        <div class="tab-content hidden" id="captcha-content" role="tabpanel" aria-labelledby="captcha-tab">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">CAPTCHA Settings</h2>
                
                <div class="p-4 mb-6 bg-blue-50 text-blue-700 border-l-4 border-blue-500 rounded">
                    <p>Configure Cloudflare Turnstile CAPTCHA to protect your forms from spam and bot submissions.</p>
                    <p class="mt-2">
                        <a href="{{ route('admin.settings.captcha') }}" class="text-blue-700 underline hover:text-blue-900">
                            Go to CAPTCHA Settings →
                        </a>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab functionality
        const tabs = document.querySelectorAll('[data-tab-target]');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Hide all tab contents
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                    content.classList.remove('active');
                });
                
                // Deactivate all tabs
                tabs.forEach(t => {
                    t.classList.remove('border-blue-600');
                    t.classList.add('border-transparent');
                    t.classList.remove('active');
                    t.setAttribute('aria-selected', 'false');
                });
                
                // Activate clicked tab
                tab.classList.add('border-blue-600');
                tab.classList.remove('border-transparent');
                tab.classList.add('active');
                tab.setAttribute('aria-selected', 'true');
                
                // Show corresponding content
                const targetId = tab.getAttribute('data-tab-target');
                const targetContent = document.getElementById(targetId);
                targetContent.classList.remove('hidden');
                targetContent.classList.add('active');
            });
        });
        
        // Color preview functionality
        function updateColorPreview(selectId, previewId) {
            const select = document.getElementById(selectId);
            const preview = document.getElementById(previewId);
            
            if (select && preview) {
                select.addEventListener('change', function() {
                    // Remove all existing color classes
                    const classesToRemove = Array.from(preview.classList).filter(className => 
                        className.startsWith('bg-')
                    );
                    
                    classesToRemove.forEach(className => {
                        preview.classList.remove(className);
                    });
                    
                    // Add the new color class
                    preview.classList.add('bg-' + this.value);
                });
            }
        }
        
        function updateGradientPreview(fromSelectId, toSelectId, previewId) {
            const fromSelect = document.getElementById(fromSelectId);
            const toSelect = document.getElementById(toSelectId);
            const preview = document.getElementById(previewId);
            
            if (fromSelect && toSelect && preview) {
                const updateGradient = function() {
                    // Remove all existing gradient classes
                    const classesToRemove = Array.from(preview.classList).filter(className => 
                        className.startsWith('from-') || className.startsWith('to-')
                    );
                    
                    classesToRemove.forEach(className => {
                        preview.classList.remove(className);
                    });
                    
                    // Add the new gradient classes
                    preview.classList.add('from-' + fromSelect.value);
                    preview.classList.add('to-' + toSelect.value);
                };
                
                fromSelect.addEventListener('change', updateGradient);
                toSelect.addEventListener('change', updateGradient);
            }
        }
        
        // Initialize color previews
        updateColorPreview('header_bg_color_from', 'header_from_preview');
        updateColorPreview('header_bg_color_to', 'header_to_preview');
        updateColorPreview('footer_bg_color_from', 'footer_from_preview');
        updateColorPreview('footer_bg_color_to', 'footer_to_preview');
          // Initialize gradient previews
        updateGradientPreview('header_bg_color_from', 'header_bg_color_to', 'header_gradient_preview');
        updateGradientPreview('footer_bg_color_from', 'footer_bg_color_to', 'footer_gradient_preview');
        
        // Button color preview functionality
        const primaryColorInput = document.getElementById('primary_button_color');
        const primaryHoverColorInput = document.getElementById('primary_button_hover_color');
        const buttonPreview = document.getElementById('button-color-preview');
          if (primaryColorInput && buttonPreview) {
            primaryColorInput.addEventListener('input', function() {
                buttonPreview.style.backgroundColor = this.value;
            });
            // Initialize with current value
            buttonPreview.style.backgroundColor = primaryColorInput.value;
        }
        
        if (primaryHoverColorInput && buttonPreview) {
            primaryHoverColorInput.addEventListener('input', function() {
                buttonPreview.setAttribute('data-hover-color', this.value);
            });
            
            // Add hover functionality
            buttonPreview.addEventListener('mouseenter', function() {
                const hoverColor = this.getAttribute('data-hover-color');
                if (hoverColor) {
                    this.style.backgroundColor = hoverColor;
                }
            });
            
            buttonPreview.addEventListener('mouseleave', function() {
                const normalColor = primaryColorInput.value;
                this.style.backgroundColor = normalColor;
            });
        }
        
        // Gradient button color preview functionality
        const primaryGradientFromInput = document.getElementById('primary_gradient_from');
        const primaryGradientToInput = document.getElementById('primary_gradient_to');
        const primaryGradientHoverFromInput = document.getElementById('primary_gradient_hover_from');
        const primaryGradientHoverToInput = document.getElementById('primary_gradient_hover_to');
        const gradientButtonPreview = document.getElementById('gradient-button-preview');
        
        const secondaryGradientFromInput = document.getElementById('secondary_gradient_from');
        const secondaryGradientToInput = document.getElementById('secondary_gradient_to');
        const secondaryGradientHoverFromInput = document.getElementById('secondary_gradient_hover_from');
        const secondaryGradientHoverToInput = document.getElementById('secondary_gradient_hover_to');
        const secondaryGradientButtonPreview = document.getElementById('secondary-gradient-button-preview');
        
        function updateGradientPreview() {
            if (primaryGradientFromInput && primaryGradientToInput && gradientButtonPreview) {
                const fromColor = primaryGradientFromInput.value;
                const toColor = primaryGradientToInput.value;
                gradientButtonPreview.style.background = `linear-gradient(to right, ${fromColor}, ${toColor})`;
                
                // Store hover colors for hover effect
                if (primaryGradientHoverFromInput && primaryGradientHoverToInput) {
                    gradientButtonPreview.setAttribute('data-hover-from', primaryGradientHoverFromInput.value);
                    gradientButtonPreview.setAttribute('data-hover-to', primaryGradientHoverToInput.value);
                }
            }
        }
        
        function updateSecondaryGradientPreview() {
            if (secondaryGradientFromInput && secondaryGradientToInput && secondaryGradientButtonPreview) {
                const fromColor = secondaryGradientFromInput.value;
                const toColor = secondaryGradientToInput.value;
                secondaryGradientButtonPreview.style.background = `linear-gradient(to right, ${fromColor}, ${toColor})`;
                
                // Store hover colors for hover effect
                if (secondaryGradientHoverFromInput && secondaryGradientHoverToInput) {
                    secondaryGradientButtonPreview.setAttribute('data-hover-from', secondaryGradientHoverFromInput.value);
                    secondaryGradientButtonPreview.setAttribute('data-hover-to', secondaryGradientHoverToInput.value);
                }
            }
        }
        
        // Primary gradient event listeners
        if (primaryGradientFromInput) {
            primaryGradientFromInput.addEventListener('input', updateGradientPreview);
        }
        if (primaryGradientToInput) {
            primaryGradientToInput.addEventListener('input', updateGradientPreview);
        }
        if (primaryGradientHoverFromInput) {
            primaryGradientHoverFromInput.addEventListener('input', updateGradientPreview);
        }
        if (primaryGradientHoverToInput) {
            primaryGradientHoverToInput.addEventListener('input', updateGradientPreview);
        }
        
        // Secondary gradient event listeners
        if (secondaryGradientFromInput) {
            secondaryGradientFromInput.addEventListener('input', updateSecondaryGradientPreview);
        }
        if (secondaryGradientToInput) {
            secondaryGradientToInput.addEventListener('input', updateSecondaryGradientPreview);
        }
        if (secondaryGradientHoverFromInput) {
            secondaryGradientHoverFromInput.addEventListener('input', updateSecondaryGradientPreview);
        }
        if (secondaryGradientHoverToInput) {
            secondaryGradientHoverToInput.addEventListener('input', updateSecondaryGradientPreview);
        }
        
        // Add hover functionality for gradient previews
        if (gradientButtonPreview) {
            gradientButtonPreview.addEventListener('mouseenter', function() {
                const hoverFrom = this.getAttribute('data-hover-from');
                const hoverTo = this.getAttribute('data-hover-to');
                if (hoverFrom && hoverTo) {
                    this.style.background = `linear-gradient(to right, ${hoverFrom}, ${hoverTo})`;
                }
            });
            
            gradientButtonPreview.addEventListener('mouseleave', function() {
                updateGradientPreview();
            });
        }
        
        if (secondaryGradientButtonPreview) {
            secondaryGradientButtonPreview.addEventListener('mouseenter', function() {
                const hoverFrom = this.getAttribute('data-hover-from');
                const hoverTo = this.getAttribute('data-hover-to');
                if (hoverFrom && hoverTo) {
                    this.style.background = `linear-gradient(to right, ${hoverFrom}, ${hoverTo})`;
                }
            });
            
            secondaryGradientButtonPreview.addEventListener('mouseleave', function() {
                updateSecondaryGradientPreview();
            });
        }        // Header Background Gradient color picker functionality
        const headerBgFromInput = document.getElementById('header_bg_color_from');
        const headerBgToInput = document.getElementById('header_bg_color_to');
        const headerGradientPreview = document.getElementById('header_gradient_preview');
        
        // Footer Background Gradient color picker functionality
        const footerBgFromInput = document.getElementById('footer_bg_color_from');
        const footerBgToInput = document.getElementById('footer_bg_color_to');
        const footerGradientPreview = document.getElementById('footer_gradient_preview');

        // Header gradient color preview functions
        function updateHeaderGradientPreview() {
            if (headerBgFromInput && headerBgToInput && headerGradientPreview) {
                const fromColor = headerBgFromInput.value;
                const toColor = headerBgToInput.value;
                headerGradientPreview.style.background = `linear-gradient(to right, ${fromColor}, ${toColor})`;
            }
        }

        // Footer gradient color preview functions
        function updateFooterGradientPreview() {
            if (footerBgFromInput && footerBgToInput && footerGradientPreview) {
                const fromColor = footerBgFromInput.value;
                const toColor = footerBgToInput.value;
                footerGradientPreview.style.background = `linear-gradient(to right, ${fromColor}, ${toColor})`;
            }
        }

        // Header gradient event listeners
        if (headerBgFromInput) {
            headerBgFromInput.addEventListener('input', updateHeaderGradientPreview);
        }
        if (headerBgToInput) {
            headerBgToInput.addEventListener('input', updateHeaderGradientPreview);
        }        // Footer gradient event listeners
        if (footerBgFromInput) {
            footerBgFromInput.addEventListener('input', updateFooterGradientPreview);
        }
        if (footerBgToInput) {
            footerBgToInput.addEventListener('input', updateFooterGradientPreview);
        }
        
        // Image overlay and page title gradients
        const overlayBgFromInput = document.getElementById('overlay_bg_color_from');
        const overlayBgToInput = document.getElementById('overlay_bg_color_to');
        const overlayGradientPreview = document.getElementById('overlay_gradient_preview');
        
        const pageTitleBgFromInput = document.getElementById('page_title_bg_color_from');
        const pageTitleBgToInput = document.getElementById('page_title_bg_color_to');
        const pageTitleGradientPreview = document.getElementById('page_title_gradient_preview');
        
        // Overlay gradient preview function
        function updateOverlayGradientPreview() {
            if (overlayBgFromInput && overlayBgToInput && overlayGradientPreview) {
                const fromColor = overlayBgFromInput.value;
                const toColor = overlayBgToInput.value;
                overlayGradientPreview.style.background = `linear-gradient(to right, ${fromColor}, ${toColor})`;
            }
        }
        
        // Page title gradient preview function
        function updatePageTitleGradientPreview() {
            if (pageTitleBgFromInput && pageTitleBgToInput && pageTitleGradientPreview) {
                const fromColor = pageTitleBgFromInput.value;
                const toColor = pageTitleBgToInput.value;
                pageTitleGradientPreview.style.background = `linear-gradient(to right, ${fromColor}, ${toColor})`;
            }
        }
        
        // Image overlay gradient event listeners
        if (overlayBgFromInput) {
            overlayBgFromInput.addEventListener('input', updateOverlayGradientPreview);
        }
        if (overlayBgToInput) {
            overlayBgToInput.addEventListener('input', updateOverlayGradientPreview);
        }
        
        // Page title gradient event listeners
        if (pageTitleBgFromInput) {
            pageTitleBgFromInput.addEventListener('input', updatePageTitleGradientPreview);
        }
        if (pageTitleBgToInput) {
            pageTitleBgToInput.addEventListener('input', updatePageTitleGradientPreview);
        }        // Initialize gradient previews on page load
        updateHeaderGradientPreview();
        updateFooterGradientPreview();
        updateOverlayGradientPreview();
        updatePageTitleGradientPreview();
        
        // Icon color preview functionality
        const iconColorInput = document.getElementById('icon_color_primary');
        const iconPreviews = [
            document.getElementById('icon-preview-1'),
            document.getElementById('icon-preview-2'),
            document.getElementById('icon-preview-3'),
            document.getElementById('icon-preview-4')
        ];
          function updateIconColorPreview() {
            if (iconColorInput && iconPreviews.length > 0) {
                const color = iconColorInput.value;
                iconPreviews.forEach(icon => {
                    if (icon) {
                        icon.style.color = color;
                    }
                });
            }
        }
        
        if (iconColorInput) {
            iconColorInput.addEventListener('input', updateIconColorPreview);
            // Make sure initial value is set
            iconColorInput.dispatchEvent(new Event('input'));
        }
        
        // Initialize icon color preview
        updateIconColorPreview();
    });
</script>
@endpush
@endsection