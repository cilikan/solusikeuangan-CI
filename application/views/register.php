<?php $this->load->view('include/header'); ?>
<div id="content">
  <div class="container">
    <div class="row">
      <!-- register -->
      <div class="col-lg-6">
        <div class="box">
          <h2 class="text-uppercase">Buat Akun Baru</h2>
          <p class="lead">Anda belum mendaftar?</p>
          <hr>
          <?php if(isset($_SESSION['terdaftar'])){ ?>
            <div class="alert alert-success"><?php echo $_SESSION['terdaftar'] ?></div>
          <?php }?>
          <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
          <form action="" method="post">
            <div class="form-group">
              <label for="email-login">Email</label>
              <input name="email" type="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password-login">Password</label>
              <input name="password1" type="password" class="form-control" >
            </div>
            <div class="form-group">
              <label for="password2-login">Konfirmasi Password</label>
              <input name="password2" type="password" class="form-control" >
            </div>
            <div class="text-right">
              <button type="submit" name="register" class="btn btn-template-outlined"><i class="fa fa-user-md"></i> Daftar</button>
            </div>
          </form>
        </div>
      </div>
      <!-- login -->
      <div class="col-lg-6">
        <div class="box">
          <h2 class="text-uppercase">Masuk</h2>
          <p class="lead">Sudah Bergabung ?</p>
          <hr>
          <?php if(isset($_SESSION['kesalahan'])){ ?>
            <div class="alert alert-danger"><?php echo $_SESSION['kesalahan'] ?></div>
          <?php }?>
          <form action="" method="post">
            <div class="form-group">
              <label for="email">Email</label>
              <input name="email" type="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input name="password" type="password" class="form-control" required>
            </div>
            <div class="text-right">
              <button type="submit" name="login" class="btn btn-template-outlined"><i class="fa fa-sign-in"></i> Masuk</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>