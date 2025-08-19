<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Ustadz Andre Raditya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .content-area {
            transition: all 0.3s ease;
        }
        .active-menu {
            background-color: #3b82f6;
            color: white;
        }
        .article-image-preview {
            max-height: 150px;
            object-fit: cover;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: absolute;
                z-index: 50;
                height: 100vh;
            }
            .sidebar-open {
                transform: translateX(0);
            }
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0,0,0,0.5);
                z-index: 40;
                display: none;
            }
            .overlay-open {
                display: block;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-blue-800 text-white w-64 flex-shrink-0">
            <div class="p-4 flex items-center justify-between border-b border-blue-700">
                <h1 class="text-xl font-bold">CMS Ustadz Andre</h1>
                <button id="sidebarCloseBtn" class="md:hidden text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <div class="flex items-center space-x-3 mb-6">
                    <img src="https://via.placeholder.com/50" alt="Profile" class="rounded-full w-10 h-10">
                    <div>
                        <p class="font-medium">Admin</p>
                        <p class="text-xs text-blue-200">Super Admin</p>
                    </div>
                </div>

                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="flex items-center space-x-3 p-2 rounded active-menu">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center space-x-3 p-2 rounded hover:bg-blue-700">
                                <i class="fas fa-newspaper"></i>
                                <span>Artikel</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center space-x-3 p-2 rounded hover:bg-blue-700">
                                <i class="fas fa-tags"></i>
                                <span>Kategori</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center space-x-3 p-2 rounded hover:bg-blue-700">
                                <i class="fas fa-user"></i>
                                <span>Profil</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center space-x-3 p-2 rounded hover:bg-blue-700">
                                <i class="fas fa-cog"></i>
                                <span>Pengaturan</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Overlay for mobile -->
        <div id="overlay" class="overlay"></div>

        <!-- Main Content -->
        <div class="content-area flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-4">
                        <button id="sidebarToggleBtn" class="md:hidden text-gray-600">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h2 class="text-lg font-semibold">Dashboard</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-600">
                            <i class="fas fa-bell"></i>
                        </button>
                        <div class="relative">
                            <button id="profileDropdownBtn" class="flex items-center space-x-2">
                                <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-full w-8 h-8">
                                <span class="hidden md:inline">Admin</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-4 bg-gray-50">
                <!-- Dashboard Overview -->
                <div id="dashboardView">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <!-- Stat Cards -->
                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500">Total Artikel</p>
                                    <h3 class="text-2xl font-bold">128</h3>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-full">
                                    <i class="fas fa-newspaper text-blue-600"></i>
                                </div>
                            </div>
                            <p class="text-sm text-green-500 mt-2">+5 baru minggu ini</p>
                        </div>

                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500">Total Kategori</p>
                                    <h3 class="text-2xl font-bold">12</h3>
                                </div>
                                <div class="bg-green-100 p-3 rounded-full">
                                    <i class="fas fa-tags text-green-600"></i>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Terakhir ditambah 2 minggu lalu</p>
                        </div>

                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500">Pengunjung</p>
                                    <h3 class="text-2xl font-bold">5.2K</h3>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-full">
                                    <i class="fas fa-users text-purple-600"></i>
                                </div>
                            </div>
                            <p class="text-sm text-green-500 mt-2">+12% dari minggu lalu</p>
                        </div>

                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-500">Artikel Populer</p>
                                    <h3 class="text-2xl font-bold">"Harta & Rezeki"</h3>
                                </div>
                                <div class="bg-yellow-100 p-3 rounded-full">
                                    <i class="fas fa-fire text-yellow-600"></i>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">1.2K views bulan ini</p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-white rounded-lg shadow p-4">
                            <h3 class="font-semibold mb-3">Tindakan Cepat</h3>
                            <div class="grid grid-cols-2 gap-3">
                                <a href="#" class="p-3 bg-blue-50 rounded-lg flex items-center space-x-2 hover:bg-blue-100 transition" onclick="showArticleForm()">
                                    <i class="fas fa-plus text-blue-600"></i>
                                    <span>Tambah Artikel</span>
                                </a>
                                <a href="#" class="p-3 bg-green-50 rounded-lg flex items-center space-x-2 hover:bg-green-100 transition">
                                    <i class="fas fa-tag text-green-600"></i>
                                    <span>Tambah Kategori</span>
                                </a>
                                <a href="#" class="p-3 bg-purple-50 rounded-lg flex items-center space-x-2 hover:bg-purple-100 transition">
                                    <i class="fas fa-user-edit text-purple-600"></i>
                                    <span>Edit Profil</span>
                                </a>
                                <a href="#" class="p-3 bg-yellow-50 rounded-lg flex items-center space-x-2 hover:bg-yellow-100 transition">
                                    <i class="fas fa-cog text-yellow-600"></i>
                                    <span>Pengaturan</span>
                                </a>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow p-4">
                            <h3 class="font-semibold mb-3">Artikel Terakhir</h3>
                            <div class="space-y-3">
                                <div class="flex items-start space-x-3">
                                    <img src="https://via.placeholder.com/80" alt="Artikel" class="w-16 h-16 rounded object-cover">
                                    <div>
                                        <h4 class="font-medium">Harta dan Rezeki dalam Islam</h4>
                                        <p class="text-sm text-gray-500">Dipublikasikan 2 hari lalu</p>
                                        <div class="flex space-x-2 mt-1">
                                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Fiqih</span>
                                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Terbaru</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <img src="https://via.placeholder.com/80" alt="Artikel" class="w-16 h-16 rounded object-cover">
                                    <div>
                                        <h4 class="font-medium">Panduan Sholat Tahajud</h4>
                                        <p class="text-sm text-gray-500">Dipublikasikan 5 hari lalu</p>
                                        <div class="flex space-x-2 mt-1">
                                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Ibadah</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Articles Table -->
                    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                        <div class="p-4 border-b flex justify-between items-center">
                            <h3 class="font-semibold">Artikel Terbaru</h3>
                            <a href="#" class="text-blue-600 text-sm">Lihat Semua</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Harta dan Rezeki dalam Islam</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Fiqih</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2 hari lalu</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Published</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                            <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Panduan Sholat Tahajud</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Ibadah</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5 hari lalu</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Published</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                            <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Membangun Keluarga Sakinah</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Keluarga</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1 minggu lalu</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Draft</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                            <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Article Form (Hidden by default) -->
                <div id="articleFormView" class="hidden">
                    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                        <div class="p-4 border-b flex justify-between items-center">
                            <h3 class="font-semibold">Tambah Artikel Baru</h3>
                            <button onclick="showDashboard()" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <form id="articleForm">
                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label for="articleTitle" class="block text-sm font-medium text-gray-700 mb-1">Judul Artikel</label>
                                        <input type="text" id="articleTitle" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan judul artikel">
                                    </div>

                                    <div>
                                        <label for="articleContent" class="block text-sm font-medium text-gray-700 mb-1">Isi Artikel</label>
                                        <textarea id="articleContent" rows="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis isi artikel di sini..."></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="articleCategory" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                            <select id="articleCategory" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="">Pilih Kategori</option>
                                                <option value="1">Fiqih</option>
                                                <option value="2">Ibadah</option>
                                                <option value="3">Keluarga</option>
                                                <option value="4">Rezeki</option>
                                            </select>
                                            <button type="button" class="mt-2 text-sm text-blue-600 hover:text-blue-800">+ Tambah Kategori Baru</button>
                                        </div>

                                        <div>
                                            <label for="articleStatus" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                            <select id="articleStatus" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                <option value="draft">Draft</option>
                                                <option value="published">Published</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Utama</label>
                                        <div class="mt-1 flex items-center">
                                            <span class="inline-block h-32 w-32 rounded-md overflow-hidden bg-gray-100">
                                                <img id="articleImagePreview" src="https://via.placeholder.com/300x200?text=Pilih+Gambar" alt="Preview" class="h-full w-full object-cover">
                                            </span>
                                            <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Pilih Gambar
                                            </button>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" id="featuredArticle" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="featuredArticle" class="block text-sm font-medium text-gray-700">Tandai sebagai Artikel Terbaru</label>
                                    </div>

                                    <div class="flex justify-end space-x-3 pt-4 border-t">
                                        <button type="button" onclick="showDashboard()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Batal
                                        </button>
                                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Simpan Artikel
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Initialize TinyMCE
        tinymce.init({
            selector: '#articleContent',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            height: 300,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });

        // Toggle sidebar on mobile
        const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
        const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('overlay');

        sidebarToggleBtn.addEventListener('click', () => {
            sidebar.classList.add('sidebar-open');
            overlay.classList.add('overlay-open');
        });

        sidebarCloseBtn.addEventListener('click', () => {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.remove('overlay-open');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('sidebar-open');
            overlay.classList.remove('overlay-open');
        });

        // Profile dropdown
        const profileDropdownBtn = document.getElementById('profileDropdownBtn');
        const profileDropdown = document.getElementById('profileDropdown');

        profileDropdownBtn.addEventListener('click', () => {
            profileDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!profileDropdownBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });

        // Show article form
        function showArticleForm() {
            document.getElementById('dashboardView').classList.add('hidden');
            document.getElementById('articleFormView').classList.remove('hidden');
        }

        // Show dashboard
        function showDashboard() {
            document.getElementById('dashboardView').classList.remove('hidden');
            document.getElementById('articleFormView').classList.add('hidden');
        }

        // Form submission
        document.getElementById('articleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would normally send the form data to the server
            alert('Artikel berhasil disimpan!');
            showDashboard();
        });

        // Image preview
        document.querySelector('button[type="button"]').addEventListener('click', function() {
            // In a real app, this would open a file dialog
            // For demo purposes, we'll just change the image
            document.getElementById('articleImagePreview').src = 'https://via.placeholder.com/300x200?text=Gambar+Dipilih';
        });
    </script>
</body>
</html>
