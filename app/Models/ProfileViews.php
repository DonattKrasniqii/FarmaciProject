<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileViews extends Model
{
    use HasFactory;

    protected $fillable = [
        'viewer_id'
    ];

    public function profileUser(){

        return $this->belongsTo(User::class,'profile_id');
    }

    public function profileViewer(){

        return $this->belongsTo(User::class,'viewer_id');
    }


}
