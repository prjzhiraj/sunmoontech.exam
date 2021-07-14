<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accountcontroller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if($this->session->userdata('user_id')){
			$this->load->model('Home_model','home');
			$this->load->model('Account_model','account');
		}else{
			redirect('');
			exit();
		}
	}

	public function mylyrics()
	{
		$data1 = $this->account->getMostViewed();
		$data2 = $this->account->getAllSongs();
		$this->load->view('templates/header',array('title'=>'My Lyrics | Lyrics PH','sect_title'=>'My Lyrics','songs'=>['mostviewed'=>$data1, 'allsongs'=>$data2]));
		$this->load->view('pages/mylyrics');
		$this->load->view('templates/footer');
	}

	public function refreshSongList(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$data = $this->account->getAllSongs();
		echo json_encode($data);
	}

	public function editSong(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$data = $this->account->getSelectedSongs($this->input->post('id'));
		echo json_encode($data);
	}

	public function deleteLyrics(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$data = $this->account->deleteLyrics($this->input->post('id'));
		echo true;
	}

	public function updateLyrics(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->form_validation->set_rules('title','<b>Song Title</b>','trim|required');
		$this->form_validation->set_rules('artist','<b>Artist</b>','trim|required');
		$this->form_validation->set_rules('lyrics','<b>Lyrics Content</b>','trim|required');
		if($this->form_validation->run()){
			$data = $this->input->post();
			if(!$data['album'])
				unset($data['album']);
			// $data['user_id'] = $this->session->userdata('user_id');
			$this->account->updateLyrics($data);
			echo json_encode(array('status' => TRUE, 'data'=>$data));
		}else{
			$feedback_data = array(
				'status' => false,
				'err_msg' => validation_errors('<div class="alert alert-danger">','</div>')
			);
			echo json_encode($feedback_data);
		}
	}

	public function saveNewLyrics(){
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->form_validation->set_rules('title','<b>Song Title</b>','trim|required');
		$this->form_validation->set_rules('artist','<b>Artist</b>','trim|required');
		$this->form_validation->set_rules('lyrics','<b>Lyrics Content</b>','trim|required');
		if($this->form_validation->run()){
			$data = $this->input->post();
			if(!$data['album'])
				unset($data['album']);
			$data['user_id'] = $this->session->userdata('user_id');
			$this->account->saveNewLyrics($data);
			echo json_encode(array('status' => TRUE, 'data'=>$data));
		}else{
			$feedback_data = array(
				'status' => false,
				'err_msg' => validation_errors('<div class="alert alert-danger">','</div>')
			);
			echo json_encode($feedback_data);
		}
	}

	public function profile()
	{
		$this->load->view('templates/header',array('title'=>'Profile | Lyrics PH','sect_title'=>'Profile'));
		$this->load->view('pages/profile');
		$this->load->view('templates/footer');
	}

}
