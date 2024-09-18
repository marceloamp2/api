<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LegalPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnpj',
        'company',
        'trade',
        'contact',
        'legal_personable_id',
        'legal_personable_type',
    ];

    public function legalPersonable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function company(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucwords(strtolower($value)),
        );
    }

    protected function trade(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucwords(strtolower($value)),
        );
    }

    protected function contact(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucwords(strtolower($value)),
        );
    }
}
