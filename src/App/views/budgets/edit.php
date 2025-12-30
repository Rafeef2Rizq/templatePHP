<?php include $this->resolve("partials/_header.php"); ?>

<main class="container mx-auto mt-12 mb-20 px-6 max-w-2xl">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Budget Edit</h1>
        <p class="text-slate-500 mt-2">Update your budget title, amount and duration.</p>
    </div>

    <section class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8">
        <form method="POST" class="space-y-6">
            <?php include $this->resolve("partials/_csrf.php"); ?>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Title</label>
                <input value="<?php echo e($budget['title']); ?>" name="title" type="text"
                    placeholder="e.g. Monthly Rent"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" />
                <?php if (array_key_exists('title', $errors)): ?>
                    <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle text-[10px]"></i> <?php echo e($errors['title'][0]); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Total Amount</label>
                <div class="relative">
                    <input value="<?php echo e($budget['total_amount']); ?>" name="total_amount" type="number"
                        step="0.01" placeholder="0.00"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" />
                </div>
                <?php if (array_key_exists('total_amount', $errors)): ?>
                    <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle text-[10px]"></i> <?php echo e($errors['total_amount'][0]); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Start Date</label>
                    <input value="<?php echo e($budget['formatted_date_start']); ?>" name="start_date" type="date"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none text-slate-600" />
                    <?php if (array_key_exists('start_date', $errors)): ?>
                        <p class="text-red-500 text-xs mt-2 font-medium"><?php echo e($errors['start_date'][0]); ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">End Date</label>
                    <input value="<?php echo e($budget['formatted_date_end']); ?>" name="end_date" type="date"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none text-slate-600" />
                    <?php if (array_key_exists('end_date', $errors)): ?>
                        <p class="text-red-500 text-xs mt-2 font-medium"><?php echo e($errors['end_date'][0]); ?></p>
                    <?php endif; ?>
                </div>
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