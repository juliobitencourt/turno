<?php

namespace App\Domain\Check\Repositories;

use Carbon\Carbon;
use App\Enums\TransactionType;
use App\Enums\CheckDepositStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Domain\Transaction\DTO\TransactionData;
use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Domain\Check\Interfaces\AcceptCheckRepositoryInterface;
use App\Domain\Transaction\Withdrawal\Repositories\WithdrawalRepository;

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

            (new WithdrawalRepository)->create(
                new TransactionData(
                    userId: Auth::user()->id,
                    description: $check->description,
                    amount: $check->amount,
                    date: Carbon::now(),
                )
            );

            // $check->user->transactions()->create([
            //     'type' => TransactionType::DEPOSIT,
            //     'description' => $check->description,
            //     'amount' => $check->amount,
            //     'date' => Carbon::now(),
            // ]);

            $this->account->incrementAccountBalance($check->user->account->id, $check->amount);
        });
    }
}