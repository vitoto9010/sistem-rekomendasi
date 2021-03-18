<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    private $_table = "saw_proto1";

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getMax()
    {
        $this->db->select_max('poin');
        $this->db->select_max('n1');
        $this->db->select_max('n2');
        $this->db->select_max('n3');
        $this->db->select_max('n4');
        $this->db->select_max('n5');
        $query = $this->db->get('saw_proto1');
        return $query->result_array();
    }

    public function save($insert, $i)
    {
        // echo '<pre>';
        // print_r($insert);
        // echo '</pre>';

        $this->db->truncate($this->_table);
        for ($j=0; $j < $i; $j++)
        {
            $this->db->insert($this->_table, $insert[$j]);
        }
    }
}