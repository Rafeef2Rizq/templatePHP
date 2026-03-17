<?php include $this->resolve("partials/_header.php"); ?>

<main class="container mx-auto mt-12 mb-20 px-6 max-w-2xl">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">New Transaction</h1>
        <p class="text-slate-500 mt-2">Add a new income or expense transaction</p>
    </div>

    <section class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8">
        <form method="POST" class="space-y-6">
            <?php include $this->resolve("partials/_csrf.php"); ?>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                <input value="<?php echo e($oldForm['description'] ?? ''); ?>" name="description" type="text"
                    placeholder="e.g. Grocery shopping"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" />
                <?php if (array_key_exists('description', $errors)): ?>
                    <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($errors['description'][0]); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Amount</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">$</span>
                    <input value="<?php echo e($oldForm['amount'] ?? ''); ?>" name="amount" type="number" step="0.01"
                        placeholder="0.00"
                        class="w-full pl-8 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" />
                </div>
                <?php if (array_key_exists('amount', $errors)): ?>
                    <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($errors['amount'][0]); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Date</label>
                <div class="relative">
                    <i class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input value="<?php echo e($oldForm['date'] ?? ''); ?>" name="date" type="date"
                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none text-slate-600" />
                </div>
                <?php if (array_key_exists('date', $errors)): ?>
                    <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($errors['date'][0]); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1 uppercase tracking-wider">Category</label>
                <div class="relative">
                    <i class="fas fa-tags absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <select name="category_id" required
                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700 font-medium">
                        <option value="">Select a category...</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= e($category['id']) ?>" <?= ($oldForm['category_id'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                                <?= e($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php if (array_key_exists('category_id', $errors)): ?>
                    <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($errors['category_id'][0]); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1 uppercase tracking-wider">Transaction Type</label>
                <div class="flex gap-3">
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="transaction_type" value="expense" <?= ($oldForm['transaction_type'] ?? 'expense') === 'expense' ? 'checked' : '' ?>
                        class="peer sr-only" />
                        <div
                            class="px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl peer-checked:border-red-500 peer-checked:bg-red-50 transition-all text-center">
                            <i class="fas fa-arrow-down text-red-500"></i>
                            <span class="ml-2 font-bold text-slate-700">Expense</span>
                        </div>
                    </label>
                    <label class="flex-1 cursor-pointer">
                        <input type="radio" name="transaction_type" value="income" <?= ($oldForm['transaction_type'] ?? '') === 'income' ? 'checked' : '' ?>
                        class="peer sr-only" />
                        <div
                            class="px-4 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-50 transition-all text-center">
                            <i class="fas fa-arrow-up text-green-500"></i>
                            <span class="ml-2 font-bold text-slate-700">Income</span>
                        </div>
                    </label>
                </div>
                <?php if (array_key_exists('transaction_type', $errors)): ?>
                    <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($errors['transaction_type'][0]); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="pt-4 space-y-3">
                <button type="submit"
                    class="w-full py-4 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 active:scale-[0.98] flex items-center justify-center gap-2">
                    <i class="fas fa-plus-circle"></i> Create Transaction
                </button>

                <a href="/transactions"
                    class="block w-full py-3 text-center text-sm font-bold text-slate-400 hover:text-slate-600 transition">
                    Cancel
                </a>
            </div>
        </form>
    </section>
</main>

<?php include $this->resolve("partials/_footer.php"); ?>