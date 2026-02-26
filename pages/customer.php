<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include __DIR__ . '/../koneksi.php';

$aksi = $_GET['aksi'] ?? '';

/* SIMPAN */
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "
        INSERT INTO customer (nama_customer, alamat, telp)
        VALUES ('$_POST[nama]','$_POST[alamat]','$_POST[telp]')
    ");
    header("Location: dashboard.php?page=customer");
    exit;
}

/* UPDATE */
if (isset($_POST['update'])) {
    mysqli_query($conn, "
        UPDATE customer SET
        nama_customer='$_POST[nama]',
        alamat='$_POST[alamat]',
        telp='$_POST[telp]'
        WHERE id_customer='$_POST[id]'
    ");
    header("Location: dashboard.php?page=customer");
    exit;
}

/* HAPUS */
if ($aksi == 'hapus') {
    mysqli_query($conn, "DELETE FROM customer WHERE id_customer='$_GET[id]'");
    header("Location: dashboard.php?page=customer");
    exit;
}
?>

<style>
.card {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    max-width: 700px;
    box-shadow: 0 4px 12px rgba(0,0,0,.1);
}
.form-group { margin-bottom: 15px; }
label { font-weight: bold; display: block; margin-bottom: 5px; }
input, textarea {
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
    text-decoration: none;
}
.btn-hijau { background: #27ae60; }
.btn-biru { background: #2980b9; }
.btn-merah { background: #c0392b; }
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}
.table th, .table td {
    border: 1px solid #ddd;
    padding: 10px;
}
.table th {
    background: #f4f4f4;
}
.header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>

<?php if ($aksi == 'tambah' || $aksi == 'edit') {
    if ($aksi == 'edit') {
        $q = mysqli_query($conn,"SELECT * FROM customer WHERE id_customer='$_GET[id]'");
        $d = mysqli_fetch_assoc($q);
    }
?>

<div class="card">
    <h3><?= ($aksi=='edit') ? 'Edit Customer' : 'Tambah Customer'; ?></h3>

    <form method="post">
        <?php if ($aksi=='edit') { ?>
            <input type="hidden" name="id" value="<?= $d['id_customer']; ?>">
        <?php } ?>

        <div class="form-group">
            <label>Nama Customer</label>
            <input type="text" name="nama" value="<?= $d['nama_customer'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" required><?= $d['alamat'] ?? '' ?></textarea>
        </div>

        <div class="form-group">
            <label>No Telp</label>
            <input type="text" name="telp" value="<?= $d['telp'] ?? '' ?>" required>
        </div>

        <button type="submit" name="<?= ($aksi=='edit')?'update':'simpan'; ?>" class="btn btn-hijau">
            Simpan
        </button>
        <a href="dashboard.php?page=customer" class="btn btn-merah">Batal</a>
    </form>
</div>

<?php } else { ?>

<div class="card">
    <div class="header-row">
        <h3>List Customer</h3>
        <a href="dashboard.php?page=customer&aksi=tambah" class="btn btn-hijau">
            + Tambah Customer
        </a>
    </div>

    <table class="table">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no=1;
        $q=mysqli_query($conn,"SELECT * FROM customer");
        while($r=mysqli_fetch_assoc($q)){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $r['nama_customer'] ?></td>
            <td><?= $r['alamat'] ?></td>
            <td><?= $r['telp'] ?></td>
            <td>
                <a href="dashboard.php?page=customer&aksi=edit&id=<?= $r['id_customer'] ?>" class="btn btn-biru">Edit</a>
                <a href="dashboard.php?page=customer&aksi=hapus&id=<?= $r['id_customer'] ?>" 
                   class="btn btn-merah"
                   onclick="return confirm('Hapus customer ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php } ?>
