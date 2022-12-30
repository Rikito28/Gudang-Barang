<?php
session_start();
require_once '../config/koneksi.php';

if (!isset($_SESSION['id_user'])) {
 header('Location: ../index.php');
}

// ambil data
$sql = "SELECT b.nama_barang, b.jenis, d.jmljual, d.pelanggan, p.tgl_pinjam, u.nama FROM detail_jual AS d INNER JOIN barang AS b ON d.id_barang = b.id_barang INNER JOIN peminjaman AS p ON d.id_pelanggan = p.id_pelanggan INNER JOIN user AS u ON p.id_user = u.id_user";
$query = $gud ->query($sql);
$data_peminjaman = $query->fetch_all(MYSQLI_ASSOC);

// Nomor untuk increment baris tabel
$no = 1;

require_once 'includes/header.php';
require_once 'includes/detail-jual.php';
require_once 'includes/footer.php';