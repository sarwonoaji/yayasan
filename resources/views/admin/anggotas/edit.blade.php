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
        <h1 class="text-3xl font-bold text-gray-800">Edit Anggota</h1>
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

    <form method="POST" action="{{ route('admin.anggotas.update', $anggota->id) }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

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
                        value="{{ old('nik', $anggota->nik) }}" required>
                    @error('nik') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status dalam Keluarga <span class="text-red-500">*</span></label>
                    <select name="status_kk" id="status_kk" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('status_kk') border-red-500 @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="Kepala Keluarga" {{ old('status_kk', $anggota->status_kk) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                        <option value="Anggota Keluarga" {{ old('status_kk', $anggota->status_kk) == 'Anggota Keluarga' ? 'selected' : '' }}>Anggota Keluarga</option>
                   </select>
                    @error('status_kk') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div id="no_kk_container" class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. KK <span class="text-red-500">*</span></label>
                    <input type="text" id="no_kk_input" name="no_kk" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('no_kk') border-red-500 @enderror"
                        value="{{ old('no_kk', $anggota->no_kk) }}">
                    <select id="no_kk_select" name="" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('no_kk') border-red-500 @enderror" style="display: none;">
                        <option value="">-- Pilih No. KK Keluarga --</option>
                        @foreach($existing_no_kk as $kk)
                            <option value="{{ $kk->no_kk }}" {{ old('no_kk', $anggota->no_kk) == $kk->no_kk ? 'selected' : '' }}>{{ $kk->no_kk }} - {{ $kk->nama_lengkap }}</option>
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
                        value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" required>
                    @error('nama_lengkap') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jenis_kelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('jenis_kelamin') border-red-500 @enderror" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('tempat_lahir') border-red-500 @enderror" 
                        value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}">
                    @error('tempat_lahir') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('tanggal_lahir') border-red-500 @enderror" 
                        value="{{ old('tanggal_lahir', $anggota->tanggal_lahir?->format('Y-m-d')) }}">
                    @error('tanggal_lahir') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Golongan Darah</label>
                    <select name="golongan_darah" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('golongan_darah') border-red-500 @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="A" {{ old('golongan_darah', $anggota->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('golongan_darah', $anggota->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ old('golongan_darah', $anggota->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ old('golongan_darah', $anggota->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
                    </select>
                    @error('golongan_darah') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan</label>
                    <select name="status_perkawinan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('status_perkawinan') border-red-500 @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="Belum Kawin" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Kawin" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                        <option value="Cerai Hidup" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="Cerai Mati" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                    </select>
                    @error('status_perkawinan') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan <span class="text-red-500">*</span></label>
                    <select name="pekerjaan_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('pekerjaan_id') border-red-500 @enderror" required>
                        <option value="">-- Pilih Pekerjaan --</option>
                        @foreach($pekerjaans as $pekerjaan)
                            <option value="{{ $pekerjaan->id }}" {{ old('pekerjaan_id', $anggota->pekerjaan_id) == $pekerjaan->id ? 'selected' : '' }}>{{ $pekerjaan->nama_pekerjaan }}</option>
                        @endforeach
                    </select>
                    @error('pekerjaan_id') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">No. Telp</label>
                    <input type="text" name="no_telp" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('no_telp') border-red-500 @enderror" 
                        value="{{ old('no_telp', $anggota->no_telp) }}">
                    @error('no_telp') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('tanggal_masuk') border-red-500 @enderror" 
                        value="{{ old('tanggal_masuk', $anggota->tanggal_masuk?->format('Y-m-d')) }}">
                    @error('tanggal_masuk') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                    <input type="file" name="foto" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('foto') border-red-500 @enderror">
                    @if($anggota->foto)
                        <p class="text-sm text-gray-600 mt-1">Foto saat ini akan diganti jika Anda memilih file baru</p>
                    @endif
                    @error('foto') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
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

            <div id="map" class="rounded-lg border border-gray-300 mb-4"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                    <input type="text" id="lat_preview" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" 
                        value="{{ old('latitude', $anggota->latitude) }}" readonly>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                    <input type="text" id="lng_preview" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" 
                        value="{{ old('longitude', $anggota->longitude) }}" readonly>
                </div>
            </div>

            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">

            @error('latitude')
                <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Alamat -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600">location_on</span>
                Alamat
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" id="alamat_lengkap" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('alamat_lengkap') border-red-500 @enderror" 
                        placeholder="Alamat akan otomatis terisi setelah memilih lokasi di peta">{{ old('alamat_lengkap', $anggota->alamat_lengkap ?? '') }}</textarea>
                    @error('alamat_lengkap') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div> --}}

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Desa</label>
                    <input type="text" name="desa" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('desa') border-red-500 @enderror" 
                        value="{{ old('desa', $anggota->desa) }}">
                    @error('desa') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">RT</label>
                    <input type="text" name="rt" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('rt') border-red-500 @enderror" 
                        value="{{ old('rt', $anggota->rt) }}" maxlength="5">
                    @error('rt') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">RW</label>
                    <input type="text" name="rw" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('rw') border-red-500 @enderror" 
                        value="{{ old('rw', $anggota->rw) }}" maxlength="5">
                    @error('rw') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan</label>
                    <input type="text" name="kelurahan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('kelurahan') border-red-500 @enderror" 
                        value="{{ old('kelurahan', $anggota->kelurahan) }}">
                    @error('kelurahan') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                    <input type="text" name="kecamatan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('kecamatan') border-red-500 @enderror" 
                        value="{{ old('kecamatan', $anggota->kecamatan) }}">
                    @error('kecamatan') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten</label>
                    <input type="text" name="kabupaten" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('kabupaten') border-red-500 @enderror" 
                        value="{{ old('kabupaten', $anggota->kabupaten) }}">
                    @error('kabupaten') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                    <input type="text" name="provinsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('provinsi') border-red-500 @enderror" 
                        value="{{ old('provinsi', $anggota->provinsi) }}">
                    @error('provinsi') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>


        <!-- Submit Buttons -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.anggotas.index') }}" class="inline-flex items-center gap-2 px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    <span class="material-symbols-outlined text-sm">cancel</span>
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors">
                    <span class="material-symbols-outlined text-sm">save</span>
                    Perbarui Anggota
                </button>
            </div>
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
        hasLocation ? 18 : 10
    );

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    let marker = null;

    // =========================
    // GET ADDRESS FROM COORDINATES (REVERSE GEOCODING)
    // =========================
    async function getAddressFromCoordinates(lat, lng) {
        try {
            // Call backend endpoint yang tidak memiliki masalah CORS
            const response = await fetch(
                `{{ route('admin.anggotas.reverse-geocode') }}?lat=${lat}&lng=${lng}`
            );
            
            if (!response.ok) {
                throw new Error('Gagal mengambil data alamat');
            }
            
            const data = await response.json();
            return data.address || null;
        } catch (error) {
            console.error('Error getting address:', error);
            return null;
        }
    }

    // =========================
    // SET MARKER
    // =========================
    async function setMarker(lat, lng) {
        if (marker) map.removeLayer(marker);

        marker = L.marker([lat, lng]).addTo(map);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        document.getElementById('lat_preview').value = lat;
        document.getElementById('lng_preview').value = lng;

        // RESET SEMUA FIELD ALAMAT TERLEBIH DAHULU
        //document.getElementById('alamat_lengkap').value = '';
        document.querySelector('input[name="desa"]').value = '';
        document.querySelector('input[name="kelurahan"]').value = '';
        document.querySelector('input[name="kecamatan"]').value = '';
        document.querySelector('input[name="kabupaten"]').value = '';
        document.querySelector('input[name="provinsi"]').value = '';

        // Ambil alamat dari koordinat
        const addressData = await getAddressFromCoordinates(lat, lng);
        
        if (addressData) {
            console.log('Nominatim Response:', addressData);
            
            // Format alamat lengkap dengan lebih detail
            const addressParts = [];
            
            // Tambahkan komponen alamat yang tersedia (lebih detail)
            if (addressData.house_number) addressParts.push(addressData.house_number);
            if (addressData.road) addressParts.push(addressData.road);
            if (addressData.house_name) addressParts.push(addressData.house_name);
            if (addressData.neighbourhood) addressParts.push(addressData.neighbourhood);
            if (addressData.hamlet) addressParts.push(addressData.hamlet);
            
            const formattedAddress = addressParts.join(', ');
            
            // Set alamat ke textarea
            // if (formattedAddress) {
            //     document.getElementById('alamat_lengkap').value = formattedAddress;
            // } else if (addressData.display_name) {
            //     // Jika tidak ada detail, gunakan display_name
            //     document.getElementById('alamat_lengkap').value = addressData.display_name;
            // }
            
            // MAPPING UNTUK INDONESIA (Nominatim memiliki struktur berbeda per lokasi)
            
            // DESA - prioritas: hamlet > suburb
            if (addressData.hamlet) {
                document.querySelector('input[name="desa"]').value = addressData.hamlet;
            } else if (addressData.suburb) {
                document.querySelector('input[name="desa"]').value = addressData.suburb;
            }
            
            // KELURAHAN - prioritas: village > neighbourhood
            if (addressData.village) {
                document.querySelector('input[name="kelurahan"]').value = addressData.village;
            } else if (addressData.neighbourhood) {
                document.querySelector('input[name="kelurahan"]').value = addressData.neighbourhood;
            }
            
            // KECAMATAN - logic khusus untuk Indonesia
            let kecamatan = '';
            
            // Jika ada municipality dengan format "Kecamatan XXX"
            if (addressData.municipality && addressData.municipality.includes('Kecamatan')) {
                kecamatan = addressData.municipality.replace('Kecamatan ', '').trim();
            } 
            // Jika ada county (di beberapa tempat ini adalah kecamatan)
            else if (addressData.county) {
                kecamatan = addressData.county;
            }
            
            if (kecamatan) {
                document.querySelector('input[name="kecamatan"]').value = kecamatan;
            }
            
            // KABUPATEN - logic: city > county (ketika tidak ada municipality dengan "Kecamatan")
            let kabupaten = '';
            
            if (addressData.city) {
                kabupaten = addressData.city;
            } 
            // Jika city tidak ada tapi ada county dan tidak ada municipality "Kecamatan"
            else if (addressData.county && (!addressData.municipality || !addressData.municipality.includes('Kecamatan'))) {
                kabupaten = addressData.county;
            }
            
            if (kabupaten) {
                document.querySelector('input[name="kabupaten"]').value = kabupaten;
            }
            
            // PROVINSI - selalu state atau region
            if (addressData.state) {
                document.querySelector('input[name="provinsi"]').value = addressData.state;
            } else if (addressData.region) {
                document.querySelector('input[name="provinsi"]').value = addressData.region;
            }
        }
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
