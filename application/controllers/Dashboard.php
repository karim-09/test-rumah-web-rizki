<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Admin
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'Dashboard';

        if (!empty($this->input->get('page',true))) {
            $page = $this->input->get('page',true);
        } else {
            $page = 1;
        };

        $limit = 10;
		$data['dt_list'] = [];
		$data['pages'] = [];
		$get_dummyapi = $this->restclient->regApi('GET','user?limit='.$limit.'&page='.$page);
		if($get_dummyapi){
			$totalData = !empty($get_dummyapi['total'])?$get_dummyapi['total']:0;
			$pages_total = ceil($totalData/$limit)-1;
			$data['dt_list'] = $get_dummyapi['data'];
	        $data['pages'] = [
	        	'count' 		=> $limit,
	        	'count_total' 	=> $totalData,
	        	'pages' 		=> $page,
	        	'pages_total' 	=> $pages_total,
	        ];
		}
        $data['page'] = $page;
		$this->render_page('dashboard_view', $data);
	}

	public function insert()
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
	    echo json_encode(array('status' => true, 'msg' => 'Data berhasil disimpan'));
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

	public function edit()
	{
        $id = $this->uri->segment(3);
        $edit = $this->restclient->regApi('GET','user/'.$id);
        if($edit){
            $data = array(
                'status'    => true,
                'id'        => $edit['id'],
                'firstName' => $edit['firstName'],
                'lastName' 	=> $edit['lastName'],
                'email' 	=> $edit['email'],
            );
        }else{
            $data = array('status' => false);
        }
        echo json_encode($data);
	}

	public function update()
	{
		$data_id 		= $this->input->post('data_id', true);
		$nama_depan 	= $this->input->post('nama_depan', true);
		$nama_belakang 	= $this->input->post('nama_belakang', true);
		$password 		= $this->input->post('password', true);
		$password2 		= $this->input->post('password2', true);

		//cek isian form
		if(empty($nama_depan) || empty($nama_belakang)){
            echo json_encode(array('status' => false, 'msg' => 'Periksa isian form, pastikan form terisi dengan benar'));
            exit();
		}

		if(!empty($password) || !empty($password2)){
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
		}

	    $dataSave = [
	    	'firstName' => $nama_depan,
	    	'lastName' 	=> $nama_belakang,
	    ];
	    $update_dummyapi = $this->restclient->regApi('PUT','user/'.$data_id,$dataSave);
	    if(isset($update_dummyapi['id'])){

		    $fileSave = file_get_contents(base_url('user.json'));
		    $dataList = json_decode($fileSave, true);
		    $dataList["records"] = array_values($dataList["records"]);
		    $cekUser = searchArrayKey('uid',$update_dummyapi['id'],$dataList["records"]);
		    if($cekUser){
			    $dataSave['email'] = $update_dummyapi['email'];
			    $dataSave['password'] = !empty($password)?$password:$dataList["records"][$cekUser]['password'];
			    $dataSave['uid'] = $update_dummyapi['id'];

		    	unset($dataList["records"][$cekUser]);
		    	$dataList["records"][$cekUser] = $dataSave;
		    	$dataList["records"] = array_values($dataList["records"]);
			    file_put_contents("user.json", json_encode($dataList));
		    }
	    }
	    
	    echo json_encode(array('status' => true, 'msg' => 'Data berhasil disimpan'));
	}

    public function delete()
    {
        $id = $this->input->post('id',TRUE);
        $delete_dummyapi = $this->restclient->regApi('delete','user/'.$id);
	    if(isset($delete_dummyapi['error'])){
	    	if(isset($delete_dummyapi['error'])){
	            echo json_encode(array('status' => false, 'msg' => $delete_dummyapi['error']));
	            exit();
	    	}else{
	            echo json_encode(array('status' => false, 'msg' => 'Terjadi kesalahan, silahkan coba lagi'));
	            exit();
	    	}
	    }

	    $fileSave = file_get_contents(base_url('user.json'));
	    $dataList = json_decode($fileSave, true);
	    $dataList["records"] = array_values($dataList["records"]);
	    $cekUser = searchArrayKey('uid',$delete_dummyapi['id'],$dataList["records"]);
	    if($cekUser){
	    	unset($dataList["records"][$cekUser]);
	    	$dataList["records"] = array_values($dataList["records"]);
		    file_put_contents("user.json", json_encode($dataList));
	    }
        echo json_encode(array('status' => true, 'msg' => 'Data berhasil dihapus.'));
    }
}