<?php include $this->resolve("partials/_header.php"); ?>

<main class="container mx-auto mt-8 mb-10 px-6 max-w-7xl space-y-8">

    <header class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Transactions</h1>
            <p class="text-slate-500 mt-1">Review and manage your financial activities</p>
        </div>
        <a href="/transaction"
            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center gap-2 active:scale-95">
            <i class="fas fa-plus text-xs"></i> New Transaction
        </a>
    </header>

    <?php include $this->resolve("partials/_search.php"); ?>

    <div class="bg-white rounded-3xl card-shadow border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Description
                        </th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Category
                        </th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Amount</th>
                        <th
                            class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">
                            Type</th>
                        <th
                            class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">
                            Receipts</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Date</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php foreach ($transactions as $transaction): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-5">
                                <span class="font-bold text-slate-700 tracking-tight">
                                    <?php echo e($transaction['description']); ?>
                                </span>
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-tag text-indigo-400 text-xs"></i>
                                    <span class="text-sm font-semibold text-slate-600">
                                        <?php echo e($transaction['category_name'] ?? 'No Category'); ?>
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <span
                                    class="font-black <?= $transaction['transaction_type'] === 'income' ? 'text-green-600' : 'text-red-600' ?> tracking-tight">
                                    <?= $transaction['transaction_type'] === 'income' ? '+' : '-' ?>$
                                    <?php echo e(number_format($transaction['amount'], 2)); ?>
                                </span>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <?php if ($transaction['transaction_type'] === 'income'): ?>
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-bold">
                                        <i class="fas fa-arrow-up text-[8px]"></i> Income
                                    </span>
                                <?php else: ?>
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 bg-red-50 text-red-700 rounded-full text-xs font-bold">
                                        <i class="fas fa-arrow-down text-[8px]"></i> Expense
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <div class="flex items-center justify-center -space-x-2">
                                    <?php foreach ($transaction['receipts'] as $receipt): ?>
                                        <div class="relative group/receipt">
                                            <a href="/transaction/<?php echo e($transaction['id']); ?>/receipt/<?php echo e($receipt['id']); ?>"
                                                class="block w-10 h-10 bg-indigo-50 text-indigo-600 rounded-lg border-2 border-white flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                                <i class="fas fa-file-invoice text-xs"></i>
                                            </a>
                                            <form
                                                action="/transaction/<?php echo e($transaction['id']); ?>/receipt/<?php echo e($receipt['id']); ?>"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this receipt?')"
                                                class="absolute -top-1 -right-1 opacity-0 group-hover/receipt:opacity-100 transition-opacity">
                                                <?php include $this->resolve("partials/_csrf.php") ?>
                                                <input type="hidden" name="_METHOD" value="DELETE" />
                                                <button type="submit"
                                                    class="w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center ring-2 ring-white hover:bg-red-600">
                                                    <i class="fas fa-times text-[8px]"></i>
                                                </button>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php if (empty($transaction['receipts'])): ?>
                                        <span class="text-[10px] font-bold text-slate-300 uppercase italic">No Files</span>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-600">
                                        <?php echo e($transaction['formatted_date']); ?>
                                    </span>
                                    <span class="text-[10px] text-slate-400 font-medium uppercase">Confirmed</span>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-end gap-2">
                                    <a href="/transaction/<?php echo e($transaction['id']); ?>/receipt"
                                        class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white transition-all flex items-center justify-center shadow-sm"
                                        title="Add Receipt">
                                        <i class="fas fa-paperclip text-xs"></i>
                                    </a>
                                    <a href="/transaction/<?php echo e($transaction['id']); ?>"
                                        class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all flex items-center justify-center shadow-sm"
                                        title="Edit">
                                        <i class="fas fa-pen text-xs"></i>
                                    </a>
                                    <form action="/transaction/<?php echo e($transaction['id']) ?>" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this transaction?')">
                                        <input type="hidden" name="_METHOD" value="DELETE" />
                                        <?php include $this->resolve("partials/_csrf.php") ?>
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