<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\TransactionType;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Auth::user()->expenses()->get()->toArray();

        return view('expenses', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenses-form');
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
