<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Check\Interfaces\CheckRepositoryInterface;
use App\Enums\CheckDepositStatus;
use App\Http\Controllers\Controller;
use App\Models\CheckDeposit;

class CheckControlController extends Controller
{
    /**
     * Initializes a new instance of the CheckControlController class.
     *
     * @param  CheckRepositoryInterface  $checkRepository The check repository to be used.
     */
    public function __construct(
        private CheckRepositoryInterface $checkRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checks = collect([
            $this->checkRepository->getAllChecks(CheckDepositStatus::PENDING)->toArray(),
            $this->checkRepository->getAllChecks(CheckDepositStatus::APPROVED)->toArray(),
            $this->checkRepository->getAllChecks(CheckDepositStatus::DENIED)->toArray(),
        ])
            ->flatten(1)
            ->groupBy('status')
            ->map(function ($items, $key) {
                return collect($items)->map(function ($item) {
                    return [
                        'description' => $item['user']['name'],
                        'amount' => $item['amount'],
                        'date' => $item['created_at'],
                        'link' => route('admin.checks.show', $item['id']),
                    ];
                })->all();
            });

        return view('admin.checks-list', [
            'pending' => $checks['pending'] ?? [],
            'approved' => $checks['approved'] ?? [],
            'denied' => $checks['denied'] ?? [],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CheckDeposit $check)
    {
        return view('admin.check-details', compact('check'));
    }
}
