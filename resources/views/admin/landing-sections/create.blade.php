@extends('admin.layout')

@section('title','Tambah Section')

@section('content')
<h1 class="text-xl font-bold mb-4">Tambah Landing Section</h1>

<form method="POST" action="{{ route('admin.landing-sections.store') }}" enctype="multipart/form-data">
@csrf

<label class="block mb-2">Key (hero, about, program)</label>
<input name="key" class="w-full border p-2 mb-4">

<label class="block mb-2">Judul</label>
<input name="title" class="w-full border p-2 mb-4">

<label class="block mb-2">Konten</label>
<textarea name="content" id="editor"
 class="w-full border p-2 mb-4"></textarea>

<label class="block mb-2">Urutan</label>
<input type="number" name="order" class="w-full border p-2 mb-4">

<label class="block mb-2">Gambar</label>
<input type="file" name="image" class="mb-4">

<label class="inline-flex items-center mb-4">
    <input type="checkbox" name="is_active" value="1" checked>
    <span class="ml-2">Aktif</span>
</label>

<button class="bg-green-600 text-white px-4 py-2 rounded">
Simpan
</button>
</form>

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#editor'));
</script>
@endsection
