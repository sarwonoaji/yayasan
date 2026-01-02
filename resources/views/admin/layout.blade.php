<!DOCTYPE html>
<html>
<head>
    <title>Admin - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" rel="stylesheet" />
 @stack('styles')
</head>
<body class="bg-gray-100 text-sm">

<style>
    /* Collapsed sidebar styles when body has .sidebar-collapsed */
    .sidebar-main { transition: width 200ms ease; overflow-x: visible; }
    .sidebar-main .nav-text, .sidebar-main .brand-text { transition: opacity 180ms ease, transform 180ms ease; }
    .sidebar-collapsed .sidebar-main { width: 76px; }
    .sidebar-collapsed .sidebar-main .nav-text { opacity: 0; transform: translateX(-6px); pointer-events: none; }
    .sidebar-collapsed .sidebar-main .brand-text { opacity: 0; transform: translateX(-6px); }
    .sidebar-collapsed .sidebar-main .w-9 { width: 36px; height: 36px; }
    @media (max-width: 767px) {
        .sidebar-collapsed .sidebar-main { position: relative; width: 100% }
        .sidebar-collapsed .sidebar-main .nav-text { display: inline }
    }

    /* Nav tooltips (hidden by default since collapse feature removed) */
    .nav-tooltip { display: none; }
    /* Page header helper: keep header above scrollable content */
    .page-header { position: sticky; top: 0; z-index: 30; background: transparent; }
    .page-header .header-inner { background: transparent; }
    /* Hide visible scrollbars on the sidebar but keep scrolling functional */
    .sidebar-main::-webkit-scrollbar { width: 0; height: 0; }
    .sidebar-main { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="flex min-h-screen text-sm">

    <!-- Sidebar -->
    <aside class="sidebar-main w-56 md:w-64 bg-slate-800 text-slate-100 p-3 md:p-4 shadow-lg md:fixed md:inset-y-0 md:left-0 md:h-screen md:overflow-y-auto z-20">
        <div class="relative flex items-center gap-2 px-1 py-2 mb-5">
            <div class="flex items-center gap-2 relative">
                <div class="w-9 h-9 bg-emerald-600 rounded flex items-center justify-center text-white font-semibold text-sm">Y</div>
                <div>
                    <div class="brand-text font-semibold text-sm">Yayasan</div>
                    <div class="brand-text text-[11px] text-slate-400">Admin Panel</div>
                </div>
                
            </div>
        </div>

        <nav class="space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">dashboard</span>
                <span class="nav-text text-sm">Dashboard</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Dashboard</span>
            </a>
            <a href="{{ route('admin.pekerjaan.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.pekerjaan*') ? 'bg-slate-700' : 'hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">engineering</span>
                <span class="nav-text text-sm">Data Pekerjaan</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Data Pekerjaan</span>
            </a>
             <a href="{{ route('admin.anggotas.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.anggotas*') ? 'bg-slate-700' : 'hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">people</span>
                <span class="nav-text text-sm">Data Anggota</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Data Anggota</span>
            </a>

            <a href="{{ route('admin.keluargas.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.keluargas*') ? 'bg-slate-700' : 'hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">family_restroom</span>
                <span class="nav-text text-sm">Data Keluarga</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Data Keluarga</span>
            </a>

            <a href="{{ route('admin.anggotas.maps') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.anggotas.maps') ? 'bg-slate-700' : 'hover:bg-slate-700' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">map</span>
                <span class="nav-text text-sm">Maps</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Maps</span>
            </a>

            <a href="{{ route('admin.landing-sections.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.landing-sections*') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">web</span>
                <span class="nav-text text-sm">Landing Page</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Landing Page</span>
            </a>

            <a href="{{ route('admin.menus.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.menus*') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">menu</span>
                <span class="nav-text text-sm">Menu Navbar</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Menu Navbar</span>
            </a>

            <a href="{{ route('admin.pages.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.pages*') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">article</span>
                <span class="nav-text text-sm">Halaman Statis</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Halaman Statis</span>
            </a>

            <a href="{{ route('admin.news.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.news*') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">rss_feed</span>
                <span class="nav-text text-sm">Berita</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Berita</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.settings*') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">settings</span>
                <span class="nav-text text-sm">Pengaturan</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Pengaturan</span>
            </a>
        </nav>

        <div class="mt-6 px-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 px-3 py-2 rounded-md text-sm">
                    <span class="material-symbols-outlined">logout</span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- external toggle removed; toggle now inside brand area -->

    <!-- Content -->
    <main class="flex-1 md:ml-64 h-screen flex flex-col">
        <!-- Optional topbar area (pages can define a section 'topbar' or use an element with class 'page-header') -->
        <div class="flex-shrink-0" id="pageTopbar">
            @yield('topbar')
        </div>

        <!-- Scrollable content area (will not scroll under the topbar) -->
        <div class="flex-1 overflow-auto">
            <div class="p-6">
                @yield('content')
            </div>
        </div>
    </main>
</div>

<script>
    // Collapse/hide feature removed; no toggle script required
</script>
@stack('scripts')
</body>
</html>
