@extends('layouts.app')

@section('title', $page->meta_title ?: $page->title)

@section('meta')
    <meta name="description" content="{{ $page->meta_description }}">
    @if($page->marketing_image)
        <meta property="og:image" content="{{ Storage::url($page->marketing_image) }}">
    @endif
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $page->title }}</h1>
        <div class="prose max-w-none text-gray-700">
            {!! nl2br(e($page->content)) !!}
        </div>
    </div>
</div>
@endsection 