@extends('layouts.app')
@section('title', 'Manajemen Asisten Lab')

@section('content')
<div class="flex flex-col md:flex-row justify-between md:items-end mb-8 space-y-4 md:space-y-0">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Daftar Asisten Lab</h1>
        <p class="text-gray-500 mt-2">Kelola data pengguna dan asisten rekam medis.</p>
    </div>
    <div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex justify-center items-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-medical-600 hover:bg-medical-700 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Asisten Baru
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-4">Nama Lengkap</th>
                    <th scope="col" class="px-6 py-4">Alamat Email</th>
                    <th scope="col" class="px-6 py-4">Peran (Role)</th>
                    <th scope="col" class="px-6 py-4">Tgl Dibuat</th>
                    <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="bg-white border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-semibold text-medical-700">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-medium uppercase">{{ $user->role }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 flex justify-center space-x-2 border-none">
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data asisten lain terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
