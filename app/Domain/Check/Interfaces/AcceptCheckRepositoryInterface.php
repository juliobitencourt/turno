<?php

namespace App\Domain\Check\Interfaces;

interface AcceptCheckRepositoryInterface
{
    public function accept($check);
}