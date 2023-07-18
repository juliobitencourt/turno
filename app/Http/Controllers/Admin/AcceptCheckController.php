<?php

namespace App\Http\Controllers\Admin;

use App\Models\CheckDeposit;
use App\Http\Controllers\Controller;
use App\Domain\Interfaces\AcceptCheckRepositoryInterface;

class AcceptCheckController extends Controller
{
    public function __construct(
        private AcceptCheckRepositoryInterface $acceptCheckRepository
    )
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Check $check)
    {
        $this->acceptCheckRepository->accept($check);
    }
}
