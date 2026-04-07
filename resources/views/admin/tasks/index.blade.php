@extends('layouts.app')
@section('title', 'Manajemen Tugas Lab')

@section('content')
<div class="flex flex-col md:flex-row justify-between md:items-end mb-8 space-y-4 md:space-y-0">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Daftar Tugas Asisten</h1>
        <p class="text-gray-500 mt-2">Buat dan kelola tugas yang diberikan kepada asisten lab.</p>
    </div>
    <div>
        <a href="{{ route('admin.tasks.create') }}" class="inline-flex justify-center items-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-medical-600 hover:bg-medical-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Tugas Baru
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-4">Penerima Tugas</th>
                    <th scope="col" class="px-6 py-4">Deskripsi Tugas</th>
                    <th scope="col" class="px-6 py-4">Status</th>
                    <th scope="col" class="px-6 py-4">Tgl Dibuat</th>
                    <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                <tr class="bg-white border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-semibold text-medical-700">{{ $task->user->name ?? 'User Terhapus' }}</td>
                    <td class="px-6 py-4 text-gray-600 w-1/2">{{ $task->description }}</td>
                    <td class="px-6 py-4">
                        @if($task->status === 'completed')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold flex items-center w-max">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Selesai
                        </span>
                        @else
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold flex items-center w-max">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Pending
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $task->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 flex justify-center space-x-2 border-none">
                        <a href="{{ route('admin.tasks.edit', $task->id) }}" class="text-blue-500 hover:text-blue-700 font-medium text-xs bg-blue-50 px-2 py-1 rounded transition">Edit</a>
                        <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Hapus tugas ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-xs bg-red-50 px-2 py-1 rounded transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        Belum ada tugas yang dibuat.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
