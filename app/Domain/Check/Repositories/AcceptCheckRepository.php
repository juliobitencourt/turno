<?php

namespace App\Domain\Check\Repositories;

use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Domain\Check\Interfaces\AcceptCheckRepositoryInterface;
use App\Domain\Transaction\DTO\TransactionData;
use App\Domain\Transaction\Withdrawal\Repositories\WithdrawalRepository;
use App\Enums\CheckDepositStatus;
use App\Models\CheckDeposit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AcceptCheckRepository implements AcceptCheckRepositoryInterface
{
    public function __construct(
        public readonly AccountRepositoryInterface $account
    ) {
    }

    public function accept(CheckDeposit $check)
    {
        $check->status = CheckDepositStatus::APPROVED;

        DB::transaction(function () use ($check) {
            $check->save();

            (new WithdrawalRepository)->create(
                new TransactionData(
                    userId: Auth::user()->id,
                    description: $check->description,
                    amount: $check->amount,
                    date: Carbon::now(),
                )
            );

            $this->account->incrementAccountBalance($check->user->account->id, $check->amount);
        });
    }
}
