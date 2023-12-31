<?php

namespace App\Http\Controllers;

use App\Domain\Account\Interfaces\AccountRepositoryInterface;
use App\Domain\User\Customer\Repositories\CustomerRepository;
use App\Domain\User\DTO\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateAccountController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request The http request.
     * @param  AccountRepositoryInterface  $accountRepository The account repository to be used.
     */
    public function __invoke(
        Request $request,
        AccountRepositoryInterface $accountRepository
    ) {
        $validated = $request->validate([
            'username' => ['required', 'string', 'lowercase', 'alpha_dash:ascii', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        $customer = (new CustomerRepository)->create(
            new UserData(
                username: $validated['username'],
                name: $validated['name'],
                email: $validated['email'],
                password: $validated['password'],
            )
        );

        $accountRepository->create($customer->user->id);

        Auth::login($customer->user);

        return redirect(route('home'));
    }
}
