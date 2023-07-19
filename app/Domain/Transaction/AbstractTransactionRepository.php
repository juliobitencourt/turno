<?php

namespace App\Domain\Transaction;

use Carbon\Carbon;
use App\Models\Transaction;
use App\Domain\Transaction\DTO\TransactionData;
use App\Domain\Transaction\Interfaces\TransactionRepositoryInterface;

abstract class AbstractTransactionRepository implements TransactionRepositoryInterface
{
    /**
     * The current transaction.
     *
     * @var  App\Models\Transaction|null
     */
    public readonly Transaction $transaction;

    /**
     * Creates a new transaction based on the provided transaction data.
     *
     * @param TransactionData $transactionData The data used to create the transaction.
     * @return self Returns an instance of the current class.
     */
    public function create(TransactionData $transactionData): self
    {
        $this->transaction = new Transaction;
        $this->transaction->user_id = $transactionData->userId;
        $this->transaction->type = $this->transactionType();
        $this->transaction->description = $transactionData->description;
        $this->transaction->amount = $transactionData->amount;
        $this->transaction->date = Carbon::parse($transactionData->date)->toDateTimeString();
        $this->transaction->save();

        return $this;
    }

    /**
     * Method: transactionType (abstract)
     *
     * Description: This method should be implemented in child classes to determine the transactions's type.
     *
     * @return string
     */
    protected abstract function transactionType(): string;

    /**
     * Method: find
     *
     * Description: Finds and retrieves a transaction based on the provided ID.
     *
     * @param string $id The ID of the transaction to find.
     * @return Transaction The found transaction object.
     */
    public function find(string $id): Transaction
    {
        return $this->transaction = Transaction::find($id);
    }
}