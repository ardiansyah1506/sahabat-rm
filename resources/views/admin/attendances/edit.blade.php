@extends('layouts.app')
@section('title', 'Edit Absensi')

@section('content')
<div class="mb-8">
    <div class="flex items-center space-x-3 mb-2">
        <a href="{{ route('admin.dashboard') }}" class="text-medical-600 hover:text-medical-800 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Edit Absensi Asisten</h1>
    </div>
    <p class="text-gray-500">Ubah detail absensi jika terdapat kesalahan input.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
    <form action="{{ route('admin.attendances.update', $attendance->id) }}" method="POST" class="p-6 md:p-8 space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Asisten</label>
            <input type="text" value="{{ $attendance->user->name ?? 'Terhapus' }}" disabled class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-500 cursor-not-allowed">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="date" value="{{ old('date', $attendance->date) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition">
                @error('date')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Waktu</label>
                <input type="time" name="time" value="{{ old('time', \Carbon\Carbon::parse($attendance->time)->format('H:i')) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition">
                @error('time')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Shift Kerja</label>
                <select name="shift" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition cursor-pointer">
                    <option value="pagi" {{ (old('shift', $attendance->shift) == 'pagi') ? 'selected' : '' }}>Pagi</option>
                    <option value="siang" {{ (old('shift', $attendance->shift) == 'siang') ? 'selected' : '' }}>Siang</option>
                    <option value="izin" {{ (old('shift', $attendance->shift) == 'izin') ? 'selected' : '' }}>Izin</option>
                </select>
                @error('shift')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Kehadiran</label>
                <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition cursor-pointer">
                    <option value="hadir" {{ (old('status', $attendance->status) == 'hadir') ? 'selected' : '' }}>Hadir</option>
                    <option value="izin" {{ (old('status', $attendance->status) == 'izin') ? 'selected' : '' }}>Izin</option>
                    <option value="alpha" {{ (old('status', $attendance->status) == 'alpha') ? 'selected' : '' }}>Alpha</option>
                </select>
                @error('status')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Pekerjaan <span class="text-xs text-gray-400 font-normal">(Kosongkan jika izin)</span></label>
            <textarea name="job_description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition">{{ old('job_description', $attendance->job_description) }}</textarea>
            @error('job_description')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end space-x-3">
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition font-medium">Batal</a>
            <button type="submit" class="bg-medical-600 hover:bg-medical-700 text-white font-medium py-2 px-6 rounded-lg shadow-sm transition">
                Perbarui Data
            </button>
        </div>
    </form>
</div>
@endsection
