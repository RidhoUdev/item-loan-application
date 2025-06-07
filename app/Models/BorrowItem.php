<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BorrowItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrow_request_id',
        'item_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function borrowRequest()
    {
        return $this->belongsTo(BorrowRequest::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }
}
