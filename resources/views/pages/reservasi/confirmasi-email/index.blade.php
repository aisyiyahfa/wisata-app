<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Reservasi Wisata Religi</title>
</head>
<body>
    <h1>Konfirmasi Reservasi Wisata Religi</h1>
    <p>Reservasi Anda telah disetujui untuk tanggal {{ $reservasi->tanggal_kunjungan->toDateString() }} pada jam {{ $reservasi->jam_kunjungan->format('H:i') }}.</p>
</body>
</html>
