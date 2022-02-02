<?php namespace App\Repositories;

use App\Mail\OrderMail;
use App\Models\Drug;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use const http\Client\Curl\AUTH_ANY;

class OrdersRepository
{
    public function store(Request $request)
    {
        $order = new Order();
        $order->drug_id = $request->input('drug_id');
        $order->name = $request->input('name');
        $order->phone_number = $request->input('phone_number');
        $order->address = $request->input('address');
        $order->message = $request->input('message');

        $drug = Drug::find($order->drug_id);

        Mail::to($order->address)->send(new OrderMail($drug,$drug->drugStore,$order->name,OrderMail::ORDER_TO_BUYER));
        Mail::to($drug->drugStore->email)->send(new OrderMail($drug,$drug->drugStore,$order->name,OrderMail::ORDER_TO_SELLER));

        return $order->save();
    }

    public function getOrders()
    {
        if (auth()->user()->is_admin) {
            return DB::table('orders')
                ->join('drugs', 'orders.drug_id', '=', 'drugs.id')
                ->join('users', 'drugs.user_id', '=', 'users.id')
                ->orderByDesc('orders.created_at')
                ->select('orders.*', 'users.name as store', 'drugs.name as product')
                ->paginate(10);
        } else {
            return DB::table('orders')
                ->join('drugs', 'orders.drug_id', '=', 'drugs.id')
                ->join('users', 'drugs.user_id', '=', 'users.id')
                ->where('drugs.user_id', auth()->user()->id)
                ->orderByDesc('orders.created_at')
                ->select('orders.*', 'users.name as store', 'drugs.name as product')
                ->paginate(10);
        }
    }
}
