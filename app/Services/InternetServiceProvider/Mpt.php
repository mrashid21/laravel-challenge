<?php

namespace App\Services\InternetServiceProvider;

use App\Interfaces\InternetServiceProviderInterface;
use App\Abstracts\InternetServiceProviderAbstract;

class Mpt extends InternetServiceProviderAbstract implements InternetServiceProviderInterface
{
    protected $operator = 'mpt';

    protected $month = 0;

    protected $monthlyFees = 200;

    public function setMonth(int $month)
    {
        $this->month = $month;
    }

    public function calculateTotalAmount(): float
    {
        return $this->month * $this->monthlyFees;
    }
}
