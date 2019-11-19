<?php $this->load->view('include/header'); ?>
<section class="bar">
  <div class="container">
    <div class="row">
      <!-- menu -->
      <div id="checkout" class="col-lg-12">
        <ul class="nav nav-pills nav-fill">
          <li class="nav-item"><a href="<?php echo base_url() . 'dashboard'; ?>" class="nav-link active">Dashboard</a></li>
          <li class="nav-item"><a href="<?php echo base_url() . 'dashboard/akun'; ?>" class="nav-link">Akun</a></li>
          <li class="nav-item"><a href="<?php echo base_url() . 'dashboard/pinjaman'; ?>" class="nav-link">Pinjaman</a></li>
        </ul>
      </div>
      <!-- menu akhir -->
      <div class="col-lg-5">
        <h2 class="text-uppercase"><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-exclamation-circle"></i></a>Kalkulator</h2>
        <script type="text/javascript">
          var nilai_jumlah_pinjaman = 500000;
          var nilai_periode = 3;
          var cicilan = 0;

          function slide_jumlah_pinjaman(value) {
            nilai_jumlah_pinjaman = value * 100000;
            document.getElementById('range_pinjaman').innerHTML = "Rp. " + formatNumber(nilai_jumlah_pinjaman);
            simulasi();
          }

          function slide_periode(value) {
            nilai_periode = value * 3;
            document.getElementById('periode').innerHTML = nilai_periode + " Bulan";
            simulasi();
          }

          function simulasi() {
            cicilan = (nilai_jumlah_pinjaman + (20 / 100) * nilai_jumlah_pinjaman) / nilai_periode;
            document.getElementById('cicilan').innerHTML = "Rp. " + formatNumber(cicilan) + " / bulan";
          }

          function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
          }
        </script>
        <label for="Jumlah Pinjaman">Jumlah Pinjaman</label>
        <input type="range" class="custom-range" min="5" max="100" value="5" onChange="slide_jumlah_pinjaman(this.value)" onmousemove="slide_jumlah_pinjaman(this.value)">
        <span id="range_pinjaman">Rp. 500,000</span>
        <br>
        <label for="Periode">Periode</label>
        <input type="range" class="custom-range" min="1" max="4" value="1" onChange="slide_periode(this.value)" onmousemove="slide_periode(this.value)">
        <span id="periode">3 Bulan</span>
        <br><br>
        <p>Cicilan</p>
        <span id="cicilan">Rp. 200,000 / bulan</span>
        <div class="text-right">
          <a class="btn btn-template-outlined" href="<?php echo base_url() . 'dashboard/pinjam_baru' ?>">Pinjam<i class="fa fa-chevron-right"></i></a>
        </div>
      </div>
      <div class="col-lg-7">
        <h2 class="text-uppercase">Riwayat Pinjaman</h2>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($pinjaman as $p) : ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $p['keterangan']; ?></td>
                  <td><?php echo $p['tanggal_pinjaman']; ?></td>
                  <td>
                    <?php if ($p['status'] == 0) { ?>
                      <span class="badge badge-info">Menunggu verifikasi</span>
                    <?php } else if ($p['status'] == 1) { ?>
                      <span class="badge badge-warning">Belum Lunas</span>
                    <?php } ?>
                  </td>
                </tr>
                <?php $i++;
              endforeach; ?>
            </tbody>
          </table>
          <div class="text-right">
            <a class="btn btn-template-outlined" href="<?php echo base_url() . 'dashboard/pinjaman' ?>">Selengkapnya<i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view('include/footer'); ?>