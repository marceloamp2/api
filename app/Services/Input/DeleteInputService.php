<?php

namespace App\Services\Input;

class DeleteInputService
{
    public function run(object $input): bool
    {
        return $input->delete();
    }
}
