<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Reservasi Wisata Religi Disetujui</title>
</head>
<body>
    <h2>Halo {{ $reservasi->nama_ketua }},</h2>
    <p>Reservasi wisata Anda telah disetujui.</p>
    <p><strong>Detail Reservasi:</strong></p>
    <ul>
        <li><strong>Nama Ketua:</strong> {{ $reservasi->nama_ketua }}</li>
        <li><strong>Jumlah Rombongan:</strong> {{ $reservasi->jumlah_rombongan }}</li>
        <li><strong>Alamat:</strong> {{ $reservasi->alamat_rombongan }}</li>
        <li><strong>Tanggal Kunjungan:</strong> {{ \Carbon\Carbon::parse($reservasi->tanggal_kunjungan)->locale('id')->isoFormat('dddd, D MMMM Y') }}</li>
        <li><strong>Jam Kunjungan:</strong> {{ \Carbon\Carbon::parse($reservasi->jam_kunjungan)->format('H:i') }} WIB</li>
    </ul>
    <p>Terima kasih telah melakukan reservasi.</p>
    <p>Salam,</p>
    <p><strong>Tim Reservasi Wisata</strong></p>
</body>
</html>
