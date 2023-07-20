<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Check\Interfaces\ApproveCheckActionInterface;
use App\Http\Controllers\Controller;
use App\Models\CheckDeposit;

class ApproveCheckController extends Controller
{
    /**
     * Initializes a new instance of the ApproveCheckController class.
     *
     * @param  ApproveCheckActionInterface  $approveCheckAction The approval action.
     */
    public function __construct(
        private ApproveCheckActionInterface $approveCheckAction
    ) {
    }

    /**
     * Handle the incoming request.
     *
     * @param  CheckDeposit  $check The check model instance that will be approved.
     */
    public function __invoke(CheckDeposit $check)
    {
        $this->approveCheckAction->approve($check);
    }
}
