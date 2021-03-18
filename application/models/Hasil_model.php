<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_model extends CI_Model
{
    private $_table = "proto1_hasil";

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["product_id" => $id])->row();
    }

    public function getDesc()
    {
        $this->db->from($this->_table);
        $this->db->order_by("nilai_peringkat", "desc");
        $query = $this->db->get(); 
        return $query->result_array();
    }

    public function save($insert, $i)
    {
        // echo '<pre>';
        // echo '---------------------------INSERT--------------------<br>';
        // print_r($insert);
        // echo '</pre>';

        $this->db->truncate($this->_table);

        for ($j=0; $j < $i; $j++)
        {
            $this->db->insert($this->_table, $insert[$j]);
        }
    }
}