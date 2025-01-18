<!DOCTYPE html>  
<html>  
<head>  
    <title>Pemasukan PDF</title>  
</head>  
<body>  
    <h1>Data Pemasukan</h1>  
    <table>  
        <thead>  
            <tr>  
                <th>ID</th>  
                <th>Nama</th>  
                <th>Jumlah</th>  
            </tr>  
        </thead>  
        <tbody>  
            @foreach($pemasukan as $item)  
                <tr>  
                    <td>{{ $item->id }}</td>  
                    <td>{{ $item->nama }}</td>  
                    <td>{{ $item->jumlah }}</td>  
                </tr>  
            @endforeach  
        </tbody>  
    </table>  
</body>  
</html>  
