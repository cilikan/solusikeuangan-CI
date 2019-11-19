<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {
    function ubah($tabel,$where,$id,$data)
    {
        $this->db->where($where,$id);
        $this->db->update($tabel,$data);
    }

    function daftarkan($tabel,$data)
    {
        $this->db->insert($tabel,$data);
    }
}
