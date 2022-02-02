<?php

namespace App\Imports;

use App\Drug;
use Maatwebsite\Excel\Concerns\ToModel;

class DrugsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Drug([
            ''
        ]);
    }
}
