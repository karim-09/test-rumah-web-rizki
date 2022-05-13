<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('uid'))) {
			redirect(base_url());
		}else{
		    $uid = $this->session->userdata('uid');
		    $fileSave = file_get_contents(base_url('user.json'));
		    $dataList = json_decode($fileSave, true);
		    $dataList["records"] = array_values($dataList["records"]);
		    $cekUser = searchArrayVal('uid',$uid,$dataList["records"]);

		    if(!$cekUser){
		    	redirect(base_url());
		    	$this->session->sess_destroy();
		    }
		}
		$this->get_profil = $cekUser;
	}

	function render_page($content, $data = NULL)
	{
		$data['header'] = $this->load->view('components/header', $data, TRUE);
		$data['js'] = $this->load->view('components/js', $data, TRUE);
		$data['nav'] = $this->load->view('components/nav', $data, TRUE);
		$data['sidebar'] = $this->load->view('components/sidebar', $data, TRUE);
		$data['content'] = $this->load->view($content, $data, TRUE);
		$data['footer'] = $this->load->view('components/footer', $data, TRUE);

		$this->load->view('components/index', $data);
	}
}
