@extends('public.layout')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description ?? $page->title)

@section('content')

{{-- BREADCRUMB --}}
<div class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <div class="text-sm text-gray-600">
            <a href="{{ route('landing') }}" class="hover:text-blue-600">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 font-semibold">{{ $page->title }}</span>
        </div>
    </div>
</div>

{{-- CONTENT --}}
<div class="container mx-auto py-16 px-4">
    <article class="max-w-3xl mx-auto">
        <h1 class="text-4xl font-bold mb-2 text-gray-900">{{ $page->title }}</h1>
        
        <div class="border-t-2 border-blue-600 pt-8">
            <div class="prose prose-lg max-w-none">
                {!! $page->content !!}
            </div>
        </div>
    </article>
</div>

@endsection
