<?php

session_start();
require_once '../../config/koneksi.php';

if(!isset($_SESSION['user'])) {
 header('Location: ../../index.php');
}

$nama_barang = $_POST['nama_barang'];
$jenis = $_POST['jenis'];
$jumlah = $_POST['jumlah'];
$kondisi = $_POST['kondisi'];
$ket = $_POST['ket'];
$tgl_regis = date("Y-m-d");
$petugas = $_SESSION['id_user'];

if(!isset($nama_barang, $jenis, $jumlah, $kondisi, $ket)) {
  header('Location: ../data-barang.php?p=tambah-barang');
}

$sql = "INSERT INTO barang VALUES ('', '$nama_barang', '$kondisi', '$jumlah', '$jenis', '$tgl_regis', '$petugas', '$ket')";
$query = $gud ->query($sql);

if($query) {
  header('Location: ../data-barang.php');
} else {
  header('Location: ../data-barang.php?p=tambah-barang');
}