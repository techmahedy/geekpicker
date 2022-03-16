<?php

namespace App\Common;

use Illuminate\Support\Str;

Trait Tokenable 
{
    public function generateApiAuthToken()
    {
        $this->api_token = Str::random(60);
        $this->save();

        return $this;
    }
}