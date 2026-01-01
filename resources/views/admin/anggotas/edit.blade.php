@extends('admin.layout')

@section('content')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map { height: 400px; }
</style>
@endpush
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Anggota</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.anggotas.update', $anggota->id) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <!-- Identitas -->
            <div>
                <label class="block text-gray-700 font-bold mb-2">NIK <span class="text-red-500">*</span></label>
                <input type="text" name="nik" class="w-full px-4 py-2 border rounded @error('nik') border-red-500 @enderror" 
                    value="{{ old('nik', $anggota->nik) }}" required>
                @error('nik') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">No. KK <span class="text-red-500">*</span></label>
                <input type="text" name="no_kk" class="w-full px-4 py-2 border rounded @error('no_kk') border-red-500 @enderror" 
                    value="{{ old('no_kk', $anggota->no_kk) }}" required>
                @error('no_kk') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Status dalam Keluarga <span class="text-red-500">*</span></label>
                <select name="status_kk" class="w-full px-4 py-2 border rounded @error('status_kk') border-red-500 @enderror" required>
                    <option value="">-- Pilih --</option>
                    <option value="Kepala Keluarga" {{ old('status_kk', $anggota->status_kk) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                    <option value="Istri" {{ old('status_kk', $anggota->status_kk) == 'Istri' ? 'selected' : '' }}>Istri</option>
                    <option value="Anak" {{ old('status_kk', $anggota->status_kk) == 'Anak' ? 'selected' : '' }}>Anak</option>
                    <option value="Menantu" {{ old('status_kk', $anggota->status_kk) == 'Menantu' ? 'selected' : '' }}>Menantu</option>
                    <option value="Cucu" {{ old('status_kk', $anggota->status_kk) == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                    <option value="Orang Tua" {{ old('status_kk', $anggota->status_kk) == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                    <option value="Lainnya" {{ old('status_kk', $anggota->status_kk) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('status_kk') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Data Pribadi -->
            <div class="col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama_lengkap" class="w-full px-4 py-2 border rounded @error('nama_lengkap') border-red-500 @enderror" 
                    value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" required>
                @error('nama_lengkap') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select name="jenis_kelamin" class="w-full px-4 py-2 border rounded @error('jenis_kelamin') border-red-500 @enderror" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                <input type="text" name="tempat_lahir" class="w-full px-4 py-2 border rounded @error('tempat_lahir') border-red-500 @enderror" 
                    value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}" required>
                @error('tempat_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="w-full px-4 py-2 border rounded @error('tanggal_lahir') border-red-500 @enderror" 
                    value="{{ old('tanggal_lahir', $anggota->tanggal_lahir?->format('Y-m-d')) }}">
                @error('tanggal_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Golongan Darah</label>
                <select name="golongan_darah" class="w-full px-4 py-2 border rounded @error('golongan_darah') border-red-500 @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="A" {{ old('golongan_darah', $anggota->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('golongan_darah', $anggota->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                    <option value="AB" {{ old('golongan_darah', $anggota->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                    <option value="O" {{ old('golongan_darah', $anggota->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
                </select>
                @error('golongan_darah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Status & Pekerjaan -->
            <div>
                <label class="block text-gray-700 font-bold mb-2">Status Perkawinan</label>
                <select name="status_perkawinan" class="w-full px-4 py-2 border rounded @error('status_perkawinan') border-red-500 @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="Belum Kawin" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Kawin" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                    <option value="Cerai Hidup" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                </select>
                @error('status_perkawinan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Pekerjaan</label>
                <input type="text" name="pekerjaan" class="w-full px-4 py-2 border rounded @error('pekerjaan') border-red-500 @enderror" 
                    value="{{ old('pekerjaan', $anggota->pekerjaan) }}">
                @error('pekerjaan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Alamat -->
            <div class="col-span-2">
                <h3 class="font-bold text-lg mb-2">Alamat</h3>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Desa</label>
                <input type="text" name="desa" class="w-full px-4 py-2 border rounded @error('desa') border-red-500 @enderror" 
                    value="{{ old('desa', $anggota->desa) }}">
                @error('desa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">RT</label>
                <input type="text" name="rt" class="w-full px-4 py-2 border rounded @error('rt') border-red-500 @enderror" 
                    value="{{ old('rt', $anggota->rt) }}" maxlength="5">
                @error('rt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">RW</label>
                <input type="text" name="rw" class="w-full px-4 py-2 border rounded @error('rw') border-red-500 @enderror" 
                    value="{{ old('rw', $anggota->rw) }}" maxlength="5">
                @error('rw') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Kelurahan</label>
                <input type="text" name="kelurahan" class="w-full px-4 py-2 border rounded @error('kelurahan') border-red-500 @enderror" 
                    value="{{ old('kelurahan', $anggota->kelurahan) }}">
                @error('kelurahan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Kecamatan</label>
                <input type="text" name="kecamatan" class="w-full px-4 py-2 border rounded @error('kecamatan') border-red-500 @enderror" 
                    value="{{ old('kecamatan', $anggota->kecamatan) }}">
                @error('kecamatan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Kabupaten</label>
                <input type="text" name="kabupaten" class="w-full px-4 py-2 border rounded @error('kabupaten') border-red-500 @enderror" 
                    value="{{ old('kabupaten', $anggota->kabupaten) }}">
                @error('kabupaten') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Provinsi</label>
                <input type="text" name="provinsi" class="w-full px-4 py-2 border rounded @error('provinsi') border-red-500 @enderror" 
                    value="{{ old('provinsi', $anggota->provinsi) }}">
                @error('provinsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Kontak & Dokumen -->
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="w-full px-4 py-2 border rounded @error('tanggal_masuk') border-red-500 @enderror" 
                    value="{{ old('tanggal_masuk', $anggota->tanggal_masuk?->format('Y-m-d')) }}">
                @error('tanggal_masuk') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">No. Telp</label>
                <input type="text" name="no_telp" class="w-full px-4 py-2 border rounded @error('no_telp') border-red-500 @enderror" 
                    value="{{ old('no_telp', $anggota->no_telp) }}" maxlength="20">
                @error('no_telp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Foto</label>
                @if ($anggota->foto)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $anggota->foto) }}" alt="{{ $anggota->nama_lengkap }}" class="w-24 h-24 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="foto" class="w-full px-4 py-2 border rounded @error('foto') border-red-500 @enderror" 
                    accept="image/*">
                <small class="text-gray-500">Biarkan kosong jika tidak ingin mengubah foto</small>
                @error('foto') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

         <div class="col-span-2 mt-6">
                <h3 class="font-bold text-lg mb-2">
                    Lokasi Rumah <span class="text-red-500">*</span>
                </h3>

                <p class="text-sm text-gray-600 mb-2">
                    Klik pada peta untuk menentukan lokasi rumah anggota
                </p>

                <div id="map" class="rounded border"></div>

                <div class="grid grid-cols-2 gap-4 mt-3">
                    <div>
                        <label class="text-sm text-gray-600">Latitude</label>
                        <input type="text" id="lat_preview" value="{{ old('latitude', $anggota->latitude) }}" class="w-full px-3 py-2 border rounded bg-gray-100" readonly>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Longitude</label>
                        <input type="text" id="lng_preview" value="{{ old('longitude', $anggota->longitude) }}" class="w-full px-3 py-2 border rounded bg-gray-100" readonly>
                    </div>
                </div>

                @error('latitude')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('admin.anggotas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Perbarui
            </button>
        </div>
    </form>
</div>
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // =========================
    // DATA AWAL (AMAN)
    // =========================
    const initialLat = {{ old('latitude')
        ?? ($anggota->latitude ?? -6.200000)
    }};

    const initialLng = {{ old('longitude')
        ?? ($anggota->longitude ?? 106.816666)
    }};

    const hasLocation = {{ old('latitude')
        || (isset($anggota) && $anggota->latitude)
        ? 'true'
        : 'false'
    }};

    // =========================
    // INIT MAP
    // =========================
    const map = L.map('map').setView(
        [initialLat, initialLng],
        hasLocation ? 16 : 5
    );

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    let marker = null;

    // =========================
    // SET MARKER
    // =========================
    function setMarker(lat, lng) {
        if (marker) map.removeLayer(marker);

        marker = L.marker([lat, lng]).addTo(map);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        document.getElementById('lat_preview').value = lat;
        document.getElementById('lng_preview').value = lng;
    }

    // =========================
    // TAMPILKAN MARKER EDIT
    // =========================
    if (hasLocation) {
        setMarker(initialLat, initialLng);
    }

    // =========================
    // KLIK MAP
    // =========================
    map.on('click', function (e) {
        setMarker(e.latlng.lat, e.latlng.lng);
    });

    // =========================
    // VALIDASI SUBMIT
    // =========================
    document.querySelector('form').addEventListener('submit', function (e) {
        if (!document.getElementById('latitude').value) {
            e.preventDefault();
            alert('Silakan pilih lokasi rumah di peta terlebih dahulu!');
        }
    });
</script>
@endpush

@endsection
