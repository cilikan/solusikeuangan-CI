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
        <a class="btn btn-template-main" href="<?php echo base_url() . 'dashboard/pinjam_baru' ?>"><i class="fa fa-plus"></i></a>
        <a class="btn btn-outline-primary" href="<?php echo base_url() . 'dashboard/pinjam_baru' ?>">Ajukan Pinjaman Baru</a>
        <br><br>
      </div>
      <div class="col-lg-12">
        <h2 class="text-uppercase">Riwayat Pinjaman</h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th>Nominal</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              $total = 0;
              foreach ($pinjaman as $p) : ?>
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $p['keterangan'] ?></td>
                  <td><?php echo 'Rp. ' . number_format($p['jumlah_pinjaman']) ?></td>
                  <td><?php echo $p['tanggal_pinjaman'] ?></td>
                  <td>
                    <?php if ($p['status'] == 0) { ?>
                      <span class="badge badge-info">Menunggu verifikasi</span>
                    <?php } else if ($p['status'] == 1) { ?>
                      <span class="badge badge-warning">Belum Lunas</span>
                    <?php } ?>
                  </td>
                  <td>
                    <?php echo anchor('dashboard/detail_pinjaman/' . $p['id_pinjaman'], '<i class="fa fa-align-justify"></i>'); ?>
                    &nbsp;
                    <?php if ($p['status'] != 1) {
                      echo anchor('dashboard/hapus/' . $p['id_pinjaman'], '<i class="fa fa-trash-o"></i>');
                    } ?>
                  </td>
                </tr>
                <?php $total += $p['jumlah_pinjaman'];
                $i++;
              endforeach; ?>
            </tbody>
            <tfoot>
              <tr>
                <th colspan=2>Total</th>
                <th><?php echo 'Rp. ' . number_format($total); ?></th>
              </tr>
              <tr>
                <th colspan=2>Pengajuan pinjam yang dibolehkan</th>
                <th><?php echo 'Rp. ' . number_format($batas_pinjaman - $total); ?></th>
              </tr>
            </tfoot>
          </table>
        </div>
        <br>
        <h2 class="text-uppercase">Lainnya</h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th>Nominal</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              $total = 0;
              foreach ($pinjaman_lainnya as $p) : ?>
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $p['keterangan'] ?></td>
                  <td><?php echo 'Rp. ' . number_format($p['jumlah_pinjaman']) ?></td>
                  <td><?php echo $p['tanggal_pinjaman'] ?></td>
                  <td>
                    <?php if ($p['status'] == 0) { ?>
                      <span class="badge badge-danger">ditolak / dihapus</span>
                    <?php } else if ($p['status'] == 1) { ?>
                      <span class="badge badge-success">lunas</span>
                    <?php } ?>
                  </td>
                  <td>
                    <?php echo anchor('dashboard/detail_pinjaman/' . $p['id_pinjaman'], '<i class="fa fa-align-justify"></i>'); ?>
                  </td>
                </tr>
                <?php $total += $p['jumlah_pinjaman'];
                $i++;
              endforeach; ?>
            </tbody>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view('include/footer'); ?>