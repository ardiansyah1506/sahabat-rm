@extends('layouts.app')
@section('title', 'Tambah Asisten Lab')

@section('content')
<div class="mb-8">
    <div class="flex items-center space-x-3 mb-2">
        <a href="{{ route('admin.users.index') }}" class="text-medical-600 hover:text-medical-800 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Tambah Asisten Lab Baru</h1>
    </div>
    <p class="text-gray-500">Buat akun untuk asisten rekam medis baru di sini.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
    <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition uppercase-placeholder">
            @error('name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-xs text-gray-400 font-normal">(digunakan untuk login)</span></label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition">
            @error('email')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition">
            <p class="text-xs text-gray-400 mt-1">Minimal 8 karakter.</p>
            @error('password')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end space-x-3">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition font-medium">Batal</a>
            <button type="submit" class="bg-medical-600 hover:bg-medical-700 text-white font-medium py-2 px-6 rounded-lg shadow-sm transition">
                Simpan Asisten
            </button>
        </div>
    </form>
</div>
@endsection
