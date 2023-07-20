<?php

namespace App\Http\Controllers\Customer;

use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Domain\Transaction\Deposit\Repositories\DepositRepository;
use App\Domain\Transaction\Withdrawal\Repositories\WithdrawalRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  AccountRepositoryInterface  $accountRepository The account repository to be used.
     * @param  DepositRepository  $deposit The deposit repository to be used.
     * @param  WithdrawalRepository  $withdrawal The withdrawal repository to be used.
     * @param int  $month The month that might be used to filter
     */
    public function __invoke(
        AccountRepositoryInterface $account,
        DepositRepository $deposit,
        WithdrawalRepository $withdrawal,
        int $month = null)
    {
        if (is_null($month)) {
            $month = date('m');
        }

        $balance = $account->getBalance(Auth::user()->account->id);
        $incomes = $deposit->sum(Auth::user()->id);
        $expenses = $withdrawal->sum(Auth::user()->id);

        return view('customer.home', [
            'balance' => $balance,
            'incomes' => $incomes,
            'expenses' => $expenses,
            'transactions' => Auth::user()->transactions()->get()->toArray(),
        ]);
    }
}
