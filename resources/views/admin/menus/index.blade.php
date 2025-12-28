@extends('admin.layout')

@section('title','Menu')

@section('content')
<h1 class="text-2xl font-bold mb-4">Kelola Menu Navbar</h1>

<a href="{{ route('admin.menus.create') }}"
   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
   + Tambah Menu
</a>

@if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<table class="w-full bg-white rounded shadow">
    <thead class="bg-gray-100 border-b">
        <tr>
            <th class="p-3 text-left">Urutan</th>
            <th class="p-3 text-left">Judul Menu</th>
            <th class="p-3 text-left">URL</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($menus as $menu)
        <tr class="border-b">
            <td class="p-3 text-center font-semibold">{{ $menu->order ?? '-' }}</td>
            <td class="p-3">{{ $menu->title }}</td>
            <td class="p-3 text-sm text-gray-600">{{ $menu->url }}</td>
            <td class="p-3">
                <span class="px-2 py-1 text-xs rounded @if($menu->is_active) bg-green-100 text-green-700 @else bg-gray-100 text-gray-700 @endif">
                    {{ $menu->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </td>
            <td class="p-3 text-center space-x-2">
                <a href="{{ route('admin.menus.edit', $menu) }}" class="text-blue-600 hover:underline">Edit</a>
                <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus menu ini?')" class="text-red-600 hover:underline">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="p-6 text-center text-gray-500">
                Belum ada menu
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
