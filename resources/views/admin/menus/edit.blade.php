@extends('admin.layout')

@section('title','Edit Menu')

@section('content')
<h1 class="text-xl font-bold mb-4">Edit Menu</h1>

<form method="POST" action="{{ route('admin.menus.update', $menu) }}" class="max-w-2xl bg-white p-6 rounded shadow">
@csrf
@method('PUT')

<div class="mb-4">
    <label class="block font-semibold mb-2">Judul Menu *</label>
    <input type="text" name="title" value="{{ old('title', $menu->title) }}" 
           class="w-full border p-2 rounded @error('title') border-red-500 @enderror" 
           placeholder="Contoh: Profil, Visi Misi" required>
    @error('title')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-semibold mb-2">URL / Link *</label>
    <input type="text" name="url" value="{{ old('url', $menu->url) }}" 
           class="w-full border p-2 rounded @error('url') border-red-500 @enderror" 
           placeholder="Contoh: /profil, /visi-misi, https://example.com" required>
    <small class="text-gray-600">Gunakan / untuk halaman internal atau URL lengkap untuk eksternal</small>
    @error('url')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label class="block font-semibold mb-2">Urutan Menu</label>
    <input type="number" name="order" value="{{ old('order', $menu->order) }}" 
           class="w-full border p-2 rounded @error('order') border-red-500 @enderror" 
           placeholder="0, 1, 2, 3 (semakin kecil semakin atas)">
    <small class="text-gray-600">Menu dengan angka lebih kecil akan tampil lebih atas</small>
    @error('order')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label class="flex items-center gap-2">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $menu->is_active) ? 'checked' : '' }}>
        <span class="font-semibold">Aktif di Navbar</span>
    </label>
</div>

<div class="flex gap-2">
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        Update Menu
    </button>
    <a href="{{ route('admin.menus.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
        Batal
    </a>
</div>

</form>
@endsection
