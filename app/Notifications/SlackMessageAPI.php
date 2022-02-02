<?php

namespace App\Notifications;

use App\Models\City;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class SlackMessageAPI extends Notification
{
    use Queueable;


    public $results;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($results = [])
    {
        $this->results = $results;
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
            ->to('#promotions')
            ->content("*NJOFTIM* :fire:" . "\n" ."Barnatorja ". "*" . $this->results['name']."*". " sapo u regjistrua ne sistem :tada:" . "\n" ."\n" ."*TË DHËNAT* :information_source:" ."\n" ."\n"
            .  'Emri : ' . "*" . $this->results['name']."*". "\n"
            .  'Qyteti : ' . "*" . City::find($this->results['city'])->name."*". "\n"
                .'Numri telefonit : ' . "*" . $this->results['phone_number']."*");
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
