<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userlogindetail_model extends CI_Model {
	public function __construct()
	{
	    parent::__construct();
	   
	}

	public function findByEmployeeMasterId($empMasterId) {
		$this->db->from('tbluserlogindetails'); 
        $this->db->where('employee_master_id', $empMasterId);
        $query = $this->db->get();
        return $query->result();
	}
}