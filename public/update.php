<?php
require_once '../app/config/config.php';
require_once '../views/partials/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM tb_inventory WHERE id_barang = ?");
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $jumlah_barang = filter_input(INPUT_POST, 'jumlah_barang', FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
    $satuan_barang = $_POST['satuan_barang'];
    $harga_beli = filter_input(INPUT_POST, 'harga_beli', FILTER_VALIDATE_FLOAT, ['options' => ['min_range' => 0]]);

    if ($jumlah_barang === false || $harga_beli === false) {
        $error = "Jumlah barang dan harga beli harus angka yang valid dan tidak negatif.";
    } else {
        // Automatically determine status based on jumlah_barang
        $status_barang = $jumlah_barang > 0 ? true : false;

        try {
            $stmt = $pdo->prepare("UPDATE tb_inventory SET kode_barang = ?, nama_barang = ?, jumlah_barang = ?, satuan_barang = ?, harga_beli = ?, status_barang = ? WHERE id_barang = ?");
            $stmt->bindValue(1, $kode_barang, PDO::PARAM_STR);
            $stmt->bindValue(2, $nama_barang, PDO::PARAM_STR);
            $stmt->bindValue(3, $jumlah_barang, PDO::PARAM_INT);
            $stmt->bindValue(4, $satuan_barang, PDO::PARAM_STR);
            $stmt->bindValue(5, $harga_beli, PDO::PARAM_STR); // Using STR due to decimal handling
            $stmt->bindValue(6, $status_barang, PDO::PARAM_BOOL);
            $stmt->bindValue(7, $id, PDO::PARAM_INT);
            $stmt->execute();
            header("Location: /sistem_inventory/public/index.php");
            exit;
        } catch (PDOException $e) {
            $error = "Terjadi kesalahan saat memperbarui barang: " . $e->getMessage();
            error_log("update.php PDOException: " . $e->getMessage());
        }
    }
}

if (!$item) {
    die("Barang tidak ditemukan.");
}
?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Barang</h1>
    <?php if (isset($error)): ?>
        <div class="bg-red-100 text-red-700 p-2 mb-4"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php include '../views/components/form_edit.php'; ?>
</div>

<?php require_once '../views/partials/footer.php'; ?>