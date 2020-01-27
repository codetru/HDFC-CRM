<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."third_party/PHPExcel.php";
require_once APPPATH."third_party/PHPExcel/IOFactory.php";
//hdfc create lead
class Lead extends CI_Controller {

function __construct()
	{
		parent::__construct();
		$this->load->database();
		// $this->load->library('/controllers/home');
		$this->load->helper(array('url','language'));
		 $this->load->library('session');
		$config=array('question_format'=>'numeric','answer_format'=>'numeric','question_max_number_size'=>9);
    
	}
	
	public function index()
	{
		//create lead viewpage
		// var_dump($this->session);die();
		// $employeecode='P7645';
		//start session
		// if ($this->session->userdata('logged_in') === TRUE) {
 	// 		$query = $this->db->select('*')->from('tblmaster')
		// 		   				->where('EmployeeCode', $employeecode);
		// 	$query = $this->db->get();
		// 	$data['employeemaster']  = $query->result();
		// 	$data['EmployeeName'] =  $data['employeemaster']['0']->EmployeeName;
		// 	$data['BranchCode'] =  $data['employeemaster']['0']->BranchCode;
		// 	$data['BranchName'] =  $data['employeemaster']['0']->BranchName;
		// 	$data['ChannelName'] =  $data['employeemaster']['0']->ChannelName;
		// 	$data['CertificationType'] = $data['employeemaster']['0']->CertificationType;
		// 	$data['CertificationCode'] =  $data['employeemaster']['0']->CertificationCode;
		// 	$this->load->view('lead',$data);
		// } else {
		// 	//$this->load->view('header'); //no need
		// 	$data['errorMsg'] = 'Please log in to continue !!!';
		// 	$this->load->view('home', $data);
		// 	//$this->load->view('footer'); //no need
		// }

		$query = $this->db->select('*')->from('tblmaster')
		 		   				->where('EmployeeCode', $employeecode);
			$query = $this->db->get();
			$data['employeemaster']  = $query->result();
			$data['EmployeeName'] =  $data['employeemaster']['0']->EmployeeName;
			$data['BranchCode'] =  $data['employeemaster']['0']->BranchCode;
			$data['BranchName'] =  $data['employeemaster']['0']->BranchName;
			$data['ChannelName'] =  $data['employeemaster']['0']->ChannelName;
			$data['CertificationType'] = $data['employeemaster']['0']->CertificationType;
			$data['CertificationCode'] =  $data['employeemaster']['0']->CertificationCode;
			$this->load->view('lead',$data);

	}

	//policy enquiry Method(pavan)
	public function policyEnquiry(){

		$postdata = $this->input->post();
		$policy_number = $postdata['policy_number'];
		$curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://uat.bhartiaxaonline.co.in/cordys/com.eibus.web.soap.Gateway.wcp?organization=o%3DB2C%2Ccn%3Dcordys%2Ccn%3DdefaultInst106%2Co%3Dmydomain.com",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "<Envelope xmlns=\"http://schemas.xmlsoap.org/soap/envelope/\">\r\n    <Body>\r\n        <PolicyEnquiry xmlns=\"http://schemas.cordys.com/MIS_IntegrationServices\">\r\n            <Policy_Number>".$policy_number."</Policy_Number>\r\n        </PolicyEnquiry>\r\n    </Body>\r\n</Envelope>",
  CURLOPT_HTTPHEADER => array(
    "content-type: text/xml",
  ),
));
curl_setopt($curl, CURLOPT_PROXY, "10.92.89.12");
curl_setopt($curl, CURLOPT_PROXYPORT, "8080");
$response = curl_exec($curl);

$err = curl_error($curl);

curl_close($curl);

$resXml = simplexml_load_string($response);

$bodyData = json_decode(json_encode($resXml->Body->PolicyEnquiryResponse->Response->POLICY_DETAILS));


if ($err) {
  echo "cURL Error #:" . $err;
	} else {
  
  		$returnData['CONTRACT_TYPE'] = (is_array($bodyData->CONTRACT_TYPE) ? $bodyData->CONTRACT_TYPE[0] : $bodyData->CONTRACT_TYPE);
  		$returnData['CLIENT_NAME'] = (is_array($bodyData->CLIENT_NAME) ? $bodyData->CLIENT_NAME[0] : $bodyData->CLIENT_NAME);
 	    $returnData['TOTAL_SUM_INSURED'] = (is_array($bodyData->TOTAL_SUM_INSURED) ? $bodyData->TOTAL_SUM_INSURED[0] : $bodyData->TOTAL_SUM_INSURED);
        $returnData['PAYABLE_PREMIUM'] = (is_array($bodyData->PAYABLE_PREMIUM) ? $bodyData->PAYABLE_PREMIUM[0] : $bodyData->PAYABLE_PREMIUM);
        $returnData['AGENT_NO'] = (is_array($bodyData->AGENT_NO) ? $bodyData->AGENT_NO[0] : $bodyData->AGENT_NO);

        echo json_encode($returnData);
	}
}

//create lead method
	public function create()
	{ 

		// var_dump()
		$ptype= $this->input->post('inputGroupSelect02');
		$policyno=$this->input->post('policyno');
		/*$policyno2=$this->input->post('policyno2');
		$policyno3=$this->input->post('policyno3');
		$policyno4=$this->input->post('policyno4');
		$policyno5=$this->input->post('policyno5');
		$policyno=$policyno1.$policyno2.$policyno3.$policyno4.$policyno5;*/
		$additional_data = array(
		'StatusCode' 			 => $this->input->post('statuscode'),
		'ProductType' 			 => $this->input->post('inputGroupSelect02'),
		'CustomerName' 			 => $this->input->post('customername'),
		'CustomerId'			 => $this->input->post('customerid'),	
		'EmployeeCode'  		 => $this->input->post('autoecode'),
		'EmployeeName'  		 => $this->input->post('employeename'),
		'BranchCode' 			 => $this->input->post('branchcode'),
		'BranchName' 			 => $this->input->post('branchname'),
		'ChannelName' 			 => $this->input->post('channelname'),
		'CertificateType' 		 => $this->input->post('certificatetype'),
		'CertificateCode' 		 => $this->input->post('certificatecode'),
		'CurrentDate' 			 => $this->input->post('currentdate'),
		'SuminsuredAmount' 	 	 => $this->input->post('suminsuredamount'),
		'TotalSumInsured'        => $this->input->post('total_sum_insured'),
		'Premium' 		 		 => $this->input->post('premium'),
		'PolicyNo'				 => $policyno,
		'LeadNo' 				 => $this->input->post('leadno'),
		'Comment' 				 => $this->input->post('comment')
		);
		
		
		$this->db->insert('tbllead', $additional_data);
		/*echo ;
		echo $this->db->insert_id();
		die();*/
		if($this->db->affected_rows() > 0){
			echo '<script language="javascript">';		
				echo 'alert("Lead number '.$this->input->post('leadno').' generated successfully");';		
				echo '</script>';
		}

	         

		 		$data['branchCode'] = $additional_data['BranchCode'];
		 		$data['employeeCode'] = $additional_data['EmployeeCode'];
		 		$data['relationshipNo'] = $additional_data['CustomerId'];
		 		$data['sameAsProposal'] = "Yes, I am good";
		 		$data['date'] = date('d-m-Y');
				$data['customerName'] = $additional_data['CustomerName'];
				$data['leadNo'] = $additional_data['LeadNo'];
                $data['channelName'] = $additional_data['ChannelName'];

            if($this->input->post('statuscode')!="Converted"){
                $this->printGidPdf($data);

		 echo "<script>window.open('".base_url()."index.php/home/leadView')</script>";
            }else{

               redirect('index.php/home/leadView', 'refresh');

            }
		 		
			
			 // redirect('', 'refresh');

			//	$this->load->view('lead');

			// $this->load->Home->saveAsPdf();
			// $query 	    = $this->db->select('*')->from('tbllead')
			//     						        ->where('LeadNo',$this->input->post('leadno'));
			// 		  							$query = $this->db->get();
			// 	   	 							$data  = $query->result();
			// 	   	 							print_r($data);

				   	 							//die();
}

private function printGidPdf($data) {
	$html=$this->load->view('welcome_message', $data, true);
	$this->downloadPdf($html, "GID.pdf");
	redirect('', 'refresh');

	// redirect($this->uri->uri_string());
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
		}



}
