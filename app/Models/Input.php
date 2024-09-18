<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Input extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }

    public function stockMovements(): BelongsToMany
    {
        return $this->belongsToMany(StockMovement::class)
            ->withPivot('quantity', 'unitary_value', 'total_value');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucfirst(strtolower($value)),
        );
    }
}
