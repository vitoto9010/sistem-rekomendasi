<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_model extends CI_Model
{

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getData($table ,$id)
    {

        return $this->db->get_where($table, ["NIS" => $id])->result_array();
        
    }

}