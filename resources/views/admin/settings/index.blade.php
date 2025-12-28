@extends('admin.layout')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="px-4 py-6 sm:px-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Pengaturan Situs</h1>
                    <a href="{{ route('admin.settings.edit') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Pengaturan
                    </a>
                </div>

                @if($setting)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Logo --}}
                    @if($setting->logo)
                    <div class="col-span-full">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Logo Situs</label>
                        <div class="max-w-xs">
                            <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" class="w-full h-auto rounded-lg shadow">
                        </div>
                    </div>
                    @endif

                    {{-- Site Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Situs</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            <p class="text-gray-900 font-semibold">{{ $setting->site_name }}</p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            <p class="text-gray-900">{{ $setting->email ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            <p class="text-gray-900">{{ $setting->phone ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="col-span-full">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            <p class="text-gray-900">{{ $setting->address ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Social Media --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Facebook</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            @if($setting->facebook)
                                <a href="{{ $setting->facebook }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 break-all">{{ $setting->facebook }}</a>
                            @else
                                <p class="text-gray-500">-</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            @if($setting->instagram)
                                <a href="{{ $setting->instagram }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 break-all">{{ $setting->instagram }}</a>
                            @else
                                <p class="text-gray-500">-</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">YouTube</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            @if($setting->youtube)
                                <a href="{{ $setting->youtube }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 break-all">{{ $setting->youtube }}</a>
                            @else
                                <p class="text-gray-500">-</p>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-4">Belum ada pengaturan. Silakan buat pengaturan baru.</p>
                    <a href="{{ route('admin.settings.edit') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700">
                        Buat Pengaturan
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
