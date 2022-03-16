<?php 

namespace App\Contracts;

interface PaymentServiceContract
{
    public function charge();

    public function setPayee($payee);

    public function setReceiver($receiver);

    public function setAmount($amount);

    public function setDescription($description);

    public function setConfig();
}