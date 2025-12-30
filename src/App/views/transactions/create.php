<?php include $this->resolve("partials/_header.php"); ?>

<main class="container mx-auto mt-12 mb-10 px-6 max-w-3xl">

    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">New Transaction</h1>
        <p class="text-slate-500 mt-2">Add your spending details to keep your budget on track</p>
    </div>

    <section class="bg-white rounded-3xl card-shadow border border-slate-100 overflow-hidden">
        <div class="p-8 sm:p-10">
            <form method="POST" class="space-y-6">
                <?php include $this->resolve("partials/_csrf.php"); ?>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1 uppercase tracking-wider">Description</label>
                    <div class="relative">
                        <i class="fas fa-pen-nib absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input value="<?php echo e($oldForm['description'] ?? ''); ?>" name="description" type="text"
                            placeholder="What did you spend on?"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700" />
                    </div>
                    <?php if (array_key_exists('description', $errors)): ?>
                        <div
                            class="flex items-center gap-2 mt-2 ml-1 text-red-500 text-xs font-bold bg-red-50 p-2 rounded-lg">
                            <i class="fas fa-exclamation-circle"></i>
                            <?php echo e($errors['description'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 ml-1 uppercase tracking-wider">Amount</label>
                        <div class="relative">
                            <i
                                class="fas fa-dollar-sign absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input value="<?php echo e($oldForm['amount'] ?? ''); ?>" name="amount" type="number"
                                step="0.01" placeholder="0.00"
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700 font-bold" />
                        </div>
                        <?php if (array_key_exists('amount', $errors)): ?>
                            <div
                                class="flex items-center gap-2 mt-2 ml-1 text-red-500 text-xs font-bold bg-red-50 p-2 rounded-lg">
                                <i class="fas fa-exclamation-circle"></i>
                                <?php echo e($errors['amount'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 ml-1 uppercase tracking-wider">Date</label>
                        <div class="relative">
                            <i
                                class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                            <input value="<?php echo e($oldForm['date'] ?? ''); ?>" name="date" type="date"
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700" />
                        </div>
                        <?php if (array_key_exists('date', $errors)): ?>
                            <div
                                class="flex items-center gap-2 mt-2 ml-1 text-red-500 text-xs font-bold bg-red-50 p-2 rounded-lg">
                                <i class="fas fa-exclamation-circle"></i>
                                <?php echo e($errors['date'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center justify-center gap-3 active:scale-[0.98]">
                        <i class="fas fa-check-circle text-lg"></i>
                        Confirm Transaction
                    </button>
                    <a href="/transactions"
                        class="block text-center mt-4 text-sm font-bold text-slate-400 hover:text-slate-600 transition">
                        Cancel and Go Back
                    </a>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include $this->resolve("partials/_footer.php"); ?>