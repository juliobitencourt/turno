<?php

namespace App\Domain\Account\Interfaces;

interface AccountRepositoryInterface
{
    public function create(string $id);

    // public function hasBalance();

    // public function addAccountBalance();

    // public function removeAccountBalance();
}