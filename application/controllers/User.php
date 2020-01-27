<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
//hdfc admin details ans report generate
require_once APPPATH."third_party/PHPExcel.php";
require_once APPPATH."third_party/PHPExcel/IOFactory.php";
class User extends CI_Controller {

    function __construct()
	{ 
		//load all library and check login status
		//if not logged in redirect to login page 
		parent::__construct();
		$this->load->database();
		$this->load->model('lead_report_model');
		$this->load->library('session');
		$this->load->helper(array('url','language'));
		// $this->load->library('excel');
	}

	public function index()
	{
//no need this 
		//lead details
		$query = $this->db->select('id,StatusCode,ProductType,CustomerName,EmployeeCode,EmployeeName,BranchCode,BranchName,Premium,PolicyNo,LeadNo,Comment')->from('tbllead')
												//  ->order_by("id","desc")
												  ->get();
				  			$data['result']   = $query->result();


		$query = $this->db->select('*')->from('tblbranch');
		    						    $query = $this->db->get();
			   	 					    $data['branchdetails']  = $query->result();

		$query = $this->db->select('*')->from('tblemployee');
		    						    $query = $this->db->get();
			   	 					    $data['employeedetails']  = $query->result();
				  		
				  			$this->load->view('lead_details',$data);
		
	}

	public function edit(){
		$id    = $this->input->get('id',true);
		$query = $this->db->select('*')->from('tbllead')
		   								->where('id', $id);
		   								 $query = $this->db->get();
		  $data['result']  = $query->row();

		    $query = $this->db->select('*')->from('tblbranch');
		    $query = $this->db->get();
		   $data['branchdetails']  = $query->result();

		    $query = $this->db->select('*')->from('tblemployee');
		    $query = $this->db->get();
		   $data['employeedetails']  = $query->result();
		      $this->load->view('lead_edit',$data);
		   

	}


//branch code updating
	   public function branch()
	   {
	   	$BranchCode = $this->input->post('branch_code');
	   	$query 	    = $this->db->select('Branch_Name')->from('tblbranch')
			    						        ->where('Branch_Code', $BranchCode);
					  							$query = $this->db->get();
				   	 							$data  = $query->result();
				   	 							foreach ($data as $key => $value) {
				   	 							$branch_list[] = $value->Branch_Name;
				   	 							}
				   	 							$data  = array_unique($branch_list);
				   	 							$data  = json_encode($data);
				       	                        echo $data;
				       	                        die();
	   }
    
    public function processFileUser(){
        $fileName = $this->input->post('fileName');
        $inputFileName = '/tmp/'.$fileName;
        try {
            //$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader("Excel2007");
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        $sheet = $objPHPExcel->getSheet(0); 
        
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();
        $successArray=array();
        $errorArray=array();
        $updateArray=array();
        for ($row = 2; $row <= $highestRow; $row++){ 
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                            NULL,
                                            TRUE,
                                            FALSE);
            if($rowData[0][0]=="Employee Code"){
                continue;
            }
            $employeeCode=$rowData[0][0];
            $employeeName=$rowData[0][1];
            $branchCode=$rowData[0][2];
            $branchName=$rowData[0][3];
            $channelName=$rowData[0][4];
            $certType=$rowData[0][5];
            $certCode=$rowData[0][6];
            $mobNo=$rowData[0][7];
            $email=$rowData[0][8];
            
            $query = $this->db->select('*')->from('tblmaster')
				   						->where('EmployeeCode', $employeeCode);
            $query = $this->db->get();
            $empArr  = $query->result();
            //var_dump($query->num_rows());
            if ($query->num_rows()<1) {
                //var_dump($rowData);
                if($employeeName!=NULL && ($mobNo!=NULL || $email!=NULL)){
                    $data = array(
                        'EmployeeCode'=>$employeeCode,
                        'EmployeeName'=>$employeeName,
                        'BranchCode'=>$branchCode,
                        'BranchName'=>$branchName,
                        'ChannelName'=>$channelName,
                        'CertificationType'=>$certType,
                        'CertificationCode'=>$certCode,
                        'MobileNumber'=>$mobNo,
                        'EmailID'=>$email
                    );
                    try {
                        $this->db->insert('tblmaster',$data);
                    }
                    catch (Exception $e) {
                    }
                    if($this->db->affected_rows()>0){
                        array_push($successArray,$rowData[0]);
                    }else{
                        $rowData[0][9]=$this->db->error();
                        array_push($errorArray,$rowData[0]);
                    }
                }else{
                    $rowData[0][9]="Required Data not provided";
                    array_push($errorArray,$rowData[0]);
                }
                
            }else{
                $data = array(
                        'EmployeeName'=>$employeeName,
                        'BranchCode'=>$branchCode,
                        'BranchName'=>$branchName,
                        'ChannelName'=>$channelName,
                        'CertificationType'=>$certType,
                        'CertificationCode'=>$certCode,
                        'MobileNumber'=>$mobNo,
                        'EmailID'=>$email
                    );
                $this->db->where('EmployeeCode', $employeeCode);
                $this->db->update('tblmaster', $data);
                array_push($updateArray,$rowData[0]);
            }
            
        }
        
        $finalArr=array("success"=>sizeof($successArray),"error"=>sizeof($errorArray),"update"=>sizeof($updateArray));
        echo json_encode($finalArr);
    }
    
    public function processFile(){
        $fileName = $this->input->post('fileName');
        $inputFileName = 'assets/tmp/'.$fileName;
        try {
            //$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader("Excel2007");
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0); 
        
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();
        $successArray=array();
        $errorArray=array();
        for ($row = 2; $row <= $highestRow; $row++){ 
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                            NULL,
                                            TRUE,
                                            FALSE);
            $leadNo=$rowData[0][0];
            $productName=$rowData[0][1];
            $policyNo=$rowData[0][2];
            $status=$rowData[0][3];
            $data = array( 
                'StatusCode'      => $status, 
                'PolicyNo' => $policyNo
            );

            $this->db->where('LeadNo', $leadNo);
            $this->db->where('ProductType', $productName);
            $this->db->update('tbllead', $data);
            
            if($this->db->affected_rows()>0){
                array_push($successArray,$rowData[0]);
            }else{
                array_push($errorArray,$rowData[0]);
            }
            
            //  Insert row data array into your database of choice here
        }
        $finalArr=array("success"=>$successArray,"error"=>$errorArray);
        echo json_encode($finalArr);
        
    }
    
        public function do_upload()
        {
                $config['upload_path']          = 'assets/tmp/';
                $config['allowed_types']        = 'xls|xlsx';
             /* $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768; */
                $config['file_name'] = time();

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        echo json_encode($error);

                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        echo json_encode($data);
                }
        }


	public function uw_update(){

		/*$id   = $this->input->get('id',true);
	die($id);*/
		$policyno1=$this->input->post('policyno1');
		$policyno2=$this->input->post('policyno2');
		$policyno3=$this->input->post('policyno3');
		$policyno4=$this->input->post('policyno4');
		$policyno5=$this->input->post('policyno5');
		$policyno=$policyno1.$policyno2.$policyno3.$policyno4.$policyno5;
			$addtional_data = array(
		'StatusCode'           => $this->input->post('statuscode'),
		'ProductType' 			 => $this->input->post('ptype'),
		'CustomerName' 			 => $this->input->post('customername'),
		'EmployeeCode' 		 => $this->input->post('autoecode'),
		'EmployeeName' 		 => $this->input->post('ename'),
		'BranchCode'        => $this->input->post('autobcode'),
		'BranchName'		     => $this->input->post('bname'),
		'Premium'           => $this->input->post('premium'),
		'PolicyNo' 			 => $policyno,
		'Comment' 		 => $this->input->post('comment'),
		'updated_at'	=>date('Y-m-d H:i:s'),
		);
		//print_r($addtional_data);
		
		$this->db->where('LeadNo', $this->input->post('leadno'));
		$this->db->update('tbllead', $addtional_data); 
		
		redirect('index.php/CRM-LeadMaster', 'refresh');
    } //hdfc lead end
   

	// report page without any data
  		public function report(){
            $userData=$this->session->userdata("emp_data");
            if(!isset($userData['employeeCode'])){
                redirect(base_url(), 'location', 301);
            }
  			//$this->load->view('header');
		//display the report form with out any data
		    $this->load->view('lead_report');
		}
		//hdfc report end
    
        public function master(){
            $userData=$this->session->userdata("emp_data");
            if(!isset($userData['employeeCode']) && $userData['userType'] !="2"){
                redirect(base_url(), 'location', 301);
            }
  			//$this->load->view('header');
		//display the report form with out any data
		    $this->load->view('admin/admin_user');
		}

		//hdfc lead report start
		public function report_details() {
			//get report form the database between two dates
            $userData=$this->session->userdata("emp_data");
            if(!isset($userData['employeeCode'])){
                redirect(base_url(), 'location', 301);
            }
			$draw = intval($this->input->get_post("draw"));
			$start = intval($this->input->get_post("start"));
			$length = intval($this->input->get_post("length"));

			$from_date = $this->input->get_post('date_form');
			$to_date   = $this->input->get_post('date_to');
            $startDate = new DateTime($from_date);
            $startDate->modify("-1 day");
            $endDate = new DateTime($to_date);
            $endDate->modify("+1 day");
			/*$query 	   = $this->db->select('*')->from('tbllead')
				    			->where('created_at >=', $from_date)
				    			->where('created_at <=', $to_date);
			$query = $this->db->get();
			$data  = $query->result();*/
													//var_dump($userData);
			$data = $this->lead_report_model->get_datatables($startDate->format('Y-m-d'), $endDate->format('Y-m-d'),$userData['employeeCode'],$userData['userType']);
			$dataSize = sizeof($data);
			$finalData['recordsTotal'] = $dataSize;
			$finalData['recordsFiltered'] = $dataSize;
			$finalData["draw"] = $draw;
			$finalData['data'] = $dataSize > 0 ? $this->getFinalDataResponse($data) : array();

	        echo json_encode($finalData);
		}

		public function getFinalDataResponse($data) {
			$fData = array();
			$no = $_POST['start'];
			$_POST['length'];
			/*$baseUrl =siteurl().'/user/downloadExcelReport/';
			$dateEndPoint = '/'.$fromDate.'/'.$toDate.'/';*/
			if (sizeof($data) > 0) {
				foreach ($data as $key => $value) {
					$row = array();
					$no++;
					$row[] = $no;
					$row[] = $value->LeadNo;
					$row[] = $value->EmployeeName;
					$row[] = $value->CustomerName;
					$row[] = $value->BranchName;
					$row[] = $value->ProductType;
					$row[] = $value->PolicyNo;
					/*$row[] = '<a href="'.$baseUrl.$value->EmployeeCode.$dateEndPoint'">  <button type="button" class="btn blue btn-default" >Download </button></a>';*/
					// $row[] = $value->BranchCode;
					// $row[] = $value->Premium;
					// $row[] = $value->EmployeeCode;
					// $row[] = $value->PolicyNo;
					// $row[] = $value->StatusCode;
					// $row[] = $value->Comment;
					$fData[] = $row;
				}
			}
			return $fData;
		}

		private function callExcelDownloadData($objPHPExcel, $fromDate, $toDate, $employeeCode) {
            $startDate = new DateTime($fromDate);
            $startDate->modify("-1 day");
            $endDate = new DateTime($toDate);
            $endDate->modify("+1 day");
			$query = $this->db->from('tbllead')
							->where('created_at >', $startDate->format('Y-m-d'))
				    		->where('created_at <', $endDate->format('Y-m-d'));
            $userData=$this->session->userdata("emp_data");
            if(!isset($userData['employeeCode'])){
                redirect(base_url(), 'location', 301);
            }
			if ($userData['userType']=="1") {
				$this->db->where('EmployeeCode', $userData['employeeCode']);
                //var_dump($userData);
			}

			$data = $query->get()->result();
			$rowCount = 2;
	        $i = 1;
	        foreach ($data as $element) {
	        	$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('B'. $rowCount, $element->StatusCode);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element->ProductType);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element->CustomerName);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->EmployeeCode);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->EmployeeName);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->BranchCode);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->BranchName);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element->Premium);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element->PolicyNo);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element->LeadNo);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element->Comment);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element->created_at);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $element->updated_at);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $element->ChannelName);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $element->CertificateType);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $element->CertificateCode);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $element->CurrentDate);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $element->SuminsuredAmount);
	        	$objPHPExcel->getActiveSheet()->SetCellValue('T'. $rowCount, $element->CustomerId);
	        	
	        	$rowCount++;
            	$i++;
	        }

	        return $objPHPExcel;
		}

		private function getExcelHeaders($objPHPExcel) {
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl_No');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Status_Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Product_Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Customer_Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Employee_Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Employee_Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Branch_Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Branch_Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Premium');
			$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Policy_No');
			$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Lead_No');
			$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Comment');
			$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Created_at');
			$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Updated_at');
			$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Channel_Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Certificate_Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Certificate_Code');
			$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Current_Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Sum_Insured_Amount');
			$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Customer_Id');
			return $objPHPExcel;
		}

		private function callExcel($fromDate, $toDate) {
			//load our new PHPExcel library
			$objPHPExcel = new PHPExcel();
			//activate worksheet number 1
			$objPHPExcel->setActiveSheetIndex(0);
			//name the worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Worksheet');
			//set cell A1 content with some text
			$objPHPExcel = $this->getExcelHeaders($objPHPExcel);
			$$objPHPExcel = $this->callExcelDownloadData($objPHPExcel, $fromDate, $toDate);
			$today = 'Worksheet_Report_'.date('d-m-Y');
			$filename=$today.'.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			            
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
		}

		public function downloadExcelReport($fromDate, $toDate) {
			$this->callExcel($fromDate, $toDate);
			var_dump('expression');die();
		}

		// search page
		public function enquiry(){
			//display the report form with out any data
            $userData=$this->session->userdata("emp_data");
            if(!isset($userData['employeeCode'])){
                redirect(base_url(), 'location', 301);
            }
                $this->load->view('enquiry');
			
		}
		//enquiry search by leadid
		public function enquiry_details(){
            $userData=$this->session->userdata("emp_data");
            if(!isset($userData['employeeCode'])){
                redirect(base_url(), 'location', 301);
            }
            $empCode=$userData['employeeCode'];
		
		$lead_no 		= $this->input->post('lead_no');
		$option 		= $this->input->post('option');
		
    	if($option == '1'){   
        $query = $this->db->select('*')->from('tbllead')
		    						   ->where('LeadNo', $lead_no)
                                        ->where('EmployeeCode',$empCode)->get()->result();
		   	 							 echo json_encode($query); die();
		}

		}

		//search by date 
		public function search_details(){
		//get report form the database between two dates
            $userData=$this->session->userdata("emp_data");
            if(!isset($userData['employeeCode'])){
                redirect(base_url(), 'location', 301);
            }
            $empCode=$userData['employeeCode'];
            $from_date = $this->input->post('date_form');
            $to_date   = $this->input->post('date_to');
            $startDate = new DateTime($from_date);
            $startDate->modify("-1 day");
            $endDate = new DateTime($to_date);
            $endDate->modify("+1 day");
            $query 	   = $this->db->select('*')->from('tbllead')
                         
                         ->where('created_at >',$startDate->format('Y-m-d'))
                         ->where('created_at <', $endDate->format('Y-m-d'));
            if($userData['userType']=="1"){
                $this->db->where('EmployeeCode',$empCode);
            }
            $query = $this->db->get();
            $data  = $query->result();
            //var_dump($this->db->last_query());
            $data  = json_encode($data);
            echo $data;
		
		//hdfc lead report end

		}

}