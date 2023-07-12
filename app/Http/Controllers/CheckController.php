<?php

namespace App\Http\Controllers;

use App\Enums\CheckStatus;
use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
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
