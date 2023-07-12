<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function createPurchase(Request $request): Transaction
    {
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'integer'],
            'date' => ['required', 'date'],
        ]);

        if ($this->checkIfUserHaveEnoughMoney(Auth::user()->balance, $request->amount) === false) {
            return abort(302, "The user's balance isn't enough to the amount");
        }

        return Transaction::create([
            'type_id' => TransactionType::EXPENSE,
            'description' => $request->description,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);
    }

    public function getExpenses(): Collection
    {
        return Auth::user()->transactions()->get();
    }

    protected function checkIfUserHaveEnoughMoney(int $balance, int $amount): bool
    {
        return $balance > $amount;
    }
}
