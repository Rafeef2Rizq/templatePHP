<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo e($title); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="public/assets/input.css" rel="stylesheet"> -->
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
    </style>
</head>

<body class="bg-slate-50 font-['Outfit'] text-slate-900">
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <nav class="mx-auto container flex items-center justify-between py-4 px-6" aria-label="Global">
            <a href="/" class="flex items-center gap-2 group">
                <div
                    class="bg-indigo-600 p-2 rounded-xl group-hover:rotate-12 transition-transform shadow-lg shadow-indigo-100">
                    <i class="fas fa-chart-line text-white"></i>
                </div>
                <span class="text-xl font-bold tracking-tight">TrackMy<span class="text-indigo-600">Money</span></span>
            </a>

            <div class="hidden md:flex items-center gap-x-8">
                <?php

                $current_page = $_SERVER['REQUEST_URI'];
                ?>
                <a href="/"
                    class="text-sm font-semibold transition <?= $current_page == '/' ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' ?>">Dashboard</a>

                <a href="/budget"
                    class="text-sm font-semibold transition <?= str_contains($current_page, 'budget') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'text-slate-500 hover:text-indigo-600' ?>">Budgets</a>

                <a href="/transactions"
                    class="text-sm font-semibold transition <?= str_contains($current_page, 'transaction') ? 'text-indigo-600 border-b-2 border-indigo-600 pb-1' : 'text-slate-500 hover:text-indigo-600' ?>">Transactions</a>

                <a href="/about"
                    class="text-sm font-semibold transition <?= $current_page == '/about' ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' ?>">About</a>
            </div>
            <div class="flex items-center gap-4">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="flex items-center gap-3 bg-slate-100 p-1.5 pr-4 rounded-full">
                        <div
                            class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                            <?php echo strtoupper(substr($_SESSION['user']['email'] ?? 'U', 0, 1)); ?>
                        </div>
                        <a href="/logout"
                            class="text-xs font-semibold text-slate-600 hover:text-red-600 transition">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="/login" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition">Login</a>
                    <a href="/register"
                        class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-indigo-700 transition shadow-md shadow-indigo-100">Get
                        Started</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>