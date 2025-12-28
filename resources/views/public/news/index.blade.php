@extends('public.layout')

@section('title','Berita & Pengumuman')
@section('meta_description', 'Baca berita dan pengumuman terbaru dari yayasan kami')

@section('content')

{{-- BREADCRUMB --}}
<div class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <div class="text-sm text-gray-600">
            <a href="{{ route('landing') }}" class="hover:text-blue-600">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 font-semibold">Berita</span>
        </div>
    </div>
</div>

{{-- HEADER --}}
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-2">Berita & Pengumuman</h1>
        <p class="text-blue-100">Informasi terbaru dari yayasan kami</p>
    </div>
</div>

{{-- NEWS LIST --}}
<div class="container mx-auto py-12 px-4">
    @if($news->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @foreach($news as $item)
        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition">
            @if($item->image)
            <div class="h-48 overflow-hidden">
                <img src="{{ asset('storage/'.$item->image) }}" 
                     alt="{{ $item->title }}" 
                     class="w-full h-full object-cover hover:scale-105 transition">
            </div>
            @else
            <div class="h-48 bg-gradient-to-r from-gray-300 to-gray-400 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            @endif

            <div class="p-6">
                <div class="text-sm text-blue-600 font-semibold mb-2">
                    {{ $item->published_at->translatedFormat('j F Y') }}
                </div>

                <h2 class="text-xl font-bold mb-3 line-clamp-2 hover:text-blue-600">
                    <a href="{{ route('news.show', $item->slug) }}">
                        {{ $item->title }}
                    </a>
                </h2>

                <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                    {{ $item->excerpt }}
                </p>

                <a href="{{ route('news.show', $item->slug) }}" 
                   class="text-blue-600 hover:text-blue-700 font-semibold inline-flex items-center transition">
                    Baca Selengkapnya
                    <span class="ml-2">→</span>
                </a>
            </div>
        </article>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="flex justify-center">
        {{ $news->links() }}
    </div>
    @else
    <div class="text-center py-16">
        <p class="text-gray-500 text-lg">Belum ada berita</p>
    </div>
    @endif
</div>

@endsection
