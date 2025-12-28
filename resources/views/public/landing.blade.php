@extends('public.layout')

@section('title', 'Beranda - Yayasan')
@section('meta_description', 'Selamat datang di website resmi yayasan kami.')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .hero-slider {
        position: relative;
        height: 500px;
    }
    
    .hero-slider .swiper-slide {
        position: relative;
        overflow: hidden;
    }
    
    .hero-slider .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .hero-slider .swiper-slide::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.6), rgba(29, 78, 216, 0.6));
        z-index: 2;
    }
    
    .hero-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        z-index: 3;
        width: 90%;
        max-width: 800px;
    }
    
    .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.5) !important;
    }
    
    .swiper-pagination-bullet-active {
        background: white !important;
    }
    
    .swiper-button-next,
    .swiper-button-prev {
        color: white !important;
        --swiper-navigation-size: 30px !important;
    }
</style>
@endpush

@section('content')

{{-- HERO SECTION WITH SLIDER --}}
<section class="relative">
    <div class="swiper hero-slider">
        <div class="swiper-wrapper">
            @if($sections->count() > 0)
                @foreach($sections as $section)
                    @if($section->image)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->title }}">
                        <div class="hero-content">
                            <h1 class="text-5xl font-bold mb-4">{{ $section->title }}</h1>
                            <p class="text-xl mb-8 text-blue-100 line-clamp-3">{{ strip_tags($section->content) }}</p>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif
            
            {{-- Fallback slide jika tidak ada gambar section --}}
            <div class="swiper-slide bg-gradient-to-r from-blue-600 to-blue-800">
                <div class="hero-content">
                    <h1 class="text-5xl font-bold mb-4">Selamat Datang</h1>
                    <p class="text-xl mb-8 text-blue-100">{{ $settings->site_name ?? 'Bersama membangun masa depan yang lebih baik' }}</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>

    {{-- CTA Buttons --}}
    <div class="absolute bottom-8 left-0 right-0 flex gap-4 justify-center z-10">
        <a href="{{ route('profil') }}" class="bg-white text-blue-600 px-8 py-3 rounded font-semibold hover:bg-gray-100 transition">
            Tentang Kami
        </a>
        <a href="{{ route('news.index') }}" class="border-2 border-white text-white px-8 py-3 rounded font-semibold hover:bg-blue-700 transition">
            Berita
        </a>
    </div>
</section>

{{-- DYNAMIC SECTIONS --}}
@foreach($sections as $section)
<section class="py-16 @if($loop->even) bg-gray-50 @endif">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl font-bold mb-6 text-blue-600">{{ $section->title }}</h2>

            @if($section->image)
            <div class="mb-8">
                <img src="{{ asset('storage/' . $section->image) }}" alt="{{ $section->title }}" class="w-full h-96 object-cover rounded-lg shadow">
            </div>
            @endif

            <div class="prose prose-lg max-w-none text-gray-700">
                {!! $section->content !!}
            </div>
        </div>
    </div>
</section>
@endforeach

{{-- LATEST NEWS SECTION --}}
<section class="py-16 bg-gray-900 text-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-2">Berita & Pengumuman</h2>
            <p class="text-gray-300">Informasi terbaru dari yayasan kami</p>
        </div>

        @if($latestNews->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            @foreach($latestNews as $news)
            <article class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition">
                @if($news->image)
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover hover:scale-105 transition">
                </div>
                @endif

                <div class="p-6">
                    <div class="text-sm text-blue-400 mb-2">
                        {{ $news->published_at->translatedFormat('j F Y') }}
                    </div>

                    <h3 class="text-xl font-bold mb-3 line-clamp-2">
                        {{ $news->title }}
                    </h3>

                    <p class="text-gray-300 text-sm line-clamp-3 mb-4">
                        {{ $news->excerpt }}
                    </p>

                    <a href="{{ route('news.show', $news->slug) }}" class="text-blue-400 hover:text-blue-300 font-semibold inline-flex items-center">
                        Baca Selengkapnya
                        <span class="ml-2">→</span>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center">
            <a href="{{ route('news.index') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded font-semibold hover:bg-blue-700 transition">
                Lihat Semua Berita
            </a>
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-gray-400 text-lg">Belum ada berita terbaru</p>
        </div>
        @endif
    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-16 bg-blue-600 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Punya Pertanyaan?</h2>
        <p class="text-lg mb-8 text-blue-100">Hubungi kami melalui halaman kontak atau media sosial</p>
        <a href="{{ route('kontak') }}" class="bg-white text-blue-600 px-8 py-3 rounded font-semibold hover:bg-gray-100 transition inline-block">
            Hubungi Kami
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const heroSlider = new Swiper('.hero-slider', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });
</script>
@endpush
