<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="ml-64 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-[#1E5631]">Edit User</h2>

        <form method="POST" action="<?= site_url('admin/updateUser/' . $user['id']) ?>">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" value="<?= esc($user['username']) ?>"
                    class="w-full border px-3 py-2 rounded" required>
            </div>

         

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password (Kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" class="w-full border px-3 py-2 rounded">
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="piket" <?= $user['role'] == 'piket' ? 'selected' : '' ?>>Piket</option>
                    <option value="bp" <?= $user['role'] == 'bp' ? 'selected' : '' ?>>BP</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <a href="<?= site_url('admin/users') ?>" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
                <button type="submit" class="px-4 py-2 bg-[#1E5631] text-white rounded">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>