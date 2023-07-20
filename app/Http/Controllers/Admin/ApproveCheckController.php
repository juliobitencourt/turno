<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Check\Interfaces\ApproveCheckRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\CheckDeposit;

class ApproveCheckController extends Controller
{
    public function __construct(
        private ApproveCheckRepositoryInterface $approveCheckRepository
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(CheckDeposit $check)
    {
        $this->approveCheckRepository->approve($check);
    }
}
