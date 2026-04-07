@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard Administrator</h1>
    <p class="text-gray-500 mt-2">Laporan absensi harian dan manajemen tugas laboratorium.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Laporan Absensi</h3>
            <form action="{{ route('admin.dashboard') }}" method="GET" class="mt-2 flex items-center space-x-2">
                <span class="text-xs text-medical-800 bg-medical-100 px-2 py-1 rounded font-medium">Tanggal:</span>
                <input type="date" name="filter_date" value="{{ $filter_date }}" class="px-2 py-1 border border-gray-300 rounded outline-none focus:border-medical-500 text-sm" onchange="this.form.submit()">
            </form>
        </div>
        
        <form action="{{ route('admin.export') }}" method="GET" class="flex items-center space-x-2">
            <input type="month" name="month" value="{{ date('Y-m') }}" class="px-3 py-2 border border-gray-300 rounded outline-none focus:border-medical-500 text-sm">
            <button type="submit" name="format" value="excel" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm font-medium transition flex items-center shadow-sm" title="Export to Excel">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Excel
            </button>
            <button type="submit" name="format" value="pdf" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm font-medium transition flex items-center shadow-sm" title="Export to PDF">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                PDF
            </button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-4">Nomor</th>
                    <th scope="col" class="px-6 py-4">Asisten Lab</th>
                    <th scope="col" class="px-6 py-4">Waktu Absen</th>
                    <th scope="col" class="px-6 py-4">Shift</th>
                    <th scope="col" class="px-6 py-4">Deskripsi Pekerjaan</th>
                    <th scope="col" class="px-6 py-4 text-center">TTD Digital</th>
                    <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $index => $attendance)
                <tr class="bg-white border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-semibold text-medical-700">{{ $attendance->user->name }}</td>
                    <td class="px-6 py-4">
                        <span class="block fw-bold">{{ $attendance->time }}</span>
                        <span class="text-xs text-gray-400">{{ $attendance->date }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($attendance->shift === 'pagi')
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-medium">Pagi</span>
                        @elseif($attendance->shift === 'siang')
                            <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded text-xs font-medium">Siang</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">Izin</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600 max-w-xs truncate" title="{{ $attendance->job_description }}">
                        {{ $attendance->job_description ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($attendance->signature)
                            <img src="{{ $attendance->signature }}" alt="Tanda Tangan" class="h-10 mx-auto border border-gray-300 rounded bg-white p-1">
                        @else
                            <span class="text-gray-400 text-xs italic">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 flex justify-center space-x-2 border-none">
                        <a href="{{ route('admin.attendances.edit', $attendance->id) }}" class="text-blue-500 hover:text-blue-700 font-medium text-xs bg-blue-50 px-2 py-1 rounded transition">Edit</a>
                        <form action="{{ route('admin.attendances.destroy', $attendance->id) }}" method="POST" onsubmit="return confirm('Hapus absensi ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-xs bg-red-50 px-2 py-1 rounded transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <p>Belum ada data absensi hari ini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($attendances->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $attendances->links() }}
    </div>
    @endif
</div>

@endsection
