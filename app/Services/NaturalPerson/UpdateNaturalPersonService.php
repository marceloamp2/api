<?php

namespace App\Services\NaturalPerson;

class UpdateNaturalPersonService
{
    public function run(array $data, object $naturalPerson): object
    {
        $naturalPerson->update($data);
        return $naturalPerson;
    }
}
