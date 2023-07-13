<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Enums\TransactionType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Auth::user()->expenses()->get()->toArray();

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
        $request->validate([
            'amount' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        if (Auth::user()->haveEnoughMoney($request->amount) === false) {
            return response()->json([
                'errors' => [
                    'amount' => ["The user's balance isn't enough to the amount"],
                ]
            ], 422); // Unprocessable Entity status code
        }

        return Auth::user()->transactions()->create([
            'type_id' => TransactionType::EXPENSE,
            'description' => $request->description,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);

        Auth::user()->subtractBalance($request->amount);
    }
}
