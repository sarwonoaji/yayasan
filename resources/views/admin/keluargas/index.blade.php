@extends('admin.layout')

@section('content')
<div class="mb-2">
    <h1 class="text-2xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">family_restroom</span>
        Data Keluarga
    </h1>

    <div class="mt-3">
        <a href="{{ route('admin.keluargas.index') }}" class="bg-emerald-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">refresh</span>
            Refresh
        </a>
    </div>
</div>

@if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="mt-4 bg-white rounded shadow overflow-x-auto">
    <table class="w-full min-w-[1000px]">
        <thead>
            <tr class="text-left bg-slate-700">
                <th class="p-3 text-slate-100">No. KK</th>
                <th class="p-3 text-slate-100">Kepala Keluarga</th>
                <th class="p-3 text-slate-100">Jenis Kelamin</th>
                <th class="p-3 text-slate-100">Tempat/Tanggal Lahir</th>
                <th class="p-3 text-slate-100">Pekerjaan</th>
                <th class="p-3 text-slate-100">No. Telp</th>
                <th class="p-3 text-slate-100">Jumlah Anggota</th>
                <th class="p-3 text-slate-100 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($keluargas as $keluarga)
                <tr class="border-b hover:bg-emerald-50">
                    <td class="p-3 font-mono text-sm">{{ $keluarga->no_kk }}</td>
                    <td class="p-3 font-semibold">{{ $keluarga->nama_lengkap }}</td>
                    <td class="p-3">
                        @if($keluarga->jenis_kelamin == 'L' || $keluarga->jenis_kelamin == 'Laki-laki')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-600 text-white">Laki-laki</span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-pink-600 text-white">Perempuan</span>
                        @endif
                    </td>
                    <td class="p-3">
                        {{ $keluarga->tempat_lahir }}
                        @if ($keluarga->tanggal_lahir)
                            <br><span class="text-gray-500 text-sm">{{ $keluarga->tanggal_lahir->format('d M Y') }}</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $keluarga->pekerjaan->nama_pekerjaan ?? '-' }}</td>
                    <td class="p-3">{{ $keluarga->no_telp ?? '-' }}</td>
                    <td class="p-3">
                        <?php
                            $jumlahAnggota = \App\Models\Anggota::where('no_kk', $keluarga->no_kk)
                                ->where('is_deleted', false)
                                ->count();
                        ?>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-emerald-600 text-white">
                            {{ $jumlahAnggota }} orang
                        </span>
                    </td>
                    <td class="p-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.keluargas.show', $keluarga->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-emerald-50 text-emerald-600 border border-transparent hover:border-emerald-100" title="Lihat Detail Keluarga">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="p-8 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <span class="material-symbols-outlined text-gray-400 text-5xl">family_restroom</span>
                            <div>
                                <p class="text-gray-500 font-medium">Tidak ada data keluarga</p>
                                <p class="text-gray-400 text-sm mt-1">Belum ada kepala keluarga yang terdaftar dalam sistem</p>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($keluargas->hasPages())
    <x-pagination :paginator="$keluargas" />
@endif
@endsection