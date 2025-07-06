<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ setting('company_name', 'MyTravel') }}</title>
    
    <!-- SEO and Social Media Sharing Meta Tags -->
    <x-seo-meta 
        :title="$seoTitle ?? View::getSection('title'). ' - '.setting('company_name', 'MyTravel')"
        :description="$seoDescription ?? ''"
        :keywords="$seoKeywords ?? ''"
        :ogImage="$seoImage ?? ''"
        :ogType="$seoType ?? 'website'"
        :canonicalUrl="$canonicalUrl ?? request()->url()"
    />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
      <!-- Dynamic Button Colors CSS -->
      <link rel="stylesheet" href="{{ secure_url(route('dynamic.css', [], false)) }}?v={{ \App\Models\Admin\Setting::get('css_version', time()) }}" type="text/css">
    <style>
       
        input:focus{
            outline:none !important; 
        }   
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <x-header />
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    <x-footer />
    
    
    @stack('scripts')
    
   
</body>
</html>