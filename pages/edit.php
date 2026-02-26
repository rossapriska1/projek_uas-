<?php
include __DIR__ . '/../koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan";
    exit;
}

$id = $_GET['id'];

/* PROSES UPDATE */
if (isset($_POST['update'])) {
    mysqli_query($conn, "
        UPDATE barang SET
            kode_barang = '$_POST[kode_barang]',
            nama_barang = '$_POST[nama_barang]',
            kategori    = '$_POST[kategori]',
            harga       = '$_POST[harga]',
            stok        = '$_POST[stok]',
            satuan      = '$_POST[satuan]'
        WHERE id_barang = '$id'
    ");

    header("Location: dashboard.php?page=list");
    exit;
}

/* AMBIL DATA */
$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'")
);
?>

<style>
.card {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    max-width: 720px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
}
.form-group {
    margin-bottom: 16px;
}
label {
    font-weight: bold;
    display: block;
    margin-bottom: 6px;
}
input {
    width: 100%;
    padding: 10px;
}
</style>

<div class="card">
    <h2>Edit Produk</h2>

    <form method="post">
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" value="<?= $data['kode_barang'] ?>" required>
        </div>

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="kategori" value="<?= $data['kategori'] ?>" required>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" value="<?= $data['harga'] ?>" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" value="<?= $data['stok'] ?>" required>
        </div>

        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" value="<?= $data['satuan'] ?>" required>
        </div>

        <button type="submit" name="update">Update</button>
        <a href="dashboard.php?page=list">Batal</a>
    </form>
</div>
