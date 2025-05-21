<form method="POST" class="bg-white p-6 rounded shadow-md">
    <div class="mb-4">
        <label class="block text-gray-700">Nama Barang</label>
        <input type="text" name="nama_barang" class="w-full border p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Jumlah Barang</label>
        <input type="number" name="jumlah_barang" class="w-full border p-2 rounded" min="1" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Satuan Barang</label>
        <select name="satuan_barang" class="w-full border p-2 rounded" required>
            <option value="kg">kg</option>
            <option value="pcs">pcs</option>
            <option value="liter">liter</option>
            <option value="meter">meter</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Harga Beli</label>
        <input type="number" step="0.01" name="harga_beli" class="w-full border p-2 rounded" min="0" required>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
</form>