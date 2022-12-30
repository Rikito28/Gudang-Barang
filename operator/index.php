<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
 header('Location: ../index.php');
}

require_once 'proses/proses-jual.php';

$sql = "SELECT * FROM barang";
$query = $gud ->query($sql);
$data_barang  = $query->fetch_all(MYSQLI_ASSOC);

$no = 1;

require_once 'includes/header.php';
require_once 'includes/penjualan.php';
require_once 'includes/footer.php';
?>