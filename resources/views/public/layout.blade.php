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
    <style>
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
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- NAVBAR --}}
    @php
        $settings = \App\Models\Setting::first();
        $menus = \App\Models\Menu::active()->get();
    @endphp

    <header class="bg-white shadow sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="font-bold text-xl text-blue-600 hover:text-blue-700">
                {{ $settings->site_name ?? 'Yayasan' }}
            </a>

            <nav class="space-x-6 hidden md:flex">
                @forelse($menus as $menu)
                    <a href="{{ $menu->url }}" class="hover:text-blue-600 transition font-medium">
                        {{ $menu->title }}
                    </a>
                @empty
                    <span class="text-gray-500">Belum ada menu</span>
                @endforelse
            </nav>

            {{-- Mobile Menu Button --}}
            <button class="md:hidden" id="mobileMenuBtn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden bg-gray-100 border-t">
            <div class="container mx-auto px-4 py-4 space-y-2">
                @forelse($menus as $menu)
                    <a href="{{ $menu->url }}" class="block hover:text-blue-600 py-2">{{ $menu->title }}</a>
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
    <footer class="bg-gray-800 text-gray-300 mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div>
                    <h3 class="font-bold text-white mb-2 text-lg">{{ $settings->site_name ?? 'Yayasan' }}</h3>
                    <p class="text-sm">
                        Website resmi yayasan keagamaan
                    </p>
                    @if($settings && ($settings->facebook || $settings->instagram || $settings->youtube))
                    <div class="flex gap-4 mt-4">
                        @if($settings->facebook)
                        <a href="{{ $settings->facebook }}" target="_blank" class="hover:text-blue-400 transition">Facebook</a>
                        @endif
                        @if($settings->instagram)
                        <a href="{{ $settings->instagram }}" target="_blank" class="hover:text-pink-400 transition">Instagram</a>
                        @endif
                        @if($settings->youtube)
                        <a href="{{ $settings->youtube }}" target="_blank" class="hover:text-red-500 transition">YouTube</a>
                        @endif
                    </div>
                    @endif
                </div>

                <div>
                    <h3 class="font-bold text-white mb-2 text-lg">Menu</h3>
                    <ul class="space-y-1 text-sm">
                        @forelse($menus as $menu)
                            <li><a href="{{ $menu->url }}" class="hover:text-blue-400 transition">{{ $menu->title }}</a></li>
                        @empty
                            <li class="text-gray-400">Belum ada menu</li>
                        @endforelse
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-white mb-2 text-lg">Kontak</h3>
                    @if($settings)
                        @if($settings->address)
                        <p class="text-sm mb-2">📍 {{ $settings->address }}</p>
                        @endif
                        @if($settings->phone)
                        <p class="text-sm mb-2">📞 <a href="tel:{{ $settings->phone }}" class="hover:text-blue-400 transition">{{ $settings->phone }}</a></p>
                        @endif
                        @if($settings->email)
                        <p class="text-sm">✉️ <a href="mailto:{{ $settings->email }}" class="hover:text-blue-400 transition">{{ $settings->email }}</a></p>
                        @endif
                    @endif
                </div>
            </div>

            <div class="text-center text-sm text-gray-400 py-4 border-t border-gray-700">
                © {{ date('Y') }} {{ $settings->site_name ?? 'Yayasan' }}. All rights reserved.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
