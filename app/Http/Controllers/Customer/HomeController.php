<?php

namespace App\Http\Controllers\Customer;

use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AccountRepositoryInterface $account, int $month = null)
    {
        if (is_null($month)) {
            $month = date('m');
        }

        $balance = $account->getBalance(Auth::user()->account->id);

        return view('customer.home', [
            'balance' => $balance,
            'incomes' => Auth::user()->incomesSum(),
            'expenses' => Auth::user()->expensesSum(),
            'transactions' => Auth::user()->transactions()->get()->toArray(),
        ]);
    }
}
