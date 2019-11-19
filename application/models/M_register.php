<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_register extends CI_Model {
    function daftarkan($tabel,$data)
    {
        $this->db->insert($tabel,$data);
    }

    function get_select($tabel,$select,$field,$where)
    {
        $this->db->select($select);
        return $this->db->get_where($tabel, array($field => $where));
    }
}
