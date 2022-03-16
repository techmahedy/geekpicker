<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\HasApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Contracts\PaymentServiceContract as Payment;

class WalletController extends Controller
{   
    use HasApiResponse;

    public function deposit(Request $request, Payment $payment)
    {   
        DB::beginTransaction();
        try {
            $payment->setReceiver(userEmail($request->user_id))
                ->setAmount(convertCurrency($request->amount, iso_code()))
                ->setDescription('A demo wallet testing using stripe!!!')
                ->setConfig()
                ->charge();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Payment failed :: ' . $e->getMessage());
            return $this->httpInternalServerError($e->getMessage());
        }
        DB::commit();
        return $this->httpSuccess('Deposit has been done successfully!!');
    }
}
