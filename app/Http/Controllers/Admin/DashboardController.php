<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\SimpleExcel\SimpleExcelWriter;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter_date = $request->query('filter_date', now()->toDateString());

        $attendances = Attendance::with('user')
            ->whereDate('date', $filter_date)
            ->latest('time')
            ->paginate(15)
            ->appends(['filter_date' => $filter_date]);
            
        return view('admin.dashboard', compact('attendances', 'filter_date'));
    }

    public function export(Request $request)
    {
        $month = $request->query('month', now()->format('Y-m'));
        $format = $request->query('format', 'excel'); // default excel
        
        $attendances = Attendance::with('user')
            ->whereYear('date', date('Y', strtotime($month)))
            ->whereMonth('date', date('m', strtotime($month)))
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        if ($format === 'pdf') {
            $labHead = \App\Models\LabHead::where('is_active', true)->first();
            $pdf = Pdf::loadView('exports.attendance', compact('attendances', 'month', 'labHead'));
            return $pdf->download("Laporan_Absensi_SAHABAT_{$month}.pdf");
        }

        $filename = "Laporan_Absensi_LabRM_{$month}.xlsx";
        $writer = SimpleExcelWriter::streamDownload($filename);
        
        foreach ($attendances as $row) {
            $writer->addRow([
                'Tanggal' => $row->date,
                'Waktu' => $row->time,
                'Nama Asisten' => $row->user->name ?? 'Terhapus',
                'Shift' => ucfirst($row->shift),
                'Deskripsi Pekerjaan' => $row->job_description,
                'Status' => ucfirst($row->status)
            ]);
        }
        
        return $writer->toBrowser();
    }
}
