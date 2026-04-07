@extends('layouts.app')
@section('title', 'Tugas Saya')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Daftar Tugas Anda</h1>
    <p class="text-gray-500 mt-2">Berikut adalah tugas-tugas dari Admin yang perlu Anda selesaikan.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($tasks as $task)
    <div class="bg-white border text-left {{ $task->status === 'completed' ? 'border-green-200' : 'border-gray-200' }} rounded-xl shadow-sm hover:shadow-md transition p-6 flex flex-col h-full relative overflow-hidden">
        @if($task->status === 'completed')
            <div class="absolute top-0 right-0 w-16 h-16 pointer-events-none transform translate-x-4 -translate-y-4">
                <svg class="text-green-100" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 17.292l-4.5-4.364 1.857-1.858 2.643 2.506 5.643-5.784 1.857 1.857-7.5 7.643z"/></svg>
            </div>
        @endif

        <div class="mb-4 text-xs font-semibold uppercase tracking-wider text-gray-400">
            Diberikan oleh: <span class="{{ $task->status === 'completed' ? 'text-green-600' : 'text-medical-600' }}">{{ $task->admin->name ?? 'Admin' }}</span>
        </div>
        
        <p class="text-gray-800 font-medium mb-6 flex-1">{{ $task->description }}</p>
        
        <div class="mt-auto border-t border-gray-100 pt-4 flex items-center justify-between">
            <span class="text-xs text-gray-400">{{ $task->created_at->diffForHumans() }}</span>
            
            @if($task->status === 'pending')
            <form action="{{ route('user.tasks.complete', $task->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="px-4 py-2 bg-medical-50 text-medical-700 hover:bg-medical-600 hover:text-white rounded-lg text-sm font-medium transition flex items-center shadow-sm border border-medical-200">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Tandai Selesai
                </button>
            </form>
            @else
            <span class="text-sm font-semibold text-green-600 flex items-center">
                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg> Selesai
            </span>
            @endif
        </div>
    </div>
    @empty
    <div class="col-span-1 md:col-span-2 lg:col-span-3 pb-8 text-center text-gray-500 py-12 bg-white rounded-2xl border border-dashed border-gray-300">
        <svg class="w-16 h-16 text-medical-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <p class="text-lg font-medium text-gray-700">Hore! Tidak ada tugas saat ini.</p>
        <p class="text-sm">Silakan kembali lagi nanti jika admin memberikan tugas baru.</p>
    </div>
    @endforelse
</div>

@if($tasks->hasPages())
<div class="mt-8">
    {{ $tasks->links() }}
</div>
@endif

@endsection
