<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bobot_model extends CI_Model
{
    private $_table = "proto1_bobot";

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getBobot($id)
    {
        $this->db->select('bobot');
        $this->db->where('kriteria', $id);
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }
    
    public function save($insert, $i)
    {
        echo '<pre>';
        print_r($insert);
        echo '</pre>';
        
        $this->db->truncate($this->_table);
        for ($j=1; $j < $i; $j++)
        {
            $this->db->insert($this->_table, $insert[$j]);
        }
	}
	
	public function update($id, $insert)
	{
		$this->db->set('bobot', $insert);
		$this->db->where('kriteria', $id);
		$this->db->update($this->_table); // gives UPDATE `_table` SET `bobot` = '$insert' WHERE `kriteria` = $id
	}
}

