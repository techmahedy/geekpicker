<?php 

namespace App\Common;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

Trait Currencyable 
{
   /*
    * Get the Currency that owns the Currencyable
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
