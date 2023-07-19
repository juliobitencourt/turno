<?php

namespace App\Domain\Check\Interfaces;

interface RejectCheckRepositoryInterface
{
    public function reject($check);
}