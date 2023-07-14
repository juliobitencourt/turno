<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Check;
use App\Enums\CheckStatus;
use Illuminate\Http\Request;
use App\Enums\TransactionType;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AcceptCheckController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Check $check)
    {
        $check->status_id = CheckStatus::ACCEPTED;

        DB::transaction(function () use ($check) {
            $check->save();

            $check->user->transactions()->create([
                'type_id' => TransactionType::INCOME,
                'description' => $check->description,
                'amount' => $check->amount,
                'date' => Carbon::now(),
            ]);

            $check->user->addMoney($check->amount);
        });
    }
}
