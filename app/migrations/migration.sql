CREATE TABLE tb_inventory (
    id_barang SERIAL PRIMARY KEY,
    kode_barang VARCHAR(20) UNIQUE NOT NULL,
    nama_barang VARCHAR(50) NOT NULL,
    jumlah_barang INTEGER NOT NULL,
    satuan_barang VARCHAR(20) NOT NULL,
    harga_beli DOUBLE PRECISION NOT NULL,
    status_barang BOOLEAN NOT NULL
);

-- Insert 15 dummy data
INSERT INTO tb_inventory (kode_barang, nama_barang, jumlah_barang, satuan_barang, harga_beli, status_barang) VALUES
('BRG001', 'Beras Premium', 100, 'kg', 15000.00, TRUE),
('BRG002', 'Minyak Goreng', 50, 'liter', 20000.00, TRUE),
('BRG003', 'Gula Pasir', 75, 'kg', 12000.00, TRUE),
('BRG004', 'Tepung Terigu', 60, 'kg', 10000.00, TRUE),
('BRG005', 'Sabun Cair', 30, 'liter', 25000.00, TRUE),
('BRG006', 'Pasta Gigi', 40, 'pcs', 15000.00, TRUE),
('BRG007', 'Sampo', 25, 'liter', 30000.00, TRUE),
('BRG008', 'Kopi Bubuk', 20, 'kg', 50000.00, TRUE),
('BRG009', 'Teh Celup', 100, 'pcs', 500.00, TRUE),
('BRG010', 'Susu Kaleng', 15, 'pcs', 10000.00, TRUE),
('BRG011', 'Biskuit', 50, 'pcs', 8000.00, TRUE),
('BRG012', 'Deterjen', 30, 'kg', 18000.00, TRUE),
('BRG013', 'Tisu', 60, 'pcs', 5000.00, TRUE),
('BRG014', 'Kabel Listrik', 100, 'meter', 2000.00, TRUE),
('BRG015', 'Lampu LED', 10, 'pcs', 25000.00, TRUE);