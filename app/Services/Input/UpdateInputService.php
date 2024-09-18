<?php

namespace App\Services\Input;

class UpdateInputService
{
    public function run(array $data, object $input): object
    {
        $input->update($data);
        return $input;
    }
}
