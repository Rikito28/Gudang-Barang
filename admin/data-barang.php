<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Barang</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
</html>

<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
  header('Location: ../index.php');
}

// Mengelurkan seluruh data barang yang ada di Database
$sql = "SELECT * FROM barang LEFT JOIN user ON barang.id_user = user.id_user";
$query = $gud->query($sql);
$data_barang = $query->fetch_all(MYSQLI_ASSOC);

// Nomor untuk increment baris tabel
$no = 1;

require_once 'includes/header.php';

if (!isset($_GET['p'])) {
  require_once 'includes/barang.php'; 
} else if ($_GET['p'] == 'tambah-barang') {
  require_once 'includes/'.$_GET['p'].'.php'; 
} else if ($_GET['p'] == 'detail-barang') {
  require_once 'includes/'.$_GET['p'].'.php'; 
} else if ($_GET['p'] == 'edit-barang') {
  require_once 'includes/'.$_GET['p'].'.php'; 
} else if ($_GET['p'] == 'hapus-barang') {
 
  $hapus = $gud ->query("DELETE FROM barang WHERE id_barang='".$_GET['id']."'");
  if ($hapus) {
    header('Location: data-barang.php');
  } else {
    header('Location: data-barang.php');
  }
}

require_once 'includes/footer.php';

?>