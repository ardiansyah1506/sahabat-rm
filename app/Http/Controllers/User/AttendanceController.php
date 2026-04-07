<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'shift' => 'required|in:pagi,siang,izin',
            'job_description' => 'nullable|string',
            'signature' => 'nullable|string',
        ]);

        $attendance = Attendance::where('user_id', Auth::id())
            ->whereDate('date', now()->toDateString())
            ->where('shift', $request->shift)
            ->first();

        if ($attendance) {
            return back()->with('error', 'Anda sudah melakukan absensi untuk shift ' . ucfirst($request->shift) . ' hari ini.');
        }

        Attendance::create([
            'user_id' => Auth::id(),
            'date' => now()->toDateString(),
            'time' => now()->toTimeString(),
            'shift' => $request->shift,
            'job_description' => $request->job_description,
            'signature' => $request->signature,
            'status' => $request->shift === 'izin' ? 'izin' : 'hadir',
        ]);

        return back()->with('success', 'Absensi berhasil disimpan!');
    }
}
