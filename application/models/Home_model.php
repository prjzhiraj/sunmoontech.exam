<?php

class Home_model extends CI_Model
{


	public function __construct()
	{
		parent::__construct();

	}

	public function getTitles(){
		$query = $this->db->select('*')->from('lyrics_tbl')->limit(8)->get();
		return ($query->num_rows()>0) ? $query->result() : false;
	}

    public function loginGetAccount($data){
    	$query = $this->db->select('ua.*, ue.fname, ue.sname, ue.gender')->from('useraccounts ua')->join('userdetails ue','ue.id = ua.id')->where('email like',$data['email'])->or_where('username like',$data['email'])->where('password like',md5($data['password']))->get();
    	return ($query->num_rows()>0) ? $query->result() : false;
    }

    public function getSong($title){
    	$query = $this->db->select('lt.*, unix_timestamp(lt.date_created) as unix_date_c, ud.fname, ud.sname')->from('lyrics_tbl lt')->join('userdetails ud','ud.user_id = lt.user_id')->where('lt.title like',$title)->get();
    	return ($query->num_rows()>0) ? $query->result() : false;
    }

    public function searchLyrics($value){
    	$query = $this->db->select('lt.*,ud.*')->from('lyrics_tbl lt')->join('userdetails ud','ud.user_id = lt.user_id')->like('lt.title',$value)->or_like('lt.artist',$value)->or_like('lt.album',$value)->get();
    	return ($query->num_rows()>0) ? $query->result() : false;
    }

    public function registerUserAccount($data){
    	$this->db->insert('useraccounts',$data);
    	return $this->db->insert_id();
    }

    public function registerUserDetails($data){
    	$this->db->insert('userdetails',$data);
    	return true;
    }

    public function addViews($id){
    	$this->db->where('id',$id)->set('views','views+1',false)->update('lyrics_tbl');
    }
}