<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public const TYPE_MEMBER_SHIP = 1;
    public const TYPE_MARKETING_ADS = 2;

    public function store(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
