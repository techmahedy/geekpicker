<?php 

namespace App\Service;

use Illuminate\Http\Request;
use App\Contracts\PaymentServiceContract;

class PaymentService implements PaymentServiceContract
{
    public $request;
    public $payee;
    public $receiver;
    public $amount;
    public $description;
    public $status;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->setPayee(auth()->id());
    }

    public function setPayee($payee)
    {
        $this->payee = $payee;

        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function setDescription($description = '')
    {
        $this->description = $description;

        return $this;
    }

    public function setReceiver($receiver)
    {  
        $this->receiver = $receiver;

        return $this;
    }

    public function setConfig()
    {
        return $this;
    }

    public function charge()
    {
        return $this;
    }
}