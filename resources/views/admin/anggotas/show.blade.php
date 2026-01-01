@extends('admin.layout')

@section('content')
@push('styles')
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>
@endpush
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Detail Anggota</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.anggotas.edit', $anggota->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                Edit
            </a>
            <a href="{{ route('admin.anggotas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Foto -->
        <div class="col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                @if ($anggota->foto)
                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama_lengkap }}" class="w-full rounded mb-4">
                @else
                    <div class="bg-gray-200 w-full aspect-square rounded mb-4 flex items-center justify-center">
                        <span class="text-gray-500">Tidak ada foto</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Informasi -->
        <div class="col-span-2">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-2xl font-bold mb-4">{{ $anggota->nama_lengkap }}</h2>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">NIK</p>
                        <p class="text-lg font-semibold">{{ $anggota->nik }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">No. KK</p>
                        <p class="text-lg font-semibold">{{ $anggota->no_kk }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Status dalam Keluarga</p>
                        <p class="text-lg font-semibold">{{ $anggota->status_kk }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Jenis Kelamin</p>
                        <p class="text-lg font-semibold">
                            {{ $anggota->jenis_kelamin == 'L' || $anggota->jenis_kelamin == 'Laki-laki' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-bold mb-4">Data Pribadi</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Tempat Lahir</p>
                        <p class="font-semibold">{{ $anggota->tempat_lahir }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Tanggal Lahir</p>
                        <p class="font-semibold">
                            @if ($anggota->tanggal_lahir)
                                {{ $anggota->tanggal_lahir->format('d M Y') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600">Umur</p>
                        <p class="font-semibold">
                            @if ($anggota->umur)
                                {{ $anggota->umur }} tahun
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600">Golongan Darah</p>
                        <p class="font-semibold">{{ $anggota->golongan_darah ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Status Perkawinan</p>
                        <p class="font-semibold">{{ $anggota->status_perkawinan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Pekerjaan</p>
                        <p class="font-semibold">{{ $anggota->pekerjaan->nama_pekerjaan ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alamat -->
    <div class="bg-white rounded-lg shadow p-6 mt-6">
        <h3 class="text-xl font-bold mb-4">Alamat Lengkap</h3>
        
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            <div>
                <p class="text-gray-600">Desa</p>
                <p class="font-semibold">{{ $anggota->desa ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600">RT</p>
                <p class="font-semibold">{{ $anggota->rt ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600">RW</p>
                <p class="font-semibold">{{ $anggota->rw ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600">Kelurahan</p>
                <p class="font-semibold">{{ $anggota->kelurahan ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600">Kecamatan</p>
                <p class="font-semibold">{{ $anggota->kecamatan ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600">Kabupaten</p>
                <p class="font-semibold">{{ $anggota->kabupaten ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600">Provinsi</p>
                <p class="font-semibold">{{ $anggota->provinsi ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t">
            <p class="text-gray-600">Alamat Lengkap</p>
            <p class="font-semibold">{{ $anggota->full_address }}</p>
        </div>
    </div>

    <!-- Kontak & Administrasi -->
    <div class="bg-white rounded-lg shadow p-6 mt-6">
        <h3 class="text-xl font-bold mb-4">Kontak & Administrasi</h3>
        
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            <div>
                <p class="text-gray-600">No. Telp</p>
                <p class="font-semibold">{{ $anggota->no_telp ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-600">Tanggal Masuk</p>
                <p class="font-semibold">
                    @if ($anggota->tanggal_masuk)
                        {{ $anggota->tanggal_masuk->format('d M Y') }}
                    @else
                        -
                    @endif
                </p>
            </div>
            <div>
                <p class="text-gray-600">Dibuat</p>
                <p class="font-semibold">{{ $anggota->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-600">Diperbarui</p>
                <p class="font-semibold">{{ $anggota->updated_at->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Maps -->
  
        <div class="bg-white rounded-lg shadow p-6 mt-6">
            <div>
                <p class="text-gray-600">Latitude</p>
                <p class="font-semibold">{{ $anggota->latitude }}</p>
            </div>
            <div>
                <p class="text-gray-600">Longitude</p>
                <p class="font-semibold">{{ $anggota->longitude }}</p>
            </div>
        </div>

         <div class="bg-white rounded shadow p-4">
        <h2 class="text-lg font-semibold mb-3">Lokasi Anggota</h2>

        <div id="map" class="w-full h-[350px] rounded"></div>
    </div>
  

    <!-- Aksi -->
    <div class="mt-6 flex justify-between">
        <a href="{{ route('admin.anggotas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
        <form method="POST" action="{{ route('admin.anggotas.destroy', $anggota->id) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" 
                onclick="return confirm('Yakin ingin menghapus anggota ini?')">
                Hapus
            </button>
        </form>
    </div>
</div>
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const lat = {{ $anggota->latitude }};
    const lng = {{ $anggota->longitude }};

    const map = L.map('map').setView([lat, lng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    L.marker([lat, lng])
        .addTo(map)
        .bindPopup("<b>{{ $anggota->nama }}</b>")
        .openPopup();
</script>
@endpush
@endsection
