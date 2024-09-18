<?php

namespace App\Services\LegalPerson;

class UpdateLegalPersonService
{
    public function run(array $data, object $legalPerson): object
    {
        $legalPerson->update($data);
        return $legalPerson;
    }
}
