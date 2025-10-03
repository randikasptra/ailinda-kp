<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class=" p-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-[#1E5631] flex items-center gap-2">
                <i data-lucide="user-cog" class="w-6 h-6"></i> 
                Edit Pengguna
            </h2>
            <a href="<?= site_url('admin/users') ?>" class="text-gray-400 hover:text-gray-600 transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </a>
        </div>

        <form method="POST" action="<?= site_url('admin/users/update/' . $user['id']) ?>">
            <?= csrf_field() ?>
            
            <div class="space-y-5">
                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="text" name="username" value="<?= esc($user['username']) ?>"
                            class="w-full pl-10 border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition"
                            required>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="email" name="email" value="<?= esc($user['email']) ?>"
                            class="w-full pl-10 border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition"
                            required>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                            class="w-full pl-10 border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] transition">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter</p>
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="shield" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <select name="role"
                            class="w-full pl-10 border border-gray-300 px-4 py-2.5 rounded-lg focus:ring-2 focus:ring-[#A4DE02] focus:border-[#A4DE02] appearance-none bg-white">
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="piket" <?= $user['role'] == 'piket' ? 'selected' : '' ?>>Piket</option>
                            <option value="bp" <?= $user['role'] == 'bp' ? 'selected' : '' ?>>BP</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-8 flex justify-end gap-3">
                <a href="<?= site_url('admin/users') ?>"
                    class="flex items-center px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    <i data-lucide="x" class="w-4 h-4 mr-2"></i>
                    Batal
                </a>
                <button type="submit"
                    class="flex items-center px-5 py-2.5 bg-[#1E5631] text-white rounded-lg hover:bg-[#145128] transition shadow-md">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>

<?= $this->endSection() ?>