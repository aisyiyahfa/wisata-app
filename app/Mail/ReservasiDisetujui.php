<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservasi;

class ReservasiDisetujui extends Mailable
{
    use Queueable, SerializesModels;

    public $reservasi;

    public function __construct(Reservasi $reservasi)
    {
        $this->reservasi = $reservasi;
    }

    public function build()
    {
        return $this->subject('Reservasi Anda Telah Disetujui')
                    ->view('pages.reservasi.email');
    }
}
