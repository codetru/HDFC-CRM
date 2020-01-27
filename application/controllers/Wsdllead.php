<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/third_party/nusoap/lib/nusoap.php');

class Wsdllead extends CI_Controller {

	public function __construct(){
        error_reporting(-1);
		parent::__construct();
		
	}

	public function getDefaultData($leadName){

   $sqlLead = $this->db->query("SELECT id lead_sno FROM tbllead where LeadNo = '".$leadName."' LIMIT 1");

    if($sqlLead->num_rows()>0){
      $leadStatus = '1';
    } else {
      $leadStatus = '0';
    }   
    return $leadStatus;
    
   }   

   public function index(){

    $server = new soap_server();
    $server->configureWSDL("WSDL","cms:WSDL");
    $server->wsdl->schemaTargetNamespace = 'lead:Data';
    $server->register("cmsleadinfo",
      array("leadumber" => "xsd:string"),
      array("return" => "xsd:leadStatus"),
      "cms:leaddatainfo",
      "cms:leaddatainfo#cmsleadinfo");
     
    function cmsleadinfo($name) {
    $ci =& get_instance();
    return $ci->getDefaultData($name);
    }
     
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    @$server->service(file_get_contents("php://input"));

}

}

