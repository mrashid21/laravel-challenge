<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Request;
use App\Interfaces\InternetServiceProviderInterface;

class InternetServiceProviderController extends Controller
{
    public function getMptInvoiceAmount(Request $request)
    {
        $mpt = new Mpt();
        $mpt->setMonth($request->get('month') ?: 1);
        $amount = $mpt->calculateTotalAmount();

        return response()->json([
            'data' => $amount,
        ]);
    }

    public function getOoredooInvoiceAmount(Request $request)
    {
        $ooredoo = new Ooredoo();
        $ooredoo->setMonth($request->get('month') ?: 1);
        $amount = $ooredoo->calculateTotalAmount();

        return response()->json([
            'data' => $amount,
        ]);
    }

    public function getInvoiceAmount(InternetServiceProviderInterface $serviceProvider, Request $request)
    {
        $serviceProvider->setMonth($request->get('month') ?: 1);
        $amount = $serviceProvider->calculateTotalAmount();

        return response()->json([
            'data' => $amount,
        ]);
    }
}
