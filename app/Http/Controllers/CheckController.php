<?php

namespace App\Http\Controllers;

use App\Enums\CheckStatus;
use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checks = Auth::user()->checks()->get();

        $checks = $checks->map(function ($check) {
            return [
                'description' => $check->description,
                'amount' => $check->amount,
                'date' => $check->created_at
            ];
        })->toArray();

        return view('checks', compact('checks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('checks-form');
    }

    public function store(Request $request): Check
    {
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'integer'],
            'file' => ['required'],
        ]);

        $path = $request->file('file')->store();

        $check = Auth::user()->checks()->create([
            'status_id' => CheckStatus::REJECTED,
            'description' => $request['description'],
            'amount' => $request['amount'],
            'filename' => $path,
        ]);

        return $check;
    }
}
