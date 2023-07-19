<?php

namespace App\Http\Controllers\Customer;

use App\Domain\Check\Interfaces\CheckRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Models\CheckDeposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
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

    public function store(Request $request): CheckDeposit
    {
        $validatedData = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric'],
            'file' => ['required'],
        ]);

        $filename = $request->file('file')->store();

        return $this->checkRepository->createCheck([
            'user_id' => Auth::user()->id,
            'description' => $validatedData['description'],
            'amount' => $validatedData['amount'],
            'picture' => $filename,
        ]);
    }
}
