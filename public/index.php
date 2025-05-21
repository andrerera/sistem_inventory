<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');

// Routing untuk halaman lain
if ($uri === 'tambah_stok.php') {
    require_once 'tambah_stok.php';
} elseif ($uri === 'add.php') {
    require_once 'add.php';
} elseif ($uri === 'update.php') {
    require_once 'update.php';
} elseif ($uri === 'delete.php') {
    require_once 'delete.php';
} elseif ($uri === 'pemakaian.php') {
    require_once 'pemakaian.php';
} else {
    // Halaman utama: Tampilkan tabel data inventory
    require_once '../app/config/config.php'; // Include koneksi database
    require_once '../views/partials/header.php'; // Include header

    // Ambil data dari database
    try {
        $stmt = $pdo->query("SELECT id_barang, kode_barang, nama_barang, jumlah_barang, status_barang FROM tb_inventory");
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching data: " . $e->getMessage());
        $items = [];
        echo "<p>Terjadi kesalahan saat mengambil data: " . $e->getMessage() . "</p>";
    }
    ?>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Sistem Inventory</h1>

        <!-- Tombol Navigasi -->
        <div class="mb-4">
            <a href="/add.php" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Tambah Barang</a>
            <a href="/tambah_stok.php" class="bg-yellow-500 text-white px-4 py-2 rounded mr-2">Tambah Stok</a>
            <a href="/pemakaian.php" class="bg-green-500 text-white px-4 py-2 rounded">Pemakaian</a>
        </div>

        <!-- Tabel Data -->
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Kode Barang</th>
                    <th class="border px-4 py-2">Nama Barang</th>
                    <th class="border px-4 py-2">Jumlah Barang</th>
                    <th class="border px-4 py-2">Status Barang</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($items)): ?>
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center">Tidak ada data barang.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($item['kode_barang']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($item['nama_barang']); ?></td>
                            <td class="border px-4 py-2"><?php echo htmlspecialchars($item['jumlah_barang']); ?></td>
                            <td class="border px-4 py-2"><?php echo $item['status_barang'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
                            <td class="border px-4 py-2">
                                <a href="/update.php?id=<?php echo $item['id_barang']; ?>" class="text-blue-500 mr-2">Edit</a>
                                <a href="/delete.php?id=<?php echo $item['id_barang']; ?>" class="text-red-500" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php
    require_once '../views/partials/footer.php'; // Include footer
}
?>