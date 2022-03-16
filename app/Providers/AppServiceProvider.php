<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\PaymentServiceContract;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {  
        if (request()->has('payment_method')) {
            $className = $this->resolvePaymentDependency(request()->get('payment_method'));
            $this->app->bind(PaymentServiceContract::class, $className);
        }
    }

    private function resolvePaymentDependency($class_name)
    {
        switch ($class_name) {
            case 'stripe':
                return \App\Service\StripePaymentService::class;
            case 'paypal':
                return 'Assuming we have paypal payment service!';
        }

        throw new \ErrorException("Error: Payment Method {$class_name} Not Found.");
    }

    public function boot()
    {   

    }
}
