<?php

namespace App\Http\Controllers\Admin;

use App\Models\CheckDeposit;
use App\Http\Controllers\Controller;
use App\Domain\Check\Interfaces\AcceptCheckRepositoryInterface;

class AcceptCheckController extends Controller
{
    public function __construct(
        private AcceptCheckRepositoryInterface $acceptCheckRepository
    )
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(CheckDeposit $check)
    {
        $this->acceptCheckRepository->accept($check);
    }
}
