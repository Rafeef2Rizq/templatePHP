<?php
require __DIR__ . "/vendor/autoload.php";

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;
use Dotenv\Dotenv;
use App\Config\Paths;

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();
$db = new Database($_ENV['DB_DRIVER'], $_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
$sqlFile = file_get_contents("./database.sql");
$db->query($sqlFile);
