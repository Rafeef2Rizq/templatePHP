<?php include $this->resolve("partials/_header.php"); ?>

<main class="min-h-[80vh] flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md">

        <div class="text-center mb-10">
            <div
                class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 text-white rounded-2xl shadow-xl shadow-indigo-100 mb-4 rotate-3 group hover:rotate-0 transition-transform duration-300">
                <i class="fas fa-lock text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Welcome Back</h1>
            <p class="text-slate-500 mt-2 font-medium">Please enter your details to sign in</p>
        </div>

        <section class="bg-white rounded-[2rem] card-shadow border border-slate-100 p-8 sm:p-10">
            <form method="POST" class="space-y-6">
                <?php include $this->resolve("partials/_csrf.php"); ?>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Email Address</label>
                    <div class="relative group">
                        <i
                            class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                        <input value="<?php echo e($oldForm['email'] ?? '') ?>" name="email" type="email"
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700"
                            placeholder="name@company.com" />
                    </div>
                    <?php if (array_key_exists('email', $errors)): ?>
                        <div
                            class="flex items-center gap-2 mt-2 text-red-500 text-xs font-bold bg-red-50 p-3 rounded-xl border border-red-100">
                            <i class="fas fa-circle-exclamation"></i>
                            <?php echo e($errors['email'] ?? $errors['email']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center ml-1">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Password</label>
                        <a href="#" class="text-[11px] font-bold text-indigo-600 hover:underline">Forgot?</a>
                    </div>
                    <div class="relative group">
                        <i
                            class="fas fa-key absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                        <input name="password" type="password"
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700"
                            placeholder="••••••••" />
                    </div>
                    <?php if (array_key_exists('password', $errors)): ?>
                        <div
                            class="flex items-center gap-2 mt-2 text-red-500 text-xs font-bold bg-red-50 p-3 rounded-xl border border-red-100">
                            <i class="fas fa-circle-exclamation"></i>
                            <?php echo e($errors['password'] ?? $errors['password']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center justify-center gap-3 active:scale-[0.97] mt-2">
                    <span>Sign In</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-50 text-center">
                <p class="text-sm text-slate-500 font-medium">
                    Don't have an account?
                    <a href="/register" class="text-indigo-600 font-bold hover:text-indigo-700 transition">Create
                        Account</a>
                </p>
            </div>
        </section>

        <p class="text-center mt-8 text-xs text-slate-400 font-medium tracking-wide">
            &copy; 2025 TrackMyMoney. All rights reserved.
        </p>
    </div>
</main>

<?php include $this->resolve("partials/_footer.php"); ?>