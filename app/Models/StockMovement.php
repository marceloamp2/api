<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'total_value',
        'nf_number',
        'supplier_id',
    ];

    public function inputs(): BelongsToMany
    {
        return $this->belongsToMany(Input::class)
            ->withPivot('quantity', 'unitary_value', 'total_value');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
