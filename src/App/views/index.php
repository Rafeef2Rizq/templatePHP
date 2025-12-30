<?php include $this->resolve("partials/_header.php"); ?>

<main class="container mx-auto mt-8 mb-10 px-6 max-w-7xl space-y-10">

    <header class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Expense Tracker</h1>
            <p class="text-slate-500 mt-1 font-medium">Track your spending and manage budgets</p>
        </div>
        <div class="flex items-center gap-4 w-full lg:w-auto">
            <div class="relative flex-grow md:w-80">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="text"
                    class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none text-sm transition-all shadow-sm placeholder:text-slate-400"
                    placeholder="Search transactions...">
            </div>
            <a href="/transaction"
                class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-200 flex items-center gap-2 whitespace-nowrap active:scale-95">
                <i class="fas fa-plus text-xs"></i> Add Transaction
            </a>
        </div>
    </header>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
            class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 hover:scale-[1.02] transition-transform duration-300">
            <div class="flex items-center justify-between mb-6">
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.15em]">Total Spent</p>
                <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center text-red-600 shadow-inner">
                    <i class="fas fa-money-bill-wave text-lg"></i>
                </div>
            </div>
            <p class="text-4xl font-black text-slate-900 tracking-tight">$430.00</p>
            <div class="mt-6">
                <div class="flex items-center justify-between text-xs mb-3 font-bold">
                    <span class="text-slate-400">This month</span>
                    <span class="text-red-600 bg-red-50 px-2 py-1 rounded-lg">+12%</span>
                </div>
                <div class="h-3 w-full bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-red-500 rounded-full shadow-[0_0_8px_rgba(239,68,68,0.4)]" style="width: 65%">
                    </div>
                </div>
            </div>
        </div>

        <div
            class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 hover:scale-[1.02] transition-transform duration-300">
            <div class="flex items-center justify-between mb-6">
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.15em]">Monthly Budget</p>
                <div
                    class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-inner">
                    <i class="fas fa-wallet text-lg"></i>
                </div>
            </div>
            <p class="text-4xl font-black text-slate-900 tracking-tight">$800.00</p>
            <div class="mt-6">
                <div class="flex items-center justify-between text-xs mb-3 font-bold">
                    <span class="text-slate-400">Monthly limit</span>
                    <span class="text-indigo-600">53.7% used</span>
                </div>
                <div class="h-3 w-full bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-indigo-600 rounded-full shadow-[0_0_8px_rgba(79,70,229,0.4)]"
                        style="width: 53.7%"></div>
                </div>
            </div>
        </div>

        <div
            class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 hover:scale-[1.02] transition-transform duration-300">
            <div class="flex items-center justify-between mb-6">
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.15em]">Remaining</p>
                <div
                    class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 shadow-inner">
                    <i class="fas fa-coins text-lg"></i>
                </div>
            </div>
            <p class="text-4xl font-black text-emerald-600 tracking-tight">$370.00</p>
            <div class="mt-6">
                <div class="flex items-center justify-between text-xs mb-3 font-bold">
                    <span class="text-slate-400">Available</span>
                    <span class="text-emerald-600">46.3% left</span>
                </div>
                <div class="h-3 w-full bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full shadow-[0_0_8px_rgba(16,185,129,0.4)]"
                        style="width: 46.3%"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
            <div class="flex items-center justify-between mb-10">
                <h3 class="text-xl font-black text-slate-900">Spending Overview</h3>
                <div class="flex bg-slate-100 p-1.5 rounded-xl">
                    <button class="px-4 py-2 text-xs font-bold bg-white text-indigo-600 rounded-lg shadow-sm">This
                        Month</button>
                    <button class="px-4 py-2 text-xs font-bold text-slate-500 hover:text-slate-700 transition">Last
                        Month</button>
                </div>
            </div>

            <div class="h-64 flex items-end justify-between gap-4 px-2">
                <?php
                $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                $heights = [180, 140, 220, 160, 120, 190, 150];
                foreach ($days as $index => $day):
                    ?>
                    <div class="flex flex-col items-center flex-1 group">
                        <div class="w-full max-w-[45px] bg-slate-50 group-hover:bg-slate-100 rounded-2xl transition-all relative overflow-hidden"
                            style="height: 240px">
                            <div class="absolute bottom-0 w-full bg-indigo-600 rounded-2xl transition-all duration-700 group-hover:bg-indigo-500 group-hover:shadow-[0_0_15px_rgba(79,70,229,0.3)]"
                                style="height: <?= $heights[$index] ?>px"></div>
                        </div>
                        <span
                            class="text-[10px] font-black text-slate-400 mt-4 uppercase tracking-[0.2em]"><?= $day ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
            <div class="flex items-center justify-between mb-10">
                <h3 class="text-xl font-black text-slate-900">Budgets</h3>
                <a href="/budget" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">View
                    All</a>
            </div>
            <div class="space-y-8">
                <div class="group">
                    <div class="flex justify-between mb-3">
                        <span class="text-sm font-bold text-slate-700">Food</span>
                        <span class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-md">$320 /
                            $500</span>
                    </div>
                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-orange-500 rounded-full" style="width: 64%"></div>
                    </div>
                    <div class="flex justify-between mt-3 text-[10px] font-bold">
                        <span class="text-slate-400 uppercase tracking-wider">64% spent</span>
                        <span class="text-emerald-600">$180 left</span>
                    </div>
                </div>

                <div class="group">
                    <div class="flex justify-between mb-3">
                        <span class="text-sm font-bold text-slate-700">Transport</span>
                        <span class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-md">$80 /
                            $200</span>
                    </div>
                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-50 rounded-full" style="width: 40%"></div>
                    </div>
                </div>

                <a href="/budget/create"
                    class="w-full py-5 border-2 border-dashed border-slate-200 rounded-[1.5rem] text-slate-400 text-sm font-black hover:border-indigo-400 hover:text-indigo-600 hover:bg-indigo-50/30 transition-all mt-6 group flex items-center justify-center">
                    <i class="fas fa-plus mr-2 text-xs group-hover:scale-125 transition-transform"></i>
                    New Budget
                </a>
            </div>
        </div>
    </section>

    <section class="max-w-4xl">
        <div
            class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="flex items-center justify-between mb-10">
                <h3 class="text-xl font-black text-slate-900">Recent Transactions</h3>
                <a href="/transactions" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">View
                    History</a>
            </div>
            <div class="space-y-3">
                <?php

                foreach ($transactions as $transation):
                    ?>
                    <div
                        class="flex items-center justify-between p-5 hover:bg-slate-50 rounded-[1.5rem] transition-all group border border-transparent hover:border-slate-100 cursor-pointer">
                        <div class="flex items-center gap-5">
                            <div>
                                <p class="text-sm font-black text-slate-800"><?= $transation['description'] ?></p>
                                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-0.5">
                                    • <?php echo $transation['date'] ?>
                                </p>
                            </div>
                        </div>
                        <span class="font-black text-red-600 text-sm tracking-tight"><?= $transation['amount'] ?></span>
                    </div>
                <?php endforeach; ?>

                <a href="/transactions"
                    class="w-full py-5 bg-slate-900 text-white text-sm font-black rounded-2xl hover:bg-indigo-600 transition-all mt-6 shadow-lg shadow-slate-200 flex items-center justify-center">
                    See All Transactions
                </a>
            </div>
        </div>
    </section>

</main>

<?php include $this->resolve("partials/_footer.php"); ?>