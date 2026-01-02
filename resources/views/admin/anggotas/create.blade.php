@extends('admin.layout')

@section('content')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map { height: 400px; }
</style>
@endpush

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Tambah Anggota Baru</h1>
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

    <form method="POST" action="{{ route('admin.anggotas.store') }}" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Data Keluarga -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600">family_restroom</span>
                Data Keluarga
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('nik') border-red-500 @enderror" 
                        value="{{ old('nik') }}" required>
                    @error('nik') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status dalam Keluarga <span class="text-red-500">*</span></label>
                    <select name="status_kk" id="status_kk" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('status_kk') border-red-500 @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="Kepala Keluarga" {{ old('status_kk') == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                        <option value="Anggota Keluarga" {{ old('status_kk') == 'Anggota Keluarga' ? 'selected' : '' }}>Anggota Keluarga</option>
                   </select>
                    @error('status_kk') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div id="no_kk_container" class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. KK <span class="text-red-500">*</span></label>
                    <input type="text" id="no_kk_input" name="no_kk" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('no_kk') border-red-500 @enderror"
                        value="{{ old('no_kk') }}">
                    <select id="no_kk_select" name="" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('no_kk') border-red-500 @enderror" style="display: none;">
                        <option value="">-- Pilih No. KK Keluarga --</option>
                        @foreach($existing_no_kk as $kk)
                            <option value="{{ $kk->no_kk }}" {{ old('no_kk') == $kk->no_kk ? 'selected' : '' }}>{{ $kk->no_kk }} - {{ $kk->nama_lengkap }}</option>
                        @endforeach
                    </select>
                    @error('no_kk') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Data Pribadi -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600">person</span>
                Data Pribadi
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('nama_lengkap') border-red-500 @enderror" 
                        value="{{ old('nama_lengkap') }}" required>
                    @error('nama_lengkap') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('jenis_kelamin') border-red-500 @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('tempat_lahir') border-red-500 @enderror" 
                        value="{{ old('tempat_lahir') }}">
                    @error('tempat_lahir') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('tanggal_lahir') border-red-500 @enderror" 
                        value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Golongan Darah</label>
                    <select name="golongan_darah" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('golongan_darah') border-red-500 @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                    </select>
                    @error('golongan_darah') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan</label>
                    <select name="status_perkawinan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('status_perkawinan') border-red-500 @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                        <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                    </select>
                    @error('status_perkawinan') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan <span class="text-red-500">*</span></label>
                    <select name="pekerjaan_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('pekerjaan_id') border-red-500 @enderror" required>
                        <option value="">-- Pilih Pekerjaan --</option>
                        @foreach($pekerjaans as $pekerjaan)
                            <option value="{{ $pekerjaan->id }}" {{ old('pekerjaan_id') == $pekerjaan->id ? 'selected' : '' }}>{{ $pekerjaan->nama_pekerjaan }}</option>
                        @endforeach
                    </select>
                    @error('pekerjaan_id') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. Telp</label>
                    <input type="text" name="no_telp" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('no_telp') border-red-500 @enderror" 
                        value="{{ old('no_telp') }}">
                    @error('no_telp') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('tanggal_masuk') border-red-500 @enderror" 
                        value="{{ old('tanggal_masuk') }}">
                    @error('tanggal_masuk') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                    <input type="file" name="foto" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('foto') border-red-500 @enderror">
                    @error('foto') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Alamat -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600">location_on</span>
                Alamat
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Desa</label>
                    <input type="text" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('desa') border-red-500 @enderror" 
                        value="{{ old('desa') }}">
                    @error('desa') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">RT</label>
                    <input type="text" name="rt" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('rt') border-red-500 @enderror" 
                        value="{{ old('rt') }}" maxlength="5">
                    @error('rt') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">RW</label>
                    <input type="text" name="rw" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('rw') border-red-500 @enderror" 
                        value="{{ old('rw') }}" maxlength="5">
                    @error('rw') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan</label>
                    <input type="text" name="kelurahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('kelurahan') border-red-500 @enderror" 
                        value="{{ old('kelurahan') }}">
                    @error('kelurahan') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                    <input type="text" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('kecamatan') border-red-500 @enderror" 
                        value="{{ old('kecamatan') }}">
                    @error('kecamatan') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten</label>
                    <input type="text" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('kabupaten') border-red-500 @enderror" 
                        value="{{ old('kabupaten') }}">
                    @error('kabupaten') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                    <input type="text" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('provinsi') border-red-500 @enderror" 
                        value="{{ old('provinsi') }}">
                    @error('provinsi') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Lokasi -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600">map</span>
                Lokasi Rumah <span class="text-red-500">*</span>
            </h3>
            <p class="text-sm text-gray-600 mb-4">Klik pada peta untuk menentukan lokasi rumah anggota</p>
            
            <div id="map" class="w-full h-80 rounded-lg border border-gray-200 mb-4"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                    <input type="text" id="latitude" name="latitude" readonly class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg @error('latitude') border-red-500 @enderror" 
                        value="{{ old('latitude') }}">
                    @error('latitude') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                    <input type="text" id="longitude" name="longitude" readonly class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg @error('longitude') border-red-500 @enderror" 
                        value="{{ old('longitude') }}">
                    @error('longitude') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.anggotas.index') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Batal
            </a>
            <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium">
                Simpan Anggota
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
    const initialLat = {{
        old('latitude')
        ?? -7.53084185
    }};

    const initialLng = {{
        old('longitude')
        ?? 110.83998226
    }};

    const hasLocation = {{
        old('latitude') ? 'true' : 'false'
    }};

    // =========================
    // INIT MAP
    // =========================
    const map = L.map('map').setView(
        [initialLat, initialLng],
        hasLocation ? 18 : 10
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
    // TAMPILKAN MARKER CREATE
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

    // =========================
    // DYNAMIC NO KK FIELD
    // =========================
    const statusKKSelect = document.getElementById('status_kk');
    const noKKContainer = document.getElementById('no_kk_container');
    const noKKInput = document.getElementById('no_kk_input');
    const noKKSelect = document.getElementById('no_kk_select');

    function toggleNoKKField() {
        const selectedValue = statusKKSelect.value;
        if (selectedValue === 'Kepala Keluarga') {
            noKKContainer.style.display = 'block';
            noKKInput.style.display = 'block';
            noKKSelect.style.display = 'none';
            noKKInput.required = true;
            noKKSelect.required = false;
            noKKInput.name = 'no_kk';
            noKKSelect.name = '';
        } else if (selectedValue && selectedValue !== '') {
            // All other family member types (Istri, Anak, Menantu, etc.) select from existing No KK
            noKKContainer.style.display = 'block';
            noKKInput.style.display = 'none';
            noKKSelect.style.display = 'block';
            noKKInput.required = false;
            noKKSelect.required = true;
            noKKInput.name = '';
            noKKSelect.name = 'no_kk';
        } else {
            noKKContainer.style.display = 'none';
            noKKInput.required = false;
            noKKSelect.required = false;
            noKKInput.name = '';
            noKKSelect.name = '';
        }
    }

    statusKKSelect.addEventListener('change', toggleNoKKField);
    toggleNoKKField(); // Initial check
</script>
@endpush

@endsection
