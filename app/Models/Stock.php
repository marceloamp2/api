<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'input_id',
    ];

    public function input(): BelongsTo
    {
        return $this->belongsTo(Input::class);
    }
}
