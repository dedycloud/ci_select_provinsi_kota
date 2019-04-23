<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('ProvinsiModel');
		$this->load->model('KotaModel');
	}

	public function index(){
		$data['provinsi'] = $this->ProvinsiModel->view();
		
		$this->load->view('form', $data);
	}
	
	public function listKota(){
		// Ambil data ID Provinsi yang dikirim via ajax post
		$id_provinsi = $this->input->post('id_provinsi');
		
		$kota = $this->KotaModel->viewByProvinsi($id_provinsi);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>Pilih</option>";
		
		foreach($kota as $data){
			$lists .= "<option value='".$data->id."'>".$data->nama."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('list_kota'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
}
