<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TransactionService;
use App\Services\ValidatorServices;
use Framework\TemplateEngine;

class Controller
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorServices $validatorServices,
        private TransactionService $transactionService
    ) {
    }

    protected function getPaginationData(int $count, int $length, int $currentPage, ?string $searchTerm = null): array
    {
        $lastPage = (int) ceil($count / $length);
        $pages = $lastPage ? range(1, $lastPage) : [];

        $pageLinks = array_map(
            fn($pageNum) => http_build_query(['p' => $pageNum, 's' => $searchTerm]),
            $pages
        );

        return [
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'pageLinks' => $pageLinks,
            'previousPage' => http_build_query(['p' => max(1, $currentPage - 1), 's' => $searchTerm]),
            'nextPage' => http_build_query(['p' => min($lastPage, $currentPage + 1), 's' => $searchTerm]),
            'searchTerm' => $searchTerm
        ];
    }


}
