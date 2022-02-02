<?php namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drug extends Model
{
    use HasFactory;
    use SoftDeletes;



    protected $table = 'drugs';

    public function images()
    {
        return $this->hasMany(Drug_Images::class);
    }

    public function drugStore()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function drugVisits()
    {
        return $this->hasMany(DrugSeen::class);
    }

    public function mainImagePath()
    {
        $image = Drug_Images::where('drug_id', $this->id)->where('is_main', 1)->first();
        if (!is_null($image)) {
            return $image->image;
        }
        return "";
    }

    public function isAccepted(){
        return $this->is_accepted == 1;
    }

    public function getDuration(){

        $start = Carbon::parse($this->created_at);
        $end = now();
        $hours = $end->diffInHours($start);
        return $hours;
    }
    public function getDurationMinutes(){
        $start = Carbon::parse($this->created_at);
        $end = now();
        $minutes = $end->diffInMinutes($start);

        return $minutes;
    }



}
