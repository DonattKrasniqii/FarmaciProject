<?php


namespace App\Repositories;


use App\Models\Category;

class CategoryRepository
{
    public function getAll(){
        return Category::orderBy('name','ASC')->get();
    }
}
