@extends('admin.layout')

@section('title', 'Maps Anggota')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map { height: 500px; }
</style>
@endpush

@section('content')

@php
    $hasFilter = request('provinsi') || request('kabupaten') || request('kecamatan');
@endphp

{{-- FILTER --}}
<div class="bg-white rounded shadow p-4 mb-4">
    <h2 class="text-lg font-semibold mb-4">Filter Wilayah</h2>

    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <select name="provinsi" class="border rounded px-3 py-2">
            <option value="">-- Provinsi --</option>
            @foreach($provinsis as $prov)
                <option value="{{ $prov }}" {{ request('provinsi')==$prov?'selected':'' }}>
                    {{ $prov }}
                </option>
            @endforeach
        </select>

        <select name="kabupaten" class="border rounded px-3 py-2">
            <option value="">-- Kabupaten --</option>
            @foreach($kabupatens as $kab)
                <option value="{{ $kab }}" {{ request('kabupaten')==$kab?'selected':'' }}>
                    {{ $kab }}
                </option>
            @endforeach
        </select>

        <select name="kecamatan" class="border rounded px-3 py-2">
            <option value="">-- Kecamatan --</option>
            @foreach($kecamatans as $kec)
                <option value="{{ $kec }}" {{ request('kecamatan')==$kec?'selected':'' }}>
                    {{ $kec }}
                </option>
            @endforeach
        </select>

        <button class="bg-blue-600 hover:bg-blue-700 text-white rounded px-4 py-2">
            Tampilkan Map
        </button>
    </form>
</div>

{{-- MAP RESULT --}}
<div class="bg-white rounded shadow p-4">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg font-semibold">Peta Lokasi Anggota</h2>

        @if($anggotas->count())
            <span class="bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full">
                {{ $anggotas->count() }} Anggota
            </span>
        @endif
    </div>

    {{-- BELUM ADA FILTER --}}
    @if(!$hasFilter)
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded text-sm">
            Silakan pilih minimal salah satu filter wilayah
            <b>(Provinsi / Kabupaten / Kecamatan)</b>
            lalu klik <b>Tampilkan Map</b>.
        </div>

    {{-- FILTER ADA, DATA KOSONG --}}
    @elseif($anggotas->count() === 0)
        <div class="bg-red-100 text-red-700 p-4 rounded text-sm">
            Data anggota tidak ditemukan pada wilayah yang dipilih.
        </div>

    {{-- ADA DATA --}}
    @else
        <div id="map" class="rounded"></div>
    @endif
</div>

@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@if($anggotas->count() && $hasFilter)
<script>
    const map = L.map('map').setView([-2.5, 118], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    const anggotas = @json($anggotas);
    const markers = [];

    anggotas.forEach(a => {
        if (!a.latitude || !a.longitude) return;

        const marker = L.marker([a.latitude, a.longitude])
            .addTo(map)
            .bindPopup(`
                <div class="text-sm">
                    <b>${a.nama_lengkap}</b><br>
                    ${a.kecamatan ?? ''} ${a.kabupaten ?? ''}<br>
                    <a href="/admin/anggotas/${a.id}"
                       class="text-blue-600 underline text-xs">
                        Lihat Detail
                    </a>
                </div>
            `);

        markers.push(marker);
    });

    if (markers.length) {
        const group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.2));
    }
</script>
@endif
@endpush
