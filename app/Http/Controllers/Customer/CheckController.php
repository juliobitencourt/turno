<?php

namespace App\Http\Controllers\Customer;

use App\Domain\Check\DTO\CheckData;
use App\Domain\Check\Interfaces\CheckRepositoryInterface;
use App\Enums\CheckDepositStatus;
use App\Http\Controllers\Controller;
use App\Models\CheckDeposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    /**
     * Initializes a new instance of the CheckController class.
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
            $this->checkRepository->getChecksByCustomer(Auth::user()->id, CheckDepositStatus::PENDING)->toArray(),
            $this->checkRepository->getChecksByCustomer(Auth::user()->id, CheckDepositStatus::APPROVED)->toArray(),
            $this->checkRepository->getChecksByCustomer(Auth::user()->id, CheckDepositStatus::DENIED)->toArray(),
        ])
            ->flatten(1)
            ->groupBy('status')
            ->map(function ($items, $key) {
                return collect($items)->map(function ($item) {
                    return [
                        'description' => $item['description'],
                        'amount' => $item['amount'],
                        'date' => $item['created_at'],
                    ];
                })->all();
            });

        return view('customer.checks-list', [
            'pending' => $checks['pending'] ?? [],
            'approved' => $checks['approved'] ?? [],
            'denied' => $checks['denied'] ?? [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.checks-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): CheckDeposit
    {
        $validatedData = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric'],
            'file' => ['required'],
        ]);

        $filename = $request->file('file')->store();

        return $this->checkRepository->createCheck(new CheckData(
            userId: Auth::user()->id,
            description: $validatedData['description'],
            amount: $validatedData['amount'],
            picture: $filename,
        )
        );
    }
}
