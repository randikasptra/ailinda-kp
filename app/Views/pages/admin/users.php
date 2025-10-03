<?= $this->extend('layout/dashboard_admin') ?>
<?= $this->section('content') ?>

<div class="p-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div class="flex items-center">
            <div class="p-3 rounded-xl bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] shadow-lg mr-4">
                <i class="fas fa-users-cog text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Kelola Pengguna</h1>
                <p class="text-gray-600 mt-1">Manajemen data pengguna sistem</p>
            </div>
        </div>
        <button onclick="openModal('tambahModal')"
            class="flex items-center bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white px-6 py-3 rounded-xl hover:shadow-xl transition-all duration-300 shadow-md group">
            <i class="fas fa-user-plus mr-3 group-hover:scale-110 transition-transform"></i>
            Tambah Pengguna
        </button>
    </div>

    <!-- Alert Notification -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="flex items-center bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-xl shadow-sm">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <div>
                <p class="font-medium"><?= session()->getFlashdata('success') ?></p>
            </div>
            <button class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Table Header with Stats -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Pengguna Sistem</h3>
                    <p class="text-sm text-gray-600">Total <?= count($users) ?> pengguna terdaftar</p>
                </div>
                <div class="flex items-center gap-2">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" placeholder="Cari pengguna..." 
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631]">
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle mr-2"></i>
                                Pengguna
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Role
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                Dibuat
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-medium uppercase tracking-wider">
                            <div class="flex items-center">
                                <i class="fas fa-cog mr-2"></i>
                                Aksi
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-gray-50/50 transition-colors duration-200 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] rounded-full flex items-center justify-center text-white font-bold text-lg shadow-md">
                                        <?= strtoupper(substr($user['username'], 0, 1)) ?>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900"><?= esc($user['username']) ?></div>
                                        <div class="text-sm text-gray-500 flex items-center mt-1">
                                            <i class="fas fa-envelope text-xs mr-1"></i>
                                            <?= esc($user['email']) ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php 
                                    $roleColor = [
                                        'admin' => 'bg-purple-100 text-purple-800 border-purple-200',
                                        'piket' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'bp' => 'bg-amber-100 text-amber-800 border-amber-200'
                                    ];
                                    $roleIcon = [
                                        'admin' => 'fa-crown',
                                        'piket' => 'fa-clipboard-list',
                                        'bp' => 'fa-hands-helping'
                                    ];
                                ?>
                                <span class="px-3 py-1.5 inline-flex items-center text-xs leading-5 font-semibold rounded-full border <?= $roleColor[strtolower($user['role'])] ?? 'bg-gray-100 text-gray-800 border-gray-200' ?>">
                                    <i class="fas <?= $roleIcon[strtolower($user['role'])] ?? 'fa-user' ?> mr-1.5"></i>
                                    <?= esc(ucfirst($user['role'])) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-clock mr-2 text-gray-400"></i>
                                    <?= !empty($user['created_at']) ? date('d M Y', strtotime($user['created_at'])) : '-' ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <!-- Tombol Detail -->
                                    <button type="button"
                                        onclick="showDetailModal('<?= esc($user['username']) ?>', '<?= esc($user['email']) ?>', '<?= esc($user['role']) ?>', '<?= date('d M Y', strtotime($user['created_at'])) ?>')"
                                        class="p-2.5 text-gray-600 bg-gray-100 rounded-xl hover:bg-[#1E5631] hover:text-white transition-all duration-300 group/btn"
                                        title="Detail">
                                        <i class="fas fa-eye group-hover/btn:scale-110 transition-transform"></i>
                                    </button>

                                    <!-- Tombol Edit -->
                                    <a href="<?= site_url('admin/users/edit/' . $user['id']) ?>"
                                        class="p-2.5 text-blue-600 bg-blue-100 rounded-xl hover:bg-blue-600 hover:text-white transition-all duration-300 group/btn"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt group-hover/btn:scale-110 transition-transform"></i>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="<?= site_url('admin/users/delete/' . $user['id']) ?>" method="post"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" title="Hapus"
                                            class="p-2.5 text-red-600 bg-red-100 rounded-xl hover:bg-red-600 hover:text-white transition-all duration-300 group/btn">
                                            <i class="fas fa-trash-alt group-hover/btn:scale-110 transition-transform"></i>
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

    <!-- Empty State -->
    <?php if (empty($users)): ?>
    <div class="text-center py-16 bg-white rounded-2xl shadow-lg mt-6">
        <i class="fas fa-users-slash text-4xl text-gray-300 mb-4"></i>
        <h3 class="text-lg font-semibold text-gray-700">Belum ada pengguna</h3>
        <p class="text-gray-500 mt-1">Tambahkan pengguna pertama untuk memulai</p>
        <button onclick="openModal('tambahModal')" class="mt-4 bg-[#1E5631] text-white px-6 py-2.5 rounded-lg hover:bg-[#145128] transition-colors">
            <i class="fas fa-user-plus mr-2"></i>Tambah Pengguna
        </button>
    </div>
    <?php endif; ?>
</div>

<!-- Modal Tambah User -->
<div id="tambahModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-md border border-[#1E5631]/20 animate-scaleIn">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-xl font-bold text-[#1E5631] flex items-center">
                <i class="fas fa-user-plus mr-2"></i>
                Tambah User Baru
            </h2>
            <button onclick="closeModal('tambahModal')"
                class="text-gray-400 hover:text-gray-600 transition duration-200 p-1 rounded-full hover:bg-gray-100">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <form method="POST" action="<?= site_url('admin/users/tambah') ?>" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="username" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                        placeholder="Masukkan username" required>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="email" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                        placeholder="Masukkan email" required>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" name="password" 
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] transition-all"
                        placeholder="Masukkan password" required>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-shield-alt text-gray-400"></i>
                    </div>
                    <select name="role" 
                        class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1E5631]/50 focus:border-[#1E5631] appearance-none bg-white">
                        <option value="admin">Admin</option>
                        <option value="piket">Piket</option>
                        <option value="bp">BP</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
            </div>
            
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeModal('tambahModal')"
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition duration-200 font-medium">
                    Batal
                </button>
                <button type="submit" 
                    class="flex-1 px-4 py-3 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white rounded-xl hover:shadow-lg transition duration-200 font-medium shadow-md">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail User -->
<div id="detailModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 hidden">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-md border border-[#1E5631]/20 animate-scaleIn">
        <div class="flex justify-between items-center mb-5">
            <h2 class="text-xl font-bold text-[#1E5631] flex items-center">
                <i class="fas fa-user-circle mr-2"></i>
                Detail Pengguna
            </h2>
            <button onclick="closeModal('detailModal')"
                class="text-gray-400 hover:text-gray-600 transition duration-200 p-1 rounded-full hover:bg-gray-100">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <div class="space-y-4">
            <div class="flex items-center justify-center mb-4">
                <div class="w-16 h-16 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] rounded-full flex items-center justify-center text-white font-bold text-2xl shadow-lg" id="detailAvatar">
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-xl">
                    <label class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Username</label>
                    <p id="detailUsername" class="text-gray-800 font-semibold text-lg"></p>
                </div>
                <div class="bg-gray-50 p-4 rounded-xl">
                    <label class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Role</label>
                    <p id="detailRole" class="text-gray-800 font-semibold text-lg"></p>
                </div>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-xl">
                <label class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Email</label>
                <p id="detailEmail" class="text-gray-800 font-semibold"></p>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-xl">
                <label class="block text-xs text-gray-500 uppercase tracking-wider mb-1">Tanggal Dibuat</label>
                <p id="detailCreated" class="text-gray-800 font-semibold"></p>
            </div>
        </div>
        <div class="mt-6">
            <button type="button" onclick="closeModal('detailModal')"
                class="w-full px-4 py-3 bg-gradient-to-r from-[#1E5631] to-[#4C9A2B] text-white rounded-xl hover:shadow-lg transition duration-200 font-medium shadow-md">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Script Modal -->
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function showDetailModal(username, email, role, created) {
        document.getElementById('detailUsername').textContent = username;
        document.getElementById('detailEmail').textContent = email;
        document.getElementById('detailRole').textContent = role;
        document.getElementById('detailCreated').textContent = created;
        document.getElementById('detailAvatar').textContent = username.charAt(0).toUpperCase();
        openModal('detailModal');
    }

    // Close modal when clicking outside
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal(modal.id);
            }
        });
    });

    // Initialize icons
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>

<style>
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .animate-scaleIn {
        animation: scaleIn 0.2s ease-out;
    }
    
    .modal {
        backdrop-filter: blur(4px);
    }
    
    .shadow-lg {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>

<?= $this->endSection() ?>