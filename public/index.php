<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include __DIR__ . '/../src/App/functions.php';
include __DIR__ . "/../src/App/bootstrap.php";


$app->run();
// dd($app);