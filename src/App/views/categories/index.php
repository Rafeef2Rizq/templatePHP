<?php include $this->resolve("partials/_header.php"); ?>

<main class="container mx-auto mt-8 mb-10 px-6 max-w-7xl space-y-8">

    <header class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Categories</h1>
            <p class="text-slate-500 mt-1">Manage your income and expense categories</p>
        </div>

        <a href="/category/create"
            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center gap-2 active:scale-95">
            <i class="fas fa-plus text-xs"></i> Create New Category
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
                        <th
                            class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">
                            Icon</th>
                        <th
                            class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">
                            Color</th>
                        <th
                            class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center">
                            Status</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php foreach ($categories as $category): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-sm"
                                        style="background: <?= e($category['color'] ?? '#6366f1') ?>">
                                        <i class="<?= e($category['icon'] ?? 'fas fa-tag') ?> text-sm"></i>
                                    </div>
                                    <span class="font-bold text-slate-800">
                                        <?= e($category['name']) ?>
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-50 rounded-lg">
                                    <i class="<?= e($category['icon'] ?? 'fas fa-tag') ?> text-slate-600 text-xs"></i>
                                    <span class="text-xs font-semibold text-slate-500">
                                        <?= e(str_replace(['fas fa-', 'far fa-'], '', $category['icon'] ?? 'tag')) ?>
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-50 rounded-lg">
                                    <div class="w-4 h-4 rounded border-2 border-white shadow-sm"
                                        style="background: <?= e($category['color'] ?? '#6366f1') ?>"></div>
                                    <span class="text-xs font-bold text-slate-600 uppercase">
                                        <?= e($category['color'] ?? '#6366f1') ?>
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                <?php if ($category['is_default'] ?? false): ?>
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 text-amber-700 rounded-full text-xs font-bold">
                                        <i class="fas fa-star text-[8px]"></i> Default
                                    </span>
                                <?php else: ?>
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-600 rounded-full text-xs font-bold">
                                        <i class="fas fa-check text-[8px]"></i> Custom
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="px-6 py-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="/category/<?= $category['id'] ?>"
                                        class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all flex items-center justify-center shadow-sm"
                                        title="Edit">
                                        <i class="fas fa-pen text-xs"></i>
                                    </a>
                                    <?php if (!($category['is_default'] ?? false)): ?>
                                        <form action="/category/<?= $category['id'] ?>" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category? This will affect all related transactions and budgets.')">
                                            <input type="hidden" name="_METHOD" value="DELETE" />
                                            <?php include $this->resolve("partials/_csrf.php"); ?>
                                            <button type="submit"
                                                class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center shadow-sm"
                                                title="Delete">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <button type="button" disabled
                                            class="w-9 h-9 rounded-xl bg-slate-100 text-slate-300 cursor-not-allowed flex items-center justify-center"
                                            title="Default categories cannot be deleted">
                                            <i class="fas fa-lock text-xs"></i>
                                        </button>
                                    <?php endif; ?>
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