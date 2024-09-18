<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'zipcode',
        'address',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'addressable_id',
        'addressable_type',
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function address(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucwords(strtolower($value)),
        );
    }

    protected function complement(): Attribute
    {
        return Attribute::make(
            set: fn(string|null $value) => ucwords(strtolower($value)),
        );
    }

    protected function neighborhood(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucwords(strtolower($value)),
        );
    }

    protected function city(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucwords(strtolower($value)),
        );
    }

    protected function state(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucwords(strtolower($value)),
        );
    }
}
