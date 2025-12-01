<?php

declare(strict_types=1);

use App\Config\Paths;
use App\Services\ReceiptService;
use App\Services\TransactionService;
use App\Services\UserServices;
use App\Services\ValidatorServices;
use Framework\Container;
use Framework\Database;
use Framework\TemplateEngine;

return [
    TemplateEngine::class => fn() => new TemplateEngine(Paths::VIEW),
    ValidatorServices::class => fn() => new ValidatorServices(),
    Database::class => fn() => new Database($_ENV['DB_DRIVER'], $_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']),
    UserServices::class => function (Container $container) {
        $db = $container->get(Database::class);

        return new UserServices($db);
    },
    TransactionService::class => function (Container $container) {
        $db = $container->get(Database::class);
        return new TransactionService($db);

    },
    ReceiptService::class => function (Container $container) {
        $db = $container->get(Database::class);
        return new ReceiptService($db);
    }
];
