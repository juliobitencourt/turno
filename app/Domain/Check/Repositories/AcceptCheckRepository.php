<?php

namespace App\Domain\Check\Repositories;

use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use Carbon\Carbon;
use App\Enums\TransactionType;
use App\Enums\CheckDepositStatus;
use Illuminate\Support\Facades\DB;
use App\Domain\Check\Interfaces\AcceptCheckRepositoryInterface;

class AcceptCheckRepository implements AcceptCheckRepositoryInterface
{
    public function __construct(
        public readonly AccountRepositoryInterface $account
    )
    {}

    public function accept($check)
    {
        $check->status = CheckDepositStatus::APPROVED;

        DB::transaction(function () use ($check) {
            $check->save();

            $check->user->transactions()->create([
                'type' => TransactionType::DEPOSIT,
                'description' => $check->description,
                'amount' => $check->amount,
                'date' => Carbon::now(),
            ]);

            $this->account->incrementAccountBalance($check->user->account->id, $check->amount);
        });
    }
}