<?php

namespace App\Services\LegalPerson;

use App\Models\LegalPerson;

class StoreLegalPersonService
{
    private LegalPerson $legalPerson;

    public function __construct(LegalPerson $legalPerson)
    {
        $this->legalPerson = $legalPerson;
    }

    public function run(array $data, int $legalPersonableId, string $legalPersonableType): object
    {
        $data['legal_personable_id'] = $legalPersonableId;
        $data['legal_personable_type'] = $legalPersonableType;
        return $this->legalPerson->create($data);
    }
}
