<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TransactionService;
use Framework\TemplateEngine;
use App\Config\Paths;

class AboutController
{

    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService
    ) {

    }
    public function about()
    {
        echo $this->view->render('about.php');
    }
}
