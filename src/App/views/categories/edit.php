<?php include $this->resolve("partials/_header.php"); ?>

<script src="https://unpkg.com/lucide@latest"></script>

<main class="container mx-auto mt-12 mb-10 px-6 max-w-3xl">

    <div class="flex items-center justify-between mb-8">
        <div class="text-left">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Edit Category</h1>
            <p class="text-slate-500 mt-1 font-medium">Customize your financial categories with Lucide icons</p>
        </div>
        <a href="/categories"
            class="text-sm font-bold text-slate-400 hover:text-indigo-600 transition flex items-center gap-2">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to List
        </a>
    </div>

    <section class="bg-white rounded-[2rem] card-shadow border border-slate-100 overflow-hidden">
        <div class="p-8 sm:p-10">
            <form method="POST" class="space-y-6">
                <?php include $this->resolve("partials/_csrf.php"); ?>

                <div class="grid grid-cols-1 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Category
                            Name</label>
                        <div class="relative group">
                            <div
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors">
                                <i data-lucide="tag" class="w-5 h-5"></i>
                            </div>
                            <input value="<?php echo e($oldForm['name'] ?? $category['name'] ?? ''); ?>" name="name"
                                type="text" placeholder="e.g. Health, Shopping, Salary"
                                class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700 font-bold" />
                        </div>
                        <?php if (array_key_exists('name', $errors)): ?>
                            <div
                                class="flex items-center gap-2 mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-3 rounded-xl">
                                <i data-lucide="alert-circle" class="w-4 h-4"></i>
                                <?php echo e($errors['name'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2 relative">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Select
                                Icon</label>

                            <div class="relative" id="icon-dropdown-container">
                                <button type="button" id="icon-dropdown-btn"
                                    class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 flex items-center justify-between transition-all group">

                                    <div class="flex items-center gap-3">
                                        <div id="selected-icon-display" class="text-indigo-600">
                                            <i data-lucide="<?= e($oldForm['icon'] ?? $category['icon'] ?? 'package') ?>"
                                                class="w-5 h-5"></i>
                                        </div>
                                        <span id="selected-icon-name" class="text-slate-700 font-bold capitalize">
                                            <?= e($oldForm['icon'] ?? $category['icon'] ?? 'package') ?>
                                        </span>
                                    </div>
                                    <i data-lucide="chevron-down"
                                        class="w-4 h-4 text-slate-400 group-focus:rotate-180 transition-transform"></i>
                                </button>

                                <input type="hidden" name="icon" id="icon-input"
                                    value="<?= e($oldForm['icon'] ?? $category['icon'] ?? 'package') ?>">

                                <div id="icon-menu"
                                    class="hidden absolute z-50 w-full mt-2 bg-white border border-slate-100 rounded-2xl shadow-2xl max-h-80 overflow-hidden flex flex-col">
                                    <div class="p-3 border-b border-slate-50">
                                        <input type="text" id="icon-search" placeholder="Search icons..."
                                            class="w-full px-4 py-2 bg-slate-50 border-none rounded-xl text-sm focus:ring-1 focus:ring-indigo-400 outline-none">
                                    </div>
                                    <div id="icon-grid"
                                        class="grid grid-cols-4 gap-2 p-4 overflow-y-auto max-h-60 custom-scrollbar">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Color
                                Theme</label>
                            <div class="relative group flex items-center gap-3">
                                <input value="<?php echo e($oldForm['color'] ?? $category['color'] ?? '#6366f1'); ?>"
                                    name="color" type="color"
                                    class="h-12 w-20 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" />
                                <span class="text-sm font-medium text-slate-500 uppercase tracking-widest">Select
                                    Color</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-50 flex flex-col sm:flex-row gap-4">
                    <button type="submit"
                        class="flex-1 py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center justify-center gap-3 active:scale-[0.98]">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                        Save Category
                    </button>
                    <a href="/categories"
                        class="flex-1 py-4 bg-slate-100 text-slate-600 font-bold rounded-2xl hover:bg-slate-200 transition flex items-center justify-center gap-3 active:scale-[0.98]">
                        Discard
                    </a>
                </div>
            </form>
        </div>
    </section>
</main>

<style>
    /* تحسين شكل التمرير داخل قائمة الأيقونات */
    .custom-scrollbar::-webkit-scrollbar {
        width: 5px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }
</style>

<script>
    // قائمة شاملة لأيقونات Lucide المناسبة للتطبيقات المالية والإدارية
    const lucideIconsList = [
        'wallet', 'shopping-cart', 'shopping-bag', 'car', 'home', 'coffee', 'utensils',
        'gift', 'heart', 'zap', 'briefcase', 'credit-card', 'refrigerator', 'tv',
        'smartphone', 'umbrella', 'plane', 'dumbbell', 'book', 'music', 'camera',
        'gamepad', 'bus', 'bike', 'truck', 'fuel', 'key', 'layers', 'package',
        'pie-chart', 'piggy-bank', 'receipt', 'banknote', 'landmark', 'coins',
        'shield', 'settings', 'user', 'users', 'mail', 'phone', 'map-pin', 'calendar'
    ];

    const dropdownBtn = document.getElementById('icon-dropdown-btn');
    const iconMenu = document.getElementById('icon-menu');
    const iconGrid = document.getElementById('icon-grid');
    const iconSearch = document.getElementById('icon-search');
    const iconInput = document.getElementById('icon-input');
    const selectedIconDisplay = document.getElementById('selected-icon-display');
    const selectedIconName = document.getElementById('selected-icon-name');

    // دالة إنشاء شبكة الأيقونات
    function renderIcons(filter = '') {
        iconGrid.innerHTML = '';
        const filtered = lucideIconsList.filter(icon => icon.includes(filter.toLowerCase()));

        if (filtered.length === 0) {
            iconGrid.innerHTML = '<p class="col-span-4 text-center text-xs text-slate-400 py-4">No icons found</p>';
            return;
        }

        filtered.forEach(iconName => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'p-3 hover:bg-indigo-50 rounded-xl flex items-center justify-center transition-all group';
            btn.title = iconName;
            btn.innerHTML = `<i data-lucide="${iconName}" class="w-6 h-6 text-slate-400 group-hover:text-indigo-600 group-hover:scale-110 transition-all"></i>`;

            btn.onclick = (e) => {
                e.preventDefault();
                selectIcon(iconName);
            };
            iconGrid.appendChild(btn);
        });
        lucide.createIcons();
    }

    // دالة اختيار الأيقونة
    function selectIcon(name) {
        iconInput.value = name;
        selectedIconName.innerText = name;
        selectedIconDisplay.innerHTML = `<i data-lucide="${name}" class="w-5 h-5"></i>`;
        iconMenu.classList.add('hidden');
        lucide.createIcons();
    }

    // فتح وإغلاق القائمة
    dropdownBtn.addEventListener('click', (e) => {
        iconMenu.classList.toggle('hidden');
        if (!iconMenu.classList.contains('hidden')) {
            iconSearch.focus();
        }
    });

    // البحث عن الأيقونات
    iconSearch.addEventListener('input', (e) => {
        renderIcons(e.target.value);
    });

    // إغلاق القائمة عند الضغط خارجها
    document.addEventListener('click', (e) => {
        if (!document.getElementById('icon-dropdown-container').contains(e.target)) {
            iconMenu.classList.add('hidden');
        }
    });

    // التشغيل الأولي
    renderIcons();
    lucide.createIcons();
</script>

<?php include $this->resolve("partials/_footer.php"); ?>