<?php

namespace App\Domain\Transaction;

use App\Domain\Transaction\DTO\TransactionData;
use App\Domain\Transaction\Interfaces\TransactionRepositoryInterface;
use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Traits\NumberFormat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractTransactionRepository implements TransactionRepositoryInterface
{
    use NumberFormat;

    /**
     * The current transaction.
     *
     * @var  App\Models\Transaction|null
     */
    public readonly Transaction $transaction;

    /**
     * Creates a new transaction based on the provided transaction data.
     *
     * @param  TransactionData  $transactionData The data used to create the transaction.
     * @return self Returns an instance of the current class.
     */
    public function create(TransactionData $transactionData): self
    {
        $this->transaction = new Transaction;
        $this->transaction->user_id = $transactionData->userId;
        $this->transaction->type = $this->transactionType();
        $this->transaction->description = $transactionData->description;
        $this->transaction->amount = $this->convertTheAmount($transactionData->amount);
        $this->transaction->date = Carbon::parse($transactionData->date)->toDateTimeString();
        $this->transaction->save();

        return $this;
    }

    /**
     * Get transactions by type.
     *
     * @param  string  $userId The id of the user to filter the transactions.
     */
    public function getTransactions(string $userId): Collection
    {
        return Transaction::where([
            'user_id' => $userId,
            'type' => $this->transactionType(),
        ])->get();
    }

    /**
     * Get the sum of transactions by type.
     *
     * @param  string  $userId The id of the user to sum the transactions.
     */
    public function sum(string $userId): int
    {
        $sum = Transaction::where([
            'user_id' => $userId,
            'type' => $this->transactionType(),
        ])->sum('amount');

        return $this->get($sum);
    }

    /**
     * This method should be implemented in child classes to determine the transactions's type.
     */
    abstract protected function transactionType(): string;

    /**
     * Finds and retrieves a transaction based on the provided ID.
     *
     * @param  string  $id The ID of the transaction to find.
     * @return Transaction The found transaction object.
     */
    public function find(string $id): Transaction
    {
        return $this->transaction = Transaction::find($id);
    }

    /**
     * Checks whether the amount should be converted to a negative value.
     *
     * @param  int  $amount The value to be converted.
     */
    protected function convertTheAmount(int $amount): int
    {
        if ($this->transactionType() === TransactionType::WITHDRAWAL->value) {
            return -$amount;
        }

        return $amount;
    }
}
