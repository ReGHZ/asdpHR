<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotifCuti extends Notification
{
    use Queueable;
    public $pengajuanCuti;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pengajuanCuti)
    {
        $this->pengajuanCuti = $pengajuanCuti;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // return $this->pengajuanCuti->toArray();

        return [
            'id' => $this->pengajuanCuti->id,
            'user_id' => $this->pengajuanCuti->user_id,
            'user_name' => $this->pengajuanCuti->user->name,
            'user_nik' => $this->pengajuanCuti->user->nik,
            'nomor_surat' => $this->pengajuanCuti->nomor_surat,
            'tanggal_surat' => $this->pengajuanCuti->tanggal_surat,
            'jenis_cuti' => $this->pengajuanCuti->jenis_cuti,
            'tanggal_mulai' => $this->pengajuanCuti->tanggal_mulai,
            'lama_hari' => $this->pengajuanCuti->lama_hari,
            'keterangan' => $this->pengajuanCuti->keterangan,
            'status' => $this->pengajuanCuti->status,
        ];
    }
}
