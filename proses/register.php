<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pendaftaran</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
</html>

<?php

require_once '../config/koneksi.php';

session_start();
 
$error = '';
$validate = '';

if( isset($_POST['submit']) ){

        $username = stripslashes($_POST['username']);

        $username = $gud -> real_escape_string($username);
        $name     = stripslashes($_POST['name']);
        $name     = $gud -> real_escape_string($name);
        $password = ($_POST['password']);
        $password = $gud -> real_escape_string($password);
        $repass   = ($_POST['repassword']);
        $repass   = $gud -> real_escape_string($repass);
		$level   = ($_POST['level']);
		$level	  = $gud -> real_escape_string($level);

        if(!empty(trim($name)) && !empty(trim($username)) && !empty(trim($password)) && !empty(trim($repass))){

            if($password == $repass){

                if( cek_nama($name,$gud) == 0 ){
                    
                    $query = "INSERT INTO user (username, nama, password, id_level ) VALUES ('$username','$name','$password','$level')";
                    $result   = mysqli_query($gud, $query);
                    
                    if ($result) {
                        $_SESSION['username'] = $username;
                        
                        header('Location: ../index.php');
                     
                    
                    } else {
                        $error =  'Register User Gagal !!';
                    }
                }else{
                        $error =  'Username sudah terdaftar !!';
                }
            }else{
                $validate = 'Password tidak sama !!';
            }
             
        }else {
            $error =  'Data tidak boleh kosong !!';
        }
    } 
    
    function cek_nama($username,$gud){
        $nama = mysqli_real_escape_string($gud, $username);
        $query = "SELECT * FROM user WHERE username = '$nama'";
        if( $result = mysqli_query($gud, $query) ) return mysqli_num_rows($result);
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 

<link rel="stylesheet" href="style.css">
</head>
<body>
        <section class="container-fluid mb-4">
            
            <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4">
                <form class="form-container" action="register.php" method="POST">
                    <br>
					<h4 class="text-center font-weight-bold"> Pendaftaran </h4>
                    <?php if($error != ''){ ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php } ?>
                    
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">
                        <?php if($validate != '') {?>
                            <p class="text-danger"><?= $validate; ?></p>
                        <?php }?>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Re-Password</label>
                        <input type="password" class="form-control" id="InputRePassword" name="repassword" placeholder="Re-Password">
                        <?php if($validate != '') {?>
                            <p class="text-danger"><?= $validate; ?></p>
                        <?php }?>
                    </div>
					<div class="form-group">
						<label for="level">Sebagai</label>
						<select name="level" class="form-control">
						<option value="">-- Masuk Sebagai ---</option>
						<option value="2">Operator</option>
						<option value="1">Admin</option>
						</select>
					</div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block" <a href="../index.php">Daftar</button>
					<div class="form-footer mt-2">
                        <p> Sudah punya akun? <a href="../index.php">Masuk</a></p>
                    </div>
                </form>
            </section>
            </section>
        </section>
		
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>