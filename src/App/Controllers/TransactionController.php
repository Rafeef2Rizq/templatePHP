<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TransactionService;
use App\Services\ValidatorServices;
use Framework\TemplateEngine;

class TransactionController extends Controller
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorServices $validatorServices,
        private TransactionService $transactionService
    ) {
    }

    public function transactions()
    {
        $page = (int) ($_GET['p'] ?? 1);
        $length = 3;
        $searchTerm = $_GET['s'] ?? null;

        [$transactions, $count] = $this->transactionService->getUserTransactions($length, ($page - 1) * $length);

        $pagination = $this->getPaginationData($count, $length, $page, $searchTerm);

        echo $this->view->render("transactions/index.php", array_merge([
            'transactions' => $transactions
        ], $pagination));
    }
    public function createView()
    {
        echo $this->view->render("transactions/create.php");
    }
    public function create()
    {
        $this->validatorServices->validateTransaction($_POST);
        $this->transactionService->create($_POST);
        redirectTo('/transactions');
    }
    public function editView(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction($params['transaction']);
        if (!$transaction) {
            redirectTo('/transactions');
        }
        echo $this->view->render('transactions/edit.php', ['transaction' => $transaction]);

    }
    public function edit(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction($params['transaction']);
        if (!$transaction) {
            redirectTo('/transactions');
        }
        $this->validatorServices->validateTransaction($_POST);
        $this->transactionService->update($_POST, $transaction['id']);
        redirectTo('/transactions');
    }
    public function delete(array $params)
    {
        $this->transactionService->delete((int) $params['transaction']);
        redirectTo('/transactions');
    }
}
