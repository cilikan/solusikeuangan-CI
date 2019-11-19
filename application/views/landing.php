<?php $this->load->view('include/header'); ?>
<section class="no-mb relative-positioned">
  <!--
  *** JUMBOTRON ***
  _________________________________________________________
  -->
  <div style="background: url('assets/img/duitbg.jpg') center center repeat; background-size: cover;" class="jumbotron relative-positioned color-white text-md-center">
    <div class="dark-mask mask-primary"></div>
    <div class="container">
      <div class="row mb-small">
        <div class="col-md-12 text-center">
          
        </div>
      </div>
      <div class="row">
        
        <div class="col-md-6 mb-small"><img src="<?php echo base_url() . 'assets/'; ?>img/duit.png" alt="..." class="img-fluid"></div>
        <div class="col-md-6 text-center-sm">
        <h1 class="text-uppercase">"Solusi KeuanganKU"</h1>
          <p class="no-letter-spacing"><br><br><br><br>Setiap orang memiliki masalahnya sendiri<br>dan biarkan kami membantu masalah keuanganmu <br> 
        "Solusi-Ku Adalah perusahaan finansial teknologi, penyedia layanan pinjaman online dan menyediakan pembayaran pinjaman dengan metode cicilan berbasis Teknologi Informasi"
        </p>
          <p><a href="#packages" class="scroll-to btn btn-template-outlined-white">Rincian</a></p>
        </div>
      </div>
    </div>
  </div>
  <!-- *** JUMBOTRON END ***-->
</section>
<section id="packages" class="bar no-mb">
  <div data-animate="fadeInUp" class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="heading text-center">
          <h2>Ajukan Pinjaman</h2>
        </div>
        
        <!-- Packages Start-->
        <div class="row packages">
          <div class="col-md-4">
            <div class="package">
              <div class="package-header light-gray">
                <h5>Rp 500.000,-</h5>
              </div>
              <div class="price">
                <div class="price-container d-flex align-items-end justify-content-center">
                  <h4 class="h1"><span class="currency">Rp </span>50.000</h4><span class="period">/ bulan</span>
                </div>
              </div>
              <ul class="list-unstyled">
                <li><i class="fa fa-check"></i>No Rekening</li>
                <li><i class="fa fa-check"></i>Foto</li>
                <li><i class="fa fa-times"></i>KTP</li>
                <li><i class="fa fa-times"></i>NPWP</li>
              </ul><a href="<?php echo base_url().'register';?>" class="btn btn-template-outlined">Daftar</a>
            </div>
          </div>
          <!-- / END FIRST PACKAGE-->
          <div class="col-md-4">
            <div class="package">
              <div class="package-header light-gray">
                <div class="content">
                  <h5>Rp 5.000.000,-</h5>
                </div>
              </div>
              <div class="price-container d-flex align-items-end justify-content-center">
                <h4 class="h1"><span class="currency">Rp </span>500.000</h4><span class="period">/ bulan</span>
              </div>
              <ul class="list-unstyled">
                <li><i class="fa fa-check"></i>No Rekening</li>
                <li><i class="fa fa-check"></i>Foto</li>
                <li><i class="fa fa-check"></i>KTP</li>
                <li><i class="fa fa-times"></i>NPWP</li>
              </ul><a href="<?php echo base_url().'register';?>" class="btn btn-template-outlined">Daftar</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="package">
              <div class="package-header light-gray">
                <h5>Rp 10.000.000,-</h5>
              </div>
              <div class="price-container d-flex align-items-end justify-content-center">
                <h4 class="h1"><span class="currency">Rp </span>1.000.000</h4><span class="period">/ bulan</span>
              </div>
              <ul class="list-unstyled">
                <li><i class="fa fa-check"></i>No Rekening</li>
                <li><i class="fa fa-check"></i>Foto</li>
                <li><i class="fa fa-check"></i>KTP</li>
                <li><i class="fa fa-check"></i>NPWP</li>
              </ul><a href="<?php echo base_url().'register';?>" class="btn btn-template-outlined">Daftar</a>
            </div>
          </div>
        </div>
        <!-- Packages End-->
      </div>
    </div>
  </div>
</section>
<?php $this->load->view('include/footer'); ?>