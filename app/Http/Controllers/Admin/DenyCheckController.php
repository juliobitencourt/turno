<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Check\Interfaces\DenyCheckRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\CheckDeposit;

class DenyCheckController extends Controller
{
    /**
     * Initializes a new instance of the CheckControlController class.
     *
     * @param  DenyCheckRepositoryInterface  $denyCheckRepository The denial action.
     */
    public function __construct(
        private DenyCheckRepositoryInterface $denyCheckRepository
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param  CheckDeposit  $check The check model instance that will be denied.
     */
    public function __invoke(CheckDeposit $check)
    {
        $this->denyCheckRepository->deny($check);
    }
}
