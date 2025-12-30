<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\BudgetsService;
use App\Services\ValidatorServices;
use Framework\TemplateEngine;

class BudgetController extends Controller
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorServices $validatorServices,
        private BudgetsService $budgetsService
    ) {
    }

    public function budgetView()
    {

        $page = (int) ($_GET['p'] ?? 1);
        $length = 3;
        $searchTerm = $_GET['s'] ?? null;

        [$budgets, $count] = $this->budgetsService->getUserBudgets($length, ($page - 1) * $length);

        $pagination = $this->getPaginationData($count, $length, $page, $searchTerm);

        echo $this->view->render("budgets/index.php", array_merge([
            'budgets' => $budgets
        ], $pagination));
    }
    public function createView()
    {
        echo $this->view->render("budgets/create.php");
    }
    public function create()
    {
        $this->validatorServices->validateBudget($_POST);
        $this->budgetsService->create($_POST);
        redirectTo('/budget');
    }


    public function editView(array $params)
    {
        $budget = $this->budgetsService->getUserBudget($params['budget']);
        if (!$budget) {
            redirectTo('/budgets');
        }
        echo $this->view->render('budgets/edit.php', ['budget' => $budget]);

    }
    public function edit(array $params)
    {
        $budget = $this->budgetsService->getUserBudget($params['budget']);
        if (!$budget) {
            redirectTo('/budget');

        }
        $this->validatorServices->validateBudget($_POST);
        $this->budgetsService->update($_POST, $budget['id']);
        redirectTo('/budget');

    }


    public function delete(array $params)
    {
        $this->budgetsService->delete((int) $params['budget']);
        redirectTo('/budget');
    }

}
