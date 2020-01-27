<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employeemaster_model extends CI_Model {
	public function __construct()
	{
	    parent::__construct();
	   
	}

	public function findById($id) {
		//var_dump($id);die();
		$this->db->from('tblmaster'); 
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
	}
}