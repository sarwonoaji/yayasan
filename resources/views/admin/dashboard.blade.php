@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold flex items-center gap-3"> 
        <span class="material-symbols-outlined text-emerald-600">dashboard</span>
        Dashboard Admin
    </h1>
</div>

{{-- Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">

    <div class="bg-white p-4 rounded shadow flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 rounded flex items-center justify-center text-emerald-600">
                <span class="material-symbols-outlined">article</span>
            </div>
            <div>
                <h3 class="text-sm text-gray-500">Total Berita</h3>
                <p class="text-2xl font-bold">{{ $totalNews }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 rounded flex items-center justify-center text-emerald-600">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
            <div>
                <h3 class="text-sm text-gray-500">Berita Publish</h3>
                <p class="text-2xl font-bold text-emerald-600">{{ $publishedNews }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 rounded flex items-center justify-center text-emerald-600">
                <span class="material-symbols-outlined">edit_note</span>
            </div>
            <div>
                <h3 class="text-sm text-gray-500">Berita Draft</h3>
                <p class="text-2xl font-bold text-emerald-500">{{ $draftNews }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 rounded flex items-center justify-center text-emerald-600">
                <span class="material-symbols-outlined">view_in_ar</span>
            </div>
            <div>
                <h3 class="text-sm text-gray-500">Landing Section</h3>
                <p class="text-2xl font-bold">{{ $landingSections }}</p>
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

{{-- Quick Action --}}
<div class="bg-white rounded shadow p-6">
    <h2 class="text-lg font-semibold mb-4 flex items-center gap-2"> 
        <span class="material-symbols-outlined text-emerald-600">bolt</span>
        Aksi Cepat
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
    </div>
</div>

@endsection
