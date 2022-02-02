<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
//    protected $table="contact";

    protected $id;
    protected $name;
    protected $email;
    protected $phone_number;
    protected $message;
}
