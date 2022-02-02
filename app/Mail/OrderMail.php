<?php

namespace App\Mail;

use App\Models\Drug;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;


    public $drug;
    public $user;
    public $userBuyer;

    public const ORDER_TO_BUYER = "ORDER";
    public const ORDER_TO_SELLER = "SELLER";

    public $toWho;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Drug $drug,User $user,$userBuyer,$toWho)
    {
        $this->drug = $drug;
        $this->user = $user;
        $this->userBuyer = $userBuyer;
        $this->toWho = $toWho;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if($this->toWho == $this::ORDER_TO_BUYER) {
            return $this->subject('Njoftim mbi porosin')
                ->view('email.orderMedicament')->with([
                    "drug" => $this->drug,
                    'user' => $this->user,
                    'userBuyer' => $this->userBuyer
                ]);
        }else if($this->toWho == $this::ORDER_TO_SELLER){
            return $this->subject('Njoftim mbi porosin')
                ->view('email.orderMedicamentSeller')->with([
                    "drug" => $this->drug,
                    'user' => $this->user,
                    'userBuyer' => $this->userBuyer
                ]);
        }


    }
}
