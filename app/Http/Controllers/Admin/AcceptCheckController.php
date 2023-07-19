<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Check\Interfaces\AcceptCheckRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\CheckDeposit;

class AcceptCheckController extends Controller
{
    public function __construct(
        private AcceptCheckRepositoryInterface $acceptCheckRepository
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(CheckDeposit $check)
    {
        $this->acceptCheckRepository->accept($check);
    }
}
