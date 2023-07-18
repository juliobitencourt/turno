<?php

namespace App\Domain\Interfaces;

interface AcceptCheckRepositoryInterface
{
    public function accept($check);
}