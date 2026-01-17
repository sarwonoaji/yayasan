@extends('admin.layout')

@section('title','Edit Berita')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">edit</span>
        Edit Berita
    </h1>
</div>

<form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
@csrf @method('PUT')

    <label class="block mb-2">Judul</label>
    <input name="title" value="{{ old('title', $news->title) }}" class="w-full border rounded px-3 py-2 mb-3">

    <label class="block mb-2">Excerpt</label>
    <textarea name="excerpt" class="w-full border rounded px-3 py-2 mb-3">{{ old('excerpt', $news->excerpt) }}</textarea>

    <label class="block mb-2">Konten</label>
    <textarea name="content" id="editor" class="w-full border rounded px-3 py-2 mb-3">{!! old('content', $news->content) !!}</textarea>

    @if($news->image)
        <img src="{{ asset('storage/'.$news->image) }}" class="h-32 mb-4 rounded">
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block mb-2">Gambar</label>
            <input type="file" name="image">
        </div>

        <div>
            <label class="block mb-2">Tanggal Publish</label>
            <input type="datetime-local" name="published_at" value="{{ optional($news->published_at)->format('Y-m-d\TH:i') }}" class="w-full border rounded px-3 py-2">
        </div>
    </div>

    <label class="block mb-2">Meta Title</label>
    <input name="meta_title" value="{{ old('meta_title', $news->meta_title) }}" class="w-full border rounded px-3 py-2 mb-3">

    <label class="block mb-2">Meta Description</label>
    <textarea name="meta_description" class="w-full border rounded px-3 py-2 mb-3">{{ old('meta_description', $news->meta_description) }}</textarea>

    <div class="flex gap-2">
        <button class="bg-emerald-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">save</span>
            Update
        </button>

        <a href="{{ route('admin.news.index') }}" class="px-4 py-2 rounded border border-emerald-100 text-emerald-700 hover:bg-emerald-50 inline-flex items-center gap-2">
            <span class="material-symbols-outlined">arrow_back</span>
            Batal
        </a>
    </div>

</form>

@push('scripts')
    <script>
        // Initialization is handled by resources/js/ckeditor.js via app.js
    </script>
@endpush
@endsection
