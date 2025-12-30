<?php

declare(strict_types=1);

namespace App\Config;

use App\Controllers\{HomeController, AboutController, AuthController, BudgetController, ErrorController, ReceiptController, TransactionController};
use App\Middleware\AuthRequiredMiddleware;
use App\Middleware\GuestOnlyMiddleware;
use Framework\App;


function registerRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home'])->add(AuthRequiredMiddleware::class);
    $app->get('/transactions', [TransactionController::class, 'transactions'])->add(AuthRequiredMiddleware::class);

    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
    $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
    $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
    $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
    $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction', [TransactionController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transaction', [TransactionController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $app->get('/transaction/{transaction}', [TransactionController::class, 'editView'])->add(AuthRequiredMiddleware::class);
    $app->post('/transaction/{transaction}', [TransactionController::class, 'edit'])->add(AuthRequiredMiddleware::class);

    $app->delete('/transaction/{transaction}', [TransactionController::class, 'delete'])->add(AuthRequiredMiddleware::class);

    $app->get('/transaction/{transaction}/receipt', [ReceiptController::class, 'uploadView'])->add(AuthRequiredMiddleware::class);

    $app->post('/transaction/{transaction}/receipt', [ReceiptController::class, 'upload'])->add(AuthRequiredMiddleware::class);

    $app->get('/transaction/{transaction}/receipt/{receipt}', [ReceiptController::class, 'download'])->add(AuthRequiredMiddleware::class);

    $app->delete('/transaction/{transaction}/receipt/{receipt}', [ReceiptController::class, 'delete'])->add(AuthRequiredMiddleware::class);
    $app->setErrorHandler([ErrorController::class, 'notFound']);
    $app->get('/budget', [BudgetController::class, 'budgetView'])->add(AuthRequiredMiddleware::class);
    $app->get('/budget/create', [BudgetController::class, 'createView'])->add(AuthRequiredMiddleware::class);
    $app->post('/budget/create', [BudgetController::class, 'create'])->add(AuthRequiredMiddleware::class);
    $app->delete('/budget/{budget}', [BudgetController::class, 'delete'])->add(AuthRequiredMiddleware::class);
    $app->get('/budget/{budget}', [BudgetController::class, 'editView'])->add(AuthRequiredMiddleware::class);
    $app->post('/budget/{budget}', [BudgetController::class, 'edit'])->add(AuthRequiredMiddleware::class);

}
