<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aduan - SIHATI BPPKAD</title>
    <style>
        @media print {
            @page { margin: 2cm; size: landscape; }
            body { font-family: 'Segoe UI', system-ui, sans-serif; color: #1A1A1A; font-size: 11pt; line-height: 1.5; }
            table { width: 100%; border-collapse: collapse; margin-top: 16px; }
            th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; font-size: 9pt; }
            th { background-color: #F6F5F4; font-weight: 600; }
            .header { text-align: center; margin-bottom: 24px; }
            .header h1 { font-size: 18pt; margin: 0; }
            .header p { margin: 4px 0; color: #5D5B54; font-size: 10pt; }
            .summary { display: flex; gap: 16px; margin: 16px 0; }
            .summary-item { flex: 1; border: 1px solid #ccc; padding: 8px 12px; border-radius: 6px; }
            .summary-item strong { font-size: 14pt; }
            .footer { margin-top: 32px; text-align: right; font-size: 9pt; color: #787671; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SIHATI BPPKAD</h1>
        <p>Sistem Helpdesk Aduan Teknologi Informasi</p>
        <p><strong>LAPORAN ADUAN</strong></p>
        <p>Periode: {{ $tglAwal ?? request('tgl_awal', '-') }} s/d {{ $tglAkhir ?? request('tgl_akhir', '-') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <p>Total Aduan</p>
            <strong>{{ $totalAduan ?? $stats->total ?? 0 }}</strong>
        </div>
        <div class="summary-item">
            <p>Selesai</p>
            <strong>{{ $aduanSelesai ?? $stats->selesai ?? 0 }}</strong>
        </div>
        <div class="summary-item">
            <p>Diproses</p>
            <strong>{{ $aduanDiproses ?? $stats->diproses ?? 0 }}</strong>
        </div>
        <div class="summary-item">
            <p>Diterima</p>
            <strong>{{ $aduanDiterima ?? $stats->diterima ?? 0 }}</strong>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Tiket</th>
                <th>Tgl. Aduan</th>
                <th>Pelapor</th>
                <th>Bidang</th>
                <th>Kategori</th>
                <th>Prioritas</th>
                <th>Status</th>
                <th>Petugas</th>
                <th>Tgl. Selesai</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($aduans ?? [] as $i => $aduan)
            <tr>
                <td>{{ $loop?->iteration ?? $i + 1 }}</td>
                <td>{{ $aduan->nomor_tiket }}</td>
                <td>{{ \Carbon\Carbon::parse($aduan->tanggal_aduan ?? $aduan->created_at)->isoFormat('DD-MM-Y') }}</td>
                <td>{{ $aduan->pelapor?->name ?? '-' }}</td>
                <td>{{ $aduan->bidang?->nama_bidang ?? '-' }}</td>
                <td>{{ $aduan->category?->nama_kategori ?? '-' }}</td>
                <td>{{ $aduan->priority?->nama_prioritas ?? '-' }}</td>
                <td>{{ $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? '-' }}</td>
                <td>{{ $aduan->petugas?->name ?? '-' }}</td>
                <td>{{ $aduan->tanggal_selesai ? \Carbon\Carbon::parse($aduan->tanggal_selesai)->isoFormat('DD-MM-Y') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="10" style="text-align:center;color:#787671;">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->isoFormat('DD MMMM YYYY HH:mm') }}</p>
    </div>

    <div class="no-print" style="margin-top:24px;text-align:center;">
        <button onclick="window.print()" style="padding:8px 24px;background:#5645D4;color:white;border:none;border-radius:6px;cursor:pointer;font-size:14px;">Cetak / Simpan PDF</button>
        <button onclick="window.close()" style="padding:8px 24px;background:#f0eeec;border:1px solid #ccc;border-radius:6px;cursor:pointer;font-size:14px;margin-left:8px;">Tutup</button>
    </div>
</body>
</html>
