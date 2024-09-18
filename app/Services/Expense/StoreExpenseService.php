<?php

namespace App\Services\Expense;

use App\Models\Expense;

class StoreExpenseService
{
    private Expense $expense;

    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    public function run(array $data): object
    {
        return $this->expense->create($data);
    }
}
