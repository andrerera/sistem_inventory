<?php
require_once '../app/config/config.php';
require_once '../views/partials/header.php';

// Use ROW_NUMBER() to generate a sequential ID for display
$stmt = $pdo->query("SELECT ROW_NUMBER() OVER (ORDER BY id_barang) as display_id, id_barang, kode_barang, nama_barang, jumlah_barang, satuan_barang, harga_beli, status_barang FROM tb_inventory ORDER BY id_barang");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Sistem Informasi Inventory Barang</h1>
    <a href="/sistem_inventory/public/add.php" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Barang</a>
    <a href="/sistem_inventory/public/pemakaian.php" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Pemakaian Barang</a>
    <a href="/sistem_inventory/public/tambah_stok.php" class="bg-yellow-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Stok</a>
    
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">Kode Barang</th>
                <th class="border p-2">Nama Barang</th>
                <th class="border p-2">Jumlah</th>
                <th class="border p-2">Satuan</th>
                <th class="border p-2">Harga Beli</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php foreach ($items as $item): ?>
                <tr>
                    <td class="border p-2"><?php echo $item['display_id']; ?></td>
                    <td class="border p-2"><?php echo $item['kode_barang']; ?></td>
                    <td class="border p-2"><?php echo $item['nama_barang']; ?></td>
                    <td class="border p-2"><?php echo $item['jumlah_barang']; ?></td>
                    <td class="border p-2"><?php echo $item['satuan_barang']; ?></td>
                    <td class="border p-2"><?php echo number_format($item['harga_beli'], 2); ?></td>
                    <td class="border p-2"><?php echo $item['status_barang'] ? 'Available' : 'Not Available'; ?></td>
                    <td class="border p-2">
                        <a href="/sistem_inventory/public/update.php?id=<?php echo $item['id_barang']; ?>" class="text-blue-500">Edit</a>
                        <a href="/sistem_inventory/public/delete.php?id=<?php echo $item['id_barang']; ?>" class="text-red-500 ml-2" onclick="return confirmDelete()">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../views/partials/footer.php'; ?>