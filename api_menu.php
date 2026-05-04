<?php
include 'koneksi.php';
include 'api_helper.php';
include 'jwt_handler.php';

error_reporting(0);
ini_set('display_errors', 0);

// 1. Cara lebih kuat untuk mengambil header Authorization
$authHeader = null;
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
} elseif (isset($_SERVER['Authorization'])) {
    $authHeader = $_SERVER['Authorization'];
} elseif (function_exists('getallheaders')) {
    $headers = getallheaders();
    if (isset($headers['Authorization'])) {
        $authHeader = $headers['Authorization'];
    }
}

// 2. Validasi Token secara ketat
if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    // Jika tidak ada header Bearer sama sekali
    sendResponse(401, "Akses Ditolak: Header Authorization Tidak Ditemukan");
}

$token = $matches[1]; // Ambil token setelah kata 'Bearer'

if (!validateToken($token)) {
    // Jika token ada tapi isinya SALAH/PALSU
    sendResponse(403, "Akses Ditolak: Token Tidak Valid atau Kadaluwarsa");
}

// --- Jika lolos pengecekan di atas, baru jalankan switch(method) ---
$method = $_SERVER['REQUEST_METHOD'];
// ... sisa kode kamu ...

switch($method) {
    case 'GET': // READ
        $result = $koneksi->query("SELECT * FROM menu");
        $data = $result->fetch_all(MYSQLI_ASSOC);
        sendResponse(200, "Data Menu Berhasil Diambil", $data);
        break;

    case 'POST': // CREATE
        $nama = $_POST['nama_menu'];
        $harga = $_POST['harga'];
        $query = "INSERT INTO menu (nama_menu, harga) VALUES ('$nama', '$harga')";
        if($koneksi->query($query)) sendResponse(201, "Menu Berhasil Ditambah");
        break;

    case 'PUT': // UPDATE
        parse_str(file_get_contents("php://input"), $_PUT);
        $id = $_PUT['id'];
        $nama = $_PUT['nama_menu'];
        $query = "UPDATE menu SET nama_menu='$nama' WHERE id_menu='$id'";
        if($koneksi->query($query)) sendResponse(200, "Menu Berhasil Diupdate");
        break;

    case 'DELETE': // DELETE
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = $_DELETE['id'];
        $query = "DELETE FROM menu WHERE id_menu='$id'";
        if($koneksi->query($query)) sendResponse(200, "Menu Berhasil Dihapus");
        break;
}
?>