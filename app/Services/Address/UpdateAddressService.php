<?php

namespace App\Services\Address;

class UpdateAddressService
{
    public function run(array $data, object $address): object
    {
        $address->update($data);
        return $address;
    }
}
