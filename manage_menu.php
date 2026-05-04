<?php
include 'koneksi.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Kelola Menu</title>
  <link rel="stylesheet" href="css/admin_menu.css">
</head>
<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 20px;
  background-color: #eef2f5;
}

.container {
  max-width: 900px;
  margin: auto;
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h1, h2 {
  text-align: center;
  color: #333;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 30px;
}

th, td {
  padding: 12px;
  border: 1px solid #ccc;
  text-align: center;
}

th {
  background-color: #006699;
  color: #fff;
}

.edit {
  background-color: #ffc107;
  color: white;
  border: none;
  padding: 6px 10px;
  border-radius: 4px;
  cursor: pointer;
}

.delete {
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 6px 10px;
  border-radius: 4px;
  cursor: pointer;
}

form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  align-items: center;
}

input, select, button[type="submit"] {
  padding: 10px;
  width: 80%;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button[type="submit"] {
  background-color: #28a745;
  color: white;
  cursor: pointer;
}</style>
<body>
  <div class="container">
    <h1>Manajemen Menu Makanan</h1>
    <table>
      <thead>
        <tr>
          <th>Nama Menu</th>
          <th>Harga</th>
          <th>Kategori</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $result = $koneksi->query("SELECT * FROM menu");

      while ($row = $result->fetch_assoc()) {
        echo "<tr>
      <td>{$row['nama_menu']}</td>
      <td>{$row['harga_porsi']}</td>
      <td>{$row['jenis']}</td>
      <td>
      <a href='update_menu.php?id={$row['id_menu']}' class='edit'>Edit</a>
      <a href='hapus_menu.php?id={$row['id_menu']}' class='delete' onclick='return confirm(\"Yakin?\")'>Hapus</a>
      </td>				
      </tr>";
        }
        ?>
        <a href="halaman_admin.php" class="btn btn-secondary">Kembali</a>        
      </tbody>
    </table>



</body>
</html>