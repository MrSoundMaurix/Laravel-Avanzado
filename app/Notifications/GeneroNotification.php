<?php

namespace App\Notifications;

use App\Genero;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneroNotification extends Notification
{
    use Queueable;

    public $nombre, $fecha, $asunto, $texto,$crear;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Genero $genero, $fechaAct = false,$crear=false)
    {
        $this->nombre = $genero->nombre;
        if ($fechaAct == false&&$crear==false) {
            $this->asunto = 'Género enviado a papelera';
            $this->texto = "envió a papelera";
            $this->fecha = $genero->deleted_at;
        } else if($fechaAct==true&&$crear==false){
            $this->asunto = 'Género restaurado';
            $this->texto = "restauró";
            $this->fecha = $genero->updated_at;
        }else if($fechaAct==true&&$crear==true){
            $this->asunto = 'Género creado correctamente';
            $this->texto = "Creo";
            $this->fecha = $genero->updated_at;

        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->greeting('Saludos!')
            ->subject($this->asunto)
            ->line("Se " . $this->texto . " el género " . $this->nombre . "a las " . $this->fecha);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
