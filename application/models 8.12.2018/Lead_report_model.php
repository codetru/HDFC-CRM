<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead_report_model extends CI_Model {
	public function __construct()
  	{
      	parent::__construct();
  	}
  	var $table = 'tbllead';
  	var $column_order = array(null, 'LeadNo','EmployeeName','CustomerName','BranchName','ProductType','PolicyNo');

  	var $column_search = array('LeadNo','EmployeeName','CustomerName','BranchName','ProductType','PolicyNo');

  	var $order = array('LeadNo' => 'desc');

  	private function _get_datatables_query()
    {
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if(empty($_POST['search']['value']) === false && $_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables($fromDate, $toDate,$empCode,$userType)
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1 && empty($_POST['length']) === false) {
        	$this->db->limit($_POST['length'], $_POST['start']);
        } else {
        	$this->db->limit(50, $_POST['start']);
        }
    	$query = $this->db->where('created_at >', $fromDate)
				    		->where('created_at <', $toDate);
        if($userType=="1"){
            $this->db->where('EmployeeCode',$empCode);
        }
        
        $query = $this->db->get();
       // var_dump($this->db->last_query());
        return $query->result();
    }
}