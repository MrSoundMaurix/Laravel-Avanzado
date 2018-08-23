<?php

namespace App\Notifications;
use App\Pelicula;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PeliculaNotification extends Notification
{
    use Queueable;
    public $nombre, $fecha, $asunto, $texto;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Pelicula $pelicula, $fechaAct = false,$crear=false)
    {
        $this->nombre = $genero->nombre;
        if ($fechaAct == false&&$crear==false) {
            $this->asunto = 'pelicula enviado a papelera';
            $this->texto = "envió a papelera";
            $this->fecha = $pelicula->deleted_at;
        } else if($fechaAct==true&&$crear==false){
            $this->asunto = 'pelicula restaurado';
            $this->texto = "restauró";
            $this->fecha = $pelicula->updated_at;
        }else if($fechaAct==true&&$crear==true){
            $this->asunto = 'pelicula creado correctamente';
            $this->texto = "Creo";
            $this->fecha = $pelicula->updated_at;

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
        return [
            //
        ];
    }
}
