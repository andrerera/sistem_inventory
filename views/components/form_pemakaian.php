<form method="POST" class="bg-white p-6 rounded shadow-md">
    <div class="mb-4">
        <label class="block text-gray-700">Pilih Barang</label>
        <select name="id_barang" id="id_barang" class="w-full border p-2 rounded" required>
            <option value="">-- Pilih Barang --</option>
            <?php foreach ($items as $item): ?>
                <option value="<?php echo $item['id_barang']; ?>">
                    <?php echo htmlspecialchars($item['nama_barang']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Stok Barang</label>
        <div id="stock_display" class="w-full border p-2 rounded text-gray-700">-</div>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Jumlah Pemakaian</label>
        <input type="number" name="jumlah_pakai" class="w-full border p-2 rounded" min="1" required>
    </div>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Proses</button>
</form>