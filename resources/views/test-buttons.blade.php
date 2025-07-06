@extends('layouts.app')

@section('title', 'Dynamic Button Colors Test')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-8">Dynamic Button Colors Test</h1>
        <p class="text-center text-gray-600 mb-12">This page demonstrates the dynamic button color system. Change the button colors in the admin panel to see them update across the entire website.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">            <!-- Dynamic Color Buttons (Should Use CSS Variables) -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Dynamic Color Buttons</h3>
                <div class="space-y-3">
                    <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-colors">
                        Primary Button (Dynamic)
                    </button>
                    <button class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">
                        Secondary Style (Dynamic)
                    </button>
                    <button class="w-full bg-blue-700 text-white py-2 px-4 rounded-md hover:bg-blue-800 transition-colors">
                        Dark Style (Dynamic)
                    </button>
                </div>
            </div>              <!-- Dynamic Gradient Buttons -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Dynamic Gradient Buttons</h3>
                <div class="space-y-3">
                    <button class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-2 px-4 rounded-md hover:from-blue-700 hover:to-indigo-800 transition-colors">
                        Primary Gradient Button
                    </button>
                    <a href="#" class="block w-full text-center py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-full font-semibold hover:from-blue-700 hover:to-indigo-800 transition-colors shadow-lg">
                        PRIMARY GRADIENT LINK
                    </a>
                    <button class="w-full bg-gradient-to-r from-blue-600 to-teal-500 text-white py-2 px-4 rounded-md hover:from-blue-700 hover:to-teal-600 transition-colors">
                        Secondary Gradient Button
                    </button>
                    <a href="#" class="block w-full text-center py-3 bg-gradient-to-r from-blue-600 to-teal-500 text-white rounded-full font-semibold hover:from-blue-700 hover:to-teal-600 transition-colors shadow-lg">
                        SECONDARY GRADIENT LINK
                    </a>
                </div>
            </div>
              <!-- Text and Border Colors (Dynamic) -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Text & Border Colors (Dynamic)</h3>
                <div class="space-y-3">
                    <button class="w-full border border-blue-600 text-blue-600 py-2 px-4 rounded-md hover:bg-blue-50 transition-colors">
                        Border Blue (Dynamic)
                    </button>
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">
                        Blue Link Text (Dynamic)
                    </a>
                    <input type="text" placeholder="Focus me (Dynamic ring)" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
              <!-- Icon Buttons (Dynamic) -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Icon Buttons (Dynamic)</h3>
                <div class="space-y-3">
                    <button class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition-colors mx-auto">
                        <i class="fas fa-play text-xl"></i>
                    </button>
                    <div class="flex justify-center space-x-2">
                        <button class="w-10 h-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button class="w-10 h-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="w-10 h-10 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">
                            <i class="fas fa-envelope"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Form Buttons -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Form Elements</h3>
                <div class="space-y-3">
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        Submit Button
                    </button>
                    <div class="flex space-x-2">
                        <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label class="text-sm text-gray-700">Checkbox with blue accent</label>
                    </div>
                </div>
            </div>
              <!-- Admin Style Buttons -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Admin Style</h3>
                <div class="space-y-3">
                    <button class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add New
                    </button>
                </div>
            </div>
            
            <!-- Dynamic Icon Colors -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4">Dynamic Icon Colors</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-center space-x-4">
                        <i class="fas fa-star text-blue-600 text-3xl"></i>
                        <i class="fas fa-heart text-blue-600 text-3xl"></i>
                        <i class="fas fa-map-marker-alt text-blue-600 text-3xl"></i>
                        <i class="fas fa-plane text-blue-600 text-3xl"></i>
                    </div>
                    <div class="flex items-center justify-center space-x-4">
                        <svg class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                        <svg class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600 text-center">These icons should change color when you update the "Primary Icon Color" setting in the admin panel.</p>
                </div>
            </div>        </div>
        
        <!-- Added Color Transparency Test Examples -->
        <div class="bg-white p-6 rounded-lg shadow-lg mt-8 col-span-3">
            <h3 class="text-lg font-semibold mb-4">Color Transparency Examples</h3>
            <p class="text-gray-600 mb-4">These examples demonstrate the RGB color transparency support.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Card with hover effect -->
                <div class="card-hover bg-white p-4 rounded-lg border border-gray-200 transition-all duration-300">
                    <h4 class="font-medium text-gray-800">Card with Hover Effect</h4>
                    <p class="text-sm text-gray-600 mt-2">Hover over this card to see the shadow effect with dynamic color transparency.</p>
                </div>
                
                <!-- Button with rgba background -->
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <button class="w-full py-2 px-4 rounded-md transition-all duration-300" 
                           style="background-color: rgba(var(--primary-button-bg-rgb), 0.2); color: rgb(var(--primary-button-bg-rgb));">
                        Transparent Button
                    </button>
                </div>
                
                <!-- Text with rgba color -->
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <p class="text-center font-medium" style="color: rgba(var(--icon-color-primary-rgb), 0.7);">
                        Text with 70% opacity
                    </p>
                </div>
            </div>
        </div>
          
          <!-- Instructions -->
        <div class="mt-12 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">How to Test</h3>
            <ol class="list-decimal list-inside space-y-2 text-blue-700">
                <li>Go to <a href="{{ route('admin.settings.index') }}" class="text-blue-600 hover:text-blue-800 underline">Admin Settings → Appearance Tab</a></li>
                <li>Scroll down to the "Button Colors" and "Icon Colors" sections</li>
                <li>Change the "Primary Button Color", "Primary Button Hover Color", and "Primary Icon Color"</li>
                <li>Click "Save Appearance Settings"</li>
                <li>Return to this page and refresh to see the changes</li>
            </ol>
        </div><!-- Current Colors Display -->
        <div class="mt-8 bg-gray-50 rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-3">Current Button Colors</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Primary Icon Color</label>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded border" style="background-color: {{ setting('icon_color_primary', '#2563eb') }}"></div>
                        <span class="font-mono text-sm">{{ setting('icon_color_primary', '#2563eb') }}</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Primary Button Color</label>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded border" style="background-color: {{ setting('primary_button_color', '#2563eb') }}"></div>
                        <span class="font-mono text-sm">{{ setting('primary_button_color', '#2563eb') }}</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Primary Button Hover Color</label>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded border" style="background-color: {{ setting('primary_button_hover_color', '#1d4ed8') }}"></div>
                        <span class="font-mono text-sm">{{ setting('primary_button_hover_color', '#1d4ed8') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-6">
                <h4 class="text-lg font-semibold mb-3">Current Gradient Colors</h4>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white p-4 rounded-lg border">
                        <h5 class="font-medium mb-3">Primary Gradient</h5>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 rounded border" style="background-color: {{ setting('primary_gradient_from', '#2563eb') }}"></div>
                                <span class="text-sm">From: {{ setting('primary_gradient_from', '#2563eb') }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 rounded border" style="background-color: {{ setting('primary_gradient_to', '#4f46e5') }}"></div>
                                <span class="text-sm">To: {{ setting('primary_gradient_to', '#4f46e5') }}</span>
                            </div>
                            <div class="mt-2 w-full h-8 rounded" style="background: linear-gradient(to right, {{ setting('primary_gradient_from', '#2563eb') }}, {{ setting('primary_gradient_to', '#4f46e5') }})"></div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-4 rounded-lg border">
                        <h5 class="font-medium mb-3">Secondary Gradient</h5>
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 rounded border" style="background-color: {{ setting('secondary_gradient_from', '#14b8a6') }}"></div>
                                <span class="text-sm">From: {{ setting('secondary_gradient_from', '#14b8a6') }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 rounded border" style="background-color: {{ setting('secondary_gradient_to', '#0891b2') }}"></div>
                                <span class="text-sm">To: {{ setting('secondary_gradient_to', '#0891b2') }}</span>
                            </div>
                            <div class="mt-2 w-full h-8 rounded" style="background: linear-gradient(to right, {{ setting('secondary_gradient_from', '#14b8a6') }}, {{ setting('secondary_gradient_to', '#0891b2') }})"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
