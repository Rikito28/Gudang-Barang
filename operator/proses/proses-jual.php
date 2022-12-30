<?php

$dt_pinjam = NULL;

if(isset($_POST['submit']) && isset($_SESSION['list_jual'])) {
 foreach ($_SESSION['list_jual'] as $list) {
  $explode = explode("-", $list['nama_barang']);
  $nama_barang = trim($explode[0]);
  $jenis = trim($explode[1]);

  $barang = $gud ->query("SELECT * FROM barang WHERE nama_barang='$nama_barang' AND jenis = '$jenis'");
  $dt_barang = $barang->fetch_assoc();


  $sisa = ($dt_barang['jumlah'] - $list['jumlah_jual']);

  $update_dt_brg = $gud ->query("UPDATE barang SET jumlah = '$sisa' WHERE id_barang = '$dt_barang[id_barang]'");

  $tgl_pembelian = $_POST['tgl-pembelian'];
  $penjual = $_POST['penjual'];
  $id_user = $_POST['id_user'];

  $penjualan = $gud ->query("INSERT INTO peminjaman VALUES ('', '$id_user', '$tgl_pembelian')");

  $detail_jual = $gud -> query("INSERT INTO detail_jual VALUES ('', '$list[id_barang]', '$list[jumlah_jual]', '$penjual', (SELECT id_pelanggan FROM peminjaman ORDER BY id_pelanggan DESC LIMIT 1))");

  $update_dt_brg = $gud ->query("UPDATE barang SET jumlah = '$sisa' WHERE id_barang = '$dt_barang[id_barang]'");
 } 
 unset($_SESSION['list_jual']);
}