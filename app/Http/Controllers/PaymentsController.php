<?php

namespace App\Http\Controllers;

use App\Exports\PaymentsExport;
use App\Notifications\JuniorParrotAPI;
use App\Repositories\PaymentsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;

class PaymentsController extends Controller
{
    private $paymentsRepository;

    public function __construct(PaymentsRepository $paymentsRepository)
    {
        $this->paymentsRepository = $paymentsRepository;
    }

    public function getPaymentInformations(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $payment = $this->paymentsRepository->getById($request->get('id'));
        if (!is_null($payment)) {
            return response()->json([
                'success' => true,
                'payment' => $payment
            ], 200);
        } else {
            return response()->json([
                'success' => false,
            ], 200);
        }
    }

    public function store(Request $request)
    {
       $validated =  $request->validate([
            'type' => 'required',
            'user' => 'required',
            'sum' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);
        if ($this->paymentsRepository->store($request)) {
            session()->flash('success', 'Pagesa është regjistruar');

            return redirect()->action([DashboardController::class, 'index']);
        } else {
            return redirect()->back()->with('message', 'Gabim në procesim! Provoni përseri.');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'user' => 'required',
            'type' => 'required',
            'sum' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);
        $payment = $this->paymentsRepository->getById($request->input('id'));
        if (!is_null($payment)) {
            if ($this->paymentsRepository->update($request, $payment)) {
                session()->flash('success', 'Pagesa është regjistruar');
                return redirect()->action([DashboardController::class, 'index']);
            } else {
                return redirect()->back()->with('message', 'Gabim në procesim! Provoni përseri.');
            }
        }
    }

    public function deletePayment($id)
    {
        $payment = $this->paymentsRepository->getById($id);
        if (!is_null($payment)) {
            if (auth()->user()->is_admin) {
                if ($this->paymentsRepository->delete($id)) {
                    session()->flash('success', 'Pagesa është fshirë!');
                    return redirect()->action([DashboardController::class, 'index']);
                }
                return redirect()->back()->with('error', 'Gabim në procesim !');
            }
            return redirect()->back()->with('error', 'Gabim në procesim !');
        } else {
            return redirect()->back()->with('error', 'Gabim në procesim !');
        }
    }

    public function printExcelData(){

         return Excel::download(new PaymentsExport(), 'pagesat.xlsx');

    }
}
