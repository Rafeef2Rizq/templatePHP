<div class="p-6 bg-slate-50/50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
    <div class="w-full sm:w-auto">
        <?php if ($currentPage > 1): ?>
            <a href="?<?php echo e($previousPage); ?>"
                class="px-4 py-2 text-xs font-bold text-slate-500 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-sm flex items-center gap-2">
                <i class="fas fa-chevron-left text-[10px]"></i> Previous
            </a>
        <?php endif; ?>
    </div>

    <div class="flex gap-1">
        <?php foreach ($pageLinks as $pageNum => $query): ?>
            <a href="?<?php echo e($query) ?>" class="w-9 h-9 flex items-center justify-center rounded-xl text-xs font-bold transition-all
                       <?php echo $pageNum + 1 === $currentPage
                           ? 'bg-indigo-600 text-white shadow-md shadow-indigo-100'
                           : 'text-slate-500 hover:bg-slate-100' ?>">
                <?php echo $pageNum + 1 ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="w-full sm:w-auto flex justify-end">
        <?php if ($currentPage < $lastPage): ?>
            <a href="?<?php echo e($nextPage) ?>"
                class="px-4 py-2 text-xs font-bold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition shadow-md shadow-indigo-100 flex items-center gap-2">
                Next <i class="fas fa-chevron-right text-[10px]"></i>
            </a>
        <?php endif; ?>
    </div>
</div>