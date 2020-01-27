<?php
require_once(APPPATH.'views/header.php');
//var_dump($this->session->userdata);die();
?>

<ul class="breadcrumb">
  <li>Lead <span class="divider">/</span></li>
  <li><a href="<?php echo site_url();?>index.php/home/leadView">Create Lead</a></li>
</ul>
 <fieldset style="
    margin-right: 5%;
    margin-left: 8%;">
    <legend>
      Create Lead
    </legend>
<form  role="form"  id="leadcreate" action="<?php echo base_url(); ?>index.php/create" method="post" accept-charset="utf-8" auto-complete="false">
        <div class="row">
         <div class="form-group col-xs-2">
           <label for="exampleInputEmail1">Status Code</label>
          </div>
          <div class="form-group col-xs-2">
            <select class="form-control" name="statuscode" id="statuscode">
              <option value="0">--Select--</option>
                <option value="Docs Collected">Docs Collected</option>
              <option value="Converted">Converted</option>              
            </select>
          </div> 
          <!-- pt -->
<div class="col-xs-1">
            </div>
           <div class="col-xs-2">
            <label for="exampleInputEmail1">Lead No </label>
          </div>
         <div class="col-xs-2">
            <input type="text" name="leadno" id="leadno" maxlength="15" class="form-control">
          </div>
            <div class="col-xs-2">
            </div>
          <!-- pt end -->
        </div>
        <div class="row">
          <div class="col-xs-2">
            <label for="exampleInputEmail1">Customer Name</label>
          </div>
         <div class="col-xs-2">
            <input type="text" name="customername" id="customername" class="form-control">
          </div>

            <div class="col-xs-1">
            </div>
            <div class="col-xs-2">
           <label for="exampleInputEmail1">Employee Code</label>
          </div> 
          <div class="col-xs-2">
            <input  type="text" id="autoecode" readonly autocomplete="on" value='<?php echo $EmployeeCode ?>' name="autoecode" class="form-control" >

          </div>
<!--           <div class="col-xs-2">
            <label for="exampleInputEmail1">Customer ID</label>
          </div>
         <div class="col-xs-2">
            <input type="text" name="customerid" id="customerid" class="form-control">
          </div>
-->
            <input type="hidden" name="customerid" id="customerid" value="">
        </div>

         <div class="row ui-widget">
           <div class="col-xs-2">
            <label for="exampleInputEmail1">Employee Name</label>
          </div>
          <div class="col-xs-2">
             <input type="text" value='<?php echo $EmployeeName ?>' readonly name="employeename" id="employeename" class="form-control" >

          </div>
             <div class="col-xs-1">
            </div>
             <div class="col-xs-2">
           <label for="exampleInputEmail1">Branch Code </label>
           
          </div>
          <div class="col-xs-2">

          <input  type="text" value='<?php echo $BranchCode ?>' id="branchcode" readonly name="branchcode" class="form-control">

          </div>
          
        </div>

      <div class="row">
            <div class="col-xs-2">
            <label for="exampleInputEmail1">Branch Name</label>
          </div>
          <div class="col-xs-2">
           <input type="text" value='<?php echo $BranchName ?>' name="branchname" readonly id="branchname" class="form-control" />

          </div>
          <div class="col-xs-1">
            </div>
          <div class="col-xs-2">
           <label for="exampleInputEmail1">Channel Name</label>
           
          </div>
          <div class="col-xs-2">

          <input  type="text" value ='<?php echo $ChannelName ?>' id="channelname" readonly name="channelname" class="form-control" />

          </div>
         
        </div>
<!-- new -->
 <div class="row">
             <div class="col-xs-2">
            <label for="exampleInputEmail1">Certification type</label>
          </div>
          <div class="col-xs-2">
           <input type="text" value ='<?php echo $CertificationType ?>' name="certificatetype" readonly id="certificatetype" class="form-control" />
          </div>
            <div class="col-xs-1">
            </div>
      <div class="col-xs-2">
           <label for="exampleInputEmail1">Certification code</label>
           
          </div>
          <div class="col-xs-2">

          <input  type="text" value ='<?php echo $CertificationCode ?>' id="certificatecode"  readonly name="certificatecode" class="form-control" />

          </div>
        
        </div>
     <div class="row">
          <div class="col-xs-2">
            <label for="exampleInputEmail1">Date</label>
          </div>
          <div class="col-xs-2">
           <input type="text" value="<?php echo date('d/m/Y');?>" name="currentdate" readonly id="currentdate" class="form-control"/>

          </div>
         <div class="col-xs-1">
            </div>
         <div class="form-group col-xs-2">
           <label for="exampleInputEmail1" >Product Type </label>
          </div>

        <div class="col-xs-2">
          <select class="custom-select" id="inputGroupSelect02" name="inputGroupSelect02" required="inputGroupSelect02">
          <option>Choose</option>
          </select>
       
        </div>
          
        </div>
<!-- e -->
     
        <div class="row">
           <div class="col-xs-2">
            <label for="exampleInputEmail1">Premium</label>
          </div>
         <div class="col-xs-2">
            <input type="text" name="premium" id="premium" onkeypress="return isNumber(event)" maxlength="7" class="form-control" >
          </div>
            <div class="col-xs-1">
            </div>
  
                  <div class="col-xs-2">
            <label for="exampleInputEmail1">Max Sum insured per life/location/risk</label>
          </div>
         <div class="col-xs-2">
         <input type="text" name="suminsuredamount" readonly="" id="suminsuredamount"  maxlength="7" class="form-control">
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
       <div class="col-xs-1">
            </div>

          
         
        </div>


              <div class="row">
         
       <div class="col-xs-2">
            <label for="exampleInputEmail1">Policy No</label>
          </div>
         <div class="col-xs-2 form-inline" style="width: 77%;">
            <input type="text" name="policyno1" id="policyno1"  maxlength="3" style="width:25px"  onkeypress="return alphanumeric(this, event)" >/
            <input type="text" name="policyno2" id="policyno2"  maxlength="8" style="width: 64px" onkeypress="return alphanumeric(this, event)" >/
            <input type="text" name="policyno3" id="policyno3"  maxlength="2" style="    width: 16px;" onkeypress="return alphanumeric(this, event)" >/
            <input type="text" name="policyno4" id="policyno4"  maxlength="2" style="    width: 16px;" onkeypress="return alphanumeric(this, event)" >/
            <input type="text" name="policyno5" id="policyno5"  maxlength="6" style="width: 50px" onkeypress="return alphanumeric(this, event)" >
          </div>
        </div>
</br>
</br>
 <div class="row" style=" margin-left: -15%;">
<div class="col-md-4 text-center"> 
    <button  type="button" id="save" name="save"  onclick="submitformforcreate();" class="btn btn-primary formButtons">Save</button> 
    <button  type="button" onclick="leadCancel();" id="leadcancel" name="cancel" class="btn btn-primary formButtons">Cancel</button> 
</div>
</div>
</form>
 </fieldset> 

<style type="text/css">
.ui-widget {
font-family: Arial;
font-size: 14px;
font-weight: normal;
line-height: 20px;
}

</style>
<script type="text/javascript">

//Composit Certified
// product type select 
        var products = new Array();
        products['Other'] = new Array('New Personal Accident (Group Product)', 'Universal Protection Plan combo (CI+PA+HC)')
        products['LI Certified'] = new Array('New Personal Accident (Group Product)', 'Universal Protection Plan combo (CI+PA+HC)')
        products['GI Cetified'] = new Array('Householder Package Policy -Only base & Valuable cover', 'Motor Two Wheeler Insurance','Motor Private Car Insurance','Motor Commercial Vehicle Insurance','Motor Liability only Insurance','Smart Individual Personal Accident Policy','Smart Health Critical Illness Policy','Traveller Insurance Policy','Group Health Insurance Policy','New Personal Accident (Group Product)','Universal Protection Plan combo (CI+PA+HC)','Shop Package Policy','Office Package Policy','Householders Package Policy- with all optional cover','Doctors Indemnity Policy','UniProtect','Group Health Insurance Policy','Group Personal Accident','Others-Including corporate insurance');
        products['Composit Certified'] = new Array('Householder Package Policy -Only base & Valuable cover', 'Motor Two Wheeler Insurance','Motor Private Car Insurance','Motor Commercial Vehicle Insurance','Motor Liability only Insurance','Smart Individual Personal Accident Policy','Smart Health Critical Illness Policy','Traveller Insurance Policy','Group Health Insurance Policy','New Personal Accident (Group Product)','Universal Protection Plan combo (CI+PA+HC)','Shop Package Policy','Office Package Policy','Householders Package Policy- with all optional cover','Doctors Indemnity Policy','UniProtect','Group Health Insurance Policy','Group Personal Accident','Others-Including corporate insurance');
        products['POSP'] = new Array('Householders Package Policy -Only base & Valuable cover','Motor Two Wheeler Insurance','Motor Private Car Insurance','Motor Commercial Vehicle Insurance','Liability only Insurance','Smart Individual Personal Accident Policy','Smart Health Critical Illness Policy','Traveller Insurance Policy','Group Health Insurance Policy','New Personal Accident (Group Product)','Universal Protection Plan combo (CI+PA+HC)','POSP–UniProtect')
     
       
        var generateOptions = function (selectTag, options) {
            options.forEach(function (element) {
                var option = document.createElement('option');
                option.text = element;
                option.value = element;
                selectTag.appendChild(option);
            }, this);
        }

//LI Certified
        var selectTag = document.getElementById('inputGroupSelect02');
     
        switch (document.getElementById('certificatetype').value) {
            case 'Other':
                generateOptions(selectTag, products['Other']);
                break;
            case 'LI Certified':
                generateOptions(selectTag, products['LI Certified']);
                break;
            case 'GI Cetified':
                generateOptions(selectTag, products['GI Cetified']);
                break;
             case 'Composit Certified':
                generateOptions(selectTag, products['Composit Certified']);
                break;
            case 'POSP':
                generateOptions(selectTag, products['POSP']);
                break;
        }
    

// end

//allow only char in customer field
$(function () {
      $('#customername').keydown(function (e) {
          if (e.ctrlKey || e.altKey) {
              e.preventDefault();
          } else {
              var key = e.keyCode;
              if (!((key == 8) || (key == 32) || (key == 46) || (key == 16) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                  e.preventDefault();
              }
          }
      });
  });

  //allow only alphanumer and ,/ in comment field

  $('#comment').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9,/ ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
});

  //allow only alphanumeric in emp code
  $('#autoecode').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
});
 
  //allow only alphanumeric in  branch code
 $('#autobcode').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
});

//autogenerate start
document.getElementById("leadno").readOnly = true;

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

$( document ).ready(function() {
  var seq = (Math.floor(Math.random() * 100000) + 100000).toString().substring(1);
  var x = new Date();
    var y = x.getFullYear().toString();
    var m = (x.getMonth() + 1).toString();
    var d = x.getDate().toString();
    (d.length == 1) && (d = '0' + d);
    (m.length == 1) && (m = '0' + m);
    var yyyymmdd = y + m + d;

document.getElementById("leadno").value = yyyymmdd+''+seq;

    
});
   
//autogenerate end

$( document ).ready(function() {
 // alert("comming");
  var ctype="<?php echo $CertificationType; ?>";
   //  alert(ctype);
});

$('select').on('change', function()
{
    var ptype= this.value;
   
    var str = ptype;
    // var productType= str.replace("/ /g", "_");
    var certificateType = $("#certificatetype").val();
    var search = " ";
    var replacement = "_";
    var productType = replaceAll(str, search, replacement); 
    certificateType = replaceAll(certificateType, search, replacement);
    // certificateType = certificateType.replace("/ /g", "_");
    certificateType = certificateType.concat("_");
    var finalJsonKey = certificateType.concat(productType);

    $("#suminsuredamount").val(getSumInsuredValue(finalJsonKey));
});

function replaceAll(data, search, replacement) {
    var target = data;
    return target.split(search).join(replacement);
};

function getSumInsuredValue(finalJsonKey) {
  var json = '{"Other_New_Personal_Accident_(Group_Product)": "No Limit","Other_Universal_Protection_Plan_combo_(CI+PA+HC)": "No Limit","LI_Certified_New_Personal_Accident_(Group_Product)": "No Limit","LI_Certified_Universal_Protection_Plan_combo_(CI+PA+HC)": "No Limit","GI_Cetified_Householder_Package_Policy_-Only_base_&_Valuable_cover": "INR 1 to 5 Cr","GI_Cetified_Motor_Two_Wheeler_Insurance": "INR 1 to 5 Cr","GI_Cetified_Motor _Private_Car_Insurance": "INR 1 to 5 Cr","GI_Cetified_Motor _Commercial_Vehicle_Insurance": "INR 1 to 5 Cr","GI_Cetified_Liability_only_Insurance": "No Limit","GI_Cetified_Smart_Individual_Personal_Accident_Policy": "INR 1 to 5 Cr","GI_Cetified_Smart_Health_Critical_Illness_Policy": "INR 1 to 5 Cr","GI_Cetified_Traveller_Insurance_Policy": "USD above 350000","GI_Cetified_New_Personal_Accident_(Group_Product)": "No Limit","GI_Cetified_Universal_Protection_Plan_combo_(CI+PA+HC)": "No Limit","GI_Cetified_Shop_Package_Policy": "INR 1 to 5 Cr","GI_Cetified_Office_Package_Policy": "INR 1 to 5 Cr","GI_Cetified_Householders_Package_Policy-_with_all_optional_cover": "INR 1 to 5 Cr","GI_Cetified_Super_Ship": "INR 1 to 5 Cr","GI_Cetified_Doctors_Indemnity_Policy": "INR 1 to 5 Cr","GI_Cetified_POS_UniProtect": "No Limit","GI_Cetified_Group_Health_Insurance_Policy": "INR 1 to 5 Cr","GI_Cetified_Group_Personal_Accident": "INR 1 to 5 Cr","GI_Cetified_Others-Including_corporate_insurance": "INR 1 to 5 Cr","Composit_Certified_Householder_Package_Policy_-Only_base_&_Valuable_cover": "INR 1 to 5 Cr","Composit_Certified_Motor_Two_Wheeler_Insurance": "INR 1 to 5 Cr","Composit_Certified_Motor_Private_Car_Insurance": "INR 1 to 5 Cr","Composit_Certified_Motor_Commercial_Vehicle_Insurance": "INR 1 to 5 Cr","Composit_Certified_Motor_Liability_only_Insurance": "No Limit","Composit_Certified_Smart_Individual_Personal_Accident_Policy": "INR 1 to 5 Cr","Composit_Certified_Smart_Health_Critical_Illness_Policy": "INR 1 to 5 Cr","Composit_Certified_Traveller_Insurance_Policy": "USD above 350000","Composit_Certified_New_Personal_Accident_(Group_Product)": "No Limit","Composit_Certified_Universal_Protection_Plan_combo_(CI+PA+HC)": "No Limit","Composit_Certified_Shop_Package_Policy": "INR 1 to 5 Cr","Composit_Certified_Office_Package_Policy": "INR 1 to 5 Cr","Composit_Certified_Householders_Package_Policy-_with_all_optional_cover": "INR 1 to 5 Cr","Composit_Certified_Doctors_Indemnity_Policy": "INR 1 to 5 Cr","Composit_Certified_UniProtect": "INR 1 to 5 Cr","Composit_Certified_Group_Health_Insurance_Policy": "INR 1 to 5 Cr","Composit_Certified_Group_Personal_Accident": "INR 1 to 5 Cr","Composit_Certified_Others-Including_corporate_insurance": "INR 1 to 5 Cr","POSP_Householders_Package_Policy_-Only_base_&_Valuable_cover": "INR 1 to 50 Lac","POSP_Motor_Two_Wheeler_Insurance": "INR 1 to 50 Lac","POSP_Motor_Private_Car_Insurance": "INR 1 to 50 Lac","POSP_Motor_Commercial_Vehicle_Insurance": "INR 1 to 50 Lac","POSP_Liability_only_Insurance": "No Limit","POSP_Smart_Individual_Personal_Accident_Policy": "INR 1 to 50 Lac","POSP_Smart_Health_Critical_Illness_Policy": "INR 1 to 3 Lac", "POSP_Group_Health_Insurance_Policy":"No Limit","POSP_Traveller_Insurance_Policy": "USD 1 - 350000","POSP_New_Personal_Accident_(Group_Product)": "No Limit","POSP_Universal_Protection_Plan_combo_(CI+PA+HC)": "No Limit","POSP_POSP–UniProtect": "No Limit"}';

  var sumInsureArray = $.parseJSON(json);
  return sumInsureArray[finalJsonKey];
}

//branchcode and branch name start

function branchCode(){
  var url = '<?php echo site_url()?>';
var branch_code  = $('#autobcode').val();
  jQuery.ajax({
      type:"post",
      dataType:"json",
      url: url+"index.php"+"/lead/branch",
      data: {branch_code:branch_code},
        success: function(data) {
          $('#bname').empty();
          $.each( data, function( key, value ) {
            document.getElementById("bname").value = value;
          //$('#bname').append('<option value="'+value+'">'+value+'</option>');
          });
      },
  });
}
//branchcode and branchname end


// $(document).ready(function () { 
// var certype = $('#certificatetype').val();
// console.log(certype);
// if(certype === 'Other' || certype ==='LI Certified'){
//   alert("other or li");
//   $('#Gi').hide();
//   $('#Posp').hide();
//   $('#Other').show();
  

// }else if(certype === 'GI Cetified' || certype === 'Composit Certified'){
//   $('#Other').hide();
//   $('#Posp').hide();
//   $('#Gi').show();
  

// } else if(certype === 'POSP') {
// $('#Other').hide();
// $('#Gi').hide();
// $('#Posp').show();  
// }


//   });





//empcode and empname end
function leadCancel(){
  document.getElementById('leadcreate').reset();

}
    
    $('#statuscode').change(function(){
        if($(this).val()=="Docs Collected"){
            for(var i=1;i<=5;i++){
                $('#policyno'+i).val("");
                $('#policyno'+i).prop('readonly', true);
            }
        }else{
            for(var i=1;i<=5;i++){
                $('#policyno'+i).prop('readonly', false);
            }
        }
    });

/*$error = "";
$product_type = $_POST['product_type'];
if(!$product_type) 
{ 
   $error .= "Select the product Type"; 
}*/
   
function submitformforcreate(){
  
  var status_code            = $('#statuscode option:selected').val();
  var product_type          = $('#inputGroupSelect02 option:selected').val();
  var customer_name          = $('#customername').val();
  //var ciustomer_id          =$('#customerid').val();
  var employee_code          = $('#autoecode').val();
  var employee_name          = $('#employeename').val();
  var branch_code            = $('#branchcode').val();
  var branch_name            = $('#branchname').val();
  var channel_name           = $('#channelname').val();
  var certificate_type       = $('#certificatetype').val();
  var certificate_code       = $('#certificatecode').val();
  var current_date           = $('#currentdate').val();
  var premium                = $('#premium').val();
  var suminsured_amount      = $('#suminsuredamount').val();
  var policyno1              = $('#policyno1').val();
  var policyno2              = $('#policyno2').val();
  var policyno3              = $('#policyno3').val();
  var policyno4              = $('#policyno4').val();
  var policyno5              = $('#policyno5').val();
  var leadno                = $('#leadno').val();
  var comment               = $('#comment').val();


//by madhesh added this validation
  console.log(product_type);

  if(product_type === 'Choose') {
  document.getElementById('inputGroupSelect02').style.borderColor = "red";
      return false;
    

}


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
    
      return false;
    }
    else {
      document.getElementById('policyno5').style.borderColor = ''; 
    }

    }


if (product_type == '0' ) {
      document.getElementById('inputGroupSelect02').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('inputGroupSelect02').style.borderColor = ''; 
    }




    if (customer_name == '' ) {
      document.getElementById('customername').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('customername').style.borderColor = ''; 
    }

    if (employee_code == '' ) {
      document.getElementById('autoecode').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('autoecode').style.borderColor = ''; 
    }
        if (employee_name == '' ) {
      document.getElementById('employeename').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('employeename').style.borderColor = ''; 
    }
        if (branch_code == '0' ) {
      document.getElementById('branchcode').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('branchcode').style.borderColor = ''; 
    }
        if (branch_name == '' ) {
      document.getElementById('branchname').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('branchname').style.borderColor = ''; 
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
//    $.toast({
//        heading: 'Success',
//        text: 'Created Lead Successfully.',
//        showHideTransition: 'slide',
//        position: 'bottom-right',
//        icon: 'success',
//        loaderBg: '#9EC600',
//        hideAfter: 3000 
//    })
    $.toast({
        heading: 'Success',
        text: 'Lead created successfully. Downloading GID...',
        position: 'bottom-left',
        showHideTransition: 'slide',
        icon: 'info',
        loader: true,        // Change it to false to disable loader
        hideAfter: 3000,
        loaderBg: '#9EC600'  // To change the background
    })
    setTimeout(function() {
               window.location.reload();
          }, 3000);
    document.getElementById("leadcreate").submit();
   
}

validate = function(){
     /* Check if it is blank */
     if (document.getElementById('inputGroupSelect02').value = ''){
       alert('Please select productType!');
       return false;
     }
     return true;

  }

</script>


<?php
require_once(APPPATH.'views/footer.php');
?>
