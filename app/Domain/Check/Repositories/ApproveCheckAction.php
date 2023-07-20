<?php

namespace App\Domain\Check\Repositories;

use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Domain\Check\Interfaces\ApproveCheckActionInterface;
use App\Domain\Transaction\Deposit\Repositories\DepositRepository;
use App\Domain\Transaction\DTO\TransactionData;
use App\Enums\CheckDepositStatus;
use App\Models\CheckDeposit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApproveCheckAction implements ApproveCheckActionInterface
{
    /**
     * Initializes a new instance of the ApproveCheckAction class.
     *
     * @param  AccountRepositoryInterface  $account The account repository to use for account operations.
     */
    public function __construct(
        public readonly AccountRepositoryInterface $account
    ) {
    }

    /**
     * Approves a check deposit and performs necessary operations.
     *
     * @param  CheckDeposit  $check The check deposit to approve.
     * @return void
     */
    public function approve(CheckDeposit $check)
    {
        $check->status = CheckDepositStatus::APPROVED;

        DB::transaction(function () use ($check) {
            $check->save();

            (new DepositRepository)->create(
                new TransactionData(
                    userId: $check->user->id,
                    description: $check->description,
                    amount: $check->amount,
                    date: Carbon::now(),
                )
            );

            $this->account->incrementAccountBalance($check->user->account->id, $check->amount);
        });
    }
}
