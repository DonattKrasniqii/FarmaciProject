<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const ADVERTISE_TYPE_PREMIUM = 1;
    const ADVERTISE_TYPE_TOP = 2;
    const ADVERTISE_TYPE_STANDARD = 3;

    const USER_IS_ACTIVE = 1;
    const USER_IS_DEACTIVATED = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function drugs()
    {
        return $this->hasMany(Drug::class, 'user_id')->orderBy('created_at','DESC');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }


    public function isAdmin(){
        return $this->is_admin == 1;
    }


    public function getUserTypeBadge($numberType){
        switch ($numberType){
            case 1 :
                return "Premium";
                break;
            case 2 :
                return "TOP";
                break;
            case 3 :
                return "STANDART";
                break;
            default :
                return null;
        }
    }

    public function views(){

        return $this->hasMany(ProfileViews::class,'profile_id');
    }

    public function getBadgeColor(){
        if($this->advertise_type == self::ADVERTISE_TYPE_PREMIUM){
            return 'badge rounded-pill bg-warning text-dark';
        }
        if($this->advertise_type == self::ADVERTISE_TYPE_TOP){
            return 'badge rounded-pill bg-success text-dark';
        }
        if($this->advertise_type == self::ADVERTISE_TYPE_STANDARD){
            return 'badge rounded-pill bg-primary text-dark';
        }
    }


}
