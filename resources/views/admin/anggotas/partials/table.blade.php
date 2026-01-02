<div class="mt-4 bg-white rounded shadow overflow-x-auto">
    <table class="w-full min-w-[1000px]">
        <thead>
            <tr class="text-left bg-slate-700">
                <th class="p-3 text-slate-100">NIK</th>
                <th class="p-3 text-slate-100">Status</th>
                <th class="p-3 text-slate-100">Nama Lengkap</th>
                <th class="p-3 text-slate-100">Jenis Kelamin</th>
                <th class="p-3 text-slate-100">Tempat/Tanggal Lahir</th>
                <th class="p-3 text-slate-100">Pekerjaan</th>
                <th class="p-3 text-slate-100">No. Telp</th>
                <th class="p-3 text-slate-100 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($anggotas as $anggota)
                <tr class="border-b hover:bg-emerald-50">
                    <td class="p-3">{{ $anggota->nik }}</td>
                    <td class="p-3">{{ $anggota->status_kk }}</td>
                    <td class="p-3">{{ $anggota->nama_lengkap }}</td>
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
                            <form method="POST" action="{{ route('admin.anggotas.destroy', $anggota->id) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-red-50 text-red-600 border border-transparent hover:border-red-100" title="Hapus">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="p-8 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <span class="material-symbols-outlined text-gray-400 text-5xl">person_off</span>
                            <div>
                                <p class="text-gray-500 font-medium">
                                    @if(request('search'))
                                        Tidak ada hasil pencarian
                                    @else
                                        Tidak ada data anggota
                                    @endif
                                </p>
                                <p class="text-gray-400 text-sm mt-1">
                                    @if(request('search'))
                                        Coba kata kunci lain atau hapus filter pencarian
                                    @else
                                        Belum ada anggota yang terdaftar dalam sistem
                                    @endif
                                </p>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($anggotas->hasPages())
    <x-pagination :paginator="$anggotas" />
@endif