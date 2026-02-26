<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include __DIR__ . '/../koneksi.php';



if (isset($_POST['simpan'])) {
    $kode     = $_POST['kode_barang'];
    $nama     = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $harga    = $_POST['harga'];
    $stok     = $_POST['stok'];
    $satuan   = $_POST['satuan'];

    $query = mysqli_query($conn, "
        INSERT INTO barang 
        (kode_barang, nama_barang, kategori, harga, stok, satuan)
        VALUES 
        ('$kode', '$nama', '$kategori', '$harga', '$stok', '$satuan')
    ");

    if (!$query) {
        die(mysqli_error($conn));
    }

    header("Location: dashboard.php?page=list");
    exit;
}
?>

<style>
.card {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    max-width: 600px;
    box-shadow: 0 4px 12px rgba(0,0,0,.1);
}
.form-group { margin-bottom: 15px; }
label { font-weight: bold; display: block; margin-bottom: 5px; }
input, select {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
.btn {
    padding: 10px 15px;
    border-radius: 5px;
    color: white;
    border: none;
    cursor: pointer;
}
.btn-tambah { background: #27ae60; }
.btn-batal { background: #c0392b; text-decoration: none; }
</style>

<div class="card">
    <h3>Tambah Produk</h3>
    <form method="post">
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" required>
        </div>

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Pakaian">Pakaian</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Alat Tulis">Alat Tulis</option>
            </select>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" required>
        </div>

        <div class="form-group">
            <label>Satuan</label>
            <select name="satuan" required>
                <option value="">-- Pilih Satuan --</option>
                <option value="pcs">pcs</option>
                <option value="box">box</option>
                <option value="kg">kg</option>
                <option value="liter">liter</option>
            </select>
        </div>

        <button type="submit" name="simpan" class="btn btn-tambah">Simpan</button>
        <a href="dashboard.php?page=list" class="btn btn-batal">Batal</a>
    </form>
</div>
