<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Petugas</title>
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
$sql = "SELECT * FROM user ";
$query = $gud ->query($sql);
$data = $query->fetch_all(MYSQLI_ASSOC);

// Nomor untuk increment baris tabel
$no = 1;

require_once 'includes/header.php';
if (!isset($_GET['h'])) {
	require_once 'includes/petugas.php';	
} else if ($_GET['h'] == 'edit-petugas') {
	require_once 'includes/'.$_GET['h'].'.php';	
} else if ($_GET['h'] == 'hapus-petugas') {
	
	$hapus = $gud ->query("DELETE FROM user WHERE id_user ='".$_GET['id']."'");
	if ($hapus) {
		header('Location: data-petugas.php');
	} else {
		header('Location: data-petugas.php');
	}

}
require_once 'includes/footer.php'; 