<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TransactionService;
use Framework\TemplateEngine;
use App\Config\Paths;

class HomeController extends Controller
{

    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService
    ) {

    }
    public function home()
    {
        $page = (int) ($_GET['p'] ?? 1);
        $length = 3;
        $searchTerm = $_GET['s'] ?? null;
        [$transactions, $count] = $this->transactionService->getUserTransactions($length, ($page - 1) * $length);
        $pagination = $this->getPaginationData($count, $length, $page, $searchTerm);


        echo $this->view->render("index.php", array_merge($pagination, [
            'transactions' => $transactions
        ], $pagination));

    }
}
