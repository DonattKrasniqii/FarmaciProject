<?php


namespace App\Repositories;


use App\Models\DrugSeen;

class DrugSeenRepository
{
    public function addVisit($drugId)
    {
        $seen = new DrugSeen();
        $seen->drug_id = $drugId;
        return $seen->save();
    }

    public function countAllVisits()
    {
        return DrugSeen::count();
    }
}
