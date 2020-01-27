<?php
 //var_dump($this->session);
  if (empty($this->session->userdata) === true) {
   // var_dump("test");die();
    redirect(BASE_PATH.'index.php/home');
  } 
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head profile="http://www.w3.org/1999/xhtml/vocab">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Expires" content="1" />
<meta http-equiv="Content-Length" content="1032" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo BASE_PATH.'assets/images/favicon.ico'?>" type="image/vnd.microsoft.icon" />
<link rel="stylesheet" href="<?php echo BASE_PATH.'assets/css/style.css'?>" />
<!-- new design -->
<link type="text/css" rel="stylesheet" href="<?php echo BASE_PATH.'assets/design/default.css'?>">
<link type="text/css" rel="stylesheet" href="<?php echo BASE_PATH.'assets/design/motor.css'?>">
<link type="text/css" rel="stylesheet" href="<?php echo BASE_PATH.'assets/design/print.css'?>">
<link type="text/css" rel="stylesheet" href="<?php echo BASE_PATH.'assets/design/style.css'?>">
<link type="text/css" rel="stylesheet" href="<?php echo BASE_PATH.'assets/bharti/css/jquery.toast.min.css'?>">
    

<link href="<?php echo BASE_PATH.'assets/fonts/font.css'?>" rel="stylesheet">
<style type="text/css">
        @import "<?php echo BASE_PATH.'assets/media/themes/smoothness/jquery-ui-1.8.4.custom.css'?>";
</style>

<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<!-- close -->
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/jquery-1.9.1.min.js'?>"></script>
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/jquery-ui.js'?>"></script>
<script src="<?php echo BASE_PATH.'assets/js/jquery.dataTables.min.js'?>"></script>
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/jquery.toast.min.js'?>"></script>
    <style>
        body{
            font-family: 'Open Sans', sans-serif !important;
        }
    </style>

<style type="text/css" media="all">
@import url("<?php echo BASE_PATH.'assets/bharti/css/bootstrap.css'?>");
</style>
<style type="text/css" media="screen">
@import url("<?php echo BASE_PATH.'assets/bharti/css/bootstrap-responsive.css'?>");
</style>
<style type="text/css" media="all">
@import url("<?php echo BASE_PATH.'assets/bharti/css/style.css'?>");
@import url("<?php echo BASE_PATH.'assets/css/jquery.dataTables.min.css'?>");
</style>
<style>
    [name=projectreport_datatable3_length],.dataTables_length select,.dataTables_filter input{
        width:auto !important;
    }
    .dataTable thead tr{
            background:#2b709c;
    color: white;
        
    }
    .dataTable thead tr th{
        border:0;
            text-align: center;
            vertical-align: middle;
    }
    
    .dataTables_filter{
        margin:0 !important;
    }
/*
    .dataTables_wrapper .row:first-child > .col-sm-6{
        display: flex !important
    }
*/
    .dataTables_wrapper .dataTables_scroll{
        border: 1px solid #e7e7e7;
}
    .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>th, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>thead>tr>td, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>th, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody>table>tbody>tr>td{
        border:0;
            text-align: center;
    }
    table.dataTable.display tbody tr.odd {
    background-color: #f1f1f1;
}
    .dataTables_scroll tr > td:last-child,.dataTables_scroll tr > th:last-child{
        width:100px
    }
    .pagination {
    margin: 10px 0px;
    background: #fdfcfc;
    border: 1px solid #e7e7e7;
    font-weight: bold;
}
    table.dataTable thead th, table.dataTable thead td{
        border-bottom: 0 !important
    }
    .paginate_button:not(:last-child){
        border-right: 1px solid #e4e2e2 !important;
        
    }
    .paginate_button{
        margin-left:0px !important;
    }
    .paginate_button.active{
        background:#e7e7e7;
        margin-left:0px !important;
        border-radius: 0 !important
    }
    .paginate_button:hover{
        border-color:#e7e7e7 !important
    }
    .customSmall{
           padding: 2px !important;
    font-size: 12px;
    color: #2a719e;
    text-align: center;
    margin: 0 auto;
    background: #f7f7f7 !important;
    display: block;
    border: 1px solid #2a719e !important;
    }
    .ui-datepicker-calendar .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header.ui-datepicker-header .ui-state-default{
        background: transparent !important;
    border: 0 !important;
    color: #7e888a !important;
    font-weight: bold;
    font-family: "Open Sans";
        text-align: center
    }
    .ui-datepicker-calendar{
        margin:0 !important;
            border: 1px solid #e7e7e7;
}
    .ui-datepicker-calendar thead tr{
            background: #daefff;
    }
    .ui-datepicker .ui-datepicker-header{
            background: #0692ff;
    color: white;
    border-radius: 0;
    }
    .ui-datepicker td:hover{
        background: #e7e7e7;
    }
    .ui-datepicker-div{
        background: #e7e7e7;
    }
    .ui-datepicker td{
        border: 1px solid #e7e7e7;
    }
    .ui-datepicker{
        padding: 0;
        border:0 !important;
    }
    .customNavbar{
                background: #104080;
    padding: 10px;
    border-bottom: 1px solid #d4d2d2;
    }    
    .bagiLogo{
            width: 70px !important;
    height: 36px !important;
    margin-top: -10px !important;;
    margin-bottom: -10px !important;
        margin-right:20px !important
    }
    .customBrand{
            font-weight: bold !important;
    text-shadow: none !important;
    color: #ecebeb !important;
    font-size: 24px !important;
    }
    .welcomeMsg{
            padding: 10px;
    color: #ffffff;
    }
    .welcomeMsg:hover{
        background: #104080 !important
    }
    .navbar .nav > li{
        margin-right:5px
    }
    .navbar .nav > li > a{
        text-shadow: none !important;
        color:white;
            border: 1px solid #104080 !important;
    }
    
    .wrapper{
        background: white !important;
        
        border: 1px solid #e7e7e7;
        border-top: 5px solid #6a91c5;
    }
    
    
    .navbar .divider-vertical {

    border-right: 1px solid #000000 !important;
}
    .navbar .nav > li > a:active,.navbar .nav > li > a:focus{
        color:white !important;
    }
    .navbar .nav > li > a:hover,.navbar .nav > li.open > a{
        text-shadow: none !important;
        color:white !important;
        background: #104080 !important;
            border: 1px solid white !important;
    }
    .navbar .nav > .active > a{
        background: transparent;
    color: white;
    border: 1px solid white !important;
        box-shadow: none !important
    }
    .navbar .nav li.dropdown > .dropdown-toggle .caret{
        border-top-color:white !important;
        border-bottom-color:white !important;
    }
    div#form{
        margin-top:20px;
        
    }
    div#form label{
        color:#414346 !important;
        font-family: 'Open Sans', sans-serif !important;
    }
    .formButtons,button{
        border-radius: 0px !important;
    background: #1980d0 !important;
        margin-right:10px;
    padding: 8px 28px !important;
    font-family: "Open Sans" !important;
    border: 0 !important;
    text-shadow: none !important;
    }
    input,textarea,select{
        border-radius: 0 !important;
    box-shadow: none !important;
    }
    .breadcrumb > li:hover,.breadcrumb > li > a:hover{
        background: transparent !important;
    }
</style>
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/bootbox.min.js'?>"></script>
<script src="<?php echo BASE_PATH.'assets/js/dataTables.bootstrap.min.js'?>"></script> 
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/aes.js'?>"></script>
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/aes-json.js'?>"></script>
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/autocomplete-0.3.0.js'?>"></script>
</head>
<title>Bharti AXA General Insurance</title>
<body style="PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #e9f3fb; PADDING-TOP: 0px">
  <iframe src="javascript:''" id="__gwt_historyFrame" tabindex="-1" style="position:absolute;width:0;height:0;border:0"></iframe>
  <noscript>
    &lt;div style="width: 22em; position: absolute; left: 50%; margin-left: -11em; color: red; background-color: white; border: 1px solid red; padding: 4px; font-family: sans-serif"&gt;
      Your web browser must have JavaScript enabled
      in order for this application to display correctly.
    &lt;/div&gt;
  </noscript>
<iframe src="javascript:''" id="bagiapps" tabindex="-1" style="position: absolute; width: 0px; height: 0px; border: none;"></iframe>
<div class="navbar customNavbar">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand customBrand" href="#"><img class="bagiLogo" src="<?php echo BASE_PATH.'assets/design/bhartiaxa-logo.jpg'?>">CRM</a>
                  <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                      <li class=""><a href="<?php echo site_url();?>index.php/home/leadView">Home</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lead <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo site_url();?>index.php/home/leadView">Update Lead Policy</a></li>
<!--                          <li><a href="<?php echo site_url();?>index.php/user/enquiry">Search Lead</a></li>-->
                        </ul>
                      </li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo site_url();?>index.php/user/report">Generate Report</a></li>
                        </ul>
                      </li>
                    </ul>
                    
                    <ul class="nav pull-right">
                      <li class="welcomeMsg">
                          Welcome <script>document.write(localStorage.getItem("user"))</script> to Bharti AXA General Insurance
<!--
                        <form class="navbar-search pull-right" action="">
                      <input type="text" class="search-query span2" placeholder="Search">
                    </form>  
-->
                      </li>
                      <li class="divider-vertical"></li>
                      <li><a href="<?php echo site_url();?>index.php/home/logout">Logout</a></li>
                    </ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div>
<div aria-hidden="true" style="display: none;"></div>
<div style="width: 100%;">
<div class="wrapper">
<!--
<div> 
<div class="containerRightPadding">
<div id="header"> 
<div id="header_in"> 
<div class="logo"> 
<a href="/"> 
<img alt="" complete="complete" src="<?php echo BASE_PATH.'assets/design/bhartiaxa-logo.jpg'?>" title=""> </a> 
</div> 
<div class="login">
<div class="login-txt"> Welcome to Bharti AXA General Insurance </div>

</div>
</div>
</div>
</div> 
</div>
-->
<div>
<!--
  <nav class="navbar navbar-inverse1">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Lead
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo site_url();?>index.php/lead">Create Lead</a></li> 
          <li><a href="<?php echo site_url();?>index.php/home/leadView">Create Lead</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reports
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo site_url();?>index.php/user/report">Generate Report</a></li>
        </ul>
      </li>
       <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Search
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo site_url();?>index.php/user/enquiry">Search Lead</a></li>
        </ul>
      </li>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="<?php echo site_url();?>index.php/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
    </ul>
  </div>
</nav>
-->

</div>
<!--  -->

<!--  -->
<!-- <ul class="nice-menu nice-menu-down nice-menu-main-menu" id="nice-menu-1">
        <li class="menu-349 menu-path-node-6 first odd  odd" id="menu-item-id-1">
        <a href="<?php echo site_url();?>index.php/CRM-LeadMaster">Lead Details</a>
        </li>
       
        <li class="menu-351 menu-path-node-12  odd  odd" id="menu-item-id-3">
        <a href="<?php echo site_url();?>index.php/CRM-LeadMaster/report">Reports</a>
        </li>
    </ul> -->
<div id="content" style="width:100%;"> 
<div class="v_layout" style="margin:2%; width:96%; ">
<div id="form">
