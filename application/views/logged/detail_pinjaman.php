<?php $this->load->view('include/header'); ?>
<section class="bar">
  <div class="container">
    <div class="row">
      <!-- menu -->
      <div id="checkout" class="col-lg-12">
        <ul class="nav nav-pills nav-fill">
          <li class="nav-item"><a href="<?php echo base_url() . 'dashboard'; ?>" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="<?php echo base_url() . 'dashboard/akun'; ?>" class="nav-link">Akun</a></li>
          <li class="nav-item"><a href="<?php echo base_url() . 'dashboard/pinjaman'; ?>" class="nav-link active">Pinjaman</a></li>
        </ul>
      </div>
      <!-- menu akhir -->
      <div class="col-lg-12">
        <h2 class="text-uppercase">Ajukan Pinjaman</h2>
      </div>
      <div class="col-lg-6">
        <form action="" method="post">
          <div class="form-group">
            <label for="jumlah_pinjaman">Jumlah pinjaman</label>
            <input id="jumlah_pinjaman" type="number" class="form-control" value="<?php echo $pinjaman_detail[0]['jumlah_pinjaman'] ?>" disabled>
          </div>
          <div class="form-group">
            <label for="periode">Periode</label>
            <select class="form-control" disabled>
              <option value="3" <?php if ($pinjaman_detail[0]['periode'] == 3) {
                                  echo 'selected';
                                } ?>>3 Bulan</option>
              <option value="6" <?php if ($pinjaman_detail[0]['periode'] == 6) {
                                  echo 'selected';
                                } ?>>6 Bulan</option>
              <option value="9" <?php if ($pinjaman_detail[0]['periode'] == 9) {
                                  echo 'selected';
                                } ?>>9 Bulan</option>
              <option value="12" <?php if ($pinjaman_detail[0]['periode'] == 12) {
                                    echo 'selected';
                                  } ?>>12 Bulan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea id="keterangan" class="form-control" disabled><?php echo $pinjaman_detail[0]['keterangan'] ?></textarea>
          </div>
        </form>
        <br>
        <p class="text-muted text-sm">Batas masa tenggang untuk bayar cicilan berikutnya adalah 30 hari</p>
      </div>
      <div class="col-lg-6">
        <br>
        <p class="text-muted text-sm">Cicilan Mulai <?php echo $pinjaman_detail[0]['tanggal_pinjaman'] ?></p>
        <p class="text-muted text-sm">Rp. <?php echo number_format(($pinjaman_detail[0]['jumlah_pinjaman'] + $pinjaman_detail[0]['jumlah_pinjaman'] * 0.2) / $pinjaman_detail[0]['periode']) ?> / bulan</p>
        <div class="heading">
          <h3>Bukti Pembayaran</h3>
        </div>
        <form action="" method="post" enctype='multipart/form-data'>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;
                foreach ($cicilan as $c) : ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                      <?php if ($c['pembayaran'] != NULL && $c['status'] == 1) { ?>
                        <span class="badge badge-success">Terverifikasi</span>
                      <?php } else if ($c['pembayaran'] != NULL && $c['status'] == 0) { ?>
                        <span class="badge badge-info">Sedang diverifikasi</span>
                      <?php } else { ?>
                        <input name="pembayaran" type="file" class="btn btn-sm btn-template-main">
                        <input name="id_cicilan" type="hidden" value="<?php echo $c['id_cicilan']?>">
                      <?php } ?>
                    </td>
                  </tr>
                  <?php $i++;
                endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="text-right">
            <button name="upload" type="submit" class="btn btn-template-outlined"><i class="fa fa-user-md"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
</section>
<?php $this->load->view('include/footer'); ?>