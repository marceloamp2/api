<?php

namespace App\Services\Input;

use App\Models\Input;

class StoreInputService
{
    private Input $input;

    public function __construct(Input $input)
    {
        $this->input = $input;
    }

    public function run(array $data): object
    {
        return $this->input->create($data);
    }
}
