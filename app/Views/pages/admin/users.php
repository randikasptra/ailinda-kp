<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class=" p-8">
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <i data-lucide="users" class="w-8 h-8 text-[#1E5631] mr-3"></i>
            <h1 class="text-3xl font-bold text-[#1E5631]">Kelola Pengguna</h1>
        </div>
        <button onclick="document.getElementById('tambahModal').classList.remove('hidden')"
            class="flex items-center bg-[#1E5631] text-white px-5 py-2.5 rounded-lg hover:bg-[#145128] transition-all duration-300 shadow-md hover:shadow-lg">
            <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
            Tambah Pengguna
        </button>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="flex items-center bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#1E5631] text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                        <div class="flex items-center">
                            <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                            Username
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                        <div class="flex items-center">
                            <i data-lucide="shield" class="w-4 h-4 mr-2"></i>
                            Role
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                        <div class="flex items-center">
                            <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                            Dibuat
                        </div>
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                        <div class="flex items-center">
                            <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
                            Aksi
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($users as $user): ?>
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-[#A4DE02] rounded-full flex items-center justify-center text-white font-medium">
                                    <?= strtoupper(substr($user['username'], 0, 1)) ?>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900"><?= esc($user['username']) ?></div>
                                    <div class="text-sm text-gray-500"><?= esc($user['email']) ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php 
                                $roleColor = [
                                    'admin' => 'bg-purple-100 text-purple-800',
                                    'piket' => 'bg-blue-100 text-blue-800',
                                    'bp' => 'bg-amber-100 text-amber-800'
                                ];
                            ?>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?= $roleColor[strtolower($user['role'])] ?? 'bg-gray-100 text-gray-800' ?>">
                                <?= esc($user['role']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex items-center">
                                <i data-lucide="clock" class="w-4 h-4 mr-1 text-gray-400"></i>
                                <?= date('d M Y', strtotime($user['created_at'])) ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-3">
                                <!-- Tombol Detail -->
                                <button type="button"
                                    onclick="showDetailModal('<?= esc($user['username']) ?>', '<?= esc($user['email']) ?>', '<?= esc($user['role']) ?>', '<?= date('d M Y', strtotime($user['created_at'])) ?>')"
                                    class="text-gray-600 hover:text-[#1E5631] transition duration-200 p-2 rounded-full hover:bg-green-50" title="Detail">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>

                                <!-- Tombol Edit -->
                                <a href="<?= site_url('admin/editUser/' . $user['id']) ?>"
                                    class="text-blue-600 hover:text-blue-800 transition duration-200 p-2 rounded-full hover:bg-blue-50" title="Edit">
                                    <i data-lucide="pencil" class="w-5 h-5"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="<?= site_url('admin/deleteUser/' . $user['id']) ?>" method="post"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" title="Hapus"
                                        class="text-red-600 hover:text-red-800 transition duration-200 p-2 rounded-full hover:bg-red-50">
                                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah User -->
<div id="tambahModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-md border border-[#1E5631]/20">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-[#1E5631] flex items-center">
                <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                Tambah User Baru
            </h2>
            <button onclick="document.getElementById('tambahModal').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600 transition duration-200">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form method="POST" action="<?= site_url('admin/tambahUser') ?>">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="text" name="username" class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]" required>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="email" name="email" class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]" required>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="password" name="password" class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]" required>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="shield" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <select name="role" class="w-full pl-10 border border-gray-300 px-3 py-2.5 rounded-lg focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white">
                            <option value="admin">Admin</option>
                            <option value="piket">Piket</option>
                            <option value="bp">BP</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('tambahModal').classList.add('hidden')"
                    class="flex items-center px-4 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                    <i data-lucide="x" class="w-4 h-4 mr-1"></i>
                    Batal
                </button>
                <button type="submit" class="flex items-center px-4 py-2.5 bg-[#1E5631] text-white rounded-lg hover:bg-[#145128] transition duration-200 shadow-md">
                    <i data-lucide="save" class="w-4 h-4 mr-1"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail User -->
<div id="detailModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-md border border-[#1E5631]/20">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-[#1E5631] flex items-center">
                <i data-lucide="user" class="w-5 h-5 mr-2"></i>
                Detail Pengguna
            </h2>
            <button onclick="document.getElementById('detailModal').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600 transition duration-200">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div class="space-y-4">
            <div>
                <label class="block text-xs text-gray-500 uppercase tracking-wider">Username</label>
                <p id="detailUsername" class="text-gray-800 font-medium mt-1 flex items-center">
                    <i data-lucide="user" class="w-4 h-4 mr-2 text-gray-500"></i>
                    <span class="text-lg"></span>
                </p>
            </div>
            <div>
                <label class="block text-xs text-gray-500 uppercase tracking-wider">Email</label>
                <p id="detailEmail" class="text-gray-800 font-medium mt-1 flex items-center">
                    <i data-lucide="mail" class="w-4 h-4 mr-2 text-gray-500"></i>
                    <span class="text-lg"></span>
                </p>
            </div>
            <div>
                <label class="block text-xs text-gray-500 uppercase tracking-wider">Role</label>
                <p id="detailRole" class="text-gray-800 font-medium mt-1 flex items-center">
                    <i data-lucide="shield" class="w-4 h-4 mr-2 text-gray-500"></i>
                    <span class="text-lg"></span>
                </p>
            </div>
            <div>
                <label class="block text-xs text-gray-500 uppercase tracking-wider">Tanggal Dibuat</label>
                <p id="detailCreated" class="text-gray-800 font-medium mt-1 flex items-center">
                    <i data-lucide="calendar" class="w-4 h-4 mr-2 text-gray-500"></i>
                    <span class="text-lg"></span>
                </p>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button type="button" onclick="document.getElementById('detailModal').classList.add('hidden')"
                class="flex items-center px-4 py-2.5 bg-[#1E5631] text-white rounded-lg hover:bg-[#145128] transition duration-200">
                <i data-lucide="check" class="w-4 h-4 mr-1"></i>
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Script Modal Detail -->
<script>
    function showDetailModal(username, email, role, created) {
        document.getElementById('detailUsername').lastChild.textContent = username;
        document.getElementById('detailEmail').lastChild.textContent = email;
        document.getElementById('detailRole').lastChild.textContent = role;
        document.getElementById('detailCreated').lastChild.textContent = created;
        document.getElementById('detailModal').classList.remove('hidden');
    }

    window.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>

<?= $this->endSection() ?>