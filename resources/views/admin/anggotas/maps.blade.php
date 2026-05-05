@extends('admin.layout')

@section('title','Maps Anggota')
@section('content')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map { height: 600px; border-radius: 0.5rem; }
</style>
@endpush

@php
    $hasFilter = request('provinsi') || request('kabupaten') || request('kecamatan');
@endphp

<div class="mb-2">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">map</span>
        Peta Anggota
    </h1>
        <a href="{{ route('admin.anggotas.index') }}" class="inline-flex items-center gap-2 border border-gray-300 px-4 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-600">filter_list</span>
            Filter Wilayah
        </h3>

        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                <select name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">-- Pilih Provinsi --</option>
                    @foreach($provinsis as $prov)
                        <option value="{{ $prov }}" {{ request('provinsi') == $prov ? 'selected' : '' }}>
                            {{ $prov }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten</label>
                <select name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">-- Pilih Kabupaten --</option>
                    @foreach($kabupatens as $kab)
                        <option value="{{ $kab }}" {{ request('kabupaten') == $kab ? 'selected' : '' }}>
                            {{ $kab }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                <select name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach($kecamatans as $kec)
                        <option value="{{ $kec }}" {{ request('kecamatan') == $kec ? 'selected' : '' }}>
                            {{ $kec }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                    <span class="material-symbols-outlined text-sm">map</span>
                    Tampilkan Peta
                </button>
            </div>
        </form>
    </div>

    <!-- Map Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600">location_on</span>
                Peta Lokasi Anggota
            </h3>

            @if($anggotas->count())
                <span class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-700 text-sm px-3 py-1 rounded-full font-medium">
                    <span class="material-symbols-outlined text-sm">people</span>
                    {{ $anggotas->count() }} Anggota
                </span>
            @endif
        </div>

        {{-- No Filter Applied --}}
        @if(!$hasFilter)
            <div class="bg-amber-50 border border-amber-200 text-amber-800 px-6 py-4 rounded-lg">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-amber-600 mt-0.5">info</span>
                    <div>
                        <p class="font-medium">Pilih Filter Wilayah</p>
                        <p class="text-sm mt-1">Silakan pilih minimal salah satu filter wilayah (Provinsi, Kabupaten, atau Kecamatan) lalu klik <strong>Tampilkan Peta</strong> untuk melihat lokasi anggota.</p>
                    </div>
                </div>
            </div>

        {{-- Filter Applied but No Data --}}
        @elseif($anggotas->count() === 0)
            <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-red-600 mt-0.5">location_off</span>
                    <div>
                        <p class="font-medium">Data Tidak Ditemukan</p>
                        <p class="text-sm mt-1">Tidak ada anggota yang ditemukan pada wilayah yang dipilih. Coba ubah filter atau periksa kembali data lokasi anggota.</p>
                    </div>
                </div>
            </div>

        {{-- Data Available --}}
        @else
            <div id="map" class="w-full rounded-lg border border-gray-200"></div>

            <div class="mt-4 text-sm text-gray-600">
                <p>Klik pada marker untuk melihat detail anggota. Peta akan menampilkan semua anggota yang sesuai dengan filter wilayah yang dipilih.</p>
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@if($anggotas->count() && $hasFilter)
<script>
    // =========================
    // INIT MAP
    // =========================
    const map = L.map('map').setView([-2.5, 118], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    const anggotas = @json($anggotas);
    const markers = [];

    // =========================
    // CREATE MARKERS
    // =========================
    anggotas.forEach(a => {
        if (!a.latitude || !a.longitude) return;

        const marker = L.marker([a.latitude, a.longitude])
            .addTo(map)
            .bindPopup(`
                <div class="p-2 min-w-48">
                    <div class="font-semibold text-gray-800 mb-1">${a.nama_lengkap}</div>
                    <div class="text-sm text-gray-600 mb-2">
                        ${a.desa ? a.desa + ', ' : ''}${a.kecamatan ?? ''}<br>
                        ${a.kabupaten ?? ''}, ${a.provinsi ?? ''}
                    </div>
                    <div class="flex gap-2">
                        <a href="/admin/anggotas/${a.id}"
                           class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-700 text-xs font-medium">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                            Lihat Detail
                        </a>
                        <a href="https://www.google.com/maps/dir/?api=1&destination=${a.latitude},${a.longitude}"
                           target="_blank"
                           class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 text-xs font-medium">
                            <span class="material-symbols-outlined text-sm">directions</span>
                            Rute
                        </a>
                    </div>
                </div>
            `);

        markers.push(marker);
    });

    // =========================
    // FIT BOUNDS
    // =========================
    if (markers.length) {
        const group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.2));
    }

    // =========================
    // ADD CONTROLS INFO
    // =========================
    const info = L.control({position: 'topright'});

    info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'bg-white p-3 rounded-lg shadow-sm border text-sm');
        this._div.innerHTML = `
            <div class="font-medium text-gray-800 mb-1">Informasi</div>
            <div class="text-gray-600">
                ${markers.length} lokasi anggota<br>
                Klik marker untuk detail
            </div>
        `;
        return this._div;
    };

    info.addTo(map);
</script>
@endif
@endpush
