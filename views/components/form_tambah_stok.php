<form method="POST" class="bg-white p-6 rounded shadow-md">
    <div class="mb-4">
        <label class="block text-gray-700">Pilih</label>
        <select name="id_barang" id="id_barang" class="w-full border p-2 rounded text-gray-700" required>
            <option value="">-- Pilih Barang --</option>
            <?php foreach ($items as $item): ?>
                <option value="<?php echo $item['id_barang']; ?>">
                    <?php echo htmlspecialchars($item['nama_barang']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Stok Saat Ini</label>
        <div id="stock_display" class="w-full border p-2 rounded text-gray-700">-</div>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Jumlah</label>
        <input type="number" name="jumlah_tambah" id="jumlah_tambah" class="w-full border p-2 rounded text-gray-700" min="1" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Perhitungan Stok</label>
        <div id="total_stock" class="w-full border p-2 rounded text-gray-700">Total Stok Setelah Ditambah: -</div>
    </div>
    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Tambah Stok</button>
</form>