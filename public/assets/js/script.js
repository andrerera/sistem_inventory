// Confirmations
function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus barang ini?');
}

// Auto-format harga beli
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });
});