<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aduan - SIHATI BPPKAD</title>
    <style>
        * { box-sizing: border-box; }

        html, body {
            background: #fff;
            margin: 0;
        }

        body {
            font-family: 'Times New Roman', Georgia, serif;
            color: #000;
            font-size: 13px;
            line-height: 1.5;
        }

        .sheet {
            max-width: 950px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* ---------- Kop / Header ---------- */
        .kop {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 14px;
            margin-bottom: 18px;
        }
        .kop h1 {
            font-size: 18px;
            margin: 0;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .kop p {
            margin: 3px 0 0;
            font-size: 12px;
        }

        .judul {
            text-align: center;
            margin: 18px 0 6px;
        }
        .judul h2 {
            font-size: 15px;
            margin: 0;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        /* ---------- Info periode ---------- */
        .info-table {
            width: auto;
            margin: 16px 0 20px;
            font-size: 12px;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 1px 0;
            border: none;
        }
        .info-table td.label { width: 110px; }
        .info-table td.sep { width: 14px; }

        /* ---------- Summary ---------- */
        .summary {
            width: 100%;
            border-collapse: collapse;
            margin: 0 0 26px;
        }
        .summary td {
            border: 1px solid #000;
            text-align: center;
            padding: 8px 6px;
            font-size: 12px;
            width: 25%;
        }
        .summary tr.label td {
            font-size: 10.5px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border-bottom: none;
            padding-bottom: 2px;
        }
        .summary tr.value td {
            font-size: 17px;
            font-weight: bold;
            border-top: none;
            padding-top: 2px;
        }

        /* ---------- Table ---------- */
        table.data {
            width: 100%;
            border-collapse: collapse;
        }
        table.data, table.data th, table.data td {
            border: 1px solid #000;
        }
        table.data th, table.data td {
            padding: 6px 8px;
            font-size: 11px;
            text-align: left;
            color: #000;
            font-weight: normal;
        }
        table.data th {
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: 0.2px;
        }
        table.data td.center,
        table.data th.center { text-align: center; }
        table.data td.empty-row {
            text-align: center;
            font-style: italic;
            padding: 20px;
        }

        .status { font-weight: bold; }

        /* ---------- Footer ---------- */
        .footer {
            margin-top: 26px;
            padding-top: 10px;
            border-top: 1px solid #000;
            display: flex;
            justify-content: space-between;
            font-size: 11px;
        }

        /* ---------- Screen-only controls ---------- */
        .actions {
            max-width: 950px;
            margin: 20px auto 0;
            padding: 0 20px;
            text-align: right;
        }
        .actions button {
            padding: 8px 20px;
            font-size: 13px;
            cursor: pointer;
            border: 1px solid #000;
            background: #fff;
            color: #000;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        .actions button:hover { background: #000; color: #fff; }
        .actions button.primary { background: #000; color: #fff; }
        .actions button.primary:hover { background: #333; }

        /* ---------- Print rules ---------- */
        @media print {
            @page { margin: 1.5cm; size: landscape; }
            body { font-size: 11pt; }
            .sheet { margin: 0; padding: 0; max-width: 100%; }
            .summary tr.label td, .summary tr.value td { break-inside: avoid; }
            table.data tr { break-inside: avoid; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="sheet">

        <div class="kop">
            <h1>SIHATI BPPKAD</h1>
            <p>Sistem Helpdesk Aduan Teknologi Informasi</p>
        </div>

        <div class="judul">
            <h2>Laporan Data Aduan</h2>
        </div>

        <table class="info-table">
            <tr>
                <td class="label">Periode</td>
                <td class="sep">:</td>
                <td>
                    @if($request->tanggal_dari && $request->tanggal_sampai)
                        {{ \Carbon\Carbon::parse($request->tanggal_dari)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($request->tanggal_sampai)->format('d-m-Y') }}
                    @else
                        Semua Periode
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">Tanggal Cetak</td>
                <td class="sep">:</td>
                <td>{{ now()->isoFormat('DD MMMM YYYY, HH:mm') }} WIB</td>
            </tr>
        </table>

        <table class="summary">
            <tr class="label">
                <td>Total Aduan</td>
                <td>Selesai</td>
                <td>Diproses</td>
                <td>Diterima</td>
            </tr>
            <tr class="value">
                <td>{{ $aduans->count() }}</td>
                <td>{{ $aduans->where('status.kode_status', 'selesai')->count() }}</td>
                <td>{{ $aduans->where('status.kode_status', 'diproses')->count() }}</td>
                <td>{{ $aduans->where('status.kode_status', 'diterima')->count() }}</td>
            </tr>
        </table>

        <table class="data">
            <thead>
                <tr>
                    <th class="center">No</th>
                    <th>No. Tiket</th>
                    <th>Tgl. Aduan</th>
                    <th>Pelapor</th>
                    <th>Bidang</th>
                    <th>Kategori</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th>Tgl. Selesai</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($aduans as $i => $aduan)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>{{ $aduan->nomor_tiket }}</td>
                    <td>{{ \Carbon\Carbon::parse($aduan->tanggal_aduan)->isoFormat('DD-MM-Y') }}</td>
                    <td>{{ $aduan->pelapor?->name ?? '-' }}</td>
                    <td>{{ $aduan->bidang?->nama_bidang ?? '-' }}</td>
                    <td>{{ $aduan->category?->nama_kategori ?? '-' }}</td>
                    <td class="center">{{ $aduan->priority?->nama_prioritas ?? '-' }}</td>
                    <td class="status">{{ $aduan->status?->nama_status ?? $aduan->status?->kode_status ?? '-' }}</td>
                    <td>{{ $aduan->tanggal_selesai ? \Carbon\Carbon::parse($aduan->tanggal_selesai)->isoFormat('DD-MM-Y') : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="empty-row">Tidak ada data untuk periode yang dipilih.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <span>SIHATI &mdash; Sistem Helpdesk Aduan Teknologi Informasi BPPKAD</span>
            <span>Halaman dicetak otomatis oleh sistem</span>
        </div>

    </div>

</body>
</html>