<?php include $this->resolve("partials/_header.php"); ?>

<main class="container mx-auto mt-12 mb-20 px-6 max-w-2xl">
    <section class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8">
        <form method="POST" class="space-y-6">
            <?php include $this->resolve("partials/_csrf.php"); ?>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                <input value="<?php echo e($transaction['description']); ?>" name="description" type="text"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" />
                <?php if (array_key_exists('description', $errors)): ?>
                    <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> <?php echo e($errors['description'][0]); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Amount</label>
                <div class="relative">
                    <input value="<?php echo e($transaction['amount']); ?>" name="amount" type="number" step="0.01"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none" />
                </div>
                <?php if (array_key_exists('amount', $errors)): ?>
                    <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> <?php echo e($errors['amount'][0]); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Date</label>
                <input value="<?php echo e($transaction['formatted_date']); ?>" name="date" type="date"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none text-slate-600" />
                <?php if (array_key_exists('date', $errors)): ?>
                    <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> <?php echo e($errors['date'][0]); ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full py-4 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 active:scale-[0.98] flex items-center justify-center gap-2">
                    Submit
                </button>
            </div>
        </form>
    </section>
</main>

<?php include $this->resolve("partials/_footer.php"); ?>