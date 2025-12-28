@extends('admin.layout')

@section('title', $news->title)

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">{{ $news->title }}</h1>
    <div class="flex gap-2">
        <a href="{{ route('admin.news.edit', $news) }}" 
           class="bg-yellow-500 text-white px-4 py-2 rounded">
            Edit
        </a>
        <a href="{{ route('admin.news.index') }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>
</div>

<div class="bg-white rounded shadow p-6">
    @if($news->image)
        <img src="{{ asset('storage/'.$news->image) }}" 
             class="w-full max-h-96 object-cover rounded mb-4">
    @endif

    <div class="mb-4">
        <span class="text-sm text-gray-500">Slug:</span>
        <p class="text-gray-700">{{ $news->slug }}</p>
    </div>

    <div class="mb-4">
        <span class="text-sm text-gray-500">Penulis:</span>
        <p class="text-gray-700">{{ $news->user?->name ?? 'N/A' }}</p>
    </div>

    <div class="mb-4">
        <span class="text-sm text-gray-500">Status:</span>
        @if($news->published_at && $news->published_at <= now())
            <p class="inline-block px-2 py-1 bg-green-100 text-green-700 text-xs rounded">
                Dipublikasikan
            </p>
        @else
            <p class="inline-block px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded">
                Draft
            </p>
        @endif
    </div>

    <div class="mb-4">
        <span class="text-sm text-gray-500">Tanggal Publish:</span>
        <p class="text-gray-700">
            {{ $news->published_at ? $news->published_at->format('d M Y H:i') : 'Belum ditentukan' }}
        </p>
    </div>

    <div class="mb-4">
        <span class="text-sm text-gray-500">Excerpt:</span>
        <p class="text-gray-700">{{ $news->excerpt ?? '-' }}</p>
    </div>

    <hr class="my-6">

    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-4">Konten</h3>
        <div class="prose prose-sm max-w-none">
            {!! $news->content !!}
        </div>
    </div>

    <hr class="my-6">

    <div class="mb-4">
        <span class="text-sm text-gray-500">Meta Title:</span>
        <p class="text-gray-700">{{ $news->meta_title ?? '-' }}</p>
    </div>

    <div class="mb-4">
        <span class="text-sm text-gray-500">Meta Description:</span>
        <p class="text-gray-700">{{ $news->meta_description ?? '-' }}</p>
    </div>

    <div class="mt-6">
        <form method="POST" action="{{ route('admin.news.destroy', $news) }}" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    onclick="return confirm('Yakin ingin menghapus berita ini?')"
                    class="bg-red-600 text-white px-4 py-2 rounded">
                Hapus
            </button>
        </form>
    </div>
</div>
@endsection
