<?php include 'koneksi.php';
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM menu WHERE id_menu = $id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Edit Menu</h2>
    <form method="post">
        <div class="mb-3">
            <label>Nama Menu</label>
            <input type="text" name="nama_menu" value="<?= $data['nama_menu'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis</label>
            <input type="text" name="jenis" value="<?= $data['jenis'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga Porsi</label>
            <input type="number" name="harga" value="<?= $data['harga_porsi'] ?>" class="form-control" required>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="manage_menu.php" class="btn btn-secondary">Kembali</a>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $nama_menu = $_POST['nama_menu'];
        $jenis = $_POST['jenis'];
        $harga = $_POST['harga'];
        $koneksi->query("UPDATE menu SET nama_menu='$nama_menu', jenis='$jenis', harga_porsi='$harga' WHERE id_menu=$id");
        echo "<script>location='manage_menu.php';</script>";
    }
    ?>
</body>
</html>
