<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        return view('customer.home', [
            'balance' => Auth::user()->balance,
            'incomes' => Auth::user()->incomesSum(),
            'expenses' => abs(Auth::user()->expensesSum()),
            'transactions' => Auth::user()->transactions()->get()->toArray()
        ]);
    }
}
