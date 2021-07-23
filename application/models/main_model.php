<?php

class Main_model extends CI_Model {
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function insert_data($data)
	{
		$this->db->insert('tbl_user',$data);
	}
	public function fetch_data(){
		// $query = $this->db->get('tbl_user');
		$query = $this->db->query("SELECT * FROM `tbl_user` ORDER BY id DESC");
		return $query;
	}
	public function deleted_data($id){
		$this->db->query("DELETE FROM `tbl_user` WHERE `id`='$id'");
	}
	public function fetch_single_data($id){
		$query = $this->db->query("SELECT * FROM `tbl_user` WHERE `id`='$id'");
		return $query;
	}
	public function updated_data($data, $id){
		$firstname = $data['firstname'];
		$lastname = $data['lastname'];
		$query = $this->db->query("UPDATE `tbl_user` SET `firstname`='$firstname',`lastname`='$lastname' WHERE `id`='$id'");
	}
	//login
	public function can_login($username,$password){
		$query = $this->db->query("SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password'");
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
		// die();
	}

}
