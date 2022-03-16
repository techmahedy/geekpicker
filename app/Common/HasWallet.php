<?php 

namespace App\Common;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

Trait HasWallet
{
    public function hasWallet()
    {
        return (bool) $this->wallet()->count();
    }

    public function holder(): MorphTo
    {
        return $this->morphTo();
    }

    public function wallet(): MorphOne
    {
        return $this->morphOne(Wallet::class, 'holder');
    }

    public function createWallet($request)
    {   
        if($this->hasWallet()) {
            return $this->wallet()->update([
                'name' => $request->name,
                'balance' => $request->balance
            ]);
        }

        return $this->wallet()->create($request->all());
    }
}