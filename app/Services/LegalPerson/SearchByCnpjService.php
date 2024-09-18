<?php

namespace App\Services\LegalPerson;

use App\Models\LegalPerson;

class SearchByCnpjService
{
    private LegalPerson $legalPerson;

    public function __construct(LegalPerson $legalPerson)
    {
        $this->legalPerson = $legalPerson;
    }

    public function run(string $cnpj)
    {
        return $this->legalPerson->where('cnpj', $cnpj)->first();
    }
}
