<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    //
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'status',
        'quantity',
        'image'
    ];

    protected function casts():array
    {
        return [
            'quantity' => 'integer'
        ];
    }

    protected function availableQuantity(): Attribute
    {
        return Attribute::make(
            get: function () {
                $activeStatuses = ['approved', 'borrowed', 'overdue'];

                $borrowedCount = $this->borrowRequests()
                                     ->whereIn('borrow_requests.status', $activeStatuses)
                                     ->sum('borrow_items.quantity');

                $available = $this->quantity - $borrowedCount;
                return $available > 0 ? $available : 0;
            }
        );
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowRequests(): BelongsToMany
    {
        return $this->belongsToMany(BorrowRequest::class, 'borrow_items')
        ->withPivot('quantity');
    }

    public function borrowItems()
    {
        return $this->hasMany(BorrowItem::class);
    }
}
