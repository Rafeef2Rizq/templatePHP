<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\UserServices;
use App\Services\ValidatorServices;
use Framework\TemplateEngine;

ini_set('display_errors', 1);
error_reporting(E_ALL);
class AuthController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorServices $validatorServices,
        private UserServices $userServicea
    ) {}
    public function registerView()
    {
        echo $this->view->render('register.php');
    }
    public function register()
    {
        $this->validatorServices->validateRegister($_POST);
        $this->userServicea->isEmailTaken($_POST['email']);
        $this->userServicea->create($_POST);
        return redirectTo('/');
    }
    public function loginView()
    {
        echo $this->view->render('login.php');
    }
    public function login()
    {
        $this->validatorServices->validateLogin($_POST);
        $this->userServicea->login($_POST);
        return redirectTo('/');
    }
    public function logout()
    {
        $this->userServicea->logout();
        redirectTo('/login');
    }
}
