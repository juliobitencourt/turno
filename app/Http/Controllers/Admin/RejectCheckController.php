<?php

namespace App\Http\Controllers\Admin;

use App\Models\Check;
use App\Enums\CheckStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RejectCheckController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Check $check)
    {
        $check->status_id = CheckStatus::REJECTED;
        $check->save();
    }
}
