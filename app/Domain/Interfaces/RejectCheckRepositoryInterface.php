<?php

namespace App\Domain\Interfaces;

interface RejectCheckRepositoryInterface
{
    public function reject($check);
}