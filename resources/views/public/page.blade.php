@extends('public.layout')

@section('title', $page->meta_title ?? $page->title)
@section('meta_description', $page->meta_description ?? $page->title)

@section('content')

{{-- BREADCRUMB --}}
<div class="bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200 py-6">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm text-gray-600 space-x-2">
            <a href="{{ route('landing') }}" class="hover:text-blue-600 transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2.83-2.83a1 1 0 011.41 0L12 12m0 0l3.76-3.76a1 1 0 011.41 0L21 12M5 6h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"></path></svg>
                Beranda
            </a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 font-semibold">{{ $page->title }}</span>
        </div>
    </div>
</div>

{{-- CONTENT --}}
<div class="container mx-auto py-20 px-4">
    <article class="max-w-3xl mx-auto" data-aos="fade-up">
        <div class="mb-12">
            <h1 class="text-5xl font-bold mb-4 gradient-text">{{ $page->title }}</h1>
            <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-blue-600"></div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12" data-aos="fade-up" data-aos-delay="100">
            <div class="prose prose-lg max-w-none">
                {!! $page->content !!}
            </div>
        </div>

        {{-- Back Button --}}
        <div class="mt-12 flex justify-center" data-aos="fade-up" data-aos-delay="200">
            <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </article>
</div>

@endsection
