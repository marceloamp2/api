<?php

namespace App\Services\Company;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class IndexCompanyService
{
    private Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function run(): Collection|array
    {
        return $this->company->with([
            'legalPerson',
            'address'
        ])->get();

    }
}
