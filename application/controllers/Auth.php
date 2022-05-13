<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if (empty($this->session->userdata('uid'))) {
			$this->load->view('login_view');
		}else{
		    redirect('dashboard');
		}
	}

	public function register()
	{
		$this->load->view('register_view');
	}

	public function register_proses()
	{
		$nama_depan 	= $this->input->post('nama_depan', true);
		$nama_belakang 	= $this->input->post('nama_belakang', true);
		$email 			= $this->input->post('email', true);
		$password 		= $this->input->post('password', true);
		$password2 		= $this->input->post('password2', true);

		//cek isian form
		if(empty($nama_depan) || empty($nama_belakang) || empty($email) || empty($password) || empty($password2)){
            echo json_encode(array('status' => false, 'msg' => 'Periksa isian form, pastikan form terisi dengan benar'));
            exit();
		}

		//cek email
		$cekEmail = explode('@', $email);
		if(count($cekEmail) != 2){
            echo json_encode(array('status' => false, 'msg' => 'Penulisan email tidak benar'));
            exit();
		}else if($cekEmail[1] != 'rumahweb.co.id'){
            echo json_encode(array('status' => false, 'msg' => 'Email hanya dibolehkan menggunakan @rumahweb.co.id'));
            exit();
		}

		//cek password
		if($password != $password2){
            echo json_encode(array('status' => false, 'msg' => 'Password tidak sama'));
            exit();
		}

	    $cekPass = $this->checkPassword($password);
	    if($cekPass != 'oke'){
            echo json_encode(array('status' => false, 'msg' => $cekPass));
            exit();
	    }

	    $dataSave = [
	    	'firstName' => $nama_depan,
	    	'lastName' 	=> $nama_belakang,
	    	'email' 	=> $email,
	    ];
	    $insert_dummyapi = $this->restclient->regApi('POST','user/create',$dataSave);
	    // pr($insert_dummyapi);
	    if(isset($insert_dummyapi['error'])){
	    	if(isset($insert_dummyapi['data']['email'])){
	            echo json_encode(array('status' => false, 'msg' => $insert_dummyapi['data']['email']));
	            exit();
	    	}else{
	            echo json_encode(array('status' => false, 'msg' => 'Terjadi kesalahan, silahkan coba lagi'));
	            exit();
	    	}
	    }

	    $fileSave = file_get_contents(base_url('user.json'));
	    $dataList = json_decode($fileSave, true);
	    $dataList["records"] = array_values($dataList["records"]);
	    $dataSave['password'] = $password;
	    $dataSave['uid'] = $insert_dummyapi['id'];
	    array_push($dataList["records"], $dataSave);
	    file_put_contents("user.json", json_encode($dataList));
	    echo json_encode(array('status' => true, 'msg' => 'Registrasi berhasil, silahkan login untuk masuk ke sistem'));
	}

	private function checkPassword($pwd) 
	{
		$err = 'okey';
		//cek jumlah
	    if (strlen($pwd) < 12) {
	        $err = 'error';
	    }
	    //cek angka
	    if (!preg_match("#[0-9]+#", $pwd)) {
	        $err = 'error';
	    }
	    //cek kapital
	    if (!preg_match("/[A-Z]/", $pwd)) {
	        $err = 'error';
	    } 
	    // cek nonalfabet
	    if (!preg_match("/\W/", $pwd)) {
	        $err = 'error';
	    }     

	    if($err == 'error'){
	    	$result = 'Password minimal 12 karakter terdiri dari huruf besar, kecil dan angka, serta nonalfabet';
	    }else{
	    	$result = 'oke';
	    }

	    return $result;
	}

	function test(){
	    $fileSave = file_get_contents(base_url('user.json'));
	    $dataList = json_decode($fileSave, true);
	    $dataList["records"] = array_values($dataList["records"]);
	    $a = searchArrayVal('email','rizki.febrianto@rumahweb.co.id',$dataList["records"]);
	    pr($a);
	}

	public function login_proses()
	{
		$email = $this->input->post('email', true);
		$password = $this->input->post('pass', true);

	    $fileSave = file_get_contents(base_url('user.json'));
	    $dataList = json_decode($fileSave, true);
	    $dataList["records"] = array_values($dataList["records"]);
	    $cekEmail = searchArrayVal('email',$email,$dataList["records"]);
	    if(!$cekEmail){
            echo json_encode(array('status' => false, 'msg' => 'Email belum terdaftar'));
            exit();
	    }

	    if($cekEmail['password'] != $password){
            echo json_encode(array('status' => false, 'msg' => 'Password salah'));
            exit();
	    }

        $userdata = array(
          'uid'     => $cekEmail['uid'],
          'email'   => $cekEmail['email'],
        );
        $this->session->set_userdata($userdata);
        echo json_encode(array('status' => true, 'msg' =>'login success','link'=>base_url('dashboard')));
	}

	public function logout()
	{
	    $this->session->sess_destroy();
	    redirect(base_url(), 'refresh');
	}
}
