<?php include $this->resolve("partials/_header.php"); ?>

<main class="container mx-auto mt-12 mb-20 px-6 max-w-2xl">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Budget Edit</h1>
        <p class="text-slate-500 mt-2">Update your budget limit amount and duration.</p>
    </div>

    <section class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8">
        <form method="POST" class="space-y-6">
            <?php include $this->resolve("partials/_csrf.php"); ?>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Limit Amount</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">$</span>
                    <input value="<?php echo e($budget['limit_amount']); ?>" name="limit_amount" type="number"
                        step="0.01" placeholder="0.00"
                        class="w-full pl-8 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" />
                </div>
                <?php if (array_key_exists('limit_amount', $errors)): ?>
                    <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle text-[10px]"></i>
                        <?php echo e($errors['limit_amount'][0]); ?>
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
                            <option value="<?= e($category['id']) ?>" <?= $budget['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                <?= e($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php if (array_key_exists('category_id', $errors)): ?>
                    <div class="flex items-center gap-2 mt-2 ml-1 text-red-500 text-xs font-bold bg-red-50 p-2 rounded-lg">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($errors['category_id'][0]); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Start Date</label>
                <div class="relative group">
                    <i
                        class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                    <input value="<?php echo e($budget['formatted_date_start'] ?? ''); ?>" name="start_date" type="date"
                        class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700" />
                </div>
                <?php if (array_key_exists('start_date', $errors)): ?>
                    <div class="flex items-center gap-2 mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-3 rounded-xl">
                        <i class="fas fa-circle-exclamation"></i>
                        <?php echo e($errors['start_date'][0]); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">End Date</label>
                <div class="relative group">
                    <i
                        class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                    <input value="<?php echo e($budget['formatted_date_end'] ?? ''); ?>" name="end_date" type="date"
                        class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700" />
                </div>
                <?php if (array_key_exists('end_date', $errors)): ?>
                    <div class="flex items-center gap-2 mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-3 rounded-xl">
                        <i class="fas fa-circle-exclamation"></i>
                        <?php echo e($errors['end_date'][0]); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="pt-4 space-y-3">
                <button type="submit"
                    class="w-full py-4 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 active:scale-[0.98] flex items-center justify-center gap-2">
                    <i class="fas fa-check-circle"></i> Save Budget
                </button>

                <a href="/budget"
                    class="block w-full py-3 text-center text-sm font-bold text-slate-400 hover:text-slate-600 transition">
                    Cancel
                </a>
            </div>
        </form>
    </section>
</main>

<?php include $this->resolve("partials/_footer.php"); ?>