<?php

namespace App\Domain\Repositories;

use Carbon\Carbon;
use App\Enums\TransactionType;
use App\Enums\CheckDepositStatus;
use Illuminate\Support\Facades\DB;
use App\Domain\Interfaces\AcceptCheckRepositoryInterface;

class AcceptCheckRepository implements AcceptCheckRepositoryInterface
{
    public function accept($check)
    {
        $check->status = CheckDepositStatus::APPROVED;

        DB::transaction(function () use ($check) {
            $check->save();

            $check->user->transactions()->create([
                'type_id' => TransactionType::DEPOSIT,
                'description' => $check->description,
                'amount' => $check->amount,
                'date' => Carbon::now(),
            ]);

            $check->user->addMoney($check->amount);
        });
    }
}