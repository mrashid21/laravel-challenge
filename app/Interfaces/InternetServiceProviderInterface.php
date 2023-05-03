<?php

namespace App\Interfaces;

interface InternetServiceProviderInterface {

	public function setMonth(int $month);

	public function calculateTotalAmount(): float;
}