<div class="container mt-5">
 <div class="card">
  <div class="card-header">
   Petugas : <?= $_SESSION['name'] ?>
  </div>
  <div class="card-body">
   <div class="row">
    <div class="col-md-6">
     <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="mt-3" autocomplete="off">
      <div class="form-group">
       <label for="id_barang">Nama Barang</label>
       <input list="barang" name="nama_barang" placeholder="Pilih barang" class="form-control" required>
       <datalist id="barang">
   
        <?php 
        foreach ($data_barang as $barang): 
         $daftar = $barang['nama_barang'].' - '.$barang['jenis'];
        ?>
   
        <option value="<?= $daftar ?>">
   
        <?php endforeach ?>
   
       </select>
      </div>
      <div class="form-group">
       <label for="jumlah_barang">Jumlah Jual</label>
       <input type="number" name="jumlah_jual" placeholder="Jumlah Barang" min="1" max="1000" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary float-right">Input Transaksi</button>
      <div class="clearfix"></div>
     </form>
    </div>
    <div class="col-md-6">
     <h3>Data Penjualan</h3>

     <?php 
     if (isset($_POST['nama_barang'], $_POST['jumlah_jual'])) {
      
      $nama_barang = trim($_POST['nama_barang']);
      $explode_nama_barang = explode("-", $nama_barang);
      $nama_barang_exploded = $explode_nama_barang[0];
      $jumlah_jual  = $_POST['jumlah_jual'];
      $id_user   = $_SESSION['id_user'];

      $barang = $gud ->query("SELECT * FROM barang WHERE nama_barang='".$nama_barang_exploded."'");
      $data_barang  = $barang->fetch_array();

      if(!isset($_SESSION['list_jual'])) {
       $_SESSION['list_jual'] = [];
      }

      $jual = 1;
      $index = -1;
      $ls_pmj = unserialize(serialize($_SESSION['list_jual']));

      // jika barang sudah ada di daftar list maka akan diupdate
      for ($i=0; $i<count($ls_pmj); $i++) {
       if($ls_pmj[$i]['nama_barang'] == $nama_barang) {
        $index = $i;
        if($jumlah_jual <= $data_barang['jumlah']) {
         $_SESSION['list_jual'][$i]['jumlah_jual'] = $jumlah_jual;
        } else {
         echo '<div class="alert alert-danger" role="alert"><b>'.$nama_barang.'</b> hanya tersedia <b>'.$data_barang['jumlah'].'</b></div>';
        }
        break;
       }
      }

      // jika list peminjaman kosong
      if($index == -1) {
       if($data_barang['jumlah'] < $jumlah_jual) {
        echo '<div class="alert alert-danger" role="alert"><b>'.$nama_barang.'</b> hanya tersedia <b>'.$data_barang['jumlah'].'</b></div>';
       } else {
        $_SESSION['list_jual'][] = [
                       'id_barang' => $data_barang['id_barang'], 
                       'nama_barang' => $nama_barang, 
                       'jumlah_jual' => $jumlah_jual
                      ];
       }
      }
     }

     ?>

      <table class="table table-bordered">
       <tr align="center">
        <th>Nama barang</th>
        <th>Jumlah jual</th>
        <th>Aksi</th>
       </tr>
        
       <?php 
       if(isset($_SESSION['list_jual'])) {
          $list = unserialize(serialize($_SESSION['list_jual']));
          $index = 0;
         for($i=0; $i<count($list); $i++) {
         ?>

         <tr>
           <td><?php echo $list[$i]['nama_barang']; ?></td>
           <td align="center"><?php echo $list[$i]['jumlah_jual']; ?></td>
           <td align="center">
            <a href="?index=<?php echo $index; ?>" onclick="return confirm('Anda yakin?')">Hapus</a>
           </td>
          </tr>

         <?php 
          $index++;
         } 

         // hapus barang pada cart
        if(isset($_GET['index'])) {
         $list = unserialize(serialize($_SESSION['list_jual']));
         unset($list[$_GET['index']]);
         $list = array_values($list);
         $_SESSION['list_jual'] = $list;
        }
       }
        ?>

      </table>
     
     <hr>

     <form method="post" action="index.php">
      <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>">
      <div class="row">
       <div class="col-md-6">
        <div class="form-group">
         <label for="tgl-pengembalian">Tgl. Pembelian</label>
         <input class="form-control" type="date" name="tgl-pembelian" id="tgl-pembelian" required>
        </div>
       </div>
       <div class="col-md-6">
        <div class="form-group">
         <label for="peminjam">Pembeli</label>
         <input class="form-control" type="text" name="penjual" id="penjual" placeholder="Masukan Nama" required>
        </div>
       </div>
       <div class="clearfix"></div>
      </div>
      <button type="submit" class="btn btn-success btn-block" name="submit">Proses</button>
     </form>

    </div>
   </div>
  </div>
 </div>
</div>

<?php 
 if(isset($_GET["index"])){
  header('Location: index.php');
 }