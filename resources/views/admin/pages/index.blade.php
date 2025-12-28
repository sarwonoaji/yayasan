@extends('admin.layout')

@section('title','Pages')

@section('content')
<h1 class="text-2xl font-bold mb-4">Halaman Statis</h1>

<a href="{{ route('admin.pages.create') }}"
   class="bg-blue-600 text-white px-4 py-2 rounded">
   + Tambah Halaman
</a>

<table class="w-full mt-4 bg-white rounded shadow">
    <tr class="border-b">
        <th class="p-2">Judul</th>
        <th>Slug</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($pages as $page)
    <tr class="border-b">
        <td class="p-2">{{ $page->title }}</td>
        <td>{{ $page->slug }}</td>
        <td>{{ $page->is_active ? 'Aktif' : 'Nonaktif' }}</td>
        <td class="space-x-2">
            <a href="{{ route('admin.pages.edit',$page) }}" class="text-blue-600">Edit</a>
            <form method="POST" action="{{ route('admin.pages.destroy',$page) }}" class="inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Hapus halaman?')" class="text-red-600">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
