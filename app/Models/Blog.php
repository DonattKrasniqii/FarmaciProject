<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory;

    const ADVERTISE_TYPE_ARCHIVE = 1;
    const ADVERTISE_TYPE_FEATURED = 0;


    protected $id;
    protected $name;
    protected $description;
    protected $image_path;
    protected $created_at;
    protected $updated_at;
    protected $is_featured;

    public function views()
    {
        return $this->hasMany(PostViews::class);
    }


}
