@extends('admin.layout')

@section('title','Edit Halaman')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-600">edit</span>
        Edit Halaman
    </h1>
</div>

<form method="POST" action="{{ route('admin.pekerjaan.update', $pekerjaan) }}" class="bg-white p-6 rounded shadow">
@csrf @method('PUT')

    <label class="block mb-2">Pekerjaan</label>
    <input name="nama_pekerjaan" value="{{ old('nama_pekerjaan', $pekerjaan->nama_pekerjaan) }}" class="w-full border rounded px-3 py-2 mb-3">

    <div class="flex gap-2">
        <button class="bg-emerald-600 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <span class="material-symbols-outlined">save</span>
            Update
        </button>

        <a href="{{ route('admin.pekerjaan.index') }}" class="px-4 py-2 rounded border border-emerald-100 text-emerald-700 hover:bg-emerald-50 inline-flex items-center gap-2">
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
