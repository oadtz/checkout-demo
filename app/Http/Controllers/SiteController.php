<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index () {
        $currencies = config('checkout.currencies');
        $currentYear = \Carbon\Carbon::now()->year;

        return view('index', compact('currencies', 'currentYear'));
    }
}
