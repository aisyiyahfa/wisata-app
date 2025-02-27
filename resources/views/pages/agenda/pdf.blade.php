<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Agenda Surat</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Buku Agenda Surat</h2>
    <table>
        <thead>
            <tr>
                <th>Nomor Agenda</th>
                <th>Nomor Surat</th>
                <th>Tipe</th>
                <th>Tanggal Surat</th>

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
                    <td>{{ $item->tipe }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->isoFormat('D MMMM Y') }}</td>

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
</body>
</html>
