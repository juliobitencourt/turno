<?php

namespace App\Models;

use App\Models\User;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type_id',
        'description',
        'amount',
        'date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type_id' => TransactionType::class,
    ];

    /**
     * The amount number accessor and mutator.
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => number_format($value/100, 2, '.', ''),
            set: fn (mixed $value) => $value * 100,
        );
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
