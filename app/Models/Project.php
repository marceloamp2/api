<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'order_id',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)
            ->withPivot('quantity', 'unitary_value', 'total_value')
            ->withTimestamps();
    }

    protected function brand(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucwords(strtolower($value)),
        );
    }
}
