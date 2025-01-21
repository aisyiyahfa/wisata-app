<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Laporan Pemasukan</title>  
    <style>  
        body {  
            font-family: Arial, sans-serif;  
            margin: 0;  
            padding: 20px;  
            background-color: #f9f9f9;  
        }  
        .container {  
            max-width: 800px;  
            margin: auto;  
            background: white;  
            padding: 20px;  
            border-radius: 8px;  
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);  
        }  
        h1 {  
            text-align: center;  
            color: #333;  
        }  
        .logo {  
            text-align: center;  
            margin-bottom: 20px;  
        }  
        table {  
            width: 100%;  
            border-collapse: collapse;  
            margin-top: 20px;  
        }  
        th, td {  
            border: 1px solid #000;  
            padding: 10px;  
            text-align: left;  
        }  
        th {  
            background-color: #f2f2f2;  
        }  
        tfoot {  
            font-weight: bold;  
        }  
        footer {  
            text-align: center;  
            margin-top: 20px;  
            font-size: 0.9em;  
            color: #777;  
        }  
    </style>  
</head>  
<body>  
    <div class="container">  
        <div class="logo">  
            <img src="logo.png" alt="Logo Perusahaan" style="max-width: 150px;">  
        </div>  
        <h1>Laporan Pemasukan</h1>  
        <p>Tanggal: {{ date('d-m-Y') }}</p>  
        <table>  
            <thead>  
                <tr>  
                    <th>NO</th>  
                    <th>Tanggal</th>  
                    <th>Nominal</th>  
                    <th>Catatan</th>  
                </tr>  
            </thead>  
            <tbody>  
                @foreach ($pemasukan as $item)  
                    <tr>  
                        <td>{{ $item->id }}</td>  
                        <td>{{ $item->tanggal }}</td>  
                        <td>{{ number_format($item->nominal, 2, ',', '.') }}</td>  
                        <td>{{ $item->catatan }}</td>  
                    </tr>  
                @endforeach  
            </tbody>  
            <tfoot>  
                <tr>  
                    <td colspan="2">Total</td>  
                    <td colspan="2">{{ number_format($pemasukan->sum('nominal'), 2, ',', '.') }}</td>  
                </tr>  
            </tfoot>  
        </table>  
        <footer>  
            <p>Dicetak oleh: {{Auth::user()->name}} | [{{ date('d-m-Y') }}]</p>  
        </footer>  
    </div>  
    <script>
        window.addEventListener("load", function() {
            window.print();
        });
    </script>
</body>  
</html>  
