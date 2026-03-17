<?php include $this->resolve("partials/_header.php"); ?>

<main class="container mx-auto mt-8 mb-10 px-6 max-w-7xl space-y-8">

    <header class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Financial Overview</h1>
            <p class="text-slate-500 mt-1 font-medium">Hello! Here's what's happening with your money today.</p>
        </div>
        <div class="flex items-center gap-4 w-full lg:w-auto">
            <a href="/transaction"
                class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-200 flex items-center gap-2 active:scale-95">
                <i class="fas fa-plus text-xs"></i> New Transaction
            </a>
        </div>
    </header>

    <!-- Stats Cards -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-red-500 to-red-600 p-6 rounded-[2rem] shadow-xl shadow-red-100 text-white">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                    <i class="fas fa-arrow-down text-lg"></i>
                </div>
                <p class="text-xs font-black text-red-100 uppercase tracking-widest">Total Expenses</p>
            </div>
            <p class="text-4xl font-black">$
                <?= number_format($amountTotal ?? 0, 2) ?>
            </p>
            <p class="text-xs text-red-100 font-semibold mt-3 opacity-80">All time spending</p>
        </div>

        <div
            class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-[2rem] shadow-xl shadow-green-100 text-white">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                    <i class="fas fa-arrow-up text-lg"></i>
                </div>
                <p class="text-xs font-black text-green-100 uppercase tracking-widest">Total Income</p>
            </div>
            <p class="text-4xl font-black">$
                <?= number_format($totalIncome ?? 0, 2) ?>
            </p>
            <p class="text-xs text-green-100 font-semibold mt-3 opacity-80">All time earnings</p>
        </div>

        <div
            class="bg-gradient-to-br from-indigo-600 to-indigo-700 p-6 rounded-[2rem] shadow-xl shadow-indigo-200 text-white">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur flex items-center justify-center">
                    <i class="fas fa-wallet text-lg"></i>
                </div>
                <p class="text-xs font-black text-indigo-100 uppercase tracking-widest">Balance</p>
            </div>
            <p class="text-4xl font-black">$
                <?= number_format(($totalIncome ?? 0) - ($amountTotal ?? 0), 2) ?>
            </p>
            <p class="text-xs text-indigo-100 font-semibold mt-3 opacity-80">Current balance</p>
        </div>
    </section>

    <!-- Charts & Budgets -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Spending Chart -->
        <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-black text-slate-900">Spending Overview</h3>
                <div class="flex gap-2">
                    <span class="px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-bold">This
                        Month</span>
                </div>
            </div>
            <div class="h-64 flex items-end justify-between gap-3">
                <?php
                $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                $heights = [120, 90, 200, 140, 80, 170, 130];
                foreach ($days as $index => $day): ?>
                    <div class="flex flex-col items-center flex-1 group cursor-pointer">
                        <div
                            class="w-full max-w-[40px] bg-gradient-to-t from-slate-100 to-slate-50 rounded-2xl relative h-48 overflow-hidden border border-slate-100">
                            <div class="absolute bottom-0 w-full bg-gradient-to-t from-indigo-600 to-indigo-400 transition-all duration-500 hover:from-indigo-500 hover:to-indigo-300"
                                style="height: <?= $heights[$index] ?>px"></div>
                        </div>
                        <span class="text-xs font-bold text-slate-400 mt-3 uppercase">
                            <?= $day ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Active Budgets -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-black text-slate-900">Active Budgets</h3>
                <a href="/budget" class="text-xs font-bold text-indigo-600 hover:text-indigo-700">View All</a>
            </div>
            <div class="space-y-6">
                <?php if (!empty($activeBudgets)): ?>
                    <?php foreach (array_slice($activeBudgets, 0, 3) as $budget): ?>
                        <?php
                        $spent = $budget['spent'] ?? 0;
                        $limit = $budget['limit_amount'];
                        $percentage = $limit > 0 ? ($spent / $limit) * 100 : 0;
                        $color = $percentage > 80 ? 'red' : ($percentage > 60 ? 'orange' : 'green');
                        ?>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="font-bold text-slate-700">
                                    <?= e($budget['category_name']) ?>
                                </span>
                                <span class="font-black text-slate-900">$
                                    <?= number_format($spent, 0) ?>/$
                                    <?= number_format($limit, 0) ?>
                                </span>
                            </div>
                            <div class="h-2.5 w-full bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-<?= $color ?>-500 transition-all"
                                    style="width: <?= min($percentage, 100) ?>%"></div>
                            </div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase">
                                <?= number_format($percentage, 0) ?>% used
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-8">
                        <i class="fas fa-inbox text-4xl text-slate-200 mb-3"></i>
                        <p class="text-sm text-slate-400 font-medium">No active budgets</p>
                    </div>
                <?php endif; ?>

                <a href="/budget/create"
                    class="flex items-center justify-center w-full py-4 border-2 border-dashed border-slate-200 rounded-2xl text-slate-400 text-xs font-bold hover:bg-slate-50 hover:border-indigo-300 hover:text-indigo-600 transition-all">
                    <i class="fas fa-plus text-xs mr-2"></i> Add New Budget
                </a>
            </div>
        </div>
    </section>

    <!-- Categories & Recent Transactions -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Top Categories -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-black text-slate-900">Top Categories</h3>
                <a href="/category" class="text-xs font-bold text-indigo-600 hover:text-indigo-700">Manage</a>
            </div>
            <div class="space-y-5">
                <?php if (!empty($topCategories)): ?>
                    <?php foreach ($topCategories as $cat): ?>
                        <div
                            class="flex items-center justify-between group hover:bg-slate-50 -mx-3 px-3 py-2 rounded-xl transition-colors">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 text-white flex items-center justify-center shadow-lg shadow-indigo-100">
                                    <i class="fas fa-tag text-sm"></i>
                                </div>
                                <div>
                                    <span class="text-sm font-bold text-slate-800 block">
                                        <?= e($cat['name']) ?>
                                    </span>
                                    <span class="text-[10px] font-semibold text-slate-400 uppercase">
                                        <?= $cat['count'] ?? 0 ?> transactions
                                    </span>
                                </div>
                            </div>
                            <span class="text-base font-black text-slate-900">
                                $
                                <?= number_format($cat['total'], 2) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-8">
                        <i class="fas fa-tags text-4xl text-slate-200 mb-3"></i>
                        <p class="text-sm text-slate-400 font-medium">No categories yet</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-black text-slate-900">Recent Transactions</h3>
                <a href="/transactions" class="text-xs font-bold text-indigo-600 hover:text-indigo-700">See All</a>
            </div>

            <div class="divide-y divide-slate-50">
                <?php if (!empty($transactions)): ?>
                    <?php foreach ($transactions as $transaction): ?>
                        <div
                            class="flex items-center justify-between py-4 group hover:bg-slate-50 -mx-4 px-4 rounded-xl transition-colors cursor-pointer">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl <?= $transaction['transaction_type'] === 'income' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' ?> flex items-center justify-center shadow-sm">
                                    <i
                                        class="fas fa-<?= $transaction['transaction_type'] === 'income' ? 'arrow-up' : 'arrow-down' ?> text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-800">
                                        <?= e($transaction['description']) ?>
                                    </p>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 bg-indigo-50 text-indigo-600 rounded text-[10px] font-bold uppercase">
                                            <i class="fas fa-tag text-[8px]"></i>
                                            <?= e($transaction['category_name'] ?? 'General') ?>
                                        </span>
                                        <span class="text-[10px] font-semibold text-slate-400">
                                            <?= e($transaction['formatted_date']) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span
                                    class="font-black text-lg <?= $transaction['transaction_type'] === 'income' ? 'text-green-600' : 'text-red-600' ?>">
                                    <?= $transaction['transaction_type'] === 'income' ? '+' : '-' ?>$
                                    <?= number_format($transaction['amount'], 2) ?>
                                </span>
                                <div class="text-[10px] font-bold text-slate-400 uppercase mt-0.5">
                                    <?= ucfirst($transaction['transaction_type']) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-12">
                        <i class="fas fa-receipt text-5xl text-slate-200 mb-4"></i>
                        <p class="text-sm text-slate-400 font-medium mb-4">No transactions yet</p>
                        <a href="/transaction"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition">
                            <i class="fas fa-plus text-xs"></i> Add First Transaction
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<?php include $this->resolve("partials/_footer.php"); ?>