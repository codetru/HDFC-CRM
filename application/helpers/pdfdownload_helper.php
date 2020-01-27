<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_pdf_file')) {
	function get_pdf_file() {
		$data = [];
		//load the view and saved it into $html variable
		$html=$this->load->view("welcome_message", $data, true);

        //this the the PDF filename that user will get to download
		$pdfName = "fileName.pdf";

        //load mPDF library
		$this->load->library('m_pdf');

       //generate the PDF from the given html
		$this->m_pdf->pdf->WriteHTML($html);

        //download it.
		$this->m_pdf->pdf->Output($pdfName, "D");
	}
}