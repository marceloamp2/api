<?php

namespace App\Services\NaturalPerson;

use App\Models\NaturalPerson;

class StoreNaturalPersonService
{
    private NaturalPerson $naturalPerson;

    public function __construct(NaturalPerson $naturalPerson)
    {
        $this->naturalPerson = $naturalPerson;
    }

    public function run(array $data, int $naturalPersonableId, string $naturalPersonableType): object
    {
        $data['natural_personable_id'] = $naturalPersonableId;
        $data['natural_personable_type'] = $naturalPersonableType;
        return $this->naturalPerson->create($data);
    }
}
