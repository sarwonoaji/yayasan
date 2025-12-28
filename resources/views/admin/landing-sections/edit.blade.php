@extends('admin.layout')

@section('title','Edit Section')

@section('content')
<h1 class="text-xl font-bold mb-4">Edit Landing Section</h1>

<form method="POST" enctype="multipart/form-data">
@csrf @method('PUT')

<label class="block mb-2">Key</label>
<input name="key" value="{{ $landingSection->key }}"
 class="w-full border p-2 mb-4">

<label class="block mb-2">Judul</label>
<input name="title" value="{{ $landingSection->title }}"
 class="w-full border p-2 mb-4">

<label class="block mb-2">Konten</label>
<textarea name="content" id="editor"
 class="w-full border p-2 mb-4">{!! $landingSection->content !!}</textarea>

<label class="block mb-2">Urutan</label>
<input type="number" name="order" value="{{ $landingSection->order }}"
 class="w-full border p-2 mb-4">

@if($landingSection->image)
    <img src="{{ asset('storage/'.$landingSection->image) }}"
         class="h-32 mb-4">
@endif

<input type="file" name="image" class="mb-4">

<label class="inline-flex items-center mb-4">
    <input type="checkbox" name="is_active" value="1"
           {{ $landingSection->is_active ? 'checked' : '' }}>
    <span class="ml-2">Aktif</span>
</label>

<button class="bg-blue-600 text-white px-4 py-2 rounded">
Update
</button>
</form>

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#editor'));
</script>
@endsection
