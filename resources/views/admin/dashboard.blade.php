@extends('admin.layout')

@section('title', 'Dashboard')

@section('page-title')
    <h1 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">dashboard</span>
        Dashboard Admin
    </h1>
@endsection

@section('content')

{{-- Content Management Statistics --}}
<div class="bg-white rounded shadow p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">article</span>
        Manajemen Konten
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-emerald-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded flex items-center justify-center text-emerald-600">
                    <span class="material-symbols-outlined">article</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Total Berita</h3>
                    <p class="text-2xl font-bold text-emerald-700">{{ $totalNews }}</p>
                </div>
            </div>
        </div>

        <div class="bg-emerald-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded flex items-center justify-center text-emerald-600">
                    <span class="material-symbols-outlined">check_circle</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Berita Publish</h3>
                    <p class="text-2xl font-bold text-emerald-700">{{ $publishedNews }}</p>
                </div>
            </div>
        </div>

        <div class="bg-emerald-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded flex items-center justify-center text-emerald-600">
                    <span class="material-symbols-outlined">edit_note</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Berita Draft</h3>
                    <p class="text-2xl font-bold text-emerald-700">{{ $draftNews }}</p>
                </div>
            </div>
        </div>

        <div class="bg-emerald-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-100 rounded flex items-center justify-center text-emerald-600">
                    <span class="material-symbols-outlined">view_in_ar</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Landing Section</h3>
                    <p class="text-2xl font-bold text-emerald-700">{{ $landingSections }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Member Management Statistics --}}
<div class="bg-white rounded shadow p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">group</span>
        Manajemen Anggota
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-blue-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded flex items-center justify-center text-blue-600">
                    <span class="material-symbols-outlined">person</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Total Anggota</h3>
                    <p class="text-2xl font-bold text-blue-700">{{ $totalAnggotas }}</p>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded flex items-center justify-center text-blue-600">
                    <span class="material-symbols-outlined">person_check</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Anggota Aktif</h3>
                    <p class="text-2xl font-bold text-blue-700">{{ $activeAnggotas }}</p>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded flex items-center justify-center text-blue-600">
                    <span class="material-symbols-outlined">work</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Jenis Pekerjaan</h3>
                    <p class="text-2xl font-bold text-blue-700">{{ $totalPekerjaan }}</p>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded flex items-center justify-center text-blue-600">
                    <span class="material-symbols-outlined">family_restroom</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Total Keluarga</h3>
                    <p class="text-2xl font-bold text-blue-700">{{ $totalKeluargas }}</p>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded flex items-center justify-center text-blue-600">
                    <span class="material-symbols-outlined">male</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Laki-laki</h3>
                    <p class="text-2xl font-bold text-blue-700">{{ $maleAnggotas }}</p>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 p-4 rounded flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded flex items-center justify-center text-blue-600">
                    <span class="material-symbols-outlined">female</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Perempuan</h3>
                    <p class="text-2xl font-bold text-blue-700">{{ $femaleAnggotas }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Info Yayasan --}}
<div class="bg-white rounded shadow p-6 mb-8">
    <h2 class="text-lg font-semibold mb-2 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">info</span>
        Informasi Yayasan
    </h2>

    @if($setting)
        <p><strong>Nama:</strong> {{ $setting->site_name }}</p>
        <p><strong>Email:</strong> {{ $setting->email ?? '-' }}</p>
        <p><strong>Telepon:</strong> {{ $setting->phone ?? '-' }}</p>
    @else
        <p class="text-emerald-600">Setting yayasan belum diisi.</p>
    @endif
</div>

{{-- Quick Actions --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Content Management Actions --}}
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-600">article</span>
            Aksi Konten
        </h2>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.news.create') }}"
               class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700 flex items-center gap-2">
               <span class="material-symbols-outlined">post_add</span>
               + Tambah Berita
            </a>

            <a href="{{ route('admin.landing-sections.index') }}"
               class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded hover:bg-emerald-100 flex items-center gap-2 border border-emerald-100">
               <span class="material-symbols-outlined">web</span>
               Kelola Landing Page
            </a>

            <a href="{{ route('admin.pages.index') }}"
               class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded hover:bg-emerald-100 flex items-center gap-2 border border-emerald-100">
               <span class="material-symbols-outlined">description</span>
               Kelola Halaman
            </a>
        </div>
    </div>

    {{-- Member Management Actions --}}
    <div class="bg-white rounded shadow p-6">
        <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-blue-600">group</span>
            Aksi Anggota
        </h2>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.anggotas.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center gap-2">
               <span class="material-symbols-outlined">person_add</span>
               + Tambah Anggota
            </a>

            <a href="{{ route('admin.anggotas.index') }}"
               class="bg-blue-50 text-blue-700 px-4 py-2 rounded hover:bg-blue-100 flex items-center gap-2 border border-blue-100">
               <span class="material-symbols-outlined">group</span>
               Kelola Anggota
            </a>

            <a href="{{ route('admin.pekerjaan.index') }}"
               class="bg-blue-50 text-blue-700 px-4 py-2 rounded hover:bg-blue-100 flex items-center gap-2 border border-blue-100">
               <span class="material-symbols-outlined">work</span>
               Kelola Pekerjaan
            </a>

            <a href="{{ route('admin.keluargas.index') }}"
               class="bg-blue-50 text-blue-700 px-4 py-2 rounded hover:bg-blue-100 flex items-center gap-2 border border-blue-100">
               <span class="material-symbols-outlined">family_restroom</span>
               Kelola Keluarga
            </a>
        </div>
    </div>
</div>

@endsection
