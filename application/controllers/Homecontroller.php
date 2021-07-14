<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homecontroller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Home_model','home');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data = $this->home->getTitles();
		$this->load->view('templates/header',array('title'=>'Lyrics PH','content'=>$data));
		$this->load->view('pages/home');
		$this->load->view('templates/footer');
	}

	public function login(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}

		$data = $this->home->loginGetAccount($this->input->post());
		if($data){
			$this->session->set_userdata('email', $data[0]->email);
			$this->session->set_userdata('username', $data[0]->username);
			$this->session->set_userdata('user_id', $data[0]->id);
			$this->session->set_userdata('fname', $data[0]->fname);
			$this->session->set_userdata('sname', $data[0]->sname);
			$this->session->set_userdata('gender', $data[0]->gender);
			$this->session->set_userdata('fullname', $data[0]->fname.' '.$data[0]->sname);
			echo json_encode(array('status'=>true));
		}else{
			$this->session->sess_destroy();
			echo json_encode(array('status'=>false));
		}
	}

	public function registerAccount(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->form_validation->set_rules('fname','<b>First Name</b>','required');
		$this->form_validation->set_rules('sname','<b>Last Name</b>','required');
		$this->form_validation->set_rules('gender','<b>Gender</b>','required');
		$this->form_validation->set_rules('email','<b>Email Address</b>','required|valid_email|is_unique[useraccounts.email]');
		$this->form_validation->set_rules('password','<b>Password</b>','trim|required');
		$this->form_validation->set_rules('confirmpassword','<b>Password Confirmation</b>','required|matches[password]');
		if($this->form_validation->run()){
			$data1 = array(
				'fname'=>$this->input->post('fname'),
				'sname'=>$this->input->post('sname'),
				'gender'=>$this->input->post('gender')
			);

			$data2 = array(
				'username'=>strtolower(substr($this->input->post('fname'),0,1).substr($this->input->post('sname'),1,2).$this->input->post('sname')),
				'password'=>md5($this->input->post('password')),
				'email'=>$this->input->post('email')
			);

			$data1['user_id'] =  $this->home->registerUserAccount($data2);
			$this->home->registerUserDetails($data1);
			echo json_encode(array('status' => TRUE, 'data1'=>$data1, 'data2'=>$data2));
		}else{
			$feedback_data = array(
				'status' => false,
				'err_msg' => validation_errors('<div class="alert alert-danger">','</div>')
			);
			echo json_encode($feedback_data);
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('');
	}

	public function viewSong($title){
		$data = $this->home->getSong(urldecode($title));
		// echo json_encode($data);
		if($data){
			$this->home->addViews($data[0]->id);
			$this->load->view('templates/header',array('title'=>urldecode($title).' | Lyrics PH','sect_title'=>urldecode($title),'content'=>$data));
			$this->load->view('pages/showsong');
			$this->load->view('templates/footer');
		}else{
			Redirect(base_url(), false);
		}

	}

	public function searchResult($page = 0){
		$searchValue = '';
		if(isset($_GET['search'])){
			$searchValue = $_GET['search'];
		}
		$currentpage = 0;
		if(isset($_GET['page'])){
			$page = $_GET['page'];
			$currentpage = $_GET['page'];
		}
		$searchCount = $this->home->searchCount($searchValue);
		$data = $this->home->searchLyrics($searchValue,$page);
		$page++;

		$this->load->view('templates/header',array('title'=>'Search Result for '.$searchValue.' | Lyrics PH','sect_title'=>'Search Result for '.$searchValue,'content'=>$data, 'searchValue'=> $searchValue, 'currentpageValue'=>$currentpage ,'nextpageValue'=>$page, 'searchCount'=>$searchCount));
		$this->load->view('pages/searchresult');
		$this->load->view('templates/footer');
	}



}
