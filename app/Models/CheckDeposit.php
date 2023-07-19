<?php

namespace App\Models;

use App\Enums\CheckDepositStatus;
use App\Traits\HasAmount;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'picture',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => CheckDepositStatus::class,
    ];

    /**
     * Get the user that owns the check.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
