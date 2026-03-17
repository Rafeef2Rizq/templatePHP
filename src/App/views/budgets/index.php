<?php include $this->resolve("partials/_header.php"); ?>

<main class="container mx-auto mt-8 mb-10 px-6 max-w-7xl space-y-8">

    <header class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Budget Management</h1>
            <p class="text-slate-500 mt-1">Set limits and control your category spending</p>
        </div>

        <a href="/budget/create"
            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center gap-2 active:scale-95">
            <i class="fas fa-plus text-xs"></i> Create New Budget
        </a>
    </header>

    <?php include $this->resolve("partials/_search.php"); ?>

    <div class="bg-white rounded-3xl card-shadow border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Category
                        </th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Limit
                            Amount</th>
                        <th
                            class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">
                            Duration</th>
                        <th
                            class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">
                            Status</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php foreach ($budgets as $budget): ?>
                        <?php
                        $now = time();
                        $start = strtotime($budget['start_date']);
                        $end = strtotime($budget['end_date']);
                        $isActive = $now >= $start && $now <= $end;
                        $isUpcoming = $now < $start;
                        $isExpired = $now > $end;
                        ?>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-folder text-indigo-400 text-sm"></i>
                                    <span class="font-bold text-slate-700">
                                        <?= e($budget['category_name']) ?>
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-dollar-sign text-green-500 text-xs"></i>
                                    <span class="text-slate-900 font-black text-lg">
                                        <?= number_format($budget['limit_amount'], 2) ?>
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center justify-center gap-2 text-xs text-slate-500">
                                        <i class="fas fa-calendar-day text-[10px]"></i>
                                        <span class="font-semibold">
                                            <?= $budget['start_date'] ? date('M d, Y', strtotime($budget['start_date'])) : 'N/A' ?>
                                        </span>
                                    </div>
                                    <div class="text-slate-300 text-[10px]">to</div>
                                    <div class="flex items-center justify-center gap-2 text-xs text-slate-500">
                                        <i class="fas fa-calendar-check text-[10px]"></i>
                                        <span class="font-semibold">
                                            <?= $budget['end_date'] ? date('M d, Y', strtotime($budget['end_date'])) : 'N/A' ?>
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <?php if ($isActive): ?>
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 text-green-700 rounded-full text-xs font-bold">
                                        <i class="fas fa-circle text-[6px] animate-pulse"></i> Active
                                    </span>
                                <?php elseif ($isUpcoming): ?>
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 rounded-full text-xs font-bold">
                                        <i class="fas fa-clock text-[10px]"></i> Upcoming
                                    </span>
                                <?php else: ?>
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-500 rounded-full text-xs font-bold">
                                        <i class="fas fa-check text-[10px]"></i> Expired
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="/budget/<?= $budget['id'] ?>"
                                        class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all flex items-center justify-center shadow-sm"
                                        title="Edit">
                                        <i class="fas fa-pen text-xs"></i>
                                    </a>
                                    <form action="/budget/<?= $budget['id'] ?>" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this budget?')">
                                        <input type="hidden" name="_METHOD" value="DELETE" />
                                        <?php include $this->resolve("partials/_csrf.php"); ?>
                                        <button type="submit"
                                            class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center shadow-sm"
                                            title="Delete">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php include $this->resolve("partials/_pagination.php"); ?>

    </div>
</main>

<?php include $this->resolve("partials/_footer.php"); ?>