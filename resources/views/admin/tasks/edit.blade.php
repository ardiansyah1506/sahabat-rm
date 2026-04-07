@extends('layouts.app')
@section('title', 'Edit Tugas Lab')

@section('content')
<div class="mb-8">
    <div class="flex items-center space-x-3 mb-2">
        <a href="{{ route('admin.tasks.index') }}" class="text-medical-600 hover:text-medical-800 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Edit Tugas Asisten</h1>
    </div>
    <p class="text-gray-500">Ubah detail atau status tugas yang diberikan.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
    <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST" class="p-6 md:p-8 space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Asisten Lab</label>
            <select name="user_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition bg-white cursor-pointer">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ (old('user_id', $task->user_id) == $user->id) ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Tugas</label>
            <textarea name="description" rows="5" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition">{{ old('description', $task->description) }}</textarea>
            @error('description')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status Tugas</label>
            <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition bg-white cursor-pointer">
                <option value="pending" {{ (old('status', $task->status) == 'pending') ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ (old('status', $task->status) == 'completed') ? 'selected' : '' }}>Selesai / Completed</option>
            </select>
            @error('status')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end space-x-3">
            <a href="{{ route('admin.tasks.index') }}" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition font-medium">Batal</a>
            <button type="submit" class="bg-medical-600 hover:bg-medical-700 text-white font-medium py-2 px-6 rounded-lg shadow-sm transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
