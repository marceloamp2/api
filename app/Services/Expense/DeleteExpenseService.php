<?php

namespace App\Services\Expense;

class DeleteExpenseService
{
    public function run(object $expense): bool
    {
        return $expense->delete();
    }
}
