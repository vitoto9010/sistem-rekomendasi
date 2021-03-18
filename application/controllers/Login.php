<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
require_once './vendor/autoload.php';


class Login extends CI_Controller{
 
	public function __construct(){
		parent::__construct();		
		$this->load->model('login_model');
 
	}
 
	public function index(){
		$this->load->view('v_login');
	}
 
	public function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => $password
			);
		$cek = $this->login_model->cek_login("admin",$where)->num_rows();
		if($cek > 0){
			if ($username != 'admin') {
				$url = "/admin/siswa/$username";
				$modal = "modal";	
				$target = "#deniedModal";
			}
			else {
				$url = "/admin";
				$modal = "";	
				$target = "";
			}
			$data_session = array(
				'nama' 		=> $username,
				'status' 	=> "login",
				'modal'		=> $modal,
				'target'	=> $target
				);
 
			$this->session->set_userdata($data_session);
			redirect(base_url($url));
 
		} else {
            $this->session->set_flashdata('error', 'Username atau password salah !');
			redirect(base_url('login'));
		}
	}
 
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}