@extends('admin.layout')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="px-4 py-6 sm:px-6">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Edit Pengaturan Situs</h1>
                </div>

                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    {{-- Site Name --}}
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Situs <span class="text-red-500">*</span></label>
                        <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $setting->site_name ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('site_name') border-red-500 @enderror">
                        @error('site_name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Logo --}}
                    <div>
                        <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                        @if($setting && $setting->logo)
                        <div class="mb-3">
                            <p class="text-sm text-gray-600 mb-2">Logo saat ini:</p>
                            <div class="max-w-xs">
                                <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" class="w-full h-auto rounded-lg shadow">
                            </div>
                        </div>
                        @endif
                        <input type="file" name="logo" id="logo" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('logo') border-red-500 @enderror">
                        <p class="mt-1 text-xs text-gray-500">Format: JPEG, PNG, GIF, WebP (Max 2MB)</p>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="address" id="address" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('address') border-red-500 @enderror">{{ old('address', $setting->address ?? '') }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone ?? '') }}" placeholder="+62..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $setting->email ?? '') }}" placeholder="email@example.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Social Media --}}
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Media Sosial</h3>
                        
                        <div class="space-y-4">
                            {{-- Facebook --}}
                            <div>
                                <label for="facebook" class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                                <input type="url" name="facebook" id="facebook" value="{{ old('facebook', $setting->facebook ?? '') }}" placeholder="https://facebook.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('facebook') border-red-500 @enderror">
                                @error('facebook')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Instagram --}}
                            <div>
                                <label for="instagram" class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                                <input type="url" name="instagram" id="instagram" value="{{ old('instagram', $setting->instagram ?? '') }}" placeholder="https://instagram.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('instagram') border-red-500 @enderror">
                                @error('instagram')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- YouTube --}}
                            <div>
                                <label for="youtube" class="block text-sm font-medium text-gray-700 mb-1">YouTube</label>
                                <input type="url" name="youtube" id="youtube" value="{{ old('youtube', $setting->youtube ?? '') }}" placeholder="https://youtube.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('youtube') border-red-500 @enderror">
                                @error('youtube')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-3 pt-6 border-t">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
