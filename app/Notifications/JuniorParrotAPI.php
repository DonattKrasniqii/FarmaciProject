<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class JuniorParrotAPI extends Notification
{
    use Queueable;


    private $validated;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($validated = [])
    {
        $this->validated = $validated;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }


    public function toSlack($notifiable)
    {

        return (new SlackMessage)
            ->from('name', ':ghost:')
            ->to('#payment')
            ->content("*NJOFTIM!* :money_with_wings:" . "\n"
            . "U bë regjistrimi i një pagese për barnatoren " . "*" . User::find($this->validated['user'])->name ."*" .
            "\n" . "Tipi që zgjodhi " .  "*" . (($this->validated['type'] == 1) ? "*Antarësim" : "Marketing") . "*" . "\n" .
            "Shuma që pagoi " .$this->validated['sum'] . "€") ;
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
