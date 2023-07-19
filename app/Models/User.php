<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\TransactionType;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'role' => UserRole::class,
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the account associated with the user.
     */
    public function account(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    /**
     * Get the checks of the user.
     */
    public function checks(): HasMany
    {
        return $this->hasMany(CheckDeposit::class);
    }

    /**
     * Get the transactions of the user.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeIncomes()
    {
        return $this->transactions()
            ->where('type', TransactionType::DEPOSIT);
    }

    public function scopeExpenses()
    {
        return $this->transactions()
            ->where('type', TransactionType::WITHDRAWAL);
    }

    public function incomesSum()
    {
        $incomes = $this->incomes()
            ->sum('amount');

        $incomes = abs($incomes);

        return number_format($incomes / 100, 2, '.', '');
    }

    public function expensesSum()
    {
        $expenses = $this->expenses()
            ->sum('amount');

        return number_format($expenses / 100, 2, '.', '');
    }

    /**
     * Check whether the user is an admin
     */
    public function isAdmin()
    {
        return $this->role === UserRole::ADMIN;
    }

    /**
     * Check whether the user is a customer
     */
    public function isCustomer()
    {
        return $this->role === UserRole::CUSTOMER;
    }
}
