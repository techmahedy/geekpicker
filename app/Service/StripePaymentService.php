<?php 

namespace App\Service;

use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Service\PaymentService;

class StripePaymentService extends PaymentService
{
    public $token;
    public $card;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function setConfig()
    {
        // When the request has card info
        if ($this->request->card_number) {
            $this->setCardInfo();
        }

        $this->setStripeToken();

        return $this;
    }

    public function charge()
    {   
        $data = [
            'amount' => $this->amount,
            'currency' => auth()->user()->currency->iso_code,
            'description' => $this->description,
            'source' => $this->token,
        ];

        $result = \Stripe\Charge::create($data);

        if ($result->status == 'succeeded') { 
            auth()->user()->wallet->transfer($this->request);
        } 
        
        return $this;
    }

    private function setStripeToken()
    {
        $this->token = $this->request->token;
    }

    public function setCardInfo()
    {
        $this->card = [
            'number' => $this->request->card_number,
            'exp_month' => $this->request->exp_month,
            'exp_year' => $this->request->exp_year,
            'cvc' => $this->request->cvc,
        ];
    }
}