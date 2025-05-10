<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    //
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description'
    ];

    public function items():HasMany
    {
        return $this->hasMany(Item::class);
    }
}
