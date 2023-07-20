<?php

namespace App\Http\Controllers\Customer;

use App\Models\CheckDeposit;
use Illuminate\Http\Request;
use App\Domain\Check\DTO\CheckData;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Domain\Check\Interfaces\CheckRepositoryInterface;

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
        $checks = $this->checkRepository->getChecksByCustomer(Auth::user()->id);

        $checks = $checks->map(function ($check) {
            return [
                'description' => $check->description,
                'amount' => $check->amount,
                'date' => $check->created_at,
            ];
        })->toArray();

        return view('customer.checks-list', compact('checks'));
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
