<?php include $this->resolve("partials/_header.php"); ?>

<main class="container mx-auto mt-12 mb-10 px-6 max-w-3xl">

    <div class="flex items-center justify-between mb-8">
        <div class="text-left">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Create Budgets</h1>
            <p class="text-slate-500 mt-1 font-medium">Create new budget for your expenses</p>
        </div>
        <a href="/budget"
            class="text-sm font-bold text-slate-400 hover:text-indigo-600 transition flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <section class="bg-white rounded-[2rem] card-shadow border border-slate-100 overflow-hidden">
        <div class="p-8 sm:p-10">
            <form method="POST" class="space-y-6">
                <?php include $this->resolve("partials/_csrf.php"); ?>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Title</label>
                    <div class="relative group">
                        <i
                            class="fas fa-pen-nib absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                        <input value="<?php echo e($oldForm['title'] ?? ''); ?>" name="title" type="text"
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700 font-medium" />
                    </div>
                    <?php if (array_key_exists('title', $errors)): ?>
                        <div
                            class="flex items-center gap-2 mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-3 rounded-xl">
                            <i class="fas fa-circle-exclamation"></i>
                            <?php echo e($errors['title'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1 ">Total Amount
                            ($)</label>
                        <div class="relative group">
                            <i
                                class="fas fa-dollar-sign absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                            <input value="<?php echo e($oldForm['total_amount'] ?? ''); ?>" name="total_amount"
                                type="number" step="0.01"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700 font-bold" />
                        </div>
                        <?php if (array_key_exists('total_amount', $errors)): ?>
                            <div
                                class="flex items-center gap-2 mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-3 rounded-xl">
                                <i class="fas fa-circle-exclamation"></i>
                                <?php echo e($errors['total_amount'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Start
                            Date</label>
                        <div class="relative group">
                            <i
                                class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                            <input value="<?php echo e($oldForm['start_date'] ?? ''); ?>" name="start_date" type="date"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700" />
                        </div>
                        <?php if (array_key_exists('start_date', $errors)): ?>
                            <div
                                class="flex items-center gap-2 mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-3 rounded-xl">
                                <i class="fas fa-circle-exclamation"></i>
                                <?php echo e($errors['start_date'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">End Date</label>
                    <div class="relative group">
                        <i
                            class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                        <input value="<?php echo e($oldForm['end_date'] ?? ''); ?>" name="end_date" type="date"
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700" />
                    </div>
                    <?php if (array_key_exists('end_date', $errors)): ?>
                        <div
                            class="flex items-center gap-2 mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-3 rounded-xl">
                            <i class="fas fa-circle-exclamation"></i>
                            <?php echo e($errors['end_date'][0]); ?>
                        </div>
                    <?php endif; ?>

                    <div class="pt-6 border-t border-slate-50 flex flex-col sm:flex-row gap-4">
                        <button type="submit"
                            class="flex-1 py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center justify-center gap-3 active:scale-[0.98]">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                        <a href="/budget"
                            class="flex-1 py-4 bg-slate-100 text-slate-600 font-bold rounded-2xl hover:bg-slate-200 transition flex items-center justify-center gap-3 active:scale-[0.98]">
                            Discard
                        </a>
                    </div>
            </form>
        </div>
    </section>

    <div class="mt-8 bg-amber-50 rounded-2xl p-4 border border-amber-100 flex gap-4 items-start">
        <i class="fas fa-shield-alt text-amber-500 mt-1"></i>
        <p class="text-xs text-amber-700 leading-relaxed font-medium">
            <strong>Security Tip:</strong> Changes made to transactions will be reflected immediately across all reports
            and budget limits. Please ensure the amounts are accurate before saving.
        </p>
    </div>
</main>

<?php include $this->resolve("partials/_footer.php"); ?>