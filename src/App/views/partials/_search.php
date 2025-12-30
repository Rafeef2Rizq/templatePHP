<div class="bg-white p-5 rounded-2xl card-shadow border border-slate-100">
    <form method="GET" class="flex flex-col md:flex-row gap-4">
        <div class="relative flex-grow">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
            <input value="<?php echo e((string) $searchTerm) ?>" name="s" type="text"
                class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all text-sm"
                placeholder="Search by description..." />
        </div>
        <button type="submit"
            class="px-8 py-2.5 bg-slate-800 text-white font-bold rounded-xl hover:bg-slate-900 transition shadow-sm active:scale-95">
            Search
        </button>
    </form>
</div>