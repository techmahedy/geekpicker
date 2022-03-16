<?php

namespace App\Models;

use App\Common\Depositable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory, Depositable;

    protected $fillable = [
        'holder_type',
        'holder_id',
        'name',
        'description',
        'meta',
        'balance'
    ];
}
