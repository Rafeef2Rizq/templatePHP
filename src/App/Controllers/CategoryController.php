<?php

declare(strict_types=1);

namespace App\Controllers;


use App\Services\CategoryService;
use App\Services\ValidatorServices;
use Framework\TemplateEngine;

class CategoryController extends Controller
{

    public function __construct(
        private TemplateEngine $view,
        private ValidatorServices $validatorServices,
        private CategoryService $categoryService
    ) {
    }

    public function categoryView()
    {

        $page = (int) ($_GET['p'] ?? 1);
        $length = 3;
        $searchTerm = $_GET['s'] ?? null;

        [$categories, $count] = $this->categoryService->getUserCategories($length, ($page - 1) * $length);

        $pagination = $this->getPaginationData($count, $length, $page, $searchTerm);

        echo $this->view->render("categories/index.php", array_merge([
            'categories' => $categories
        ], $pagination));
    }
    public function createView()
    {
        echo $this->view->render("categories/create.php");
    }
    public function create()
    {

        $this->validatorServices->validateCategory($_POST);
        $this->categoryService->create($_POST);
        redirectTo('/category');
    }


    public function editView(array $params)
    {
        $category = $this->categoryService->getUserCategory($params['category']);
        if (!$category) {
            redirectTo('/category');
        }
        echo $this->view->render('categories/edit.php', ['category' => $category]);

    }
    public function edit(array $params)
    {
        $category = $this->categoryService->getUserCategory($params['category']);
        if (!$category) {
            redirectTo('/category');

        }
        $this->validatorServices->validateCategory($_POST);
        $this->categoryService->update($_POST, $category['id']);
        redirectTo('/category');

    }


    public function delete(array $params)
    {
        $this->categoryService->delete((int) $params['category']);
        redirectTo('/category');
    }

}
