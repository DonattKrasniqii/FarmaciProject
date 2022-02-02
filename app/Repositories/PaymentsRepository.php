<?php namespace App\Repositories;

use App\Models\Payment;
use App\Notifications\JuniorParrotAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PaymentsRepository
{
    public function getById($payment)
    {
        return Payment::find($payment);
    }

    public function getAll()
    {
        return Payment::latest()->paginate(20);
    }

    public function store(Request $request)
    {
        return $this->update($request, new Payment());
    }

    public function update(Request $request, $payment)
    {
        if (!$payment instanceof Payment) {
            $payment = $this->getById($payment);
        }

        $payment->user_id = $request->input('user');
        $payment->type = $request->input('type');
        $payment->sum = $request->input('sum');
        $payment->from = $request->input('from');
        $payment->to = $request->input('to');
        $payment->note = $request->input('note');

        Notification::route('slack', env('SLACK_WEBHOOKPAYMENT'))
            ->notify(new JuniorParrotAPI($request->all()));

        return $payment->save();
    }

    public function delete($id)
    {
        return Payment::find($id)->delete();
    }
}
