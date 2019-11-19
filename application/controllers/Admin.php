<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_dashboard');

        //pengalihan ke home ketika tidak login
        if (!(isset($_SESSION['logged']))) {
            redirect('home');
        }
    }

    //INDEX
    public function index()
    {


        //apabila salah satu tombol diklik
        if (isset($_POST['tolak_semua']) || isset($_POST['proses'])) {
            $email = $_POST['email'];
            $user = $this->db->get_where('user', array('email' => $email))->result_array();
            //apabila klik tolak_semua
            if (isset($_POST['tolak_semua'])) {
                $aksi_foto = 0;
                $aksi_ktp = 0;
                $aksi_npwp = 0;
            } else if (isset($_POST['proses'])) {
                $aksi_foto = $_POST['aksi_foto'];
                $aksi_ktp = $_POST['aksi_ktp'];
                $aksi_npwp = $_POST['aksi_npwp'];
            }
            $data_syarat = array(
                'syarat_foto' => $aksi_foto,
                'syarat_ktp' => $aksi_ktp,
                'syarat_npwp' => $aksi_npwp
            );
            //var_dump($data_syarat);
            //JADIKAN SATU MODEL
            //mengubah syarat dari 0 jadi 1
            $this->m_dashboard->ubah('syarat', 'email', $email, $data_syarat);

            //apabila ada nilai 0 akan menghapus gambar
            if ($aksi_foto == 0 || $aksi_ktp == 0 || $aksi_npwp == 0) {
                if ($aksi_foto == 0) {
                    $user[0]['foto'] = NULL;
                }
                if ($aksi_ktp == 0) {
                    $user[0]['ktp'] = NULL;
                }
                if ($aksi_npwp == 0) {
                    $user[0]['npwp'] = NULL;
                }
                $this->m_dashboard->ubah('user', 'email', $email, array('foto' => $user[0]['foto'], 'ktp' => $user[0]['ktp'], 'npwp' => $user[0]['npwp']));
            }
            redirect('admin','refresh');
        }

        //AKSI PINJAMAN DIKLIK
        if (isset($_POST['aksi_pinjaman'])) {
            $id_pinjaman = $_POST['id_pinjaman'];
            $aksi_pinjaman = $_POST['aksi_pinjaman'];
            //apabila diterima
            if ($aksi_pinjaman == 1) {
                //mengubah status jadi 1 atau terverfikasi dan menambahkan data baru pada cicilan
                $this->m_dashboard->ubah('pinjaman', 'id_pinjaman', $id_pinjaman, array('status' => 1));
                $this->m_dashboard->daftarkan('cicilan', array('id_pinjaman' => $id_pinjaman));
            } else {
                //jika ditolak mengubah deleted menjadi 1
                $this->m_dashboard->ubah('pinjaman', 'id_pinjaman', $id_pinjaman, array('deleted' => 1));
            }
            redirect('admin','refresh');
        }

        //AKSI CICILAN DIKLIK
        if (isset($_POST['aksi_cicilan'])) {
            $id_cicilan = $_POST['id_cicilan'];
            $id_pinjaman = $_POST['id_pinjaman'];
            $aksi_cicilan = $_POST['aksi_cicilan'];
            //apabila diterima
            if ($aksi_cicilan == 1) {
                //mengubah status jadi 1 atau terverfikasi dan menambahkan data baru pada cicilan hingga batas periode
                //dan mengubah lunas jika akhir periode telah sampai
                $this->m_dashboard->ubah('cicilan', 'id_cicilan', $id_cicilan, array('status' => 1));
                $periode_terbayar = $this->db->get_where('cicilan', array('id_pinjaman' => $id_pinjaman))->num_rows();
                $this->db->select('periode');
                $periode_pinjaman  = $this->db->get_where('pinjaman', array('id_pinjaman' => $id_pinjaman))->result_array();
                if ($periode_terbayar == $periode_pinjaman[0]['periode']) {
                    $this->m_dashboard->ubah('pinjaman', 'id_pinjaman', $id_pinjaman, array('deleted' => 1));
                } else {
                    //jika belum lunas tambahkan data baru atau tagihan
                    $this->m_dashboard->daftarkan('cicilan', array('id_pinjaman' => $id_pinjaman));
                }
            } else {
                //jika ditolak menghapus bukti pembayaran
                $this->m_dashboard->ubah('cicilan', 'id_cicilan', $id_cicilan, array('pembayaran' => NULL));
            }
            redirect('admin','refresh');
        }
        //belum tambah refresh di semua
        $where_user = "foto != ''  OR ktp != '' OR npwp != ''";
        $user = $this->db->get_where('user', $where_user)->result_array();
        $pinjaman = $this->db->get_where('pinjaman', array('status' => 0, 'deleted' => 0))->result_array();
        $where_cicilan = "cicilan.status = 0 AND cicilan.pembayaran != '' AND pinjaman.status = 1 AND pinjaman.deleted = 0";
        // $this->db->select('*');
        // $this->db->from('cicilan');
        // $cicilan = $this->db->join('pinjaman', "cicilan.status = 0 AND cicilan.pembayaran != '' AND pinjaman.status = 1 AND pinjaman.deleted = 0");

        $cicilan = $this->db->query("SELECT * FROM cicilan JOIN pinjaman ON pinjaman.id_pinjaman = cicilan.id_pinjaman AND cicilan.status = 0 AND cicilan.pembayaran != '' ")->result_array();
        $data = array(
            'user' => $user,
            'pinjaman' => $pinjaman,
            'cicilan' => $cicilan
        );
        //echo '<pre>';var_dump($data);'</pre>';
        $this->load->view('logged/admin', $data);
    }
}
