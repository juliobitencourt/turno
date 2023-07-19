<?php

namespace App\Http\Controllers\Admin;

use App\Models\CheckDeposit;
use App\Http\Controllers\Controller;
use App\Domain\Interfaces\RejectCheckRepositoryInterface;

class RejectCheckController extends Controller
{
    public function __construct(
        private RejectCheckRepositoryInterface $rejectCheckRepository
    )
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(CheckDeposit $check)
    {
        $this->rejectCheckRepository->reject($check);
    }
}
