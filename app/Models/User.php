<?php

namespace App\Models;

use App\Common\Currencyable;
use App\Common\HasWallet;
use App\Common\Tokenable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Currencyable, Tokenable, HasWallet;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function register($request) : self
    {   
        $this->currency_id = $request->currency_id;
        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = bcrypt($request->password);
        $this->save();

        if($request->has_wallet){
            $this->createWallet($request);
        }
        
        return $this;
    }

}
