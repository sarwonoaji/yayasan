@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

{{-- Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-500">Total Berita</h3>
        <p class="text-3xl font-bold">{{ $totalNews }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-500">Berita Publish</h3>
        <p class="text-3xl font-bold text-green-600">{{ $publishedNews }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-500">Berita Draft</h3>
        <p class="text-3xl font-bold text-orange-500">{{ $draftNews }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-500">Landing Section</h3>
        <p class="text-3xl font-bold">{{ $landingSections }}</p>
    </div>

</div>

{{-- Info Yayasan --}}
<div class="bg-white rounded shadow p-6 mb-8">
    <h2 class="text-lg font-semibold mb-2">Informasi Yayasan</h2>

    @if($setting)
        <p><strong>Nama:</strong> {{ $setting->site_name }}</p>
        <p><strong>Email:</strong> {{ $setting->email ?? '-' }}</p>
        <p><strong>Telepon:</strong> {{ $setting->phone ?? '-' }}</p>
    @else
        <p class="text-red-600">Setting yayasan belum diisi.</p>
    @endif
</div>

{{-- Quick Action --}}
<div class="bg-white rounded shadow p-6">
    <h2 class="text-lg font-semibold mb-4">Aksi Cepat</h2>

    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.news.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
           + Tambah Berita
        </a>

        <a href="{{ route('admin.landing-sections.index') }}"
           class="bg-slate-700 text-white px-4 py-2 rounded hover:bg-slate-800">
           Kelola Landing Page
        </a>
    </div>
</div>

@endsection
