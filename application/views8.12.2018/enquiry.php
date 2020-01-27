<?php
require_once(APPPATH.'views/header.php');
?>
<ul class="breadcrumb">
  <li>Lead <span class="divider">/</span></li>
  <li><a href="<?php echo site_url();?>index.php/user/enquiry">Search Lead</a></li>
</ul>
  <fieldset style="
    margin-right: 5%;
    margin-left: 8%;">
    <legend>
      Search Lead
    </legend>
     <form  role="form" name="form" action="" method="post" >
        
        <div class="row">
          <div class="col-xs-2">
            <input type="hidden" value="<?php echo site_url()?>" id="url">
            <label for="exampleInputEmail1">Select Search Type</label>
          </div>
          <div class="col-xs-2">
            <select class="form-control" id="enquiry-by" name="enquiry-by">
            <option value="0">--Select--</option>
            <option value="1">By Lead ID</option>
            <option value="2">By Date</option>
          </select>
          </div>
        </div>
    <div id="bylead">
        <div class="row" >
        <div class="col-xs-2">
          <label for="exampleInputEmail1">Lead ID</label> 
          </div>
           <div class="col-xs-2">
            <input type="text" name="leadno" id="leadno" class="form-control" placeholder="">
          </div>
        </div>
      </div>   
         <div id="bydate" >
         <div class="row">
            <div class="col-xs-2">
              <label for="exampleInputEmail1">From Date</label>
            </div>
            <div class="col-xs-2">
              <input type="text" name="fdate" id="fdate" class="form-control" placeholder="">
              <span id="span-anumber">  </span>
            </div>
        </div>
        <div class="row">
          <div class="col-xs-2">
            <label for="exampleInputEmail1">To Date</label>
          </div>
          <div class="col-xs-2">
            <input type="text" name="tdate" id="tdate" class="form-control" placeholder="">
            <span id="span-anumber">  </span>
          </div>
        </div>
      </div>
      <div class="row">
       <div class="col-xs-2">
             <button type="button" id="enquiry-search" class="btn btn-info" onclick="userEnquiry();">Search</button>
          </div>
       
      </div>
      
<div id="processing" style="display:none">
<img src="<?php echo BASE_PATH.'assets/images/ajax_loader.gif'?>">
Processing...
</div>
       </form>
</fieldset>
      
  <div id="reports-div" style="display: none;">
  <div class="widgetcontent" align="center">
  <table id="projectreport_datatable3" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
                  <th>S.No</th>
                  <th>Lead ID</th>
                  <th>Employee Name</th>
                  <th>Customer Name</th>
                  <th>Branch Name</th>
                  <th>Product Type</th>
                  <th>Policy No</th>                  
                  <th>Print GID</th>
                 
    </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
    </div>
  </div>
<?php
require_once(APPPATH.'views/footer.php');
?> 
<script type="text/javascript">
//function for hide /show search box
$(function () {
   $("#bylead").hide();
   $("#bydate").hide();
        $("#enquiry-by").change(function () {
            if ($(this).val() == "1") {
                $("#bylead").show();
                $("#bydate").hide();
            } else if ($(this).val() == "2"){
                $("#bylead").hide();
                $("#bydate").show();
            }
            else {
                $("#bylead").hide();
                $("#bydate").hide();
            }
        });
    });
// end

//start function for date picker
$(function() {
    $( "#fdate" ).datepicker({dateFormat: 'yy-mm-dd'});
    $( "#tdate" ).datepicker({dateFormat: 'yy-mm-dd'});
  });
// end

var url = '<?php echo site_url()?>';

//search button function start
function userEnquiry(){

   var form_date = $('#fdate').val();
   var to_date   = $('#tdate').val();

var date_form = form_date.replace(/\//g, "-");
var date_to   = to_date.replace(/\//g, "-");
/*console.log("console dates");
console.log(date_form);
console.log(date_to);*/

$('#processing').show();
   $("#projectreport_datatable3").dataTable().fnDestroy();
  var enquire_by = $( "#enquiry-by option:selected").val();
  var option   = $('#enquiry-by option:selected').val();
  var lead_no        = $('#leadno').val();
//validation alert
  if(option =='1'){
   if (lead_no == '' ) {
     document.getElementById('leadno').style.borderColor = "red";
     $('#reports-div').hide();
     return false;
   }
   else {
     document.getElementById('leadno').style.borderColor = ''; 
   }  
  }
  if(option == '2'){
       if (form_date == '' ) {
    document.getElementById('fdate').style.borderColor = "red";
    return false;
  }
  else {
    document.getElementById('fdate').style.borderColor = ''; 
  }
  if (to_date == '' ) {
    document.getElementById('tdate').style.borderColor = "red";
    return false;
  }
  else {
    document.getElementById('tdate').style.borderColor = ''; 
  }
  }


  // 
  if(option=='1'){
    //console.log("forming data option 1");
    var formData = { lead_no:lead_no, option:option}
    //console.log(formData);
    var urlnew =url+"index.php"+"/user/enquiry_details";
  }
  if(option =='2'){
  // console.log("forming data option 2");
    var formData = {date_form : date_form, date_to: date_to }
    //console.log(formData); 
    var urlnew =url+"index.php"+"/user/search_details";
  }

/*  if(user_report == '' || user_report == '[]'){

          alert("lead number is incorrect");
           
          }*/
   //  var formData = { ref_no:ref_no, option:option};
     jQuery.ajax({
              type:"post",
              dataType:"json",
              url: urlnew,
              data: formData,
              success: function(data) {
                console.log(data);
              $('#processing').hide();
               var user_report = data;
              $.fn.dataTableExt.sErrMode = 'throw';
              var oTable =  $('#projectreport_datatable3').dataTable(
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
        "scrollX": true,
        "sDom": 'T<"clear">lf<"top"i>rtip'
        });
        var row = [];  
          if(user_report.length == 0){
              
              if($('#enquiry-by').val()==1){
                 $.toast({
                heading: 'Error',
                text: 'Incorrect lead number. Please re-enter the correct lead number',
                position: 'bottom-center',
                showHideTransition: 'slide',
                icon: 'error',
                loader: true,        // Change it to false to disable loader
                hideAfter: 10000,
                loaderBg: '#9EC600'  // To change the background
            })
            }
            
            oTable.fnClearTable();
            //oTable.fnAddData(row);
          return false;
          }

       
         // console.log(usertype);
        $.each(user_report, function(i, UserReport)    
            { 
              row[i] =  [];
              row[i][0] = "";
              row[i][1]  = UserReport['LeadNo'];
              row[i][2]  = UserReport['EmployeeName'];
              row[i][3]  = UserReport['CustomerName'];
              row[i][4]  = UserReport['BranchName'];
              row[i][5]  = UserReport['ProductType'];
              row[i][6]  = UserReport['PolicyNo'];
              var statusLead=UserReport['StatusCode'].toLowerCase();
              if(statusLead.trim().indexOf("converted")==0){
                    row[i][7]='';
               }else{
                   row[i][7]  = '<button type="submit" id="edit" Onclick="downloadPdf('+UserReport['LeadNo']+')" class="customSmall">Download</button></a>';
               }
              
               
            }); 
        oTable.fnClearTable();
        oTable.fnAddData(row);
              },

          });
  $('#reports-div').show();

}



 
</script>


<style type="text/css">
.dataTables_filter {
    display: none;
}
#form form{ 
margin-left:10%;
margin-top:5%;
width:100%;
}
div.DTTT_container {
  position: relative;
  float: right;
  margin-bottom: 1em;
  display: none;
}
</style>