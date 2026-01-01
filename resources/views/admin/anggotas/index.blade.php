@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Daftar Anggota</h1>
        <a href="{{ route('admin.anggotas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Anggota
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">NIK</th>
                    <th class="px-4 py-2 text-left">Nama Lengkap</th>
                    <th class="px-4 py-2 text-left">Jenis Kelamin</th>
                    <th class="px-4 py-2 text-left">Tempat/Tanggal Lahir</th>
                    <th class="px-4 py-2 text-left">Pekerjaan</th>
                    <th class="px-4 py-2 text-left">No. Telp</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggotas as $anggota)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $anggota->nik }}</td>
                        <td class="px-4 py-2">{{ $anggota->nama_lengkap }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 bg-gray-200 rounded">
                                {{ $anggota->jenis_kelamin == 'L' || $anggota->jenis_kelamin == 'Laki-laki' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            {{ $anggota->tempat_lahir }}
                            @if ($anggota->tanggal_lahir)
                                <br><small class="text-gray-600">{{ $anggota->tanggal_lahir->format('d M Y') }}</small>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $anggota->pekerjaan->nama_pekerjaan?? '-'}}</td>
                        <td class="px-4 py-2">{{ $anggota->no_telp ?? '-' }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('admin.anggotas.show', $anggota->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">
                                Lihat
                            </a>
                            <a href="{{ route('admin.anggotas.edit', $anggota->id) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.anggotas.destroy', $anggota->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Yakin ingin menghapus?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-gray-500">Tidak ada data anggota</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $anggotas->links() }}
    </div>
</div>
@endsection
