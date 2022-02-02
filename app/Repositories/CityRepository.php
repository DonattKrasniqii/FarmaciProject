<?php


namespace App\Repositories;


use App\Models\City;

class CityRepository
{
    public function getAll(){
        return City::orderBy('name','ASC')->get();
    }
}
