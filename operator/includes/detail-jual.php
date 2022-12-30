<div class="container mt-5">
 
 <h2>Data Penjualan</h2>

 <div class="clearfix"></div>

 <table class="table table-sm mt-3">
  <thead>
   <tr>
    <th>No</th>
    <th>Nama Barang</th>
    <th>Jenis</th>
    <th>Jumlah Jual</th>
    <th>Tgl. Pembelian</th>
    <th>Pembeli</th>
    <th>Petugas</th>
   </tr>
  </thead>
  <tbody>

   <?php foreach ($data_peminjaman as $data) :
   ?>

   <tr>
    <td><?= $no++; ?></td>
    <td><?= $data['nama_barang']; ?></td>
    <td><?= $data['jenis']; ?></td>
    <td><?= $data['jmljual']; ?></td>
    <td><?= $data['tgl_pinjam']; ?></td>
    <td><?= $data['pelanggan']; ?></td>
    <td><?= $data['nama']; ?></td>
   </tr>

   <?php endforeach; ?>

  </tbody>
 </table>
</div>