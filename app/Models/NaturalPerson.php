<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class NaturalPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'natural_personable_id',
        'natural_personable_type',
    ];

    public function naturalPersonable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => ucwords(strtolower($value)),
        );
    }
}
