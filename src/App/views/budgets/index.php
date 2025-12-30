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
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Title</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Total
                            amount</th>
                        <th
                            class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">
                            Start date</th>
                        <th
                            class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">
                            End Date</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php foreach ($budgets as $budget): ?>
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="px-6 py-5 font-semibold text-slate-700">
                                <?= e($budget['title']) ?>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="text-slate-900 font-bold">$<?= number_format($budget['total_amount'], 2) ?></span>
                            </td>

                            <td class="px-6 py-5 text-center text-slate-500 text-sm">
                                <?= $budget['start_date'] ? date('M d, Y', strtotime($budget['start_date'])) : 'N/A' ?>
                            </td>

                            <td class="px-6 py-5 text-center text-slate-500 text-sm">
                                <?= $budget['end_date'] ? date('M d, Y', strtotime($budget['end_date'])) : 'N/A' ?>
                            </td>

                            <td class="px-6 py-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="/budget/<?= $budget['id'] ?>"
                                        class="p-2 text-slate-400 hover:text-indigo-600 transition">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/budget/<?= $budget['id'] ?>" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        <input type="hidden" name="_METHOD" value="DELETE" />
                                        <button class="p-2 text-slate-400 hover:text-red-600 transition">
                                            <i class="fas fa-trash"></i>
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