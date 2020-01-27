<?php

foreach ($branchdetails as $key => $value) {
 $branchCode[] = $value->Branch_Code;
 $branchName[] = $value->Branch_Name;
}
$branch_code = array_unique($branchCode);
$branch_name = array_unique($branchName);
$branch_name_json = json_encode($branch_name);

foreach ($employeedetails as $key => $value) {
 $empCode[] = $value->Employee_Code;
 $empName[] = $value->Employee_Name;
}
$emp_code = array_unique($empCode);
$emp_name = array_unique($empName);
$emp_name_json = json_encode($emp_name);

require_once(APPPATH.'views/header.php');

$arr_product_type = array('Health' =>'Health' ,'Motor' =>'Motor','Home' =>'Home','Office' =>'Office','Shop' =>'Shop','Health' =>'Health','Idemnity' =>'Indemnity','Sme' =>'SME','GMC' =>'GMC','GPA' =>'GPA','Bundled' =>'Health Bundled');
$arr_status = array('Docs Collected' =>'Docs Collected' ,'Converted' =>'Converted');
?>

<link href="<?php echo BASE_PATH.'assets/upload/uploadfile.css'?>" rel="stylesheet">
<script src="<?php echo BASE_PATH.'assets/upload/jquery.uploadfile.min.js'?>"></script>

     <form  role="form" action="<?php echo base_url(); ?>index.php/user/uw_update" method="post" id="UW_update" accept-charset="utf-8" auto-complete="false">
      <input type="hidden" value="<?php echo site_url()?>" id="url">
       
        <div class="row">
          <div class="col-xs-2">
            <label for="exampleInputEmail1">Status Code</label>
          </div>
          <div class="col-xs-2">
            <select class="form-control" name="statuscode" id="statuscode">
                 
          <option value="<?php echo $result->StatusCode?>"><?php echo $result->StatusCode?>
            <?php foreach ($arr_status as $key => $value) {
            if($result->StatusCode != $value){
            ?>
            <option value="<?php echo $value?>"><?php echo $value?></option>
            <?php
            } }  ?>
     
        </select>
          </div>
          <div class="col-xs-2">
            <label for="exampleInputEmail1">Product Type </label>
          </div>
          <div class="col-xs-2">
            <select class="form-control" name="ptype" id="ptype">
            <option value="<?php echo $result->ProductType?>"><?php echo $result->ProductType;?>
           <?php  foreach ($arr_product_type as $key => $value) {
             if($result->ProductType != $value){
             ?>
             <option value="<?php echo $value?>"><?php echo $value?></option>
             <?php
             } } ?>
          </select>
          </div>
        </div>


       <div class="row">
          <div class="col-xs-2">
            <label for="exampleInputEmail1">Customer Name</label>
          </div>
          <div class="col-xs-2">
            <input type="text" name="customername" id="customername" class="form-control" value="<?php echo $result->CustomerName;?>">
          </div>
             <div class="col-xs-2">
            <label for="exampleInputEmail1">Premium</label>
          </div>
          <div class="col-xs-2">
            <input type="text" name="premium" id="premium" class="form-control" value="<?php echo $result->Premium;?>">
          </div>        
        </div>
  

        <div class="row">
      <div class="col-xs-2">
        <label for="phone">Employee Code</label>
      </div>
    <div class="col-xs-2">
      <input type="text"  name="autoecode" id="autoecode" value="<?php echo $result->EmployeeCode?>" class="form-control" onchange="empCode();">
    </div>
      <div class="col-xs-2">
       <label for="password">Employee Name</label> 
      </div>
      <div class="col-xs-2">
    <input type="text"  name="ename" id="ename" value="<?php echo $result->EmployeeName?>" class="form-control">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-2">
        <label for="phone">Branch Code</label>
      </div>
      <div class="col-xs-2">
       <input type="text"  name="autobcode" id="autobcode" value="<?php echo $result->BranchCode?>" class="form-control" onchange="bCode();">
      </div>

      <div class="col-xs-2">
       <label for="password">Branch Name</label> 
      </div>
      <div class="col-xs-2">
      <input type="text"  name="bname" id="bname" value="<?php echo $result->BranchName?>" class="form-control">
      </div>
    </div>
 
     <div class="row">
        <div class="col-xs-2">
            <label for="exampleInputEmail1">Lead No </label>
          </div>
          <div class="col-xs-2">
            <input type="text"  name="leadno" id="leadno" value="<?php echo $result->LeadNo?>" class="form-control">
          </div>
         <div class="col-xs-2">
           <label for="exampleInputEmail1">Comment</label>
          </div>
         <div class="col-xs-2">
            <textarea rows="3" cols="4"  maxlength="500" name="comment" id="comment"><?php echo $result->Comment?></textarea>
          </div>
     </div>
      <div class="row">
      
     
        </div>
      

 <div class="row">
         
       <div class="col-xs-2">
            <label for="exampleInputEmail1">Policy No</label>
          </div>
         <div class="col-xs-4 form-inline" style="width: 77%;">
            <input type="text" name="policyno1" id="policyno1"  maxlength="3" style="width:4%"  onkeypress="return alphanumeric(this, event)" value="<?php echo $result->PolicyNo;?>">/
            <input type="text" name="policyno2" id="policyno2"  maxlength="8" style="width: 8%;" onkeypress="return alphanumeric(this, event)" value="<?php echo $result->PolicyNo;?>">/
            <input type="text" name="policyno3" id="policyno3"  maxlength="2" style="width: 2%;" onkeypress="return alphanumeric(this, event)" value="<?php echo $result->PolicyNo;?>">/
            <input type="text" name="policyno4" id="policyno4"  maxlength="2" style="width: 2%;" onkeypress="return alphanumeric(this, event)" value="<?php echo $result->PolicyNo;?>">/
            <input type="text" name="policyno5" id="policyno5"  maxlength="6" style="width: 7%;" onkeypress="return alphanumeric(this, event)" value="<?php echo $result->PolicyNo;?>">
          </div>
        </div>
      </br>
      </br>
          <div class="row" style=" margin-left: -15%;">
            <div class="col-md-4 text-center">
            <button  type="button" onclick="leadCancel();" id="leadcancel" name="cancel" class="btn btn-primary">Cancel</button>
             <button type="button" id="submit-inspection"  onclick="updateIns();" class="btn btn-info">Update</button>
        </div>
 </div>
</div>
   
       
</form>
    
<?php 
require_once(APPPATH.'views/footer.php');
?>
<script type="text/javascript">
var url      = '<?php echo site_url()?>';
var ref_no   = $('#ref_no').val();
var id       = $('#id').val();

//APG/I2435770/22/07/B26139

var p1 = '<?php echo substr($result->PolicyNo,0,3)?>';
document.getElementById("policyno1").value = p1;
var p2 = '<?php echo substr($result->PolicyNo,3,8)?>';
document.getElementById("policyno2").value = p2;
var p3 = '<?php echo substr($result->PolicyNo,11,2)?>';
document.getElementById("policyno3").value = p3;
var p4 = '<?php echo substr($result->PolicyNo,13,2)?>';
document.getElementById("policyno4").value = p4;
var p5 = '<?php echo substr($result->PolicyNo,15,6)?>';
document.getElementById("policyno5").value = p5;
</script>

<script type="text/javascript">

document.getElementById("leadno").readOnly = true;

function leadCancel(){
  document.getElementById('UW_update').reset();
3
}

function alphanumeric(txt, e) {
    var arr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    var code;
    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    var char = keychar = String.fromCharCode(code);
    if (arr.indexOf(char) == -1)
        return false;
}

$("#policyno1").keyup(function () {
    if (this.value.length >= 3) {
      $('#policyno2').focus();
    }
});
$("#policyno2").keyup(function () {
    if (this.value.length >= 8) {
      $('#policyno3').focus();
    }
});
$("#policyno3").keyup(function () {
    if (this.value.length >= 2) {
      $('#policyno4').focus();
    }
});
$("#policyno4").keyup(function () {
    if (this.value.length >= 2) {
      $('#policyno5').focus();
    }
});


$( function() {
  var s = ["P0002","S7928","V2499","R3809","M2995","J1244","K1996","I0259","S7933","R3811","V2502","K1997","S7934","N3350","R3813","D1794","P3092","P3093","P3094","R0009","M0004","J0002","B1134","D1795","D1796","E0104","J1246","M2998","M2999","M3000","M3001","P3095","S7937"];
    var availableTags = s;   
    $( "#autoecode" ).autocomplete({
      source: availableTags
    });
  } );

 $( function() {
  var b = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"];
    var availableTagsb = b;   
    $( "#autobcode" ).autocomplete({
      source: availableTagsb
    });
  } );


//edit branchcode start
function bCode(){
var url = $('#url').val();
var branch_code  = $('#autobcode').val();
if(branch_code==='' || branch_code===' ' || branch_code=='0'){
  document.getElementById("bname").value = '';
}else{
  jQuery.ajax({
      type:"post",
      dataType:"json",
      url: url+"index.php"+"/user/branch",
      data: {branch_code:branch_code},
        success: function(data) {
          $('#bname').empty();
          $.each( data, function( key, value ) {
            document.getElementById("bname").value = value;
         // $('#bname').append('<option value="'+value+'">'+value+'</option>');
          });
      },
         });
    }
}
//edit branccode end

function empCode(){
  var url = '<?php echo site_url()?>';
var emp_code  = $('#autoecode').val();
if(emp_code==='' || emp_code===' ' || emp_code=='0'){
  document.getElementById("ename").value = '';
}else{
  jQuery.ajax({
      type:"post",
      dataType:"json",
      url: url+"index.php"+"/user/employee",
      data: {emp_code:emp_code},
        success: function(data) {
          $('#ename').empty();
          $.each( data, function( key, value ) {
            document.getElementById("ename").value = value;
         // $('#ename').append('<option value="'+value+'">'+value+'</option>');
          });
      },
  });}
}

function updateIns(){
var status_code            = $('#statuscode option:selected').val();
  var product_type          = $('#ptype option:selected').val();
  var customer_name          = $('#customername').val();
  var employee_code          = $('#autoecode').val();
  var employee_name          = $('#ename').val();
  var branch_code            = $('#autobcode').val();
  var branch_name            = $('#bname').val();
  var premium               = $('#premium').val();
  var policyno1              = $('#policyno1').val();
  var policyno2              = $('#policyno2').val();
  var policyno3              = $('#policyno3').val();
  var policyno4              = $('#policyno4').val();
  var policyno5              = $('#policyno5').val();
//  var policyno              = $('#policyno').val();
  var leadno                = $('#leadno').val();
  var comment           = $('#comment').val();



if (status_code == '0' ) {
      document.getElementById('statuscode').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('statuscode').style.borderColor = ''; 
    }

     if (status_code === 'Converted' ) {

         if (policyno1 == '' ) {
      document.getElementById('policyno1').style.borderColor = "red";
      return false;
    }
    else if(policyno1.length != '3'){
      document.getElementById('policyno1').style.borderColor = "red";
      alert("Enter 3 digit");
      return false;
    }
    else {
      document.getElementById('policyno1').style.borderColor = ''; 
    }
     if (policyno2 == '' ) {
      document.getElementById('policyno2').style.borderColor = "red";
      return false;
    }
    else if(policyno2.length != '8'){
      document.getElementById('policyno2').style.borderColor = "red";
      alert("Enter 8 digit");
      return false;
    }
    else {
      document.getElementById('policyno2').style.borderColor = ''; 
    }
     if (policyno3 == '' ) {
      document.getElementById('policyno3').style.borderColor = "red";
      return false;
    }
    else if(policyno3.length != '2'){
      document.getElementById('policyno2').style.borderColor = "red";
      alert("Enter 2 digit");
      return false;
    }
    else {
      document.getElementById('policyno3').style.borderColor = ''; 
    }
     if (policyno4 == '' ) {
      document.getElementById('policyno4').style.borderColor = "red";
      return false;
    }
    else if(policyno4.length != '2'){
      document.getElementById('policyno4').style.borderColor = "red";
      alert("Enter 2 digit");
      return false;
    }
    else {
      document.getElementById('policyno4').style.borderColor = ''; 
    }
     if (policyno5 == '' ) {
      document.getElementById('policyno5').style.borderColor = "red";
      return false;
    }
    else if(policyno5.length != '6'){
      document.getElementById('policyno5').style.borderColor = "red";
      alert("Enter 6 digit");
      return false;
    }
    else {
      document.getElementById('policyno5').style.borderColor = ''; 
    }

    }


if (product_type == '0' ) {
      document.getElementById('ptype').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('ptype').style.borderColor = ''; 
    }

    if (customer_name == '' ) {
      document.getElementById('customername').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('customername').style.borderColor = ''; 
    }

    if (employee_code == '' || employee_code === '0' || employee_code === ' ' ) {
      document.getElementById('autoecode').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('autoecode').style.borderColor = ''; 
    }
        if (employee_name == '' || employee_name === '0' || employee_name === ' ' ) {
      document.getElementById('ename').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('ename').style.borderColor = ''; 
    }
        if (branch_code == '' || branch_code ===  '0' || branch_code === ' ' ) {
      document.getElementById('autobcode').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('autobcode').style.borderColor = ''; 
    }
        if (branch_name == '' || branch_name === '0' || branch_name === ' ') {
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

    document.getElementById("UW_update").submit();

}

</script>


<style type="text/css">
table,th,td{
  padding: 8px;
  line-height: 1.42857143;
  vertical-align: top;
  border: 1px solid rgb(211, 199, 199);
  color: rgb(17, 49, 132);
}
</style>
 