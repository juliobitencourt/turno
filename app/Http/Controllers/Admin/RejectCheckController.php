<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Interfaces\RejectCheckRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\CheckDeposit;

class RejectCheckController extends Controller
{
    public function __construct(
        private RejectCheckRepositoryInterface $rejectCheckRepository
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(CheckDeposit $check)
    {
        $this->rejectCheckRepository->reject($check);
    }
}
