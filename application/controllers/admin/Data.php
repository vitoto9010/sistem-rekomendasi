<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once './vendor/autoload.php';
use Phpml\Classification\KNearestNeighbors;
use Phpml\Dataset\CsvDataset;
use Phpml\CrossValidation\RandomSplit;
use Phpml\Metric\Accuracy;

class Data extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("siswa_model");
        $this->load->library('form_validation');
        if($this->session->userdata('nama') != "admin"){
            redirect(base_url("login"));
        }
    }

    public function index()
    {
		$data['model_data'] = $data['model_list'] = [];
		$data['model_title'] = "";
		$this->load->library('csvreader');
		
		if (count(scandir('./upload/model/')) > 2) { //if model file exist

			$data['model_list'] = array_slice(scandir('./upload/model/'), 2); 

			if (isset($_POST['pilihan_model']) && $_POST['action'] == 'Choose') { //if model dipilih
				$data['model_title'] = $model_current = $_POST['pilihan_model'];
			}
			else { //else pakai default model (model pertama yg ada di folder)
				$data['model_title'] = $model_current = scandir('./upload/model/')[2];
			}
			
			if (file_exists('./upload/model/'.$model_current)) { //proses mengambil data model
				$result =   $this->csvreader->parse_file('./upload/model/'.$model_current); //path to csv file
				$data['model_data'] =  $result;
			}
			else {
				$data['model_data'] = [];
			}

			
		}
		
        $this->load->view("admin/v_model", $data);
    }

    public function add()
    {
        $this->load->library('csvreader');
        $result =   $this->csvreader->parse_file('./upload/model/dataModel.csv');//path to csv file
        $data['csvData'] =  $result;
        $this->load->view("admin/product/new_form", $data);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/');
       
        $product = $this->siswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["product"] = $product->getById($id);
        if (!$data["product"]) show_404();
        
        $this->load->view("admin/product/edit_form", $data);
    }

    public function upload()
    {
        $config['upload_path']          = './upload/model/';
        $config['allowed_types']        = 'csv';
        $config['file_name']            = 'dataModel '.date("d-m-y H,i").'.csv';
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
            if ($this->validasiCSV() != 0)
            {
                $this->session->set_flashdata('error', 'Silahkan Upload file lain <br> Data tidak lengkap');
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('success', 'Data Berhasil Diupload');
            }
        }
        redirect(site_url('admin/data'));
        
    }

    public function validasiCSV()
    {
        $empty = 0;
        $row = 1;
        if (($handle = fopen("./upload/model/dataModel.csv", "r")) !== FALSE)
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

    public function download()
    {
        $this->load->helper('download');

        force_download('./upload/template_sistemRekomendasi.csv',NULL);
	}
	
	public function model()
	{
		if ($_POST['action'] == 'Choose') {
			$this->index();
		}
		
		else if ($_POST['action'] == 'Delete') {
			$file_dir = './upload/model/'.$_POST['pilihan_model'];

			if (!unlink($file_dir)) {  
				$this->session->set_flashdata('error', $file_dir.' cannot be deleted due to an error');
				$this->index();
			}  
			else {  
				$this->session->set_flashdata('success', $file_dir.'Data Berhasil Dihapus');
				$this->index();
			} 

		}
		
		// else {
		// 	redirect(site_url('admin/data'));
		// }
	}

	public function delete()
    {
		$id = $_POST[""];
        if (!isset($id)) show_404();
        
        if ($this->siswa_model->delete($id)) {
            redirect(site_url('admin/products'));
        }
    }
}
