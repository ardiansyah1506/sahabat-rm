<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Absensi Asisten Lab</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 0px solid #3b82f6; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; color: #1e3a8a; margin: 0; }
        .subtitle { font-size: 14px; color: #2563eb; margin: 5px 0 0 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #eff6ff; color: #1d4ed8; }
        .signature { max-height: 40px; }
        .text-center { text-align: center; }
</head>
<body>
    <table style="width: 100%; border-bottom: 3px solid #1e3a8a; margin-bottom: 20px; padding-bottom: 15px; border-collapse: collapse;">
        <tr>
            <td style="width: 15%; text-align: center; border: none;">
                @if(file_exists(public_path('pdf.png')))
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('pdf.png'))) }}" style="width: 80px; max-height: 80px; object-fit: contain;" alt="Logo Universitas">
                @endif
            </td>
            <td style="width: 85%; text-align: center; border: none;">
                <p style="font-size: 20px; font-weight: bold; color: #1e3a8a; margin: 0 0 5px 0;">SISTEM ABSENSI SAHABAT</p>
                <p style="font-size: 16px; font-weight: bold; color: #1e3a8a; margin: 0 0 5px 0;">LABORATORIUM REKAM MEDIS UNIVERSITAS</p>
                <p style="font-size: 14px; color: #2563eb; margin: 0;">Jadwal Kehadiran Asisten, Bulan: {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}</p>
            </td>
        </tr>
    </table>
    
    @if(isset($for_user))
    <div style="margin-bottom: 15px;">
        <p style="margin: 0;"><strong>Nama Asisten:</strong> {{ $for_user->name }}</p>
        <p style="margin: 3px 0 0 0;"><strong>Email:</strong> {{ $for_user->email }}</p>
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                @if(!isset($for_user))
                    <th>Nama Asisten</th>
                @endif
                <th>Shift</th>
                <th>Deskripsi Pekerjaan</th>
                <th class="text-center">Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $index => $row)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($row->date)->format('d M Y') }}</td>
                <td>{{ $row->time }}</td>
                @if(!isset($for_user))
                    <td>{{ $row->user->name ?? 'Terhapus' }}</td>
                @endif
                <td>{{ ucfirst($row->shift) }}</td>
                <td>{{ $row->job_description }}</td>
                <td class="text-center">
                    @if($row->signature)
                        <!-- dompdf supports base64 images -->
                        <img src="{{ $row->signature }}" class="signature">
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width: 100%; border: none; margin-top: 40px;">
        <tr>
            <td style="border: none; width: 50%;"></td>
            <td style="border: none; width: 50%; text-align: center;">
                <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p style="margin-bottom: 80px;">Kepala Laboratorium,</p>
                @if(isset($labHead) && $labHead)
                    <p style="margin-bottom: 0;"><strong>{{ $labHead->name }}</strong></p>
                    <p style="margin-top: 2px;"><span style="font-size: 11px; color: #555;">NIP. {{ $labHead->nip ?? '-' }}</span></p>
                @else
                    <p style="margin-bottom: 0;"><strong>(................................................)</strong></p>
                    <p style="margin-top: 2px;"><span style="font-size: 11px; color: #555;">NIP. </span></p>
                @endif
            </td>
        </tr>
    </table>
</body>
</html>
