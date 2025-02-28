<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Agenda Surat</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
        }
        .container {
            margin: auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-transform: capitalize;
            text-align: center
        }
        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tbody tr:hover {
            background-color: #e9ecef;
            transition: 0.2s;
        }
        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Buku Agenda Surat</h2>
    <table>
        <thead>
            <tr>
                <th>Nomor Agenda</th>
                <th>Nomor Surat</th>
                <th>Tipe</th>
                <th>Tanggal</th>

                @if(request('tipe') == 'Masuk')
                    <th>Pengirim</th>
                @elseif(request('tipe') == 'Keluar')
                    <th>Penerima</th>
                @else
                    <th>Pengirim</th>
                    <th>Penerima</th>
                @endif
                
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($surat as $item)
                <tr>
                    <td>{{ $item->nomor_agenda }}</td>
                    <td>{{ $item->nomor_surat }}</td>
                    <td>{{ ucfirst($item->tipe) }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->locale('id')->isoFormat('dddd, D MMMM Y')}}</td>

                    @if(request('tipe') == 'Masuk')
                        <td>{{ $item->pengirim }}</td>
                    @elseif(request('tipe') == 'Keluar')
                        <td>{{ $item->penerima }}</td>
                    @else
                        <td>{{ $item->pengirim }}</td>
                        <td>{{ $item->penerima }}</td>
                    @endif

                    <td>{{ $item->kategori->nama ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
