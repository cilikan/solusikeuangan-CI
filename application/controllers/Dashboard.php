<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __Construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->model('M_dashboard');
    $this->load->library('session');

    //pengalihan jika sudah login
    if (!(isset($_SESSION['logged']))) {
      redirect('home');
    }

    //redirect jika admin yang login
    if ($_SESSION['email'] == 'admin@admin') {
      redirect('admin');
    }
  }

  //MENCARI BATAS PINJAMAN
  public function batas_pinjaman()
  {
    //ambil data dari database
    $user = $this->db->get_where('user', array('email' => $_SESSION['email']))->result_array();
    $syarat = $this->db->get_where('syarat', array('email' => $_SESSION['email']))->result_array();
    $email = $_SESSION['email'];

    // hitung batas pinjaman
    if ($user[0]['foto'] != null && $syarat[0]['syarat_foto'] == 1 && $user[0]['ktp'] != null && $syarat[0]['syarat_ktp'] == 1 && $user[0]['npwp'] != null && $syarat[0]['syarat_npwp'] == 1) {
      return 10000000;
    } else if ($user[0]['foto'] != null && $syarat[0]['syarat_foto'] == 1 && $user[0]['ktp'] != null && $syarat[0]['syarat_ktp'] == 1) {
      return 5000000;
    } else if ($user[0]['nama'] != null  &&  $user[0]['jenis_bank'] != null  &&  $user[0]['no_rekening'] != null) {
      return 1000000;
    } else {
      return 0;
    }
  }

  //MENCARI SISA PINJAMAN
  public function sisa_pinjaman()
  {
    $this->db->select('jumlah_pinjaman');
    $pinjaman = $this->db->get_where('pinjaman', array('email' => $_SESSION['email'], 'deleted' => 0))->result_array();
    $total_pinjaman = 0;
    foreach ($pinjaman as $p) {
      $total_pinjaman += $p['jumlah_pinjaman'];
    }
    return $this->batas_pinjaman() - $total_pinjaman;
  }

  //FUNGSI UPLOAD GAMBAR
  public function upload_gambar($nama, $user)
  {
    $filename = md5($nama . $user);
    $config['upload_path']          = './gambar/' . $nama . '/';
    $config['allowed_types']        = 'jpg|png';
    $config['max_size']             = '10000';
    $config['is_image']             = true;
    $config['overwrite']            = true;
    $config['file_name']            = $filename;
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    $configL['image_library'] = 'gd2';
    $configL['source_image']  = 'gambar/' . $nama . '/' . $filename . '.png';
    $configL['new_image']     = 'gambar/' . $nama . '/' . $filename . '.jpg';
    $configL['overwrite']      = true;
    $this->load->library('image_lib', $configL);
    $this->image_lib->resize();

    if ($this->upload->do_upload($nama)) {
      return $filename;
    } else {
      return NULL;
    }
  }

  //INDEX
  public function index()
  {
    $u = $this->db->get_where('user', array('email' => $_SESSION['email']))->result_array();
    //redirect jika belum melengkapi info
    if($u[0]['nama'] == null  ||  $u[0]['jenis_bank'] == null  || $u[0]['no_rekening'] == null){
      redirect('dashboard/akun','refresh');
    }

    $email = $_SESSION['email'];
    $pinjaman = $this->db->limit(5)->get_where('pinjaman', array('email' => $email, 'deleted' => 0))->result_array();
    $data = array(
      'pinjaman' => $pinjaman
    );
    $this->load->view('logged/dashboard', $data);
  }

  //AKUN
  public function akun()
  {
    //ambil data dari database
    $user = $this->db->get_where('user', array('email' => $_SESSION['email']))->result_array();
    $syarat = $this->db->get_where('syarat', array('email' => $_SESSION['email']))->result_array();
    $email = $_SESSION['email'];

    //apabila ada ubah data dan tambah foto
    if (isset($_POST['ubah'])) {
      $nama = $this->input->post('nama');
      $jenis_bank = $this->input->post('jenis_bank');
      $no_rekening = $this->input->post('no_rekening');
      if ($user[0]['foto'] == NULL) {
        $foto = $this->upload_gambar('foto', $email);
        $this->M_dashboard->ubah('user', 'email', $email, array('foto' => $foto));
        $this->M_dashboard->ubah('syarat', 'email', $email, array('syarat_foto' => '0'));
      }
      if ($user[0]['ktp'] == NULL) {
        $ktp = $this->upload_gambar('ktp', $email);
        $this->M_dashboard->ubah('user', 'email', $email, array('ktp' => $ktp));
        $this->M_dashboard->ubah('syarat', 'email', $email, array('syarat_ktp' => '0'));
      }
      if ($user[0]['npwp'] == NULL) {
        $npwp = $this->upload_gambar('npwp', $email);
        $this->M_dashboard->ubah('user', 'email', $email, array('npwp' => $npwp));
        $this->M_dashboard->ubah('syarat', 'email', $email, array('syarat_npwp' => '0'));
      }
      $data = array(
        'nama' => $nama,
        'jenis_bank' => $jenis_bank,
        'no_rekening' => $no_rekening,
      );
      $this->M_dashboard->ubah('user', 'email', $email, $data);
      redirect('dashboard/akun', 'refresh');
    }

    //apabila ganti password
    if (isset($_POST['ganti_password'])) {
      $password_lama = md5($this->input->post('password_lama'));
      $password1 = md5($this->input->post('password1'));
      $password2 = md5($this->input->post('password2'));
      $this->form_validation->set_rules('password1', 'Password', 'required');
      $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password1]');
      if ($password_lama == $user[0]['password']) {
        //apabila semua terpenuhi
        if ($this->form_validation->run() == TRUE) {
          $password_baru = array('password' => $password1);
          $this->M_dashboard->ubah('user', 'email', $email, $password_baru);
          $this->session->set_flashdata("terganti", "password telah diganti");
          redirect("dashboard/akun", "refresh");
        }
      } else {
        $this->session->set_flashdata('kesalahan', 'password salah');
        redirect("dashboard/akun", "refresh");
      }
    }

    $data = array(
      'user' => $user,
      'syarat' => $syarat,
      'batas_pinjaman' => $this->batas_pinjaman()
    );
    $this->load->view('logged/akun', $data);
  }

  //RIWAYAT PINJAMAN
  public function pinjaman()
  {
    $u = $this->db->get_where('user', array('email' => $_SESSION['email']))->result_array();
    //redirect jika belum melengkapi info
    if($u[0]['nama'] == null  ||  $u[0]['jenis_bank'] == null  || $u[0]['no_rekening'] == null){
      redirect('dashboard/akun','refresh');
    }
    //ambil data dari database
    $email = $_SESSION['email'];
    $pinjaman = $this->db->get_where('pinjaman', array('email' => $email, 'deleted' => 0))->result_array();
    $pinjaman_lainnya = $this->db->get_where('pinjaman', array('email' => $email, 'deleted' => 1))->result_array();
    $data = array(
      'pinjaman' => $pinjaman,
      'pinjaman_lainnya' => $pinjaman_lainnya,
      'batas_pinjaman' => $this->batas_pinjaman()
    );
    $this->load->view('logged/riwayat_pinjaman', $data);
  }

  //MENAMBAHKAN PINJAMAN BARU
  public function pinjam_baru()
  {
    //ambil data dari database
    $user = $this->db->get_where('user', array('email' => $_SESSION['email']))->result_array();
    $syarat = $this->db->get_where('syarat', array('email' => $_SESSION['email']))->result_array();
    $email = $_SESSION['email'];
    $batas_pinajaman = $this->sisa_pinjaman();

    //apabila klik pinjam
    if (isset($_POST['pinjam'])) {
      $jumlah_pinjaman = $_POST['jumlah_pinjaman'];
      $periode = $_POST['periode'];
      $keterangan = $_POST['keterangan'];
      if ($jumlah_pinjaman > $batas_pinajaman) {
        $this->session->set_flashdata('kesalahan', 'Batas pinjaman anda hanya Rp.' . number_format($batas_pinajaman));
        redirect("dashboard/pinjam_baru", "refresh");
      }
      //jika berhasil menambahkan pinjaman 
      else {
        $data_pinjaman = array(
          'email' => $email,
          'jumlah_pinjaman' => $jumlah_pinjaman,
          'periode' => $periode,
          'tanggal_pinjaman' => date("Y-m-d"),
          'status' => 0,
          'keterangan' => $keterangan
        );
        $this->M_dashboard->daftarkan('pinjaman', $data_pinjaman);
        redirect("dashboard/pinjaman", "refresh");
      }
    }

    $data = array(
      'user' => $user,
      'syarat' => $syarat
    );
    $this->load->view('logged/tambah_pinjaman', $data);
  }

  //DETAIL PINJAMAN
  public function detail_pinjaman($id)
  {
    $ada_detail = $this->db->get_where('pinjaman', array('id_pinjaman' => $id, 'email' => $_SESSION['email']))->num_rows();
    if ($ada_detail > 0) {
      $pinjaman_detail = $this->db->get_where('pinjaman', array('id_pinjaman' => $id, 'email' => $_SESSION['email']))->result_array();
      $jumlah_cicilan = $this->db->get_where('cicilan', array('id_pinjaman' => $id))->num_rows();
      $cicilan = $this->db->get_where('cicilan', array('id_pinjaman' => $id))->result_array();
      $data = array(
        'pinjaman_detail' => $pinjaman_detail,
        'cicilan' => $cicilan
      );
      $this->load->view('logged/detail_pinjaman', $data);
      if (isset($_POST['upload'])) {
        $id_cicilan = $_POST['id_cicilan'];
        $pembayaran = $this->upload_gambar('pembayaran', $id_cicilan);
        $this->M_dashboard->ubah('cicilan', 'id_cicilan', $id_cicilan, array('pembayaran' => $pembayaran));
        redirect('dashboard/detail_pinjaman/' . $id, 'refresh');
      }
    } else {
      redirect("dashboard/pinjaman", "refresh");
    }
  }

  //HAPUS
  public function hapus($id)
  {
    $this->M_dashboard->ubah('pinjaman', 'id_pinjaman', $id, array('deleted' => '1'));
    redirect("dashboard/pinjaman", "refresh");
  }
}
