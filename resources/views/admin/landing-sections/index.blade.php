@extends('admin.layout')

@section('title','Landing Sections')

@section('content')
<h1 class="text-2xl font-bold mb-4">Landing Page Sections</h1>

<a href="{{ route('admin.landing-sections.create') }}"
   class="bg-blue-600 text-white px-4 py-2 rounded">
   + Tambah Section
</a>

<table class="w-full mt-4 bg-white rounded shadow">
    <thead>
        <tr class="border-b">
            <th class="p-2">Key</th>
            <th>Judul</th>
            <th>Order</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    @foreach($sections as $section)
        <tr class="border-b">
            <td class="p-2">{{ $section->key }}</td>
            <td>{{ $section->title }}</td>
            <td>{{ $section->order }}</td>
            <td>
                <span class="{{ $section->is_active ? 'text-green-600' : 'text-red-600' }}">
                    {{ $section->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </td>
            <td class="space-x-2">
                <a href="{{ route('admin.landing-sections.edit', $section) }}"
                   class="text-blue-600">Edit</a>

                <form action="{{ route('admin.landing-sections.destroy', $section) }}"
                      method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus section ini?')"
                            class="text-red-600">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
