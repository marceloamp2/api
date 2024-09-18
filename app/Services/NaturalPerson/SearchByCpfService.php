<?php

namespace App\Services\NaturalPerson;

use App\Models\NaturalPerson;

class SearchByCpfService
{
    private NaturalPerson $naturalPerson;

    public function __construct(NaturalPerson $naturalPerson)
    {
        $this->naturalPerson = $naturalPerson;
    }

    public function run(string $cpf)
    {

        return $this->naturalPerson->where('cpf', $cpf)->first();
    }
}
