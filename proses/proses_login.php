<?php

session_start();

require_once '../config/koneksi.php';

$username = $gud -> real_escape_string($_POST['username']);
$password = ($gud -> real_escape_string($_POST['password']));
$level = $_POST['level'];

if(empty($username) || empty($password) || empty($level)) {
	header('Location: ../index.php');
}

$sql = "SELECT * FROM user WHERE username = '" .$username. "' AND password = '" .$password. "' AND id_level = '" .$level. "'";
$query = $gud->query($sql);
$result = $query->fetch_assoc();
var_dump($result);

if($query->num_rows > 0) {
  $_SESSION['name'] = $result['nama'];
  $_SESSION['id_user'] = $result['id_user'];

  if($result['id_level'] == 1) {
    header('Location: ../admin/index.php');
  } else {
    header('Location: ../operator/index.php');
  }
} else {
  $_SESSION['error'] = "Data yang anda masukan salah, silahkan coba lagi";
  header('Location: ../index.php');
}

?>