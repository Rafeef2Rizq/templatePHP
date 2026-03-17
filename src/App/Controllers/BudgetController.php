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
        $categories = $this->budgetsService->getCategories();

        $pagination = $this->getPaginationData($count, $length, $page, $searchTerm);

        echo $this->view->render("budgets/index.php", array_merge([
            'budgets' => $budgets,
            'categories' => $categories
        ], $pagination));
    }
    public function createView()
    {
        echo $this->view->render("budgets/create.php", [
            'categories' => $this->budgetsService->getCategories()
        ]);
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
        $categories = $this->budgetsService->getCategories();

        if (!$budget) {
            redirectTo('/budget');
            return;
        }
        echo $this->view->render('budgets/edit.php', ['budget' => $budget, 'categories' => $categories]);

    }
    public function edit(array $params)
    {
        $budget = $this->budgetsService->getUserBudget($params['budget']);
        if (!$budget) {
            redirectTo('/budget');
            return;
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