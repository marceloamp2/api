<?php

namespace App\Services\Expense;

class UpdateExpenseService
{
    public function run(array $data, object $expense): object
    {
        $expense->update($data);
        return $expense;
    }
}
