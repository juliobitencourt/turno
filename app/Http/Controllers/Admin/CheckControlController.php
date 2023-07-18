<?php

namespace App\Http\Controllers\Admin;

use App\Models\CheckDeposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Interfaces\CheckRepositoryInterface;

class CheckControlController extends Controller
{
    public function __construct(
        private CheckRepositoryInterface $checkRepository
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checks = $this->checkRepository->getAllChecks();

        $checks = $checks->map(function ($check) {
            return [
                'description' => $check->user->name,
                'amount' => $check->amount,
                'date' => $check->created_at,
                'link' => route('admin.checks.show', $check)
            ];
        })->toArray();

        return view('admin.checks-list', compact('checks'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Check $check)
    {
        return view('admin.check-details', compact('check'));
    }
}
