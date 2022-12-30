<div class="container mt-5">

  <div class="row text-center">
    
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
 
		<?php 
          $sql = $gud ->query("SELECT COUNT(*) AS jmlJual FROM detail_jual");
          $jual = $sql->fetch_assoc();
          ?>

          <h5 class="card-title">Data Penjualan</h5>
          <p class="card-text">Data barang yang dijual</p>
          <h4><?= $jual['jmlJual']; ?></h4>
          <a href="#" class="card-link">Lihat Data Penjualan</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          
		  <?php 
          $sql = $gud ->query("SELECT COUNT(*) AS jmlBarang FROM barang");
          $barang = $sql ->fetch_assoc();
          ?>
 
          <h5 class="card-title">Data Barang</h5>
          <p class="card-text">Jumlah barang saat ini</p>
          <h3><?= $barang['jmlBarang']; ?></h3>
          <a href="data-barang.php" class="card-link">Lihat Data Barang</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
 
          <?php 
          $sql = $gud ->query("SELECT COUNT(*) AS jmlOpt FROM user WHERE id_level = 1");
          $opt = $sql ->fetch_assoc();
          ?>

          <h5 class="card-title">Data Petugas</h5>
          <p class="card-text">Jumlah petugas saat ini</p>
          <h3><?= $opt['jmlOpt']; ?></h3>
          <a href="data-petugas.php" class="card-link">Lihat Data Petugas</a>
        </div>
      </div>
    </div>
  </div>

</div>