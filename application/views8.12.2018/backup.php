//working 10pm 6-8-2018
<?php
foreach ($branchdetails as $key => $value) {
 $branchName[]=$value->Branch_Code;
}
$branch_name = array_unique($branchName); 

foreach ($employeedetails as $key => $value) {
 $empName[]=$value->Employee_Code;
}
$emp_name = array_unique($empName); 
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
<!-- close -->
<style type="text/css" media="all">
@import url("<?php echo BASE_PATH.'assets/bharti/css/bootstrap.css'?>");
</style>
<style type="text/css" media="screen">
@import url("<?php echo BASE_PATH.'assets/bharti/css/bootstrap-responsive.css'?>");
</style>
<style type="text/css" media="all">
@import url("<?php echo BASE_PATH.'assets/bharti/css/style.css'?>");
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/jquery-1.9.1.min.js'?>"></script>
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/jquery-ui.js'?>"></script>
<script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/bootbox.min.js'?>"></script>


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
<div aria-hidden="true" style="display: none;"></div>
<div style="width: 100%;margin-top:-20px!important;">
<div class="wrapper">
<div> 
<div class="containerRightPadding">
<div id="header"> 
<div id="header_in"> 
<div class="logo"> 
<a href="/"> 
<img alt="" complete="complete" src="<?php echo BASE_PATH.'assets/design/bhartiaxa-logo.jpg'?>" title=""> </a> 
</div> 

</div>
</div>
</div> 
</div>

<div id="content" style="width:100%;margin-top:19%;"> 
<div class="v_layout" style="margin-top: -10%;width:96%;">
<div id="form" class="h-100 row align-items-center">

<form  role="form"  id="leadcreate" action="<?php echo base_url(); ?>index.php/create" method="post" accept-charset="utf-8" auto-complete="false">
        <div class="row">
         <div class="form-group col-xs-2">
           <label for="exampleInputEmail1">Status Code</label>
          </div>
          <div class="form-group col-xs-2">
            <select class="form-control" name="statuscode" id="statuscode">
              <option value="0">--Select--</option>
              <option value="Open">Open</option>
              <option value="Docs Collected">Docs Collected</option>
              <option value="Converted">Converted</option>              
            </select>
          </div> 
           <div class="form-group col-xs-2">
           <label for="exampleInputEmail1">Product Type</label>
          </div>
           <div class="col-xs-2">
            <select class="form-control" name="producttype" id="producttype">
              <option value="0">--Select--</option>
              <option value="Health">Health</option>
              <option value="Motor">Motor</option>
              <option value="Home">Home</option>
               <option value="Office">Office</option>
              <option value="Shop">Shop</option>
              <option value="Doctor">Doctor</option>
                <option value="Indemnity">Indemnity</option>
               <option value="SME">SME</option>
              <option value="GMC">GMC</option>
              <option value="GPA">GPA</option>
               <option value="Health Bundled">Health Bundled</option>
            </select>
          </div> 
        </div>
        <div class="row">
          <div class="col-xs-2">
            <label for="exampleInputEmail1">Customer Name</label>
          </div>
         <div class="col-xs-2">
            <input type="text" name="customername" id="customername" class="form-control" ">
          </div>
       <div class="col-xs-2">
            <label for="exampleInputEmail1">Policy No</label>
          </div>
         <div class="col-xs-2">
            <input type="text" name="policyno" id="policyno" maxlength="25" class="form-control" ">
          </div>
        </div>

         <div class="row">
           <div class="col-xs-2">
           <label for="exampleInputEmail1">Employee Code</label>
          </div>
          <div class="col-xs-2">
            <select class="form-control" name="ecode" id="ecode" onchange="empCode();">
            <option value="0">--Select--</option>EmployeeName
            <?php foreach ($emp_name as $key => $value) {
              ?>
            <option value="<?php echo $value?>"><?php echo $value?></option>
           <?php } ?>
            </select>
          </div>
          <div class="col-xs-2">
            <label for="exampleInputEmail1">Employee Name</label>
          </div>
          <div class="col-xs-2">
            <select class="form-control" id="ename" name="ename">

          </select>
          </div>
        </div>

      <div class="row">
           <div class="col-xs-2">
           <label for="exampleInputEmail1">Branch Code </label>
           
          </div>
          <div class="col-xs-2">

          <input  type="text" id="bcode" autocomplete="off" name="bcode" class="form-control" placeholder="Type to get an Ajax call of Countries">

            <select class="form-control" name="bcode" id="bcode" onchange="branchCode();">
            <option value="0">--Select--</option>BranchName
            <?php foreach ($branch_name as $key => $value) {
              ?>
            <option value="<?php echo $value?>"><?php echo $value?></option>
           <?php } ?>
            </select>
          </div>
          <div class="col-xs-2">
            <label for="exampleInputEmail1">Branch Name</label>
          </div>
          <div class="col-xs-2">
            <select class="form-control" id="bname" name="bname">

          </select>
          </div>
        </div>


<!--          <div class="row">
           <div class="col-xs-2">
           <label for="exampleInputEmail1">Branch Code </label>
           
          </div>
          <div class="col-xs-2">
            <select class="form-control" name="bcode" id="bcode" onchange="branchCode();">
            <option value="0">--Select--</option>BranchName
            <?php foreach ($branch_name as $key => $value) {
              ?>
            <option value="<?php echo $value?>"><?php echo $value?></option>
           <?php } ?>
            </select>
          </div>
          <div class="col-xs-2">
            <label for="exampleInputEmail1">Branch Name</label>
          </div>
          <div class="col-xs-2">
            <select class="form-control" id="bname" name="bname">

          </select>
          </div>
        </div>
 -->       
        <div class="row">
          <div class="col-xs-2">
            <label for="exampleInputEmail1">Premium</label>
          </div>
         <div class="col-xs-2">
            <input type="text" name="premium" id="premium" onkeypress="return isNumber(event)" maxlength="7" class="form-control" ">
          </div>
           <div class="col-xs-2">
            <label for="exampleInputEmail1">Lead No </label>
          </div>
         <div class="col-xs-2">
            <input type="text" name="leadno" id="leadno" maxlength="15" class="form-control" ">
          </div>

        </div>
        <div class="row">
        


          <div class="col-xs-2">
            <label for="exampleInputEmail1">Comment</label>
          </div>
         <div class="col-xs-2">
          <textarea rows="3" name="comment" cols="50" maxlength="100"  id="comment" width: "174px;" height:"41px; class="form-control" "></textarea>
           <!--  <input type="text" name="comment" id="comment" maxlength="10" class="form-control" "> -->
          </div>
        </div>
</br>
</br>
 <div class="row" style=" margin-left: -15%;">
<div class="col-md-4 text-center"> 
    <button  type="button" id="save" name="save"  onclick="submitformforcreate();" class="btn btn-primary">Save</button> 
    <button  type="button" onclick="leadCancel();" id="leadcancel" name="cancel" class="btn btn-primary">Cancel</button> 
</div>
</div>
</form>  
<style type="text/css">
.ui-widget {
font-family: Arial;
font-size: 14px;
font-weight: normal;
line-height: 20px;
}

</style>
<script type="text/javascript">

//auto search start
$(document).ready(function () {
  var url = '<?php echo site_url()?>';
    $("#bcode").keyup(function () {
      console.log("coming");
        $.ajax({
            type: "POST",
            url: url+"index.php"+"/lead/branch",
            data: {
                keyword: $("#bcode").val()
            },
            dataType: "json",
            success: function (data) {
              console.log(data);
                if (data.length > 0) {
                    $('#DropdownCountry').empty();
                    $('#country').attr("data-toggle", "dropdown");
                    $('#DropdownCountry').dropdown('toggle');
                }
                else if (data.length == 0) {
                    $('#country').attr("data-toggle", "");
                }
                $.each(data, function (key,value) {
                    if (data.length >= 0)
                        $('#DropdownCountry').append('<li role="displayCountries" ><a role="menuitem dropdownCountryli" class="dropdownlivalue">' + value['name'] + '</a></li>');
                });
            }
        });
    });
    $('ul.txtcountry').on('click', 'li a', function () {
        $('#country').val($(this).text());
    });
});

//end
//branchcode and branch name start

function branchCode(){
  var url = '<?php echo site_url()?>';
var branch_code  = $('#bcode option:selected').val();
  jQuery.ajax({
      type:"post",
      dataType:"json",
      url: url+"index.php"+"/lead/branch",
      data: {branch_code:branch_code},
        success: function(data) {
          $('#bname').empty();
          $.each( data, function( key, value ) {
          $('#bname').append('<option value="'+value+'">'+value+'</option>');
          });
      },
  });
}
//branchcode and branchname end

//empcode and empname start
function empCode(){
  var url = '<?php echo site_url()?>';
var emp_code  = $('#ecode option:selected').val();
  jQuery.ajax({
      type:"post",
      dataType:"json",
      url: url+"index.php"+"/lead/employee",
      data: {emp_code:emp_code},
        success: function(data) {
          console.log(data);
          $('#ename').empty();
          $.each( data, function( key, value ) {
          $('#ename').append('<option value="'+value+'">'+value+'</option>');
          });
      },
  });
}
//empcode and empname end
function leadCancel(){
  document.getElementById('leadcreate').reset();

}
function submitformforcreate(){

 var status_code            = $('#statuscode option:selected').val();
  var product_type          = $('#producttype option:selected').val();
  var customer_name          = $('#customername').val();
  var employee_code          = $('#ecode option:selected').val();
  var employee_name          = $('#ename option:selected').val();
  var branch_code            = $('#bcode option:selected').val();
  var branch_name            = $('#bname option:selected').val();
  var premium               = $('#premium').val();
  var policyno              = $('#policyno').val();
  var leadno                = $('#leadno').val();
  var comment           = $('#comment').val();
  console.log(status_code);
    if (status_code == '0' ) {
      document.getElementById('statuscode').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('statuscode').style.borderColor = ''; 
    }

     if (status_code === 'Converted' ) {

         if (policyno == '' ) {
      document.getElementById('policyno').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('policyno').style.borderColor = ''; 
    }

    }
    else {
      document.getElementById('policyno').style.borderColor = ''; 
    }

if (product_type == '0' ) {
      document.getElementById('producttype').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('producttype').style.borderColor = ''; 
    }

    if (customer_name == '' ) {
      document.getElementById('customername').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('customername').style.borderColor = ''; 
    }

    if (employee_code == '0' ) {
      document.getElementById('ecode').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('ecode').style.borderColor = ''; 
    }
        if (employee_name == '0' ) {
      document.getElementById('ename').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('ename').style.borderColor = ''; 
    }
        if (branch_code == '0' ) {
      document.getElementById('bcode').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('bcode').style.borderColor = ''; 
    }
        if (branch_name == '0' ) {
      document.getElementById('bname').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('bname').style.borderColor = ''; 
    }
    
    if (premium == '' ) {
      document.getElementById('premium').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('premium').style.borderColor = ''; 
    }
    if (comment == '' ) {
      document.getElementById('comment').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('comment').style.borderColor = ''; 
    }
    if (leadno == '' ) {
      document.getElementById('leadno').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('leadno').style.borderColor = ''; 
    }


    document.getElementById("leadcreate").submit();
}
</script>
</div>
</div>
</div> 
</div>
</div>
</body>
</html>