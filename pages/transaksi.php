<?php
include(_DIR_ . '/../koneksi.php');
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
<div class="card shadow">
<div class="card-header bg-primary text-white">
    <h5>Transaksi Penjualan</h5>
</div>
<div class="card-body">

<form method="POST">

<!-- PILIH CUSTOMER -->
<div class="mb-3">
<label class="form-label">Pilih Customer</label>
<select name="id_customer" class="form-select" required>
    <option value="">-- Pilih Customer --</option>
    <?php
    $cust = mysqli_query($conn, "SELECT * FROM customer");
    while ($c = mysqli_fetch_array($cust)) {
        echo "<option value='".$c['id_customer']."'>".$c['nama_customer']."</option>";
    }
    ?>
</select>
</div>

<!-- PRODUK -->
<div id="produk-list">
    <div class="produk-item border p-3 mb-3 rounded">

        <div class="mb-2">
        <label class="form-label">Pilih Barang</label>
        <select name="id_barang[]" class="form-select" required>
            <option value="">-- Pilih Barang --</option>
            <?php
            $brg = mysqli_query($conn, "SELECT * FROM tbl_barang");
            while ($b = mysqli_fetch_array($brg)) {
                echo "<option value='".$b['id_barang']."'>".$b['nama_barang']."</option>";
            }
            ?>
        </select>
        </div>

        <div>
        <label class="form-label">Jumlah</label>
        <input type="number" name="jumlah[]" class="form-control" required>
        </div>

    </div>
</div>

<button type="button" class="btn btn-secondary mb-3" onclick="tambahProduk()">+ Tambah Barang</button>

<br>

<button type="submit" name="simpan" class="btn btn-success">Simpan Transaksi</button>

</form>

</div>
</div>
</div>

<script>
function tambahProduk() {
    var produk = document.querySelector('.produk-item');
    var clone = produk.cloneNode(true);

    // reset value supaya tidak ikut ter-copy
    clone.querySelectorAll("select, input").forEach(el => el.value = "");

    document.getElementById('produk-list').appendChild(clone);
}
</script>

<?php
if(isset($_POST['simpan'])){

    $id_customer = $_POST['id_customer'];
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    for($i = 0; $i < count($id_barang); $i++){

        mysqli_query($conn, "INSERT INTO transaksi 
        (id_customer, id_barang, jumlah) 
        VALUES 
        ('$id_customer', '".$id_barang[$i]."', '".$jumlah[$i]."')");

    }

    echo "<script>alert('Transaksi berhasil disimpan!');</script>";
}
?>