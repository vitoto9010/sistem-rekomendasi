<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("detail_model");
    }

    public function view($nis)
    {
        $detail = $this->detail_model;
        $siswa = $detail->getData("siswa_data", $nis);
        $data['siswa'] = $siswa[0];

        //$data['smt1'] = $detail->getData("siswa_smt1", $nis);
        $smt1 = $detail->getData("siswa_smt1", $nis);
        $data['smt1'] = $smt1[0];

        $smt2 = $detail->getData("siswa_smt2", $nis);
        $data['smt2'] = $smt2[0];

        $smt3 = $detail->getData("siswa_smt3", $nis);
        $data['smt3'] = $smt3[0];

        $smt4 = $detail->getData("siswa_smt4", $nis);
        $data['smt4'] = $smt4[0];

        $smt5 = $detail->getData("siswa_smt5", $nis);
        $data['smt5'] = $smt5[0];

        //$data['title'] = $data['news_item']['title'];

        $this->load->view("admin/v_siswa", $data);
    }
}