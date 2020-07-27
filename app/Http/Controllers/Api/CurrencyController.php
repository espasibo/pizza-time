<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Currency;

class CurrencyController extends Controller
{

    public function get_list() {

        $cur = Currency::get();

        return response()->json($cur);
    }
}