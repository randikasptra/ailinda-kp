<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>


<div class="ml-64 p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-[#1E5631]">Kelola Users</h1>
        <button onclick="document.getElementById('tambahModal').classList.remove('hidden')"
            class="bg-[#1E5631] text-white px-4 py-2 rounded hover:bg-[#145128]">+ Tambah User</button>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#A4DE02] text-white">
                <tr>
                    <th class="px-4 py-2 text-left text-sm">Username</th>
                    <!-- <th class="px-4 py-2 text-left text-sm">Email</th> -->
                    <th class="px-4 py-2 text-left text-sm">Role</th>
                    <th class="px-4 py-2 text-left text-sm">Created</th>
                    <th class="px-4 py-2 text-left text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="px-4 py-2"><?= esc($user['username']) ?></td>
                        <td class="px-4 py-2"><?= esc($user['role']) ?></td>
                        <td class="px-4 py-2"><?= date('d M Y', strtotime($user['created_at'])) ?></td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="#" class="text-blue-600 hover:underline">Edit</a>
                            <a href="#" class="text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah User -->
<div id="tambahModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold mb-4 text-[#1E5631]">Tambah User Baru</h2>
        <form method="POST" action=<?="/admin/tambahUser"?> >
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" class="w-full border px-3 py-2 rounded">
                    <option value="admin">Admin</option>
                    <option value="piket">Piket</option>
                    <option value="bp">BP</option>
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('tambahModal').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-[#1E5631] text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>