@extends('layouts.app')
@section('title', 'Pengaturan Profil')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Pengaturan Profil</h1>
    <p class="text-gray-500 mt-2">Perbarui informasi profil dan foto Anda di sini.</p>
</div>

@if(session('success'))
<div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm">
    <div class="flex items-center">
        <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        <p class="text-green-700 font-medium">{{ session('success') }}</p>
    </div>
</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8">
        @csrf
        @method('PUT')
        
        <div class="flex flex-col md:flex-row gap-8">
            <div class="md:w-1/3 flex flex-col items-center">
                <div class="w-40 h-40 rounded-full bg-gray-100 border-4 border-white shadow-lg overflow-hidden relative mb-4 flex-shrink-0">
                    @if($user->avatar)
                        <img id="avatar-preview" src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                    @else
                        <div id="avatar-preview" class="w-full h-full bg-medical-100 flex items-center justify-center text-medical-600 text-5xl font-bold uppercase">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                
                <div class="w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2 text-center">Ganti Foto Profil</label>
                    <input type="file" name="avatar" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-medical-50 file:text-medical-700 hover:file:bg-medical-100 transition cursor-pointer outline-none">
                    <p class="text-xs text-gray-400 mt-2 text-center">JPG, PNG, GIF up to 2MB</p>
                    @error('avatar')<p class="text-red-500 text-xs mt-1 text-center">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="md:w-2/3 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-xs text-gray-400 font-normal">(digunakan untuk login)</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bio / Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition" placeholder="Ceritakan sedikit tentang Anda (contoh: Mahasiswa aktif 2026, Asisten Lab RM-2)...">{{ old('description', $user->description) }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div class="pt-4 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-medical-600 hover:bg-medical-700 text-white font-medium py-2 px-6 rounded-lg shadow-sm transition flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
