<?php 

namespace App\Common;

use App\Models\Wallet;
use App\Models\Transaction;

Trait Depositable
{
    public function transaction()
    {
        return $this->morphTo();
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'payable');
    }

    public function transfer($request)
    {   
        auth()->user()->wallet()->update([
            'balance' => auth()->user()->wallet->balance - $request->amount
        ]);

        Wallet::where('holder_id',$request->user_id)->update([
            'balance' => holderWalletBalance($request->user_id) + convertCurrencyForReceiver(convertCurrency($request->amount, $request->user_id), $request->user_id )
        ]);

        return $this->transactions()->create([
            'payable_type' => 'App\Models\Wallet',
            'payable_id'  => auth()->user()->wallet->id,
            'wallet_id' => auth()->user()->wallet->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'user_id' => $request->user_id
        ]);
    }
}