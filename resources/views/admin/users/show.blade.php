@extends('layouts.app')
@section('title', 'Detail Profil Asisten')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detail Asisten: {{ $user->name }}</h1>
            <p class="text-gray-500 mt-2">Analitik kehadiran absensi dan rincian masa aktif.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-medium py-2 px-4 rounded-lg transition flex items-center">
            Kembali
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center relative overflow-hidden">
        <div class="absolute inset-x-0 top-0 h-24 bg-blue-600"></div>
        
        @if($user->avatar)
            <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="w-28 h-28 rounded-full object-cover border-4 border-white shadow-md z-10 mt-6 mb-4 bg-white">
        @else
            <div class="w-28 h-28 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-4xl font-bold uppercase shadow-md z-10 mt-6 mb-4 border-4 border-white">
                {{ substr($user->name, 0, 1) }}
            </div>
        @endif
        
        <h2 class="text-xl font-bold text-gray-800 text-center">{{ $user->name }}</h2>
        <p class="text-gray-500 mb-6">{{ $user->email }}</p>
        
        <div class="w-full bg-blue-50 border border-blue-100 p-4 rounded-xl">
            <h3 class="text-xs font-bold text-blue-700 uppercase tracking-wider mb-3">Periode Masa Aktif</h4>
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-medium text-gray-600">Mulai Aktif</span>
                <span class="text-sm font-bold text-gray-800">{{ $user->active_start_date ? \Carbon\Carbon::parse($user->active_start_date)->translatedFormat('d M Y') : 'Belum diatur' }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm font-medium text-gray-600">Akhir Aktif</span>
                <span class="text-sm font-bold text-gray-800">{{ $user->active_end_date ? \Carbon\Carbon::parse($user->active_end_date)->translatedFormat('d M Y') : 'Belum diatur' }}</span>
            </div>
            @if($user->active_end_date && now()->greaterThan($user->active_end_date))
                <div class="mt-3 px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded text-center">
                    MASA AKTIF BERAKHIR
                </div>
            @endif
        </div>
    </div>
    
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
            <h2 class="text-xl font-bold text-gray-800">Analitik Absensi Bulanan</h2>
            <form action="{{ route('admin.users.show', $user->id) }}" method="GET" class="flex items-center space-x-2">
                <label class="text-sm text-gray-500 font-medium">Pilih Bulan:</label>
                <input type="month" name="month" value="{{ $month }}" class="border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2 outline-none font-medium text-gray-700" onchange="this.form.submit()">
            </form>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-blue-50 p-5 rounded-xl border border-blue-100 text-center">
                <h3 class="text-4xl font-black text-blue-600 mb-2">{{ $stats['total'] }}</h3>
                <p class="text-xs font-bold text-blue-800 uppercase tracking-wider">Total Data</p>
            </div>
            <div class="bg-green-50 p-5 rounded-xl border border-green-100 text-center">
                <h3 class="text-4xl font-black text-green-600 mb-2">{{ $stats['pagi'] }}</h3>
                <p class="text-xs font-bold text-green-800 uppercase tracking-wider">Shift Pagi</p>
            </div>
            <div class="bg-orange-50 p-5 rounded-xl border border-orange-100 text-center">
                <h3 class="text-4xl font-black text-orange-600 mb-2">{{ $stats['siang'] }}</h3>
                <p class="text-xs font-bold text-orange-800 uppercase tracking-wider">Shift Siang</p>
            </div>
            <div class="bg-purple-50 p-5 rounded-xl border border-purple-100 text-center">
                <h3 class="text-4xl font-black text-purple-600 mb-2">{{ $stats['izin'] }}</h3>
                <p class="text-xs font-bold text-purple-800 uppercase tracking-wider">Izin</p>
            </div>
        </div>

        <div class="mt-8 bg-gray-50 p-4 rounded-xl text-sm text-gray-600">
            <strong>Catatan:</strong> Data dihitung berdasarkan total absensi digital yang terekam pada sistem di bulan yang dipilih. Statistik ini mencakup seluruh rincian kegiatan dan deskripsi kerja.
        </div>
    </div>
</div>
@endsection
