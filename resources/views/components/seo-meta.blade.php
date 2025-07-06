@php
// Default values
$title = $title ?? ($seoTitle ?? config('app.name'));
$description = $description ?? ($seoDescription ?? 'Book your perfect vacation with MyTravel. We offer exclusive travel packages for destinations worldwide.');
$keywords = $keywords ?? ($seoKeywords ?? 'travel, vacation, bookings, trip packages, destinations');
$ogImage = $ogImage ?? ($seoImage ?? asset('images/default-social-share.jpg'));
$ogType = $ogType ?? 'website';
$twitterCard = $twitterCard ?? 'summary_large_image';
$canonicalUrl = $canonicalUrl ?? request()->url();
$keywords = $keywords ?? ($seoKeywords ?? 'travel, vacation, bookings, trip packages, destinations');
$ogImage = $ogImage ?? ($seoImage ?? asset('images/default-social-share.jpg'));
$ogType = $ogType ?? 'website';
$twitterCard = $twitterCard ?? 'summary_large_image';
$canonicalUrl = $canonicalUrl ?? request()->url();
@endphp

<!-- SEO Meta Tags -->
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

<!-- Open Graph Meta Tags for Social Media -->
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:site_name" content="{{ config('app.name') }}">

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="{{ $twitterCard }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $ogImage }}">

<!-- Additional Meta Tags -->
<meta name="robots" content="index, follow">
<meta name="author" content="{{ config('app.name') }}">
