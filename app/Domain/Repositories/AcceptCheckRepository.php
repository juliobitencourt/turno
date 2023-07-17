<?php

namespace App\Domain\Repositories;

use Carbon\Carbon;
use App\Enums\CheckStatus;
use App\Enums\TransactionType;
use Illuminate\Support\Facades\DB;
use App\Domain\Interfaces\AcceptCheckRepositoryInterface;

class AcceptCheckRepository implements AcceptCheckRepositoryInterface
{
    public function accept($check)
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