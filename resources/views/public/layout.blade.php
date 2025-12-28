<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Yayasan')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO BASIC --}}
    <meta name="description" content="@yield('meta_description','Website resmi yayasan')">

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- AOS (Animate On Scroll) --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    <style>
        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Navbar transition */
        header {
            transition: all 0.3s ease;
        }

        /* Button hover effects */
        .btn-primary {
            @apply inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5;
        }

        .btn-secondary {
            @apply inline-block px-6 py-3 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-50 hover:shadow-lg;
        }

        /* Card hover effect */
        .card-hover {
            @apply transition-all duration-300 hover:shadow-xl hover:-translate-y-1;
        }

        /* Gradient text */
        .gradient-text {
            @apply bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white text-gray-900 leading-relaxed">

    {{-- NAVBAR --}}
    @php
        $settings = \App\Models\Setting::first();
        $menus = \App\Models\Menu::active()->get();
    @endphp

    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 backdrop-blur-sm bg-opacity-95">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="font-bold text-2xl gradient-text hover:opacity-80 transition">
                {{ $settings->site_name ?? 'Yayasan' }}
            </a>

            <nav class="space-x-1 hidden md:flex">
                @forelse($menus as $menu)
                    <a href="{{ $menu->url }}" class="px-3 py-2 rounded-lg text-gray-700 font-medium transition-all duration-300 hover:bg-blue-50 hover:text-blue-600">
                        {{ $menu->title }}
                    </a>
                @empty
                    <span class="text-gray-500">Belum ada menu</span>
                @endforelse
            </nav>

            {{-- Mobile Menu Button --}}
            <button class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition" id="mobileMenuBtn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-100">
            <div class="container mx-auto px-4 py-3 space-y-1">
                @forelse($menus as $menu)
                    <a href="{{ $menu->url }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300">
                        {{ $menu->title }}
                    </a>
                @empty
                    <span class="text-gray-500 block py-2">Belum ada menu</span>
                @endforelse
            </div>
        </div>
    </header>

    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gradient-to-br from-slate-900 to-slate-800 text-gray-300 mt-20 border-t border-slate-700">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div data-aos="fade-up">
                    <h3 class="font-bold text-white mb-3 text-lg gradient-text">{{ $settings->site_name ?? 'Yayasan' }}</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Website resmi yayasan yang berdedikasi untuk memberikan pelayanan terbaik bagi masyarakat.
                    </p>
                    @if($settings && ($settings->facebook || $settings->instagram || $settings->youtube))
                    <div class="flex gap-3 mt-4">
                        @if($settings->facebook)
                        <a href="{{ $settings->facebook }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-700 hover:bg-blue-600 flex items-center justify-center transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        @endif
                        @if($settings->instagram)
                        <a href="{{ $settings->instagram }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-700 hover:bg-pink-600 flex items-center justify-center transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm4.441 15.892c0 2.297-1.852 4.157-4.157 4.157H11.716c-2.305 0-4.157-1.86-4.157-4.157V11.716c0-2.305 1.852-4.157 4.157-4.157h.568c2.305 0 4.157 1.852 4.157 4.157v4.176z"/></svg>
                        </a>
                        @endif
                        @if($settings->youtube)
                        <a href="{{ $settings->youtube }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-700 hover:bg-red-600 flex items-center justify-center transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>

                <div data-aos="fade-up" data-aos-delay="100">
                    <h3 class="font-bold text-white mb-4 text-lg">Menu Navigasi</h3>
                    <ul class="space-y-2 text-sm">
                        @forelse($menus as $menu)
                            <li><a href="{{ $menu->url }}" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">{{ $menu->title }}</a></li>
                        @empty
                            <li class="text-gray-500">Belum ada menu</li>
                        @endforelse
                    </ul>
                </div>

                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="font-bold text-white mb-4 text-lg">Kontak Kami</h3>
                    @if($settings)
                        @if($settings->address)
                        <p class="text-sm text-gray-400 mb-3 flex items-start gap-2">
                            <span class="text-blue-400 mt-1">📍</span>
                            <span>{{ $settings->address }}</span>
                        </p>
                        @endif
                        @if($settings->phone)
                        <p class="text-sm text-gray-400 mb-3 flex items-center gap-2">
                            <span class="text-blue-400">📞</span>
                            <a href="tel:{{ $settings->phone }}" class="hover:text-blue-400 transition-colors duration-300">{{ $settings->phone }}</a>
                        </p>
                        @endif
                        @if($settings->email)
                        <p class="text-sm text-gray-400 flex items-center gap-2">
                            <span class="text-blue-400">✉️</span>
                            <a href="mailto:{{ $settings->email }}" class="hover:text-blue-400 transition-colors duration-300">{{ $settings->email }}</a>
                        </p>
                        @endif
                    @endif
                </div>
            </div>

            <div class="border-t border-slate-700 pt-6">
                <p class="text-center text-sm text-gray-500">
                    © {{ date('Y') }} <span class="gradient-text font-semibold">{{ $settings->site_name ?? 'Yayasan' }}</span>. All rights reserved. | Designed with ❤️
                </p>
            </div>
        </div>
    </footer>

    {{-- AOS Script --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: false,
            offset: 100
        });
    </script>

    @stack('scripts')
</body>
</html>
