<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('admin.attendances.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);
        
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'shift' => 'required|in:pagi,siang,izin',
            'job_description' => 'nullable|string',
            'status' => 'required|in:hadir,izin,alpha'
        ]);

        $attendance->update([
            'date' => $request->date,
            'time' => $request->time,
            'shift' => $request->shift,
            'job_description' => $request->job_description,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        
        return redirect()->route('admin.dashboard')->with('success', 'Data absensi berhasil dihapus.');
    }
}
