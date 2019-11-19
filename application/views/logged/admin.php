<?php $this->load->view('include/header'); ?>
<section class="bar">
  <div class="container">
    <div class="col-lg-12">
      <h2 class="text-uppercase">Verifikasi Data akun peminjam</h2>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Email</th>
              <th colspan=2>Foto</th>
              <th colspan=2>KTP</th>
              <th colspan=2>NPWP</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <!-- data akun -->
            <?php foreach ($user as $u) : ?>
              <form action="" method="post">
                <tr>
                  <td><?php echo $u['email']; ?><input type="hidden" name="email" value="<?php echo $u['email']; ?>"></td>
                  <?php if ($u['foto'] != NULL) { ?>
                    <td>
                      <select name="aksi_foto" class="form-control">
                        <option value=1>Terima</option>
                        <option value=0>Tolak</option>
                      </select>
                    </td>
                    <td><a href="<?php echo base_url() . 'gambar/foto/' . $u['foto'] . '.jpg' ?>" target="_blank"><i class="btn btn-template-outlined fa fa-image"></i></a></td>
                  <?php } else { ?>
                    <input type="hidden" name="aksi_foto" value=0>
                    <td colspan=2><span class="badge badge-danger">Belum Upload</span></td>
                  <?php } ?>
                  <?php if ($u['ktp'] != NULL) { ?>
                    <td>
                      <select name="aksi_ktp" class="form-control">
                        <option value=1>Terima</option>
                        <option value=0>Tolak</option>
                      </select>
                    </td>
                    <td><a href="<?php echo base_url() . 'gambar/ktp/' . $u['ktp'] . '.jpg' ?>" target="_blank"><i class="btn btn-template-outlined fa fa-image"></i></a></td>
                  <?php } else { ?>
                    <input type="hidden" name="aksi_ktp" value=0>
                    <td colspan=2><span class="badge badge-danger">Belum Upload</span></td>
                  <?php } ?>
                  <?php if ($u['npwp'] != NULL) { ?>
                    <td>
                      <select name="aksi_npwp" class="form-control">
                        <option value=1>Terima</option>
                        <option value=0>Tolak</option>
                      </select>
                    </td>
                    <td><a href="<?php echo base_url() . 'gambar/npwp/' . $u['npwp'] . '.jpg' ?>" target="_blank"><i class="btn btn-template-outlined fa fa-image"></i></a></td>
                  <?php } else { ?>
                    <input type="hidden" name="aksi_npwp" value=0>
                    <td colspan=2><span class="badge badge-danger">Belum Upload</span></td>
                  <?php } ?>
                  <td align="right">
                    <button name="proses" type="submit" class="btn btn-template-outlined"><i class="fa fa-check"></i></button>
                    <button name="tolak_semua" type="submit" class="btn btn-template-outlined"><i class="fa fa-times"></i></button>
                  </td>
                </tr>
              </form>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <br>
      <h2 class="text-uppercase">Verifikasi Pinjaman</h2>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Email</th>
              <th>Keterangan</th>
              <th>Nominal</th>
              <th>Tanggal Pinjam</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pinjaman as $p) : ?>
              <form action="" method="post">
                <tr>
                  <td><?php echo $p['email']; ?></td>
                  <td><?php echo $p['keterangan']; ?></td>
                  <td><?php echo 'Rp. ' . number_format($p['jumlah_pinjaman']); ?></td>
                  <td><?php echo $p['tanggal_pinjaman']; ?></td>
                  <td align="right">
                    <input type="hidden" name="id_pinjaman" value="<?php echo $p['id_pinjaman'] ?>">
                    <button value="1" name="aksi_pinjaman" type="submit" class="btn btn-template-outlined"><i class="fa fa-check"></i></button>
                    <button value="0" name="aksi_pinjaman" type="submit" class="btn btn-template-outlined"><i class="fa fa-times"></i></button>
                  </td>
                </tr>
              </form>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <h2 class="text-uppercase">Verifikasi Cicilan</h2>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Pembayaran</th>
              <th>Jumlah yang harus dibayar</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cicilan as $c) : ?>
              <form action="" method="post">
                <tr>
                  <td><?php echo 'Rp. '. number_format(($c['jumlah_pinjaman']+$c['jumlah_pinjaman']*0.2)/$c['periode']); ?></td>
                  <td><a href="<?php echo base_url() . 'gambar/pembayaran/' . $c['pembayaran'] . '.jpg' ?>" target="_blank"><i class="btn btn-template-outlined fa fa-image"></i></a></td>
                  <td align="right">
                    <input type="hidden" name="id_pinjaman" value="<?php echo $c['id_pinjaman'] ?>">
                    <input type="hidden" name="id_cicilan" value="<?php echo $c['id_cicilan'] ?>">
                    <button value="1" name="aksi_cicilan" type="submit" class="btn btn-template-outlined"><i class="fa fa-check"></i></button>
                    <button value="0" name="aksi_cicilan" type="submit" class="btn btn-template-outlined"><i class="fa fa-times"></i></button>
                  </td>
                </tr>
              </form>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
</section>
<?php $this->load->view('include/footer'); ?>