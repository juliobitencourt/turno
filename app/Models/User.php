<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
use App\Models\Transaction;
use App\Enums\TransactionType;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
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
        'role_id' => UserRole::class,
        'email_verified_at' => 'datetime',
    ];

    public function subtractMoney($amount): void
    {
        $this->balance = $this->balance - $amount;
        $this->save();
    }

    public function addMoney($amount): void
    {
        $this->balance = $this->balance + $amount;
        $this->save();
    }

    public function checks(): HasMany
    {
        return $this->hasMany(Check::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeIncomes()
    {
        return $this->transactions()
                    ->where('type_id', TransactionType::INCOME);
    }

    public function scopeExpenses()
    {
        return $this->transactions()
                    ->where('type_id', TransactionType::EXPENSE);
    }

    public function incomesSum()
    {
        return $this->incomes()
                    ->sum('amount');
    }

    public function expensesSum()
    {
        return $this->expenses()
                    ->sum('amount');
    }

    public function haveEnoughMoney($amount): bool
    {
        return $this->balance > $amount;
    }

    public function isAdmin()
    {
        return $this->role_id === UserRole::ADMINISTRATOR;
    }

    public function isCustomer()
    {
        return $this->role_id === UserRole::CUSTOMER;
    }
}
