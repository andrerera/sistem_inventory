<?php
require_once '../app/config/config.php';
require_once '../views/partials/header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form inputs
    $id_barang = filter_input(INPUT_POST, 'id_barang', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    $jumlah_tambah = filter_input(INPUT_POST, 'jumlah_tambah', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

    if (!$id_barang || !$jumlah_tambah) {
        $error = "Input tidak valid. Pastikan ID barang dan jumlah tambah stok adalah angka positif.";
        error_log("tambah_stok.php: Invalid input - id_barang=" . var_export($id_barang, true) . ", jumlah_tambah=" . var_export($jumlah_tambah, true));
    } else {
        try {
            // Fetch current stock
            $stmt = $pdo->prepare("SELECT jumlah_barang, status_barang FROM tb_inventory WHERE id_barang = ?");
            $stmt->execute([$id_barang]);
            $item = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$item) {
                $error = "Barang tidak ditemukan!";
                error_log("tambah_stok.php: Item not found for id_barang=$id_barang");
            } else {
                $new_jumlah = $item['jumlah_barang'] + $jumlah_tambah;
                $status_barang = ($new_jumlah > 0) ? true : $item['status_barang'];

                // Debug: Log values
                error_log("tambah_stok.php: id_barang=$id_barang, jumlah_tambah=$jumlah_tambah, new_jumlah=$new_jumlah, status_barang=" . var_export($status_barang, true));

                // Update stock and status with explicit binding
                $stmt = $pdo->prepare("UPDATE tb_inventory SET jumlah_barang = ?, status_barang = ? WHERE id_barang = ?");
                $stmt->bindValue(1, $new_jumlah, PDO::PARAM_INT);
                $stmt->bindValue(2, $status_barang, PDO::PARAM_BOOL);
                $stmt->bindValue(3, $id_barang, PDO::PARAM_INT);
                $stmt->execute();

                // Redirect to index.php after success
                header("Location: /sistem_inventory/public/index.php");
                exit;
            }
        } catch (PDOException $e) {
            error_log("tambah_stok.php PDOException: " . $e->getMessage());
            $error = "Terjadi kesalahan saat menambah stok: " . $e->getMessage();
        }
    }
}

// Fetch items with stock for the form
try {
    $stmt = $pdo->query("SELECT id_barang, nama_barang, jumlah_barang FROM tb_inventory");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("tambah_stok.php fetch items PDOException: " . $e->getMessage());
    $error = "Gagal mengambil data barang: " . $e->getMessage();
    $items = [];
}

// Prepare stock data for JavaScript
$stock_data = [];
foreach ($items as $item) {
    $stock_data[$item['id_barang']] = $item['jumlah_barang'];
}
?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Stok Barang</h1>
    <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 p-2 mb-4"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php include '../views/components/form_tambah_stok.php'; ?>
</div>

<script>
    // Pass stock data to JavaScript
    const stockData = <?php echo json_encode($stock_data); ?>;

    // Function to update stock display and calculation
    function updateStockDisplay() {
        const idBarang = document.getElementById('id_barang').value;
        const jumlahTambahInput = document.getElementById('jumlah_tambah').value;
        const stockDisplay = document.getElementById('stock_display');
        const totalStockDisplay = document.getElementById('total_stock');

        // Update existing stock display
        if (idBarang && stockData[idBarang] !== undefined) {
            const currentStock = stockData[idBarang];
            stockDisplay.textContent = '' + currentStock;

            // Calculate total stock after adding
            const jumlahTambah = parseInt(jumlahTambahInput) || 0;
            const totalStock = currentStock + jumlahTambah;
            totalStockDisplay.textContent = '' + totalStock;
        } else {
            stockDisplay.textContent = '-';
            totalStockDisplay.textContent = '-';
        }
    }

    // Run on page load and on change/input
    document.addEventListener('DOMContentLoaded', updateStockDisplay);
    document.getElementById('id_barang').addEventListener('change', updateStockDisplay);
    document.getElementById('jumlah_tambah').addEventListener('input', updateStockDisplay);
</script>

<?php require_once '../views/partials/footer.php'; ?>