@extends('admin.layout')

@section('title','Tambah Berita')

@section('content')
<h1 class="text-xl font-bold mb-4">Tambah Berita</h1>

<form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
@csrf

<label class="block mb-2">Judul</label>
<input name="title" class="w-full border p-2 mb-4" required>

<label class="block mb-2">Excerpt</label>
<textarea name="excerpt" class="w-full border p-2 mb-4"></textarea>

<label class="block mb-2">Konten</label>
<textarea name="content" id="editor"
 class="w-full border p-2 mb-4"></textarea>

<label class="block mb-2">Gambar</label>
<input type="file" name="image" class="mb-4">

<label class="block mb-2">Tanggal Publish</label>
<input type="datetime-local" name="published_at"
 class="border p-2 mb-4">

<label class="block mb-2">Meta Title</label>
<input name="meta_title" class="w-full border p-2 mb-4">

<label class="block mb-2">Meta Description</label>
<textarea name="meta_description"
 class="w-full border p-2 mb-4"></textarea>

<button class="bg-green-600 text-white px-4 py-2 rounded">
Simpan
</button>
</form>

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#editor'));
</script>
@endsection
