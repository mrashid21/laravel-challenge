<?php

namespace App\Services\InternetServiceProvider;

use App\Interfaces\InternetServiceProviderInterface;
use App\Abstracts\InternetServiceProviderAbstract;

class Ooredoo extends InternetServiceProviderAbstract implements InternetServiceProviderInterface
{
    protected $operator = 'ooredoo';

    protected $month = 0;

    protected $monthlyFees = 150;

    public function setMonth(int $month)
    {
        $this->month = $month;
    }

    public function calculateTotalAmount(): float
    {
        return $this->month * $this->monthlyFees;
    }
}
