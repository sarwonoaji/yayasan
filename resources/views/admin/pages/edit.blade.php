@extends('admin.layout')

@section('title','Edit Halaman')

@section('content')
<h1 class="text-xl font-bold mb-4">Edit Halaman</h1>

<form method="POST">
@csrf @method('PUT')

<input name="title" value="{{ $page->title }}"
 class="w-full border p-2 mb-4">

<input name="slug" value="{{ $page->slug }}"
 class="w-full border p-2 mb-4">

<textarea name="content" id="editor"
 class="w-full border p-2 mb-4">{!! $page->content !!}</textarea>

<input name="meta_title" value="{{ $page->meta_title }}"
 class="w-full border p-2 mb-4">

<textarea name="meta_description"
 class="w-full border p-2 mb-4">{{ $page->meta_description }}</textarea>

<label class="inline-flex items-center mb-4">
    <input type="checkbox" name="is_active" value="1" {{ $page->is_active ? 'checked' : '' }}>
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
