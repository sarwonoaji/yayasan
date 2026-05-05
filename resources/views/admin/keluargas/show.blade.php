@extends('admin.layout')

@section('title','Detail Keluarga')
@section('content')
<div class="mb-2">
    <h1 class="text-2xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">family_restroom</span>
        Detail Keluarga
    </h1>

    <div class="mt-3 flex gap-4">
        <a href="{{ route('admin.keluargas.index') }}" class="inline-flex items-center gap-2 border border-gray-300 px-4 py-2 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Kembali
        </a>

        <a href="{{ route('admin.keluargas.pdf', $kepalaKeluarga->id) }}" target="_blank" class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">
            <span class="material-symbols-outlined text-sm">print</span>
            Cetak PDF
        </a>
    </div>
</div>

@if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

<!-- Info Kepala Keluarga -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">person</span>
        Kepala Keluarga
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">No. KK</label>
            <p class="mt-1 text-sm text-gray-900 font-mono">{{ $kepalaKeluarga->no_kk }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <p class="mt-1 text-sm text-gray-900 font-semibold">{{ $kepalaKeluarga->nama_lengkap }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">NIK</label>
            <p class="mt-1 text-sm text-gray-900 font-mono">{{ $kepalaKeluarga->nik }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <p class="mt-1 text-sm text-gray-900">
                @if($kepalaKeluarga->jenis_kelamin == 'L' || $kepalaKeluarga->jenis_kelamin == 'Laki-laki')
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-600 text-white">Laki-laki</span>
                @else
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-pink-600 text-white">Perempuan</span>
                @endif
            </p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Tempat/Tanggal Lahir</label>
            <p class="mt-1 text-sm text-gray-900">
                {{ $kepalaKeluarga->tempat_lahir }}
                @if ($kepalaKeluarga->tanggal_lahir)
                    , {{ $kepalaKeluarga->tanggal_lahir->format('d M Y') }}
                @endif
            </p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Pekerjaan</label>
            <p class="mt-1 text-sm text-gray-900">{{ $kepalaKeluarga->pekerjaan->nama_pekerjaan ?? '-' }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
            <p class="mt-1 text-sm text-gray-900">{{ $kepalaKeluarga->no_telp ?? '-' }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Alamat</label>
            <p class="mt-1 text-sm text-gray-900">
                {{ $kepalaKeluarga->desa ?? '-' }}, RT {{ $kepalaKeluarga->rt ?? '-' }}/RW {{ $kepalaKeluarga->rw ?? '-' }}<br>
                {{ $kepalaKeluarga->kelurahan ?? '-' }}, {{ $kepalaKeluarga->kecamatan ?? '-' }}<br>
                {{ $kepalaKeluarga->kabupaten ?? '-' }}, {{ $kepalaKeluarga->provinsi ?? '-' }}
            </p>
        </div>
    </div>
</div>

<!-- Anggota Keluarga -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">groups</span>
        Anggota Keluarga ({{ $anggotaKeluarga->count() }} orang)
    </h3>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[1000px]">
            <thead>
                <tr class="text-left bg-slate-100">
                    <th class="p-3 text-slate-700 text-sm font-semibold">Status</th>
                    <th class="p-3 text-slate-700 text-sm font-semibold">NIK</th>
                    <th class="p-3 text-slate-700 text-sm font-semibold">Nama Lengkap</th>
                    <th class="p-3 text-slate-700 text-sm font-semibold">Jenis Kelamin</th>
                    <th class="p-3 text-slate-700 text-sm font-semibold">Tempat/Tanggal Lahir</th>
                    <th class="p-3 text-slate-700 text-sm font-semibold">Pekerjaan</th>
                    <th class="p-3 text-slate-700 text-sm font-semibold">No. Telp</th>
                    <th class="p-3 text-slate-700 text-sm font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggotaKeluarga as $anggota)
                    <tr class="border-b hover:bg-gray-50 {{ $anggota->status_kk == 'Kepala Keluarga' ? 'bg-emerald-50' : '' }}">
                        <td class="p-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                @if($anggota->status_kk == 'Kepala Keluarga') bg-emerald-600 text-white
                                @elseif($anggota->status_kk == 'Istri') bg-pink-600 text-white
                                @elseif($anggota->status_kk == 'Anak') bg-blue-600 text-white
                                @else bg-gray-600 text-white @endif">
                                {{ $anggota->status_kk }}
                            </span>
                        </td>
                        <td class="p-3 font-mono text-sm">{{ $anggota->nik }}</td>
                        <td class="p-3 font-semibold">{{ $anggota->nama_lengkap }}</td>
                        <td class="p-3">
                            @if($anggota->jenis_kelamin == 'L' || $anggota->jenis_kelamin == 'Laki-laki')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-600 text-white">Laki-laki</span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-pink-600 text-white">Perempuan</span>
                            @endif
                        </td>
                        <td class="p-3">
                            {{ $anggota->tempat_lahir }}
                            @if ($anggota->tanggal_lahir)
                                <br><span class="text-gray-500 text-sm">{{ $anggota->tanggal_lahir->format('d M Y') }}</span>
                            @endif
                        </td>
                        <td class="p-3">{{ $anggota->pekerjaan->nama_pekerjaan ?? '-' }}</td>
                        <td class="p-3">{{ $anggota->no_telp ?? '-' }}</td>
                        <td class="p-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.anggotas.show', $anggota->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-emerald-50 text-emerald-600 border border-transparent hover:border-emerald-100" title="Lihat Detail">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.anggotas.edit', $anggota->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-blue-50 text-blue-600 border border-transparent hover:border-blue-100" title="Edit">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection