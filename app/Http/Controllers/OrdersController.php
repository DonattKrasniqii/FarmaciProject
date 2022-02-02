<?php

namespace App\Http\Controllers;

use App\Repositories\OrdersRepository;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $ordersRepository;
    public function __construct(OrdersRepository $ordersRepository)
    {
        $this->ordersRepository=$ordersRepository;
    }

    public function saveOrder(Request $request){
        $request->validate([
            'drug_id'=>'required',
            'name'=>'required',
            'phone_number'=>'required',
            'address'=>'required',
        ]);
        if($this->ordersRepository->store($request)){
            return redirect()->back()->with('message', 'Faleminderit për porosinë!');
        }
        else{
            return redirect()->back()->with('message', 'Gabim në procesim! Provoni përseri.');
        }
    }
}
