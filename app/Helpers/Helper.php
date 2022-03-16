<?php

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Http;

if (!function_exists('iso_code')) {
    /**
     * description
     *
     * @param
     * @return
     */
    function iso_code()
    {
        return auth()->user()->currency->iso_code;
    }
}

function convertCurrencyForReceiver($amount,$userId){
    $response = Http::get('https://openexchangerates.org/api/latest.json?app_id=90548d693ce6421db1f572a11aefdc68');
    if($response->successful()) {
        $data = json_decode($response->body());
        $usd = $data->rates->USD;
        $eur = $data->rates->EUR;
        switch (iso_code_by_user_id($userId)) {
            case 'USD':
                return $amount * $usd;
            case 'EUR':
                return $amount * $eur;
        }
        return $amount;
    }
    return response()->json([
        'Error' => 'Internel Server Error!!'
    ]);
}

function convertCurrency($amount, $userId){
    $response = Http::get('https://openexchangerates.org/api/latest.json?app_id=90548d693ce6421db1f572a11aefdc68');
    if($response->successful()) {
        $data = json_decode($response->body());
        $usd = $data->rates->USD; // 1
        $eur = $data->rates->EUR; //.9

        switch (iso_code()) {
            case 'USD':
                return $amount * $usd;
            case 'EUR':
                return $amount * (1/$eur);
        }
    }
    return response()->json([
        'Error' => 'Internel Server Error!!'
    ]);
}

if (!function_exists('iso_code_by_user_id')) {
    /**
     * description
     *
     * @param
     * @return
     */
    function iso_code_by_user_id($id)
    {
        $user = User::find($id);
        return $user->currency->iso_code;
    }
}

if (!function_exists('userEmail')) {
    /**
     * description
     *
     * @param
     * @return
     */
    function userEmail($id)
    {
        return User::find($id)->email;
    }
}


if (!function_exists('holderWalletBalance')) {
    /**
     * description
     *
     * @param
     * @return
     */
    function holderWalletBalance($id)
    {
        return Wallet::where('holder_id',$id)->first()['balance'];
    }
}