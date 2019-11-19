<?php $this->load->view('include/header'); ?>
<section class="bar">
  <div class="container">
    <div class="row">
      <!-- menu -->
      <div id="checkout" class="col-lg-12">
        <ul class="nav nav-pills nav-fill">
          <li class="nav-item"><a href="<?php echo base_url() . 'dashboard'; ?>" class="nav-link">Dashboard</a></li>
          <li class="nav-item"><a href="<?php echo base_url() . 'dashboard/akun'; ?>" class="nav-link active">Akun</a></li>
          <li class="nav-item"><a href="<?php echo base_url() . 'dashboard/pinjaman'; ?>" class="nav-link">Pinjaman</a></li>
        </ul>
      </div>
      <!-- menu akhir -->
      <div class="col-lg-6">
        <h2 class="text-uppercase">Data Akun</h2>
        <form action="" method="post" enctype='multipart/form-data'>
          <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input name="nama" type="text" class="form-control" value="<?php echo $user[0]['nama']; ?>" required>
          </div>
          <div class="form-group">
            <label for="jenis-bank">Jenis Bank</label>
            <select name="jenis_bank" class="form-control" required>
              <option value="BCA" <?php if ($user[0]['jenis_bank'] == 'BCA') echo 'SELECTED'; ?>>BCA</option>
              <option value="BNI" <?php if ($user[0]['jenis_bank'] == 'BNI') echo 'SELECTED'; ?>>BNI</option>
              <option value="BRI" <?php if ($user[0]['jenis_bank'] == 'BRI') echo 'SELECTED'; ?>>BRI</option>
              <option value="MANDIRI" <?php if ($user[0]['jenis_bank'] == 'MANDIRI') echo 'SELECTED'; ?>>Mandiri</option>
              <option <?php if ($user[0]['jenis_bank'] == null) echo 'SELECTED'; ?> disabled>-</option>
            </select>
          </div>
          <div class="form-group">
            <label for="no_rekening">No.Rekening</label>
            <input name="no_rekening" type="text" class="form-control" value="<?php echo $user[0]['no_rekening']; ?>" required>
          </div>
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <td>Foto</td>
                  <td>
                    <?php if ($user[0]['foto'] != NULL) { ?>
                      <a href="<?php echo base_url() . 'gambar/foto/' . $user[0]['foto'] . '.jpg' ?>" target="_blank"><i class="btn btn-template-outlined fa fa-image"></i></a>
                    <?php } else { ?>
                      <input name="foto" type="file" class="btn btn-sm btn-template-main">
                    <?php } ?>
                  </td>
                  <td align="right">
                    <?php if ($user[0]['foto'] == null) { ?>
                      <span class="badge badge-danger">Belum diupload</span>
                    <?php } else if ($syarat[0]['syarat_foto'] == 0) { ?>
                      <span class="badge badge-info">sedang diverifikasi</span>
                    <?php } else { ?>
                      <span class="badge badge-success">Terverifikasi</span>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <td>KTP</td>
                  <td>
                    <?php if ($user[0]['ktp'] != NULL) { ?>
                      <a href="<?php echo base_url() . 'gambar/ktp/' . $user[0]['ktp'] . '.jpg' ?>" target="_blank"><i class="btn btn-template-outlined fa fa-image"></i></a>
                    <?php } else { ?>
                      <input name="ktp" type="file" class="btn btn-sm btn-template-main">
                    <?php } ?>
                  </td>
                  <td align="right">
                    <?php if ($user[0]['ktp'] == null) { ?>
                      <span class="badge badge-danger">Belum diupload</span>
                    <?php } else if ($syarat[0]['syarat_ktp'] == 0) { ?>
                      <span class="badge badge-info">sedang diverifikasi</span>
                    <?php } else { ?>
                      <span class="badge badge-success">Terverifikasi</span>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <td>NPWP</td>
                  <td>
                    <?php if ($user[0]['npwp'] != NULL) { ?>
                      <a href="<?php echo base_url() . 'gambar/npwp/' . $user[0]['npwp'] . '.jpg' ?>" target="_blank"><i class="btn btn-template-outlined fa fa-image"></i></a>
                    <?php } else { ?>
                      <input name="npwp" type="file" class="btn btn-sm btn-template-main">
                    <?php } ?>
                  </td>
                  <td align="right">
                    <?php if ($user[0]['npwp'] == null) { ?>
                      <span class="badge badge-danger">Belum diupload</span>
                    <?php } else if ($syarat[0]['syarat_npwp'] == 0) { ?>
                      <span class="badge badge-info">sedang diverifikasi</span>
                    <?php } else { ?>
                      <span class="badge badge-success">Terverifikasi</span>
                    <?php } ?>
                  </td>
                </tr>
                <?php
                if (isset($error)) {
                  echo $error;
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="text-right">
            <button name="ubah" type="submit" class="btn btn-template-outlined"><i class="fa fa-user-md"></i> Simpan</button>
          </div>
        </form>
      </div>
      <div class="col-lg-6">
        <h2 class="text-uppercase">Ubah Kata Sandi</h2>
        <?php if (isset($_SESSION['terganti'])) { ?>
          <div class="alert alert-success"><?php echo $_SESSION['terganti'] ?></div>
        <?php } ?>
        <?php if (isset($_SESSION['kesalahan'])) { ?>
          <div class="alert alert-danger"><?php echo $_SESSION['kesalahan'] ?></div>
        <?php } ?>
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <form action="" method="post">
          <div class="form-group">
            <label for="password">Kata sandi lama</label>
            <input name="password_lama" type="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="new_password">Kata sandi baru</label>
            <input name="password1" type="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="new_password">Ulangi kata sandi</label>
            <input name="password2" type="password" class="form-control" required>
          </div>
          <div class="text-right">
            <button type="submit" name="ganti_password" class="btn btn-template-outlined"><i class="fa fa-sign-in"></i> Ubah</button>
          </div>
        </form>
        <div class="col-lg-12">
          <h2 class="text-uppercase">Limit Pinjaman</h2>
          <p class="lead"><?php echo 'Rp. '.number_format($batas_pinjaman);?></p>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view('include/footer'); ?>