<?php
require_once '../app/config/config.php';
require_once '../views/partials/header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = filter_input(INPUT_POST, 'jumlah_barang', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $satuan_barang = $_POST['satuan_barang'];
    $harga_beli = filter_input(INPUT_POST, 'harga_beli', FILTER_VALIDATE_FLOAT, ['options' => ['min_range' => 0]]);

    if ($jumlah_barang === false || $harga_beli === false) {
        $error = "Jumlah barang harus lebih dari 0 dan harga beli harus angka yang valid dan tidak negatif.";
    } else {
        try {
            // Auto-generate kode_barang in format BRGXXX
            $stmt = $pdo->query("SELECT kode_barang FROM tb_inventory WHERE kode_barang LIKE 'BRG%' ORDER BY kode_barang DESC LIMIT 1");
            $last_kode = $stmt->fetchColumn();
            if ($last_kode) {
                $last_number = (int) substr($last_kode, 3);
                $new_number = $last_number + 1;
            } else {
                $new_number = 1;
            }
            $kode_barang = sprintf("BRG%03d", $new_number);

            // Status is always true since jumlah_barang is at least 1
            $status_barang = true;

            $stmt = $pdo->prepare("INSERT INTO tb_inventory (kode_barang, nama_barang, jumlah_barang, satuan_barang, harga_beli, status_barang) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $kode_barang, PDO::PARAM_STR);
            $stmt->bindValue(2, $nama_barang, PDO::PARAM_STR);
            $stmt->bindValue(3, $jumlah_barang, PDO::PARAM_INT);
            $stmt->bindValue(4, $satuan_barang, PDO::PARAM_STR);
            $stmt->bindValue(5, $harga_beli, PDO::PARAM_STR);
            $stmt->bindValue(6, $status_barang, PDO::PARAM_BOOL);
            $stmt->execute();

            // Redirect to index.php after success
            header("Location: /sistem_inventory/public/index.php");
            exit;
        } catch (PDOException $e) {
            $error = "Terjadi kesalahan saat menambah barang: " . $e->getMessage();
            error_log("add.php PDOException: " . $e->getMessage());
        }
    }
}
?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Barang</h1>
    <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 p-2 mb-4"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php include '../views/components/form_add.php'; ?>
</div>

<?php require_once '../views/partials/footer.php'; ?>