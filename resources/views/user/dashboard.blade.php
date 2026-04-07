@extends('layouts.app')
@section('title', 'Dashboard Asisten')

@section('content')
<div class="flex flex-col sm:flex-row justify-between sm:items-end mb-8 space-y-4 sm:space-y-0">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Asisten Lab</h1>
        <p class="text-gray-500 mt-2">Selamat datang, laporkan kehadiran dan pekerjaan Anda disini.</p>
    </div>
    
    <div>
        <form action="{{ route('user.export') }}" method="GET" class="flex items-center space-x-2">
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
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Form Absensi -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-medical-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 bg-medical-50 text-medical-800 flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                <h3 class="text-lg font-semibold">Form Kehadiran Harian</h3>
            </div>
            
            <form action="{{ route('user.attendance.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" readonly class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-500 cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Masuk</label>
                        <input type="time" name="time" value="{{ date('H:i') }}" readonly class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-500 cursor-not-allowed">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Shift Kerja</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="shift" value="pagi" class="peer sr-only" required>
                            <div class="text-center px-4 py-3 border border-gray-300 rounded-lg peer-checked:bg-medical-50 peer-checked:border-medical-500 peer-checked:text-medical-700 hover:bg-gray-50 transition">
                                <span class="block font-medium">Pagi</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="shift" value="siang" class="peer sr-only" required>
                            <div class="text-center px-4 py-3 border border-gray-300 rounded-lg peer-checked:bg-medical-50 peer-checked:border-medical-500 peer-checked:text-medical-700 hover:bg-gray-50 transition">
                                <span class="block font-medium">Siang</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="shift" value="izin" class="peer sr-only" required>
                            <div class="text-center px-4 py-3 border border-gray-300 rounded-lg peer-checked:bg-red-50 peer-checked:border-red-500 peer-checked:text-red-700 hover:bg-gray-50 transition">
                                <span class="block font-medium">Izin</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Pekerjaan <span class="text-xs text-gray-400 font-normal">(Kosongkan jika izin)</span></label>
                    <textarea name="job_description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-medical-500 focus:border-medical-500 outline-none transition" placeholder="Jelaskan pekerjaan yang akan dilakukan di lab..."></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanda Tangan Digital</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 p-2 text-center" id="signature-container">
                        <canvas id="signature-pad" class="w-full max-w-full h-40 bg-white border border-gray-200 cursor-crosshair rounded shadow-inner" style="touch-action: none;"></canvas>
                        <input type="hidden" name="signature" id="signature-input">
                        <div class="mt-2 text-right">
                            <button type="button" id="clear-signature" class="text-xs text-red-500 hover:text-red-700 underline font-medium">Clear / Hapus TTD</button>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" id="submit-btn" class="w-full bg-medical-600 hover:bg-medical-700 text-white font-medium py-3 px-4 rounded-lg shadow-sm transition">
                        Kirim Absensi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Ringkasan Info (Tasks) -->
    <div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-semibold text-gray-800">Tugas Baru</h3>
            </div>
            <div class="p-6">
                <!-- Data dummy, ini akan di loop -->
                @forelse($pending_tasks ?? [] as $task)
                <div class="bg-gray-50 border-l-4 border-medical-500 p-4 rounded-r-lg mb-3">
                    <p class="text-sm text-gray-700">{{ $task->description }}</p>
                    <div class="mt-2 text-xs text-gray-500 flex justify-between items-center">
                        <span>Oleh: {{ $task->admin->name }}</span>
                        <a href="{{ route('user.tasks') }}" class="text-medical-600 hover:underline">Selesaikan &rarr;</a>
                    </div>
                </div>
                @empty
                <p class="text-sm text-gray-500 italic text-center">Belum ada tugas baru.</p>
                @endforelse
                
                <div class="mt-4 pt-4 border-t border-gray-100 text-center">
                    <a href="{{ route('user.tasks') }}" class="text-sm font-medium text-medical-600 hover:text-medical-800 hover:underline">Lihat Semua Tugas</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Simple Signature Pad Script using HTML5 Canvas
    document.addEventListener("DOMContentLoaded", function() {
        const canvas = document.getElementById('signature-pad');
        const ctx = canvas.getContext('2d');
        const clearBtn = document.getElementById('clear-signature');
        const signatureInput = document.getElementById('signature-input');
        const form = document.querySelector('form');
        
        let drawing = false;
        
        // Resize canvas to correct resolution
        function resizeCanvas() {
            const ratio =  Math.max(window.devicePixelRatio || 1, 1);
            const container = canvas.parentElement;
            canvas.width = container.offsetWidth - 16; // internal padding
            canvas.height = 160; 
            ctx.scale(1, 1);
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#000000';
        }
        
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        function getMousePos(canvas, evt) {
            const rect = canvas.getBoundingClientRect();
            return {
                x: (evt.clientX || evt.touches[0].clientX) - rect.left,
                y: (evt.clientY || evt.touches[0].clientY) - rect.top
            };
        }

        canvas.addEventListener('mousedown', function(e) { drawing = true; const pos = getMousePos(canvas, e); ctx.beginPath(); ctx.moveTo(pos.x, pos.y); });
        canvas.addEventListener('touchstart', function(e) { drawing = true; const pos = getMousePos(canvas, e); ctx.beginPath(); ctx.moveTo(pos.x, pos.y); e.preventDefault(); });
        
        canvas.addEventListener('mousemove', function(e) {
            if(!drawing) return;
            const pos = getMousePos(canvas, e);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
        });
        canvas.addEventListener('touchmove', function(e) {
            if(!drawing) return;
            const pos = getMousePos(canvas, e);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
            e.preventDefault();
        });

        function updateSignatureInput() {
            const blank = document.createElement('canvas');
            blank.width = canvas.width;
            blank.height = canvas.height;
            if(canvas.toDataURL() !== blank.toDataURL()) {
                // Convert to jpeg with 0.7 quality to reduce size payload
                signatureInput.value = canvas.toDataURL('image/jpeg', 0.7);
            } else {
                signatureInput.value = '';
            }
        }

        canvas.addEventListener('mouseup', function() { drawing = false; updateSignatureInput(); });
        canvas.addEventListener('touchend', function(e) { drawing = false; e.preventDefault(); updateSignatureInput(); });
        canvas.addEventListener('mouseout', function() { drawing = false; updateSignatureInput(); });

        clearBtn.addEventListener('click', function() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            // reset background to white for jpeg compression visibility
            ctx.fillStyle = "#ffffff";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            signatureInput.value = '';
        });

        // Initialize white background
        ctx.fillStyle = "#ffffff";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        form.addEventListener('submit', function(e) {
            updateSignatureInput();
            if(!signatureInput.value) {
                const isIzin = document.querySelector('input[name="shift"][value="izin"]');
                if(!isIzin || !isIzin.checked) {
                    alert('Tanda tangan digital wajib diisi!');
                    e.preventDefault();
                    return false;
                }
            }
        });
    });
</script>
@endsection
