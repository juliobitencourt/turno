<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, int $month = null)
    {
        if (is_null($month)) {
            $month = date('m');
        }

        return view('home', [
            'balance' => Auth::user()->balance,
            'incomes' => Auth::user()->incomesSum(),
            'expenses' => abs(Auth::user()->expensesSum()),
            'transactions' => Auth::user()->transactions()->get()->toArray()
        ]);
    }
}
