<?php
include 'koneksi.php';
include 'api_helper.php';
include 'jwt_handler.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE username='$username' AND password='$password'");
    $user = mysqli_fetch_array($query);

    if ($user) {
        $token = generateToken($user['id_pelanggan']);
        sendResponse(200, "Login Berhasil", ["token" => $token, "user" => $user['username']]);
    } else {
        sendResponse(401, "Username atau Password Salah");
    }
} else {
    sendResponse(405, "Method Not Allowed");
}
?>