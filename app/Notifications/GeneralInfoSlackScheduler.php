<?php

namespace App\Notifications;

use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class GeneralInfoSlackScheduler extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    private $countUsers;
    private $countDrugs;
    private $totalSum;
    private $joke;



    public function __construct($countUsers,$countDrugs,$totalSum,$joke)
    {
        $this->countDrugs = $countDrugs;
        $this->countUsers = $countUsers;
        $this->totalSum = $totalSum;
        $this->joke = $joke;
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
            ->content("*Jam këtu tani* :mantelpiece_clock: " . "\n" .
            "Ekzekutova disa query në databazë dhe morra disa informata" . "\n"
            . "1.Totali i barnatoreve : " . "*" . $this->countUsers."* :muscle:" . "\n"
            . "2.Totali i medikamenteve : " . "*" . $this->countDrugs. "* :pill:" . "\n"
            . "3.Shuma e pagesave : " . "*" . $this->totalSum. "* € :moneybag:" . "\n" .
            " Pas ketyre query te ekzekutura mu dok vetja si SQL Expert :alien: prandaj po e tregoj  nje 'joke' " . "\n" . "\n" .
            "*".$this->joke. "*");
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
