@extends('admin.layout')

@section('title','Detail Anggota')
@section('content')
@push('styles')
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>
@endpush

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Detail Anggota</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Foto -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                @if ($anggota->foto)
                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama_lengkap }}" class="w-full h-64 object-cover rounded-lg mb-4">
                @else
                    <div class="bg-gray-100 w-full h-64 rounded-lg mb-4 flex items-center justify-center">
                        <span class="text-gray-400 text-lg">Tidak ada foto</span>
                    </div>
                @endif
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $anggota->nama_lengkap }}</h3>
                <p class="text-gray-600 text-sm">NIK: {{ $anggota->nik }}</p>
            </div>
        </div>

        <!-- Informasi -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Data Pribadi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-emerald-600">person</span>
                    Data Pribadi
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tempat Lahir</label>
                            <p class="text-gray-800">{{ $anggota->tempat_lahir }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Lahir</label>
                            <p class="text-gray-800">
                                @if ($anggota->tanggal_lahir)
                                    {{ $anggota->tanggal_lahir->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Umur</label>
                            <p class="text-gray-800">
                                @if ($anggota->umur)
                                    {{ $anggota->umur }} tahun
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Golongan Darah</label>
                            <p class="text-gray-800">{{ $anggota->golongan_darah ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Status Perkawinan</label>
                            <p class="text-gray-800">{{ $anggota->status_perkawinan ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Pekerjaan</label>
                            <p class="text-gray-800">{{ $anggota->pekerjaan->nama_pekerjaan ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">No. Telp</label>
                            <p class="text-gray-800">{{ $anggota->no_telp ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Masuk</label>
                            <p class="text-gray-800">
                                @if ($anggota->tanggal_masuk)
                                    {{ $anggota->tanggal_masuk->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Keluarga -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-emerald-600">family_restroom</span>
                    Data Keluarga
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">No. KK</label>
                            <p class="text-gray-800">{{ $anggota->no_kk }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Status dalam Keluarga</label>
                            <p class="text-gray-800">{{ $anggota->status_kk }}</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Jenis Kelamin</label>
                            <p class="text-gray-800">
                                {{ $anggota->jenis_kelamin == 'L' || $anggota->jenis_kelamin == 'Laki-laki' ? 'Laki-laki' : 'Perempuan' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alamat -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-600">location_on</span>
            Alamat Lengkap
        </h3>
        <div class="mb-4">
            <p class="text-gray-800 text-lg">{{ $anggota->full_address }}</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div>
                <label class="font-medium text-gray-500">Desa</label>
                <p class="text-gray-800">{{ $anggota->desa ?? '-' }}</p>
            </div>
            <div>
                <label class="font-medium text-gray-500">RT</label>
                <p class="text-gray-800">{{ $anggota->rt ?? '-' }}</p>
            </div>
            <div>
                <label class="font-medium text-gray-500">RW</label>
                <p class="text-gray-800">{{ $anggota->rw ?? '-' }}</p>
            </div>
            <div>
                <label class="font-medium text-gray-500">Kelurahan</label>
                <p class="text-gray-800">{{ $anggota->kelurahan ?? '-' }}</p>
            </div>
            <div>
                <label class="font-medium text-gray-500">Kecamatan</label>
                <p class="text-gray-800">{{ $anggota->kecamatan ?? '-' }}</p>
            </div>
            <div>
                <label class="font-medium text-gray-500">Kabupaten</label>
                <p class="text-gray-800">{{ $anggota->kabupaten ?? '-' }}</p>
            </div>
            <div>
                <label class="font-medium text-gray-500">Provinsi</label>
                <p class="text-gray-800">{{ $anggota->provinsi ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Lokasi -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-600">map</span>
            Lokasi
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="text-sm font-medium text-gray-500">Latitude</label>
                <p class="text-gray-800 font-mono">{{ $anggota->latitude }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500">Longitude</label>
                <p class="text-gray-800 font-mono">{{ $anggota->longitude }}</p>
            </div>
        </div>
        <div id="map" class="w-full h-80 rounded-lg border border-gray-200"></div>
    </div>

    <!-- Aksi -->
    <div class="mt-8 flex justify-center gap-4">
        <button onclick="routeToLocation({{ $anggota->latitude }}, {{ $anggota->longitude }})" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg text-sm font-medium">
            <span class="material-symbols-outlined text-sm">directions</span>
            Route ke Lokasi
        </button>
        <a href="{{ route('admin.anggotas.index') }}" class="inline-flex items-center gap-2 border border-gray-300 px-6 py-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Kembali
        </a>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const lat = {{ $anggota->latitude }};
    const lng = {{ $anggota->longitude }};

    const map = L.map('map').setView([lat, lng], 18);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    L.marker([lat, lng])
        .addTo(map)
        .bindPopup("<b>{{ $anggota->nama_lengkap }}</b>")
        .openPopup();

    function routeToLocation(destLat, destLng) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const originLat = position.coords.latitude;
                const originLng = position.coords.longitude;
                const url = `https://www.google.com/maps/dir/${originLat},${originLng}/${destLat},${destLng}`;
                window.open(url, '_blank');
            }, function(error) {
                alert('Tidak dapat mendapatkan lokasi saat ini. Pastikan izin lokasi diaktifkan.');
                // Fallback: buka maps tanpa origin
                const url = `https://www.google.com/maps/dir//${destLat},${destLng}`;
                window.open(url, '_blank');
            });
        } else {
            alert('Geolocation tidak didukung oleh browser ini.');
            const url = `https://www.google.com/maps/dir//${destLat},${destLng}`;
            window.open(url, '_blank');
        }
    }
</script>
@endpush
@endsection
