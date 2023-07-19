<?php

namespace App\Models;

use App\Enums\CheckDepositStatus;
use App\Models\User;
use App\Enums\UserRole;
use App\Traits\HasAmount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckDeposit extends Model
{
    use HasFactory, SoftDeletes, HasUuids, HasAmount;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'description',
        'amount',
        'filename',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => UserRole::class,
    ];

    /**
     * Get the user that owns the check.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
