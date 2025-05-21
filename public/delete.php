<?php
require_once '../app/config/config.php';

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if ($id !== false && $id > 0) {
        try {
            $stmt = $pdo->prepare("DELETE FROM tb_inventory WHERE id_barang = ?");
            $stmt->execute([$id]);

            // Redirect to index.php after success
            header("Location: /sistem_inventory/public/index.php");
            exit;
        } catch (PDOException $e) {
            error_log("delete.php PDOException: " . $e->getMessage());
            die("Terjadi kesalahan saat menghapus barang: " . $e->getMessage());
        }
    } else {
        die("ID barang tidak valid.");
    }
} else {
    die("ID barang tidak ditemukan.");
}
?>