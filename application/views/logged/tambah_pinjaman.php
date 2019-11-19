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
        <?php if (isset($_SESSION['kesalahan'])) { ?>
          <div class="alert alert-danger"><?php echo $_SESSION['kesalahan'] ?></div>
        <?php } ?>
        <form action="" method="post">
          <div class="form-group">
            <label for="jumlah_pinjaman">Jumlah pinjaman</label>
            <input name="jumlah_pinjaman" value="500000" min="500000" max="10000000" type="number" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="periode">Periode</label>
            <select name="periode" class="form-control" required>
              <option value="3">3 Bulan</option>
              <option value="6">6 Bulan</option>
              <option value="9">9 Bulan</option>
              <option value="12">12 Bulan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control" required></textarea>
          </div>
          <div class="text-right">
            <button name="pinjam" type="submit" class="btn btn-template-outlined"><i class="fa fa-user-md"></i>Ajukan Pinjaman</button>
          </div>
        </form>
      </div>
      <div class="col-lg-6">
        <br>
        <p class="text-muted text-sm">Cicilan Mulai <?php echo date('Y-m-d'); ?></p>
      </div>
    </div>
</section>
<?php $this->load->view('include/footer'); ?>