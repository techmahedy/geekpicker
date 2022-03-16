<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'payable_type',
        'payable_id',
        'wallet_id',
        'type',
        'amount',
        'user_id'
    ];
}
