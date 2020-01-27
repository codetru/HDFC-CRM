<?php
    class Pdfexample extends CI_Controller{ 
    function __construct()
    { parent::__construct();
        $this->load->library('session');
     } 
    function index() {
    $this->load->library('mypdf');
    $mypdf = new Mypdf();
    $pdfFilePath = "output_pdf_name.pdf";
    $this->mypdf->WriteHTML('<h1>Hello world!</h1>');
    $this->mypdf->Output();
    // var_dump('expression');die();
    /*$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('Pdf Example');
    $pdf->SetHeaderMargin(30);
    $pdf->SetTopMargin(20);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->Write(5, 'CodeIgniter TCPDF Integration');
    $pdf->Output('pdfexample.pdf', 'I'); }*/
    }
}
    ?>
