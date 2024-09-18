<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    public function billsToPays(): HasMany
    {
        return $this->hasMany(BillsToPay::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucfirst(strtolower($value)),
        );
    }
}
