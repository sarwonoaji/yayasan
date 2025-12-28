<!DOCTYPE html>
<html>
<head>
    <title>Admin - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-800 text-white p-4">
        <h1 class="font-bold text-xl mb-6">CMS Yayasan</h1>

        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block hover:bg-slate-700 p-2 rounded">Dashboard</a>
            <a href="{{ route('admin.landing-sections.index') }}" class="block hover:bg-slate-700 p-2 rounded">Landing Page</a>
            <a href="{{ route('admin.menus.index') }}" class="block hover:bg-slate-700 p-2 rounded">Menu Navbar</a>
            <a href="{{ route('admin.pages.index') }}" class="block hover:bg-slate-700 p-2 rounded">Halaman Statis</a>
            <a href="{{ route('admin.news.index') }}" class="block hover:bg-slate-700 p-2 rounded">Berita</a>
            <a href="{{ route('admin.settings.index') }}" class="block hover:bg-slate-700 p-2 rounded">⚙️ Pengaturan</a>
        </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>
</div>

</body>
</html>
