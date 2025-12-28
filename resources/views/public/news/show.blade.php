@extends('public.layout')

@section('title', $news->meta_title ?? $news->title)
@section('meta_description', $news->meta_description ?? $news->excerpt)

@section('content')

{{-- BREADCRUMB --}}
<div class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <div class="text-sm text-gray-600">
            <a href="{{ route('landing') }}" class="hover:text-blue-600">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('news.index') }}" class="hover:text-blue-600">Berita</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 font-semibold">{{ $news->title }}</span>
        </div>
    </div>
</div>

{{-- ARTICLE --}}
<article class="container mx-auto py-12 px-4">
    <div class="max-w-3xl mx-auto">
        {{-- HEADER --}}
        <header class="mb-8">
            <h1 class="text-4xl font-bold mb-4 text-gray-900">{{ $news->title }}</h1>
            
            <div class="flex items-center justify-between text-gray-600 pb-6 border-b-2 border-gray-200">
                <div class="flex items-center space-x-4">
                    @if($news->author)
                    <div>
                        <p class="font-semibold text-gray-800">{{ $news->author->name }}</p>
                        <p class="text-sm">Penulis</p>
                    </div>
                    @endif
                </div>
                <div class="text-right">
                    <p class="font-semibold text-gray-800">{{ $news->published_at->translatedFormat('j F Y') }}</p>
                    <p class="text-sm">Dipublikasikan</p>
                </div>
            </div>
        </header>

        {{-- FEATURED IMAGE --}}
        @if($news->image)
        <div class="mb-8">
            <img src="{{ asset('storage/'.$news->image) }}"
                 alt="{{ $news->title }}" 
                 class="w-full h-96 object-cover rounded-lg shadow-lg">
        </div>
        @endif

        {{-- CONTENT --}}
        <div class="prose prose-lg max-w-none mb-12">
            {!! $news->content !!}
        </div>

        {{-- BACK BUTTON --}}
        <div class="text-center pt-8 border-t-2 border-gray-200">
            <a href="{{ route('news.index') }}" 
               class="inline-block bg-blue-600 text-white px-6 py-3 rounded font-semibold hover:bg-blue-700 transition">
                ← Kembali ke Berita
            </a>
        </div>
    </div>
</article>

@endsection
