<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once './vendor/autoload.php';
use Phpml\Classification\KNearestNeighbors;
use Phpml\Dataset\CsvDataset;
use Phpml\CrossValidation\RandomSplit;
use Phpml\Metric\Accuracy;
use Phpml\Metric\ConfusionMatrix;

class Prediksi extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
		$this->load->model("siswa_model");
        $this->load->model("normalisasi_model");
        $this->load->model("hasil_model");
        $this->load->model("bobot_model");
		$this->load->library('form_validation');
        if($this->session->userdata('nama') != "admin"){
            redirect(base_url("login"));
        }
	}

	public function index()
	{
        // load view admin/overview.php
		$hasil = $this->hasil_model;
		$bobot = $this->bobot_model;
		$data['hasil'] = $hasil->getDesc();
		$data['bobot'] = $bobot->getAll();
        $this->load->view("admin/v_prediksi", $data);
	}

	public function redirect()
	{
        redirect(site_url('admin/prediksi'));
	}

	public function upload()
    {
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'csv';
        $config['file_name']            = 'dataSiswa.csv';
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', 'Proses Upload Gagal <br> Format file salah');
        }
        
        else {
            if ($this->validasiCSV('dataSiswa.csv') != 0)
            {
                $this->session->set_flashdata('error', 'Silahkan Upload file lain <br> Data tidak lengkap');
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('success', 'Data Berhasil Diupload');
            }
        }
        redirect(site_url('admin/prediksi'));
        
    }

    public function validasiCSV($target_file)
    {
        $empty = 0;
        $row = 1;
        if (($handle = fopen("./upload/$target_file", "r")) !== FALSE)
        {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
            {
                $num = count($data);
                $row++;
                for ($c=0; $c < $num; $c++) 
                {
                    if ($data[$c] == null)
                    {
                        $empty++;
                    }
                }
            }
        fclose($handle);
        }
        return $empty;
	}
	
	public function update()
	{
		$bobArr = array_slice($_POST, 0, 6);
		$bobot_model = $this->bobot_model;
		foreach ($bobArr as $kriteria => $bobot) {
			$bobot /= 100;
			$bobot_model->update($kriteria, $bobot);
		}
		
		$this->session->set_flashdata('success', 'Proses Update Bobot Berhasil');
		redirect(site_url('admin/prediksi'));
		
	}

	public function rekomendasi()
    {
        if ($this->validasiCSV('model/dataModel.csv') != 0 || $this->validasiCSV('dataSiswa.csv') != 0)
        {
            $this->session->set_flashdata('error', 'Proses Kalkulasi Gagal <br> Terdapat kesalahan di Data Model atau Data Siswa');
        }
        else {
            $k = 1;
            $persentase = 0.9;
            $statusKnn = "";
            $model = new CsvDataset('./upload/model/dataModel.csv', 6, true, ',');
            $dataset = new CsvDataset('./upload/dataSiswa.csv', 6, true, ',');
            $dataset_nis = new CsvDataset('./upload/dataSiswa.csv', 7, true, ',');
            
            $nis = $dataset_nis->getTargets();
            $this->session->set_userdata('nis', $nis);

            $samples = $model->getSamples();
            $targets = $model->getTargets();
            $this->session->set_userdata('model_samples', $samples);
            $this->session->set_userdata('model_targets', $targets);

            $test = $dataset->getSamples();
            $actualTargets = $dataset->getTargets();
            $this->session->set_userdata('dataset', $test);
            $this->session->set_userdata('actualTargets', $actualTargets);

            //KLASIFIKASI KNN
            $classifier = new KNearestNeighbors($k);
            $classifier->train($samples, $targets);
            $predicted = $classifier->predict($test);
            $this->session->set_userdata('predicted', $predicted);
            $confusionMatrix = ConfusionMatrix::compute($actualTargets, $predicted, ['TIDAK', 'BERPRESTASI']);
            $this->session->set_userdata('confMat', $confusionMatrix);

            $testMat = [
                ['atas kiri', 'atas kanan'],
                ['bawah kiri', "bawah kanan"],
            ];
            $this->session->set_userdata('testMat', $testMat);

            $acc = Accuracy::score($actualTargets, $predicted);
            $this->session->set_userdata('acc', $acc);
           
            $i = 0;
            foreach ($nis as $index => $nis_x) {
                if ($predicted[$index] != "BERPRESTASI") {
                    continue;
               }
                $insert[$i++] = array(
                    "nis"    => $nis_x,
                    "poin"   => $test[$index][0],
                    "n1"     => $test[$index][1],
                    "n2"     => $test[$index][2],
                    "n3"     => $test[$index][3],
                    "n4"     => $test[$index][4],
                    "n5"     => $test[$index][5],
                    "status" => $predicted[$index]
                );
            }
            $knn = $this->siswa_model;
            $this->session->set_userdata('insert awal', $insert);
            echo "---------------------------------------------------";
            $knn->save($insert, $i);

            //NORMALISASI SAW
            $data = $knn->getAll();
            $max = $knn->getMax();
            
            $i = 0;
            foreach ($data as $item) {
                $insert[$i++] = array(
                    "nis"    => $item['NIS'],
                    "norPOIN"   => $item['POIN']/$max[0]['poin'],
                    "norN1"     => $item['N1']/$max[0]['n1'],
                    "norN2"     => $item['N2']/$max[0]['n2'],
                    "norN3"     => $item['N3']/$max[0]['n3'],
                    "norN4"     => $item['N4']/$max[0]['n4'],
                    "norN5"     => $item['N5']/$max[0]['n5']
                );
            }
            $normal = $this->normalisasi_model;
            $this->session->set_userdata('normalisasi', $insert);
            echo "---------------------------------------------------";
            $normal->save($insert, $i);        

            //PERHITUNGAN NILAI PREFERENSI
            $data_normal = $normal->getAll();
            $bobot = $this->bobot_model;
            $bob['n1'] = $bobot->getBobot('bobN1');
            $bob['n2'] = $bobot->getBobot('bobN2');
            $bob['n3'] = $bobot->getBobot('bobN3');
            $bob['n4'] = $bobot->getBobot('bobN4');
            $bob['n5'] = $bobot->getBobot('bobN5');
            $bob['poin'] = $bobot->getBobot('bobPOIN');

            $i = 0;
            foreach ($data_normal as $item) {
                $insert[$i++] = array(
                    "nis"    => $item['NIS'],
                    "nilai_peringkat"   =>   $item['norPOIN']*$bob['poin'][0]['bobot']+
                                    $item['norN1']*$bob['n1'][0]['bobot']+
                                    $item['norN2']*$bob['n2'][0]['bobot']+
                                    $item['norN3']*$bob['n3'][0]['bobot']+
                                    $item['norN4']*$bob['n4'][0]['bobot']+
                                    $item['norN5']*$bob['n5'][0]['bobot']
                                    );
            }
            $hasil = $this->hasil_model;
            $this->session->set_userdata('hasil', $insert);
            echo "---------------------------------------------------";
            $hasil->save($insert, $i);
            //$data['hasil'] = $hasil->getDesc();
            $this->session->set_flashdata('prediksi', 'Proses Rekomendasi Siswa Berhasil dengan akurasi sebesar '.$acc);
        }
        
        redirect(site_url('admin/prediksi'));
	}
	
}
