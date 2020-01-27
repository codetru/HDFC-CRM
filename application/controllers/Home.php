<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// ob_start();
	/**
	 * My first class
	 */
	// require_once __DIR__ . '../hdfc/vendor/autoload.php';
	// require_once(APPPATH.'libraries/mpdf/');
	
	class Home extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper(array('url','language'));
			$this->load->library('session');
			$this->load->model('Employeemaster_model');
		}

		public function index()
		{
			if ( ! file_exists(APPPATH.'views/home.php'))
	        {
	                // Whoops, we don't have a page for that!
	                show_404();
	        }

	        $data['title'] = ucfirst($page);
	      //  $this->load->view('header', $data);
	        $this->load->helper('form');
	        $this->load->view('home', $data);
	      //  $this->load->view('footer', $data);

//	        $this->testPdf();
		}
        
        public function login(){
            $empcode = $this->input->post('emp_code');
            $password = $this->input->post('password');
            $this->db->select('tem.id, tem.MobileNumber, tem.EmployeeName, tem.EmployeeCode,tem.id,tuld.userType')
						->from('tblmaster tem')
						->join('tbluserlogindetails tuld', 'tem.id = tuld.employee_master_id')
						->where('tem.EmployeeCode', $empcode)
						->where('tuld.password', $password);
            $query = $this->db->get();
           
            $data = $query->result();
            if (empty($data) === true) {
                $loginArr = array('loggedIn'=>false, 'empCode'=>$empcode);
            }else{
                $employeecode= $data[0]->EmployeeCode;
				$session_data['employeeCode'] = $data[0]->EmployeeCode;
				$session_data['empMasterId'] = $data[0]->id;
                $session_data['userType'] = $data[0]->userType;
				$this->session->set_userdata('emp_data', $session_data);
                $loginArr = array('loggedIn'=>true, 'empCode'=>$empcode,'empName'=>$data[0]->EmployeeName);
            }
            echo json_encode($loginArr);
        }
        
        public function leadView(){
            $userData=$this->session->userdata("emp_data");
            if(!isset($userData['employeeCode'])){
                redirect(base_url(), 'location', 301);
            }
            $employeecode=$userData['employeeCode'];
            $query = $this->db->select('*')->from('tblmaster')
				   						->where('EmployeeCode', $employeecode);
            $query = $this->db->get();
            $data['employeemaster']  = $query->result();
            $data['EmployeeCode'] =  $data['employeemaster']['0']->EmployeeCode;
            $data['EmployeeName'] =  $data['employeemaster']['0']->EmployeeName;
            $data['BranchCode'] =  $data['employeemaster']['0']->BranchCode;
            $data['BranchName'] =  $data['employeemaster']['0']->BranchName;
            $data['ChannelName'] =  $data['employeemaster']['0']->ChannelName;
            $data['CertificationType'] = $data['employeemaster']['0']->CertificationType;
            $data['CertificationCode'] =  $data['employeemaster']['0']->CertificationCode;
            if($userData['userType']=="1"){
                $this->load->view('lead',$data);
            }else{
                $this->load->view('admin/admin_upload',$data);
            }
            
        }

		function testPdf(){
	$this->load->library('mypdf');
    $mypdf = new Mypdf();
    $pdfFilePath = "output_pdf_name.pdf";
    $this->mypdf->WriteHTML('<h1>Hello world!</h1>');
    $this->mypdf->Output();			
		}
		public function sendOtp() {
			//$this->load->view('header');
			$empcode = $this->input->post('emp_code');
			if ($empcode == "") {
				echo "empty";
			} else {
				$query = $this->db->select('tem.id, tem.MobileNumber, tod.is_verified, tod.daily_retry_count, tod.last_try_date')->from('tblmaster tem')->join('tblotpdetails tod', 'tem.id = tod.employee_master_id');
				$query = $this->db->where("tem.EmployeeCode", $empcode);
		   		$query = $this->db->get();
		   		$data  = $query->result();

		   		$otpVerificationDetails = $this->isOtpVerifiedUser($data, $empcode);
		   		
	 			foreach ($data as $key => $value) {
					$mobilenumber = $value->MobileNumber;
				}
			}
			
			if (empty($mobilenumber) === true) {
				$data['errorMsg'] = "please check your employee code and try again after sometime!!!";
				$this->load->view("otperror", $data);
			} else {
				if (empty($otpVerificationDetails['errorMsg']) === false) {
					$this->load->view('otperror', $otpVerificationDetails);
				} else {
					if (empty($otpVerificationDetails['isVerified']) === true && empty($otpVerificationDetails['triggerOtp']) === false) {
						$this->triggerOtp($mobilenumber, $data[0]->id);
					} elseif(empty($otpVerificationDetails['isVerified']) === false) {
						$this->db->select('password')->from('tbluserlogindetails');
						$this->db->where('employee_master_id', $data[0]->id);
						$query = $this->db->get();
						$loginDetails = $query->result();
						if (empty($loginDetails) === true) {
							$this->load->view('setpassword', array('empMasterId' => $data[0]->id));
						} else {
							$this->load->view('password', array('empMasterId' => $data[0]->id));
						}
					}
				}
			}

			//$this->load->view('footer', $data);
			
			/*echo $resData['Status'];
			echo json_decode($response, true);
			$data['title'] = $empcode;*/
		}

		private function isOtpVerifiedUser($userDetails, $empcode) {
			$userData['isVerified'] = true;
			$userData['triggerOtp'] = false;
			$userData['todayDate'] = date('Y-m-d');
			
			if (sizeof($userDetails) == 1) {
				$isVerified = $userDetails[0]->is_verified;
				$dailyRetryCount = $userDetails[0]->daily_max_retry_count;
				$lastTryDate = $userDetails[0]->last_try_date;
				if (empty($isVerified) === true) {
					if ($dailyRetryCount < 3) {
						$userData['triggerOtp'] = true;
					}
					$dailyRetryCount = $dailyRetryCount+1;
					$userData['isVerified'] = false;
					$userData['dailyRetryCount'] = $dailyRetryCount;
					$this->updateOtpDetailsByEmpMasterId($userData, $userDetails[0]->id);
				}
			} else {
				//insert data in otp details
				$otpDetails['is_verified'] = $userData['isVerified'] = false;
				$userData['triggerOtp'] = true;
				$otpDetails['daily_retry_count'] = 1;
				$otpDetails['last_try_date'] = $userData['todayDate'];
				$query = $this->db
							->select('id', 'MobileNumber')
							->from('tblmaster')
							->where('EmployeeCode', $empcode);
				$query = $this->db->get();
				$data = $query->result();
				if (empty($data) === true) {
					$userData['errorMsg'] = "Employee Code not found";
				} else {
					$otpDetails['employee_master_id'] = $data[0]->id;
					$this->db->insert('tblotpdetails', $otpDetails);
				}
			}
			return $userData;
		}

		private function updateOtpDetailsByEmpMasterId($data, $empMasterId) {
			$otpData['is_verified'] = $data['isVerified'];
			$this->db->set('is_verified', $data['isVerified']);
			if (empty($data['dailyRetryCount']) === false) {
				$otpData['daily_retry_count'] = $data['dailyRetryCount'];
				$this->db->set('daily_retry_count', $data['dailyRetryCount']);
			}
			$this->db->where('employee_master_id', $empMasterId);
			$this->db->update('tblotpdetails', $otpData);
		}

		public function verifyPassword() {

			$data['title'] = "verifyPassword";
			$userData=$this->session->userdata("emp_data");
			//var_dump($userData);die();
			$empMasterId = $this->input->post('emp_master_id');
			//var_dump($userData);
			if(empty($empMasterId) === true){
				$empMasterId=$userData["empMasterId"];
			}
			
			$pwd = $this->input->post('pwd');
			if(empty($pwd) === true){
				$pwd=$userData["pwd"];
			}
			if (!isset($userData) && (empty($empMasterId) === true || empty($pwd) === true)) {
				//$this->load->view('header', $data);
				$this->load->view('otperror', array('errorMsg' => 'Something went wrong!!!'));
			} else {
				/*$this->db->select('password')
						->from('tbluserlogindetails')
						->where('employee_master_id', $empMasterId)
						->where('password', $pwd);*/
				$this->db->select('tem.id, tem.MobileNumber, tem.EmployeeName, tem.EmployeeCode')
						->from('tblmaster tem')
						->join('tbluserlogindetails tuld', 'tem.id = tuld.employee_master_id')
						->where('tuld.employee_master_id', $empMasterId)
						->where('tuld.password', $pwd);
				$query = $this->db->get();
				//var_dump($this->db->last_query());
				$data = $query->result();

				if (empty($data) === true) {
					//$this->load->view('header', $data);
					$this->load->view('password', array('emp_master_id' => $empMasterId, 'errorMsg' => 'Wrong password !!!'));
				} else {
					// create lead
					$employeecode= $data[0]->EmployeeCode;
					$session_data['employeeCode'] = $data[0]->EmployeeCode;
					//var_dump($pwd);
					$session_data['empMasterId'] = $empMasterId;
					$session_data['pwd'] = $pwd;
					$this->session->set_userdata('emp_data', $session_data);

					//var_dump($this->session->userdata);
					$query = $this->db->select('*')->from('tblmaster')
				   						->where('EmployeeCode', $employeecode);
				   	$query = $this->db->get();
					$data['employeemaster']  = $query->result();
		 			$data['EmployeeCode'] =  $data['employeemaster']['0']->EmployeeCode;
					$data['EmployeeName'] =  $data['employeemaster']['0']->EmployeeName;
					$data['BranchCode'] =  $data['employeemaster']['0']->BranchCode;
					$data['BranchName'] =  $data['employeemaster']['0']->BranchName;
					$data['ChannelName'] =  $data['employeemaster']['0']->ChannelName;
					$data['CertificationType'] = $data['employeemaster']['0']->CertificationType;
					$data['CertificationCode'] =  $data['employeemaster']['0']->CertificationCode;

					$this->load->view('lead',$data);
				}

				//$this->load->view('footer', $data);
			}
		}

		public function logout() {
            $this->session->set_userdata('emp_data', FALSE);
            $this->session->sess_destroy();
            redirect(base_url(), 'location', 301);
//			$sess_array = array('userdata' => '');
//			$this->session->unset_userdata($sess_array);
//			 $this->session->sess_destroy();
//			//var_dump($this->session);die();
//			$data['errorMsg'] = 'Successfully Logout';
//			//$this->load->view('header', $data);
//			$this->load->view('home', $data);
//		//	$this->load->view('footer', $data);
		}

		public function verifyOtp()
		{
		//	$this->load->view('header');
            $changeData=$this->session->userdata("change_password");
			//var_dump($userData);die();
			//$empMasterId = $this->input->post('session_id');
			//var_dump($userData);
//			if(empty($empMasterId) === true){
//				$empMasterId=$userData["empMasterId"];
//			}
            //var_dump($changeData);
			$sessionId = $changeData['sessionId'];
			$otpCode = $this->input->post('otp_code');
			$empMasterId = $changeData['id'];

			if (empty($otpCode) === true || empty($sessionId) === true) {
				echo "empty otp Code or session Id";
			} else {
				$endPoint = sprintf("SMS/VERIFY/%s/%s", $sessionId, $otpCode);
				$url = $this->getOtpApiBaseUrl().$endPoint;

				$response = $this->download_content($url);
				$resData = json_decode($response, true);
				$finalResponse = $this->getResponse($resData['Status'], $resData['Details']);
				if ($finalResponse['isVerified']) {
					echo "success";
				} elseif($finalResponse['isError']) {
					echo "error";
				} elseif (!$finalResponse['isVerified'] && !$finalResponse['isError']) {
					echo "error";
				}
			}
		}

		public function saveAsPdf() {
			//start
	$LeadNo  = $this->input->get('LeadNo',true);
	$query =$this->db->select('*')
					  ->from('tbllead')
					  ->where('LeadNo',$LeadNo)
					  ->get();
				   	 					$data['employeemaster']  = $query->result();
				   	 					       	            
// end fetch data
			// $data = [];
			// $data['name'] = "Vinay";
			// $data['branchName'] = "T.Nagar-Chennai";
			// $data['employeeCode'] = "P7645";
			// $data['relationshipNo'] = "64091660";
			// $data['sameAsProposal'] = "Yes, I am good";
			// $data['date'] = date('d-m-Y');
			// $data['customerName'] = "Vinay Kumar";

			// test
			$data['name'] = $data['employeemaster']['0']->EmployeeName;
			$data['branchCode'] = $data['employeemaster']['0']->BranchCode;
			$data['employeeCode'] = $data['employeemaster']['0']->EmployeeCode;
			$data['relationshipNo'] = $data['employeemaster']['0']->CustomerId;
			$data['sameAsProposal'] = "Yes, I am good";
			$data['date'] = date('d-m-Y');
			$data['customerName'] = $data['employeemaster']['0']->CustomerName;
            $data['leadNo'] = $data['employeemaster']['0']->LeadNo;
            $data['channelName'] = $data['employeemaster']['0']->ChannelName;


			//load the view and saved it into $html variable
			$html=$this->load->view('welcome_message', $data, true);
			$this->downloadPdf($html, "Lead.pdf");
		}

		public function downloadPdf($html, $filename) {
	        //this the the PDF filename that user will get to download
			$pdfFilePath = $filename;

	        //load mPDF library
			$this->load->library('m_pdf');

	       //generate the PDF from the given html
			$this->m_pdf->pdf->WriteHTML($html);

	        //download it.
			$this->m_pdf->pdf->Output($pdfFilePath, "D");
		}//old
		// private function triggerOtp($mobilenumber, $empMasterId) {
		// 	$endPoint = sprintf("SMS/%s/AUTOGEN", $mobilenumber);
		// 	$url = $this->getOtpApiBaseUrl().$endPoint;
			
		// 	$response = file_get_contents($url);
		// 	$resData = json_decode($response, true);
		// 	if ($resData['Status'] == "Success" && $resData['Details'] != "") {
		// 		$data['sessionId'] = $resData['Details'];
		// 		$data['empMasterId'] = $empMasterId;
		// 		$this->load->view('otpverify', $data);
		// 	} else {
		// 		$data['errorMsg'] = "please try again after sometime!!!";
		// 		$this->load->view("otperror", $data);
		// 	}
		// }


function download_content($url) {
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                          CURLOPT_URL => $url,
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_SSL_VERIFYPEER => 0,
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 30,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "GET",
                          CURLOPT_POSTFIELDS => "",
                          CURLOPT_HTTPHEADER => array(
                            "content-type: application/x-www-form-urlencoded"
                          ),
                        ));

				curl_setopt($curl, CURLOPT_PROXY, "10.92.89.12"); //your proxy url
    curl_setopt($curl, CURLOPT_PROXYPORT, "8080"); // your proxy port number
                        $response = curl_exec($curl);
                        $err = curl_error($curl);

                        curl_close($curl);

                        if ($err) {
                          return "cURL Error #:" . $err;
                        } else {
                          return $response;
                        }
            }
        
        private function send_mail($to_email,$otpNo) { 
	    
         $from_email = "crm@bhartiaxa.com";
   
         //Load email library 
         $this->load->library('email'); 
   			$config = array();
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'smtp-relay.gmail.com';
			//$config['smtp_user'] = 'xxx';
			//$config['smtp_pass'] = 'xxx';
			$config['smtp_port'] = 25;
			$this->email->initialize($config);
	 $this->email->set_newline("\r\n");
         $this->email->from($from_email, 'CRM Application'); 
         $this->email->to($to_email);
         $this->email->subject('Your OTP for CRM Application'); 
         $this->email->message('Your OTP for CRM application is '.$otpNo); 
   
         //Send mail 
         if($this->email->send()) {
            return true;
         } else {
print_r($this->email->print_debugger());
            return false;
}
        }
        
		private function triggerOtp($mobilenumber, $empMasterId, $isForgotPasswordUser = false) {
			//var_dump($empMasterId);die();
            $otpNumber = mt_rand(100000,999999);
            $otpArr=array("otp"=>$otpNumber);
            
            //Email
            
            $this->db->from('tblmaster')
					->where('id', $empMasterId);
			$query = $this->db->get();
			//echo $this->db->last_query();
            $data = $query->result();
            $this->send_mail($data[0]->EmailID,$otpNumber);
            
            $this->session->set_userdata('otpSession', $otpArr);
			$endPoint = sprintf("SMS/%s/%s", $mobilenumber,$otpNumber);
		    $url = $this->getOtpApiBaseUrl().$endPoint;
			
			$response = $this->download_content($url);
			//var_dump($response);
			$resData = json_decode($response, true);
			if ($resData['Status'] == "Success" && $resData['Details'] != "") {
				$data['sessionId'] = $resData['Details'];
				$data['empMasterId'] = $empMasterId;
				$data['isForgotPasswordUser'] = $isForgotPasswordUser;
				$data['res']=$resData;
				//$this->load->view('otpverify', $data);
                return $data;
			} else {
				$data['errorMsg'] = "please try again after sometime!!!";
				$data['res']=$resData;
				//$this->load->view("otperror", $data);
                return $data;
			}
		}

		public function savePassword() {
            $changeData=$this->session->userdata("change_password");
			$sessionId = $changeData['sessionId'];
			$empMasterId = $changeData['id'];
            
			$loginDetails['employee_master_id'] = $empMasterId;
			$loginDetails['password'] = $this->input->post('password');
			if (empty($loginDetails['employee_master_id']) === true || empty($loginDetails['password']) === true) {
				echo "error";
			}
			$this->db->from('tbluserlogindetails')->where('employee_master_id', $loginDetails['employee_master_id']);
			$query = $this->db->get();
			//var_dump($query);die();
			$existedData = $query->result();
			if (empty($existedData) === true) {
				$this->db->insert('tbluserlogindetails', $loginDetails);
				echo "success";
			} else {
				$this->db->set('password', $loginDetails['password']);
				$this->db->where('employee_master_id', $loginDetails['employee_master_id']);
				$this->db->update('tbluserlogindetails', $loginDetails);

				echo "success";
			}
		}

		//27-11-2018
		public function forgotPassword() {
			//var_dump($employeeMasterId);die();
            $empcode = $this->input->post('emp_code');
			$this->db->from('tblmaster')
					->where('EmployeeCode', $empcode);
			$query = $this->db->get();
			$data = $query->result();
			if (empty($data) === false && empty($data[0]->MobileNumber) === false) {
				$sdata=$this->triggerOtp($data[0]->MobileNumber, $data[0]->id, true);
                $sdata['EmployeeCode']=$data[0]->EmployeeCode;
                $sdata['MobileNumber']=$data[0]->MobileNumber;
                $sdata['EmailID']=$data[0]->EmailID;
                $sdata['id']=$data[0]->id;
                $this->session->set_userdata('change_password', $sdata);
                echo json_encode($sdata);
			} else {
				$sdata = array("errorMsg"=>"Please try again after sometime!!!");
                echo json_encode($sdata);
				//$this->load->view('home', $data);
			}
		}

		public function resendOtp($empMasterId) {
			//var_dump($employeeMasterId);die();
			$data = $this->Employeemaster_model->findById($empMasterId);
			if (empty($data) === false && empty($data[0]->MobileNumber) === false) {
				$this->triggerOtp($data[0]->MobileNumber, $empMasterId);
			} else {
				$data['errorMsg'] = "Please try again after sometime!!!";
				$this->load->view('home', $data);
			}	
		}

		private function getOtpApiBaseUrl() {
			$apiKey ="2ae5cc68-4eec-11e9-8806-0200cd936042"; 
			//"921bd12f-eccb-11e8-a895-0200cd936042";
			return sprintf("https://2factor.in/API/V1/%s/", $apiKey);
		}

		private function getResponse($status, $details) {
			$response['isVerified'] = false;
			$response['isError'] = true;
			$response['errorMsg'] = "Please try after sometime...";
			
			if (empty($status) === true) {
				return $response;
			}

			switch ($status) {
				case 'Success':
					$response['errorMsg'] = "";
					$response['isError'] = false;
					$response['isVerified'] = true;
					break;

				case 'Error':
					if ($details == "OTP Mismatch") {
						$response['isError'] = false;
						$response['errorMsg'] = "Enter correct Otp";
					}

					break;
			}

			return $response;
		}
		public function checkCrmLead(){

			if($_SERVER['REQUEST_METHOD'] == "POST"){

				$getReuest = json_decode(file_get_contents('php://input'));
				$encodeJson = json_decode(json_encode($getReuest,true));
				$leadNumber = $encodeJson->leadNumber;
				$this->db->select('LeadNo');
				$this->db->where('LeadNo',$leadNumber);
				$thisData = $this->db->get('tbllead');
				if($thisData->num_rows() > 0){
					$responceStatus['status'] = true;
					$responceStatus['message'] = 'matched';
				} else {
					$responceStatus['status'] = false;
					$responceStatus['message'] = 'not matched';
				}
				
			} else {
				$responceStatus['status'] = false;
			}

			echo json_encode($responceStatus); 
		}
		
	}
?>