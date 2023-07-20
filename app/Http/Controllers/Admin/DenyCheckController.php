<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Interfaces\DenyCheckRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\CheckDeposit;

class DenyCheckController extends Controller
{
    public function __construct(
        private DenyCheckRepositoryInterface $denyCheckRepository
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(CheckDeposit $check)
    {
        $this->denyCheckRepository->deny($check);
    }
}
