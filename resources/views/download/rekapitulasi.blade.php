<!DOCTYPE html>
<html>
<head>
    <title>USULAN PENGAJUAN CUTI PEGAWAI</title>
    <style>
        @page {
            size: A4 landscape;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: calc(100% - 20px);
            border-collapse: collapse;
            margin: 0 10px 0px 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
        .signature {
            float: right;
            text-align: left;
            margin: 10px 200px 0px 0px;
        }
    </style>
</head>
<body>
    <h2>USULAN PENGAJUAN CUTI PEGAWAI : BULAN @foreach ($blanko as $index => $format){{ strtoupper(\Carbon\Carbon::parse($format->updated_at)->locale('id')->translatedFormat('F Y')) }}@endforeach</h2>
    <table>
        <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>LAMANYA CUTI</th>
            <th>TANGGAL CUTI</th>
            <th>TUJUAN CUTI</th>
            <th>ALASAN CUTI</th>
            <th>CUTI TAHUN</th>
            <th>KETERANGAN</th>
        </tr>
        <!-- Repeat the following row for each data entry -->
        @foreach ($blanko as $index => $data)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $data->nama_pegawai }}</td>
            <td>{{ abs(\Carbon\Carbon::parse($data->selesai_cuti)->diffInDays(\Carbon\Carbon::parse($data->mulai_cuti)))+1 }} hari</td>
            <td>{{ \Carbon\Carbon::parse($data->mulai_cuti)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($data->selesai_cuti)->format('d-m-Y') }}</td>
            <td>{{ ucwords($data->tujuan_cuti) }}</td>
            <td>{{ ucwords($data->alasan) }}</td>
            <td>{{ \Carbon\Carbon::parse($data->mulai_cuti)->format('Y') }}/{{ \Carbon\Carbon::parse($data->selesai_cuti)->format('Y') }}</td>
            <td>{{ $data->keterangan ?? '-'}}</td>
        </tr>
        @endforeach
        <!-- Repeat the above row for 21 more data entries -->
    </table>
    <div class="signature">
        <p>Palembang, 31 Oktober 2024</p>
        <p>Kepala Bagian Tata Usaha</p>
        <br><br><br>
        <p>Tri Ivani Tersano, S.Sos</p>
        <p>NIP. 197209031997031001</p>
    </div>
</body>
</html>