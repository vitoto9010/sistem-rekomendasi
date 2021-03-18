<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Normalisasi_model extends CI_Model
{
    private $_table = "proto1_normal";

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
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