<?php include $this->resolve('partials/_header.php') ?>

<main class="container mx-auto mt-12 mb-20 px-6 max-w-4xl">
    <section class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

        <div class="bg-slate-50/50 border-b border-slate-100 p-8">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">About TrackMyMoney</h1>
            <p class="text-slate-500 mt-2">Personal Finance & Budget Tracker</p>
        </div>

        <div class="p-8 space-y-8">
            <article class="prose prose-slate max-w-none">
                <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <i class="fas fa-info-circle text-indigo-600"></i> Our Mission
                </h3>
                <p class="text-slate-600 leading-relaxed">
                    Welcome to <strong>TrackMyMoney</strong>, your companion in the journey towards financial freedom.
                    This platform is designed to help you track transactions, manage budgets, and visualize your
                    spending habits
                    with simplicity and precision.
                </p>
            </article>

            <hr class="border-slate-100" />

            <div class="bg-indigo-50 rounded-2xl p-6 border border-indigo-100">
                <h4 class="text-sm font-bold text-indigo-900 uppercase tracking-widest mb-3">Security Preview</h4>
                <div class="flex items-center gap-3">
                    <span
                        class="px-3 py-1 bg-white border border-indigo-200 rounded-lg text-xs font-bold text-indigo-600 shadow-sm">
                        Escaping Data:
                    </span>
                    <code class="text-slate-600 font-mono text-sm bg-indigo-100/50 px-2 py-1 rounded">
                        <?php echo e("<script>alert('Secure!')</script>"); ?>
                    </code>
                </div>
                <p class="text-xs text-indigo-400 mt-3 italic">
                    * All user inputs are sanitized to ensure the highest security standards.
                </p>
            </div>
        </div>

        <div class="bg-slate-50 p-6 text-center">
            <a href="/"
                class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition flex items-center justify-center gap-2">
                <i class="fas fa-arrow-left text-[10px]"></i> Back to Dashboard
            </a>
        </div>
    </section>
</main>

<?php include $this->resolve('partials/_footer.php') ?>