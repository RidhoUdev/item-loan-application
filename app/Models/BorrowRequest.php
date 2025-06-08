<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BorrowRequest extends Model
{
    //
    use HasFactory;
    
    protected $fillable = [
        'borrower_id',
        'operator_id',
        'status',
        'request_date',
        'expected_return_date',
        'return_date'
    ];

    protected $casts = [
        'request_date'         => 'datetime',
        'expected_return_date' => 'datetime',
        'return_date'          => 'datetime',
    ];

    public function borrower() :BelongsTo
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    public function operator() :BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'borrow_items')
                    ->withPivot('quantity');
    }
}
