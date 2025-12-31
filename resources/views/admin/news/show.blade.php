@extends('admin.layout')

@section('title', $news->title)

@section('content')
<div class="flex items-start justify-between gap-4 mb-4">
    <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-emerald-600 text-3xl">article</span>
        <div>
            <h1 class="text-xl font-bold">{{ $news->title }}</h1>
            <div class="text-sm text-slate-500">{{ $news->slug }}</div>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <a href="{{ route('admin.news.edit', $news) }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-2 rounded text-sm">
            <span class="material-symbols-outlined">edit</span>
            Edit
        </a>

        <a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-2 border border-slate-200 px-3 py-2 rounded text-sm text-slate-700 hover:bg-slate-50">
            <span class="material-symbols-outlined">arrow_back</span>
            Kembali
        </a>
    </div>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    @if($news->image)
    <div class="w-full max-h-96 overflow-hidden">
        <img src="{{ asset('storage/'.$news->image) }}" alt="{{ $news->title }}" class="w-full h-56 object-cover">
    </div>
    @endif

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <div class="text-sm text-slate-500">Penulis</div>
                <div class="font-medium text-slate-800">{{ $news->user?->name ?? 'N/A' }}</div>
            </div>

            <div>
                <div class="text-sm text-slate-500">Status</div>
                @if($news->published_at && $news->published_at <= now())
                    <div class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-emerald-600 text-white">Published</div>
                @else
                    <div class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">Draft</div>
                @endif
            </div>

            <div>
                <div class="text-sm text-slate-500">Tanggal Publish</div>
                <div class="text-slate-700 text-sm">{{ $news->published_at ? $news->published_at->format('d M Y H:i') : 'Belum ditentukan' }}</div>
            </div>
        </div>

        @if($news->excerpt)
            <div class="mb-6 text-slate-700">{{ $news->excerpt }}</div>
        @endif

        <div class="prose max-w-none mb-6">
            {!! $news->content !!}
        </div>

        <div class="border-t pt-4 flex items-center justify-between">
            <div class="text-sm text-slate-600">
                <div><strong>Meta Title:</strong> {{ $news->meta_title ?? '-' }}</div>
                <div class="mt-1"><strong>Meta Description:</strong> {{ $news->meta_description ?? '-' }}</div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="inline-flex items-center gap-2 text-slate-700 border border-slate-200 px-3 py-2 rounded hover:bg-slate-50">
                    <span class="material-symbols-outlined">visibility</span>
                    Lihat Publik
                </a>

                <form method="POST" action="{{ route('admin.news.destroy', $news) }}" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">
                        <span class="material-symbols-outlined">delete</span>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
