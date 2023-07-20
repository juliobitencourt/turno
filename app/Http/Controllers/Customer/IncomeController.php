<?php

namespace App\Http\Controllers\Customer;

use App\Domain\Transaction\Deposit\Repositories\DepositRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Initializes a new instance of the ExpenseController class.
     *
     * @param  DepositRepository  $withdrawal The withdrawal repository to be used.
     */
    public function __construct(
        public readonly DepositRepository $deposit,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomes = $this->deposit->getTransactions(Auth::user()->id)->toArray();

        return view('customer.incomes-list', compact('incomes'));
    }
}
