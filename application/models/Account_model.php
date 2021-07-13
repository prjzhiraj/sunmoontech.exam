<?php

class Account_model extends CI_Model
{


	public function __construct()
	{
		parent::__construct();

	}

	public function getMostViewed(){
		$query = $this->db->select('*,unix_timestamp(date_created) as unix_date_c')->from('lyrics_tbl')->where('user_id',$this->session->userdata('user_id'))->limit(4)->order_by('views','DESC')->get();
		return ($query->num_rows()>0) ? $query->result() : false;
	}

	public function getAllSongs(){
		$query = $this->db->select('*,unix_timestamp(date_created) as unix_date_c')->from('lyrics_tbl')->where('user_id',$this->session->userdata('user_id'))->order_by('date_created','asc')->get();
		return ($query->num_rows()>0) ? $query->result() : false;
	}

	public function saveNewLyrics($data){
		$this->db->insert('lyrics_tbl',$data);
	}

	public function updateLyrics($data){
		$this->db->where('id',$data['id'])->update('lyrics_tbl',$data);
	}

	public function getSelectedSongs($id){
		$query = $this->db->select('*')->from('lyrics_tbl')->where('id',$id)->get();
		return ($query->num_rows()>0) ? $query->result() : false;
	}

	public function deleteLyrics($id){
		$this->db->where('id',$id)->delete('lyrics_tbl');
	}

}