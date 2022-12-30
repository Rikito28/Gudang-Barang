<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
  header('Location: ../../index.php');
}

$nama  = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$id = $_POST['id'];

$update = $gud ->query("UPDATE user SET nama = '$nama', username = '$username', password = '$password' WHERE id_user = '".$id."'");

if ($update) {
  header('Location: ../data-petugas.php');
} else {
  header('Location: ../data-petugas.php?h=edit-petugas');
}