@extends('admin.layout')

@section('title','Berita')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Berita</h1>
    <a href="{{ route('admin.news.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">
        + Tambah Berita
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-100 border-b">
        <tr>
            <th class="p-3 text-left">Gambar</th>
            <th class="p-3 text-left">Judul</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Tanggal</th>
            <th class="p-3 text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
    @forelse($news as $item)
        <tr class="border-b">
            <td class="p-3">
                @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}"
                         class="h-14 rounded">
                @else
                    <span class="text-gray-400">-</span>
                @endif
            </td>

            <td class="p-3">
                <div class="font-semibold">{{ $item->title }}</div>
                <div class="text-sm text-gray-500">{{ $item->slug }}</div>
            </td>

            <td class="p-3">
                @if($item->published_at && $item->published_at <= now())
                    <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded">
                        Published
                    </span>
                @else
                    <span class="px-2 py-1 bg-gray-200 text-gray-700 text-xs rounded">
                        Draft
                    </span>
                @endif
            </td>

            <td class="p-3 text-sm">
                {{ $item->published_at?->format('d M Y') ?? '-' }}
            </td>

            <td class="p-3 text-center space-x-2">
                <a href="{{ route('admin.news.edit', $item) }}"
                   class="text-blue-600">Edit</a>

                <form action="{{ route('admin.news.destroy', $item) }}"
                      method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus berita ini?')"
                            class="text-red-600">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="p-6 text-center text-gray-500">
                Belum ada berita
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
@endsection
