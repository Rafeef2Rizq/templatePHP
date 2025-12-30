<?php include $this->resolve("partials/_header.php"); ?>

<main class="min-h-screen flex items-center justify-center px-6 py-12 bg-slate-50">
    <div class="w-full max-w-2xl">

        <div class="text-center mb-10">
            <div
                class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 text-white rounded-2xl shadow-xl shadow-indigo-100 mb-4 rotate-3 group hover:rotate-0 transition-transform duration-300">
                <i class="fas fa-user-plus text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Create Account</h1>
            <p class="text-slate-500 mt-2 font-medium">Join us today and start tracking your wealth</p>
        </div>

        <section class="bg-white rounded-[2rem] card-shadow border border-slate-100 p-8 sm:p-10">
            <form method="POST" class="space-y-6">
                <?php include $this->resolve("partials/_csrf.php"); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Email
                            Address</label>
                        <div class="relative group">
                            <i
                                class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                            <input value="<?php echo e($oldForm['email'] ?? ''); ?>" name="email" type="email"
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700"
                                placeholder="john@example.com" />
                        </div>
                        <?php if (array_key_exists('email', $errors)): ?>
                            <div
                                class="mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-2 rounded-lg flex items-center gap-2">
                                <i class="fas fa-info-circle"></i> <?php echo e($errors['email'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Age</label>
                        <div class="relative group">
                            <i
                                class="fas fa-birthday-cake absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                            <input name="age" value="<?php echo e($oldForm['age'] ?? ''); ?>" type="number"
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700" />
                        </div>
                        <?php if (array_key_exists('age', $errors)): ?>
                            <div
                                class="mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-2 rounded-lg flex items-center gap-2">
                                <i class="fas fa-info-circle"></i> <?php echo e($errors['age'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Country</label>
                        <div class="relative group">
                            <i
                                class="fas fa-globe absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                            <select name="country"
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white appearance-none transition-all text-slate-700">
                                <option value="USA" <?php echo ($oldForm['country'] ?? '') === 'USA' ? 'selected' : '' ?>>
                                    USA</option>
                                <option value="Canada" <?php echo ($oldForm['country'] ?? '') === 'Canada' ? 'selected' : '' ?>>Canada</option>
                                <option value="Mexico" <?php echo ($oldForm['country'] ?? '') === 'Mexico' ? 'selected' : '' ?>>Mexico</option>
                            </select>
                        </div>
                        <?php if (array_key_exists('country', $errors)): ?>
                            <div
                                class="mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-2 rounded-lg flex items-center gap-2">
                                <i class="fas fa-info-circle"></i> <?php echo e($errors['country'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Social Media
                            Profile</label>
                        <div class="relative group">
                            <i
                                class="fas fa-link absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                            <input name="socialMediaURL" value="<?php echo e($oldForm['socialMediaURL'] ?? ''); ?>"
                                type="text"
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700"
                                placeholder="https://twitter.com/username" />
                        </div>
                        <?php if (array_key_exists('socialMediaURL', $errors)): ?>
                            <div
                                class="mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-2 rounded-lg flex items-center gap-2">
                                <i class="fas fa-info-circle"></i> <?php echo e($errors['socialMediaURL'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Password</label>
                        <div class="relative group">
                            <i
                                class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                            <input name="password" type="password"
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700"
                                placeholder="••••••••" />
                        </div>
                        <?php if (array_key_exists('password', $errors)): ?>
                            <div
                                class="mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-2 rounded-lg flex items-center gap-2">
                                <i class="fas fa-info-circle"></i> <?php echo e($errors['password'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Confirm
                            Password</label>
                        <div class="relative group">
                            <i
                                class="fas fa-shield-alt absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-indigo-500 transition-colors"></i>
                            <input name="confirmPassword" type="password"
                                class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all text-slate-700"
                                placeholder="••••••••" />
                        </div>
                        <?php if (array_key_exists('confirmPassword', $errors)): ?>
                            <div
                                class="mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-2 rounded-lg flex items-center gap-2">
                                <i class="fas fa-info-circle"></i> <?php echo e($errors['confirmPassword'][0]); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="pt-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative flex items-center">
                            <input name="tos" type="checkbox"
                                class="peer h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 bg-slate-50 checked:bg-indigo-600 checked:border-indigo-600 transition-all shadow-sm" />
                            <i
                                class="fas fa-check absolute opacity-0 peer-checked:opacity-100 text-white text-[10px] left-1"></i>
                        </div>
                        <span class="text-sm font-medium text-slate-500 group-hover:text-slate-700 transition-colors">I
                            accept the <a href="#" class="text-indigo-600 underline">Terms of Service</a></span>
                    </label>
                    <?php if (array_key_exists('tos', $errors)): ?>
                        <div class="mt-2 text-red-500 text-[11px] font-bold bg-red-50 p-2 rounded-lg inline-block">
                            <i class="fas fa-info-circle"></i> <?php echo e($errors['tos'][0]); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center justify-center gap-3 active:scale-[0.98]">
                    <span>Create My Account</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-50 text-center">
                <p class="text-sm text-slate-500 font-medium">Already have an account? <a href="/login"
                        class="text-indigo-600 font-bold hover:text-indigo-700 transition">Sign In</a></p>
            </div>
        </section>
    </div>
</main>

<?php include $this->resolve("partials/_footer.php"); ?>