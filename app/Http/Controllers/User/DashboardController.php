<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\SimpleExcel\SimpleExcelWriter;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $pending_tasks = Task::with('admin')
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->get();
            
        $currentMonth = now()->format('Y-m');
        $attendancesThisMonth = Attendance::where('user_id', $user->id)
            ->where('date', 'like', $currentMonth . '-%')
            ->get();
            
        $stats = [
            'pagi' => $attendancesThisMonth->where('shift', 'pagi')->count(),
            'siang' => $attendancesThisMonth->where('shift', 'siang')->count(),
            'izin' => $attendancesThisMonth->where('shift', 'izin')->count(),
        ];
            
        return view('user.dashboard', compact('pending_tasks', 'stats', 'user'));
    }

    public function export(Request $request)
    {
        $month = $request->query('month', now()->format('Y-m'));
        $format = $request->query('format', 'excel');
        
        $attendances = Attendance::where('user_id', Auth::id())
            ->whereYear('date', date('Y', strtotime($month)))
            ->whereMonth('date', date('m', strtotime($month)))
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        if ($format === 'pdf') {
            $for_user = Auth::user();
            $labHead = \App\Models\LabHead::where('is_active', true)->first();
            $pdf = Pdf::loadView('exports.attendance', compact('attendances', 'month', 'for_user', 'labHead'));
            return $pdf->download("Absensi_Pribadi_{$month}.pdf");
        }

        $filename = "Absensi_Pribadi_{$month}.xlsx";
        $writer = SimpleExcelWriter::streamDownload($filename);
        
        foreach ($attendances as $row) {
            $writer->addRow([
                'Tanggal' => $row->date,
                'Waktu' => $row->time,
                'Shift' => ucfirst($row->shift),
                'Deskripsi Pekerjaan' => $row->job_description,
                'Status' => ucfirst($row->status)
            ]);
        }
        
        return $writer->toBrowser();
    }
}
