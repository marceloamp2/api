<?php

namespace App\Services\Address;

use App\Models\Address;

class StoreAddressService
{
    private Address $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    public function run(array $data, int $addressableId, string $addressableType): object
    {
        $data['addressable_id'] = $addressableId;
        $data['addressable_type'] = $addressableType;
        return $this->address->create($data);
    }
}
