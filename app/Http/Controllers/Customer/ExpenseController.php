<?php

namespace App\Http\Controllers\Customer;

use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Domain\Transaction\DTO\TransactionData;
use App\Domain\Transaction\Withdrawal\Repositories\WithdrawalRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Initializes a new instance of the ExpenseController class.
     *
     * @param  AccountRepositoryInterface  $account The account repository to be used.
     * @param  WithdrawalRepository  $withdrawal The withdrawal repository to be used.
     */
    public function __construct(
        public readonly AccountRepositoryInterface $account,
        public readonly WithdrawalRepository $withdrawal,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = $this->withdrawal->getTransactions(Auth::user()->id)->toArray();

        return view('customer.expenses-list', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.expenses-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        if (! $this->account->hasBalance(Auth::user()->account->id, $request->amount)) {
            return response()->json([
                'errors' => [
                    'amount' => ["The user's balance isn't enough to the amount"],
                ],
            ], 422); // Unprocessable Entity status code
        }

        $expense = (new WithdrawalRepository)->create(
            new TransactionData(
                userId: Auth::user()->id,
                description: $validated['description'],
                amount: $validated['amount'],
                date: date_create($request->date),
            )
        );

        $this->account->decrementAccountBalance(Auth::user()->account->id, $request->amount);

        return $expense->transaction;
    }
}
