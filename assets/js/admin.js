$(function(){
if( self != top ) { 
  top.location = self.location ;
}
});
 $(document).ready
            (
                function()
                {
                     var identity = '';
                    var password = '';
                    $( "form" ).attr( "autocomplete", "off" );
                }
 );
function createDataTableShowReports()
{                               
     var oTable =  $('#projectreport_datatable').dataTable(
        {
            "fnDrawCallback": function ( oSettings )
        {
    // Need to redo the counters if filtered or sorted 
    if ( oSettings.bSorted || oSettings.bFiltered )
        {
            for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                {
                    $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                }
        }
    },
    "aLengthMenu":  [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]], 
    "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] }],    
    "sPaginationType":"full_numbers",
    "aaSorting":[],
    "bJQueryUI":true,
    "sDom": 'T<"clear">lf<"top"i>rtip'
    });
    var row = [];  
    if(user_report.length == 0){
           return false;
      }
    $.each(user_report, function(i, UserReport)    
        {   
            row[i] =  [];
            row[i][0] = "";
            row[i][1] = UserReport['first_name'];
            row[i][2] = UserReport['last_name'];
            row[i][3] = UserReport['BranchName'];
            row[i][4] = UserReport['email'];
            row[i][5] = UserReport['Type'];
            row[i][6] = '<button type="submit" id="edit" Onclick="userEdit('+UserReport['id']+')" class="btnn " >View/Edit</button>';
            if(UserReport['Type'] == 'Admin'){
            row[i][7] = 'Active';    
            row[i][8] = '<button type="submit" class="btnn-disabled" disabled="true">Disable</button>'; 
           }
            else if(UserReport['active'] == '1')
            {
               row[i][7] = 'Active';
               row[i][8] = '<button type="submit"  Onclick="del('+UserReport['id']+','+UserReport['active']+');" class="btnn" >Disable</button>'; 
            }
            else
            {
            row[i][7] = 'De-Active';
            row[i][8] = '<button type="submit"  Onclick="del('+UserReport['id']+','+UserReport['active']+');" class="btnn" >Enable</button>';
            }  
        }); 
    oTable.fnClearTable();
    oTable.fnAddData(row);
} 
//hdfc details start              
function createDataTableShowReports1()
{     
    if(user_report.length == 0){
           alert("No records avaliable");
           return false;
      }                           
     var oTable =  $('#projectreport_datatable1').dataTable(
        {
            "fnDrawCallback": function ( oSettings )
        {
    // Need to redo the counters if filtered or sorted 
    if ( oSettings.bSorted || oSettings.bFiltered )
        {
            for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                {
                    $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                }
        }
    },
    "aLengthMenu":  [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]], 
    "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] }],    
    "sPaginationType":"full_numbers",
    "aaSorting":[],
    "bJQueryUI":true,
    "sDom": 'T<"clear">lf<"top"i>rtip'
    });
    var row = [];  
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10) {
        dd='0'+dd
    } 
    if(mm<10) {
        mm='0'+mm
    } 
    today = mm+'-'+dd+'-'+yyyy;
    $.each(user_report, function(i, UserReport)    
        {                 
            row[i] =  [];
            row[i][0] = "";
            row[i][1] = UserReport['StatusCode'];                         
            row[i][2] = UserReport['ProductType']; 
            row[i][3] = UserReport['CustomerName'];   
            row[i][4] = UserReport['EmployeeCode'];   
            row[i][5] = UserReport['BranchCode'];                   
            row[i][6] = UserReport['BranchName'];
            row[i][7] = UserReport['Premium'];  
            row[i][8] = UserReport['PolicyNo']; 
            row[i][9] = UserReport['LeadNo'];  
            row[i][10] = UserReport['Comment'];    
            row[i][11] = '<button type="submit" id="edit" Onclick="inspectionEdit('+UserReport['id']+')" class="btnn" >View../Edit</button>';                                         
            var start_date = new Date(UserReport['UpdateDate']);
            var end_date   = new Date(today);
            var diff = ((end_date - start_date)/ 86400000);
       
        }); 
    oTable.fnClearTable();
    oTable.fnAddData(row);
}
//hdfc details end
function vendorManagement(){
      if(user_report.length == 0){
           alert("No records avaliable");
           return false;
      } 
    var oTable =  $('#vendorManagement').dataTable(
    {
        "fnDrawCallback": function ( oSettings )
    {
    // Need to redo the counters if filtered or sorted 
    if ( oSettings.bSorted || oSettings.bFiltered )
    {
        for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
            {
                $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
            }
    }
    },
    "aLengthMenu":  [[10, 25, 50, 100, -1],[10, 25, 50, 100, "All"]], 
    "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ 0 ] }],    
    "sPaginationType":"full_numbers",
    "aaSorting":[],
    "bJQueryUI":true,
    "sDom": 'T<"clear">lf<"top"i>rtip'
    });
    var row = [];  
    $.each(user_report, function(i, UserReport)    
        {                 
            row[i] =  [];
            row[i][0] = "";
            row[i][1] = UserReport['VendorName'];                         
            row[i][2] = UserReport['InspectionEmail'];                    
            row[i][3] ='<button type="submit"  Onclick="vendorEdit('+UserReport['id']+');" class="btnn">View /Edit</button>'; 
            if(UserReport['status'] == '1')
            {
            row[i][4] = 'Active';
            row[i][5] = '<button type="submit"  Onclick="activate('+UserReport['id']+','+UserReport['status']+');" class="btnn" >Disable</button>'; 
            }
            else
            {
            row[i][4] = 'De-Active';
            row[i][5] = '<button type="submit"  Onclick="activate('+UserReport['id']+','+UserReport['status']+');" class="btnn" >Enable</button>';
            }  
        }); 
    oTable.fnClearTable();
    oTable.fnAddData(row);

    }

function del(userid,status){
  if(status == '1' ){
     bootbox.confirm("Are you sure u want to Deactivate ?", function(result) {
         if(result == true){
         jQuery.ajax({
            type:"post",
            dataType:"json",
            url: url+"auth/delete_user",
            data: {id:userid,status:status},
              success: function(data) {
              window.location.href= url+"auth/index";
            },
        });
        }
     }); 
  }
  else
  {
    bootbox.confirm("Are you sure u want to activate ?", function(result) {
         if(result == true){
            jQuery.ajax({
            type:"post",
            dataType:"json",
            url: url+"auth/delete_user",
            data: {id:userid,status:status},
              success: function(data) {
            window.location.href= url+"auth/index";
            },
        });
       // window.location.href= url+"/auth/delete_user?id="+userid+"&status="+status+"&csrf="+localStorage.getItem('csrf');
        }
     }); 
  }
}


function activate(userid,status){

if(status == '1' ){
     bootbox.confirm("Are you sure u want to Deactivate ?", function(result) {
         if(result == true){
        window.location.href= url+"vendor/activate_user?id="+userid+"&status="+status;
        }
     }); 
  }
  else
  {
    bootbox.confirm("Are you sure u want to activate ?", function(result) {
        if(result == true){
        window.location.href= url+"vendor/activate_user?id="+userid+"&status="+status;
        }
     }); 
  }
}

function numberOnly(txt, e) {
    var arr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ";
    var code;
    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    var char = keychar = String.fromCharCode(code);
    if (arr.indexOf(char) == -1)
        return false;
}
function numbertext(txt, e) {
    var arr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890-. ";
    var code;
    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    var char = keychar = String.fromCharCode(code);
    if (arr.indexOf(char) == -1)
        return false;
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
function numberstext(txt, e) {
    var arr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890#, ";
    var code;
    if (window.event)
        code = e.keyCode;
    else
        code = e.which;
    var char = keychar = String.fromCharCode(code);
    if (arr.indexOf(char) == -1)
        return false;
}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function branchCode(){
var branch_name  = $('#bname option:selected').val();
var csrf = $('#csrf').val();
  jQuery.ajax({
      type:"post",
      dataType:"json",
      url: url+"user/branch",
      data: {branch_name:branch_name},
        success: function(data) {
          $('#bcode').empty();
          $.each( data, function( key, value ) {
          $('#bcode').append('<option value="'+value+'">'+value+'</option>');
          });
          var branch_code  = $('#bcode option:selected').val();
            jQuery.ajax({
              type:"post",
              dataType:"json",
              url: url+"user/vendor",
              data: {branch_code:branch_code},
                success: function(data) {
                  $('#preins-vendoremail').empty();
                  $('#preins-vendoremail').append('<option value="0">--Select--</option>');
                  $.each( data, function( key, value ) {
                   $('#preins-vendoremail').append('<option value="'+value+'">'+value+'</option>');
                  });
              },
          });
      },
  });
}

function bCode(){
var url = $('#url').val();
var branch_name  = $('#bname option:selected').val();
  jQuery.ajax({
      type:"post",
      dataType:"json",
      url: url+"user/branch",
      data: {branch_name:branch_name},
        success: function(data) {
          $('#bcode').empty();
          $.each( data, function( key, value ) {
          $('#bcode').append('<option value="'+value+'">'+value+'</option>');
          });
      },
  });
}
function authIndex(){
var url = $('#url').val();
window.location.href =url+'auth/index';
}
function authInscancel(){
var url = $('#url').val();
window.location.href =url+'auth/preinspection';
}
function userInscancel(){
var url = $('#url').val();
window.location.href =url+'auth/index';
}
function vendorEdit(id){   
window.location.href= url+"vendor/edit_vendor?id="+id;
}
//lead edit
function inspectionEdit(id){
  console.log(id);
var url = $('#url').val();
//window.location.href= url+"user/edit?id="+id;
window.location.href= url+"index.php"+"/user/edit?id="+id;
}
//lead update
function reopenVendor(id){
var reopen_type="Vendor";
var url = $('#url').val();
window.location.href= url+"user/reopen?id="+id+"&t="+reopen_type;  
}

function reopenUW(id){
var reopen_type="Underwriter";  
var url = $('#url').val();
window.location.href= url+"user/reopen?id="+id+"&t="+reopen_type; 
}

//download pdf
function downloadPdf(LeadNo){  
  console.log("download click");
var url = $('#url').val();
window.location.href= url+"index.php/home/saveAsPdf?LeadNo="+LeadNo; 
}
function userEdit(id){
window.location.href= url+"auth/edit_user?id="+id;
}

function userType(){
  var url = $('#url').val();
  var type = $( "#type option:selected").val();
  if(type == 'Vendor'){
    $('#vendorname').show();
    $('#branchlist').hide();
    var branch_code  = $('#bcode option:selected').val();
    jQuery.ajax({
        type:"post",
        dataType:"json",
        url: url+"auth/vendor",
        data: {branch_code:branch_code},
          success: function(data) {
            $('#vname').empty();
            $('#vname').append('<option value="0">--Select--</option>');
            $.each( data, function( key, value ) {
             $('#vname').append('<option value="'+value+'">'+value+'</option>');
            });
        },
    });
  }

  if(type == 'SM'){
   $('#vendorname').hide();
   $('#branchlist').hide();
   $('#imdlist').show();
  }


  if(type == 'Admin'){
   $('#vendorname').hide();
   $('#branchlist').hide();
    $('#imdlist').hide();
  }
  if(type == 'Branch'){
   $('#vendorname').hide();
   $('#branchlist').hide();
   $('#imdlist').hide();
  }
  if(type == 'Claims'){
   $('#vendorname').hide();
   $('#branchlist').hide();
   $('#imdlist').hide();
  }
  if(type == 'ABS'){
   $('#vendorname').hide();
   $('#branchlist').show();
   $('#imdlist').hide();
  }
  if(type == 'IMD'){
   $('#vendorname').hide();
   $('#branchlist').hide();
   $('#imdlist').hide();
  }
  if(type == '0'){
   $('#vendorname').hide();
   $('#branchlist').hide();
   $('#imdlist').hide();
  }
  if(type == 'Underwriter'){
   $('#vendorname').hide();
   $('#branchlist').show();
   $('#imdlist').hide();
  }
  if(type == 'Operations'){
   $('#vendorname').hide();
   $('#branchlist').show();
   $('#imdlist').hide();
  }
}
function checkType(){
var ptype   = $('#ptype').val();
if(ptype =='FTW'){
    $('#dupinspctn').empty().append('<option value="No">No</option>').append('<option value="Yes">Yes</option>');
    $('#pymtmode').empty().append('<option value="Customer">Customer</option>').append('<option value="Company">Company</option>');
  }
}
function regCheck(){
var reg_no  = $('#regno').val();
var ptype   = $('#ptype').val();
  jQuery.ajax({
            type:"post",
            dataType:"json",
            url: url+"user/check_reg",
            data: {reg_no:reg_no},
              success: function(data) {
               if(data == 1 && ptype != 'FTW' )
               {
                $('#dupinspctn').empty();
                $('#dupinspctn').append('<option value="No">No</option>').append('<option value="Yes">Yes</option>');
                $('#pymtmode').empty();
                $('#pymtmode').append('<option value="Company">Company</option>').append('<option value="Customer">Customer</option>');
               }
               else if (data == 0 )
               {
                alert("Number Already Registered");
                $('#dupinspctn').empty();
                $('#dupinspctn').append('<option value="Yes">Yes</option>').append('<option value="No">No</option>');
                $('#pymtmode').empty();
                $('#pymtmode').append('<option value="Customer">Customer</option>').append('<option value="Company">Company</option>');
               }
               else {
                $('#dupinspctn').empty();
                $('#dupinspctn').append('<option value="No">No</option>').append('<option value="Yes">Yes</option>');
                $('#pymtmode').empty();
                $('#pymtmode').append('<option value="Customer">Customer</option>').append('<option value="Company">Company</option>');
               }
            },
     });
}
function statusChange() {
    var status   = $('#status option:selected').val();
    if(status == 'Recommended'){
      alert("Upload Documents");
      $('#upload-div').show();
      $('#reason-div').hide();
    }else if(status == 'Not Recommended'){
      alert("Upload Documents");
      $('#upload-div').show();
      $('#reason').val("");
      $('#reason-div').show();
    }else if(status =='Cancelled'){
      $('#upload-div').hide();
      $('#reason').val("");
      $('#reason-div').show();
    }else if(status =='Re-Scheduled'){
      $('#upload-div').hide();
      $('#reason').val("");
      $('#reason-div').show();
    }else if(status == 'Appointment fixed'){
      $('#upload-div').hide();
      $('#reason').val("");
      $('#reason-div').show();
    }else{
      $('#upload-div').hide();
      $('#reason-div').hide();
    }
}
  function IsEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
  }  
  function vendorCancel(){
  var url = $('#url').val();
  window.location.href =url+'vendor/manageVendor';
  }
  function userCreate(){
  var url = $('#url').val();
  window.location.href =url+'user/index';
  }
   function userDownload(data){
  var url = $('#url').val();
  var refno = $('#ref-no').val();
  window.location.href =url+'user/download?id='+refno+"&data="+data;
  }
function submitformforcreate(){
  var url                    = $('#url').val();
  var branch_code            = $('#bcode option:selected').val();
  var branch_name            = $('#bname option:selected').val();
  var imd_code               = $('#imdcode').val();
  var pno_staff_broker_agent = $('#pnumber-staff').val();
  var client_name            = $('#client-name').val();
  var phone_no               = $('#pnumber').val();
  var client_email           = $('#client-email').val();
  var aphone_no              = $('#apnumber').val();
  var reason_inspection      = $('#rsninsptn').val();
  var product_type           = $('#ptype option:selected').val();
  var risk_type              = $('#rtype option:selected').val();
  var location_inspection    = $('#lcninsptn').val();
  var regno                  = $('#regno').val();
  var dup_inspection         = $('#dupinspctn option:selected').val();
  var make                   = $('#make').val();
  var model                  = $('#model').val();
  var payment_mode           = $('#pymtmode option:selected').val();
  var status                 = $('#status option:selected').val();
  var pre_inspecton_vemail   = $('#preins-vendoremail option:selected').val();
  var conveyance             = $('#conveyance option:selected').val();
  var conveyance_km          = $('#cnvyanceinkm').val();
  var alter_client_name      = $('#altrclientnme').val();
  var remarks_old            = $('textarea#remarks').val();
  var remarks                = $.trim(remarks_old);
  var pno_sales_staff_email  = $('#pnoemaild').val();
    if (branch_code == '0' ) {
      document.getElementById('bcode').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('bcode').style.borderColor = ''; 
    }
    if (branch_name == '' ) {
      document.getElementById('bname').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('bname').style.borderColor = ''; 
    }
    if (imd_code == '') {
      document.getElementById('imdcode').style.borderColor = "red";
      return false;
    }
    else if(imd_code.length != '8'){
      document.getElementById('imdcode').style.borderColor = "red";
      alert("Imd code must be 8 digit");
      return false;
    }
    else {
      document.getElementById('imdcode').style.borderColor = ''; 
    }
    if (pno_staff_broker_agent  == '') {
      document.getElementById('pnumber-staff').style.borderColor = "red";
      return false;
    }
    else if(pno_staff_broker_agent.length != '10'){
      document.getElementById('pnumber-staff').style.borderColor = "red";
      alert("Phone number must be 10 digit");
      return false;
    }
    else {
      document.getElementById('pnumber-staff').style.borderColor = ''; 
    }
    if (client_name == '' ) {
      document.getElementById('client-name').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('client-name').style.borderColor = ''; 
    }
   
    if (phone_no == '') {
      document.getElementById('pnumber').style.borderColor = "red";
      return false;
    }
    else if(phone_no.length != '10'){
      document.getElementById('pnumber').style.borderColor = "red";
      alert("Phone number must be 10 digit");
      return false;
    }
    else {
      document.getElementById('pnumber').style.borderColor = ''; 
    }
    if(client_email &&! IsEmail(client_email) ){
      document.getElementById('client-email').style.borderColor = "red";
      alert("Please enter valid email");
      return false;
    }
    else
    {
      document.getElementById('client-email').style.borderColor = ''; 
    }
    if (!IsEmail(pno_sales_staff_email)) {
      document.getElementById('pnoemaild').style.borderColor = "red";
      alert("Enter valid email id");
      return false;
    }
    else {
      document.getElementById('pnoemaild').style.borderColor = ''; 
    }
   
    if (reason_inspection == '0' ) {
      document.getElementById('rsninsptn').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('rsninsptn').style.borderColor = ''; 
    }
    if (product_type == '0' ) {
      document.getElementById('ptype').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('ptype').style.borderColor = ''; 
    }
    if (risk_type == '0' ) {
      document.getElementById('rtype').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('rtype').style.borderColor = ''; 
    }
    if (location_inspection == '' ) {
      document.getElementById('lcninsptn').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('lcninsptn').style.borderColor = ''; 
    }
    if (regno == '' ) {
      document.getElementById('regno').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('regno').style.borderColor = ''; 
    }
    if (dup_inspection == '0' ) {
      document.getElementById('dupinspctn').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('dupinspctn').style.borderColor = ''; 
    }
    if (make == '' ) {
      document.getElementById('make').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('make').style.borderColor = ''; 
    }
    if (model == '' ) {
      document.getElementById('model').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('model').style.borderColor = ''; 
    }
    if (payment_mode == '' ) {
      document.getElementById('pymtmode').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('pymtmode').style.borderColor = ''; 
    }
    if (status == '0' ) {
      document.getElementById('status').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('status').style.borderColor = ''; 
    }
    if (pre_inspecton_vemail == '0' ) {
      document.getElementById('preins-vendoremail').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('preins-vendoremail').style.borderColor = ''; 
    }
    if (conveyance == '0' ) {
      document.getElementById('conveyance').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('conveyance').style.borderColor = ''; 
    }
    if (remarks == '') {
      document.getElementById('remarks').style.borderColor = "red";
      return false;
    }
    else {
      document.getElementById('remarks').style.borderColor = ''; 
    }



    $('#loading').show();
    document.getElementById("inspectioncreate").submit();
}
  function IsEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
  }
