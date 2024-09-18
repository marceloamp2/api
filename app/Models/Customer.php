<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_type',
        'phone',
        'cellphone',
        'email',
    ];

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function legalPerson(): MorphOne
    {
        return $this->morphOne(LegalPerson::class, 'legal_personable');
    }

    public function naturalPerson(): MorphOne
    {
        return $this->morphOne(NaturalPerson::class, 'natural_personable');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => strtolower($value),
        );
    }
}
