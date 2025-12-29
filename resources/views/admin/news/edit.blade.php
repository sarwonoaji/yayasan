@extends('admin.layout')

@section('title','Edit Berita')

@section('content')
<h1 class="text-xl font-bold mb-4">Edit Berita</h1>

<form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data">
@csrf @method('PUT')

<label class="block mb-2">Judul</label>
<input name="title" value="{{ $news->title }}"
 class="w-full border p-2 mb-4">

<label class="block mb-2">Excerpt</label>
<textarea name="excerpt"
 class="w-full border p-2 mb-4">{{ $news->excerpt }}</textarea>

<label class="block mb-2">Konten</label>
<textarea name="content" id="editor"
 class="w-full border p-2 mb-4">{!! $news->content !!}</textarea>

@if($news->image)
    <img src="{{ asset('storage/'.$news->image) }}"
         class="h-32 mb-4 rounded">
@endif

<input type="file" name="image" class="mb-4">

<label class="block mb-2">Tanggal Publish</label>
<input type="datetime-local" name="published_at"
 value="{{ optional($news->published_at)->format('Y-m-d\TH:i') }}"
 class="border p-2 mb-4">

<label class="block mb-2">Meta Title</label>
<input name="meta_title" value="{{ $news->meta_title }}"
 class="w-full border p-2 mb-4">

<label class="block mb-2">Meta Description</label>
<textarea name="meta_description"
 class="w-full border p-2 mb-4">{{ $news->meta_description }}</textarea>

<button class="bg-blue-600 text-white px-4 py-2 rounded">
Update
</button>
</form>

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#editor'));
</script>
@endsection
