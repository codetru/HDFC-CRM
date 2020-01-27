<?php
require_once(APPPATH.'views/header.php');
?>
<ul class="breadcrumb">
  <li>Lead <span class="divider">/</span></li>
  <li><a href="<?php echo site_url();?>index.php/user/report">Generate Report</a></li>
</ul>
<fieldset style="
    margin-right: 5%;
    margin-left: 8%;">
    <legend>
      Generate Report
    </legend>
   <form  role="form" name="form" action="" method="post" >
       <div id="report-div">
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
         <div class="col-xs-2"></div>
         <div class="col-xs-3">
            <button type="button" id="report-info" class="btn btn-info" style="margin-left:0" onclick="userReport();">Show Reports</button>
         </div>
      </div>
  </form>
</fieldset>
  <div id="reports-div" style="">
<!--
      <link rel="stylesheet" href="<?php echo BASE_PATH.'assets/css/dataTables.bootstrap.min.css'?>"/>
      <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />
-->

<!--
        <script src="<?php echo BASE_PATH.'../assets/media/js/jquery.dataTables.js'?>" type="text/javascript"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo BASE_PATH.'assets/media/js/ZeroClipboard.js'?>"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo BASE_PATH.'assets/media/js/TableTools.js'?>"></script>
-->
<!--
        <style type="text/css">
        
        @import "<?php echo BASE_PATH.'assets/media/themes/smoothness/jquery-ui-1.8.4.custom.css'?>";
        </style>
-->

        <!-- <div class="widgetcontent" align="center">
                <table id="projectreport_datatable3" class="display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                    <th>S.No</th>
                    <th>Status Code</th>
                    <th>Product Type</th>
                    <th>Customer Name</th>
                    <th>Employee Code</th>
                    <th>Employee Name</th>
                    <th>Branch Code</th>
                    <th>Branch Name</th>
                    <th>Premium</th>
                    <th>Policy No</th>
                    <th>Lead No</th>
		                <th>Comment</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
          </div> -->

    <div class="portlet-body planbox" style="color: #000;">
    <div class="dwnbutton reportTable" style="
    float: right;
    margin-top: 20px;
    margin-bottom: 20px;
display:none"><button type="button" style="margin-right: 0;" class="btn blue btn btn-info downloadReport" id="">Download Report </button>
    </div>
      
      <div>
        <div class="container box" style="width:100%;">
          <div class="table-responsive">
            <br />  

            <table id="table" class="table table-striped reportTable" cellspacing="0" width="100%" style="display:none">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Lead No</th>
                  <th>Employee Name</th>
                  <th>Customer Name</th>
                  <th>Branch Name</th>
                  <th>Product Type</th>
                  <th>Policy No</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>                         
          </div>
        </div>
      </div>
    </div>
    </div>
 <script type="text/javascript">
  var table;
  $(function() {
    $( "#fdate" ).datepicker({dateFormat: 'yy-mm-dd'});
    $( "#tdate" ).datepicker({dateFormat: 'yy-mm-dd'});
  });

  $(".downloadReport").click(function() {
          var from_date = $('#fdate').val();
          var to_date   = $('#tdate').val();
          var date_from = from_date.replace(/\//g, "-");
          var date_to   = to_date.replace(/\//g, "-");
          if (from_date == '' ) {
              document.getElementById('fdate').style.borderColor = "red";
              return false;
          } else {
              document.getElementById('fdate').style.borderColor = ''; 
                  }

          if (to_date == '' ) {
              document.getElementById('tdate').style.borderColor = "red";
              return false;
              } else {
                document.getElementById('tdate').style.borderColor = ''; 
                  }
    var fromDate = $('#fdate').val();
    var toDate = $('#tdate').val();
    var url = "<?php echo site_url()?>index.php/"+'user/downloadExcelReport/'+fromDate+'/'+toDate;
    console.log('download report url: '+url);
      /*$.ajax({
        url : url,
        type : 'GET',
        success: function(data){
        }
      });*/
      window.open(url);
  });
  function userReport(){
    $("#reports-div").show();
    loadDataInTable();
}

function loadDataInTable() {
  var url = '<?php echo site_url()?>';
  var from_date = $('#fdate').val();
  var to_date   = $('#tdate').val();
  var date_from = from_date.replace(/\//g, "-");
  var date_to   = to_date.replace(/\//g, "-");
  if (from_date == '' ) {
    document.getElementById('fdate').style.borderColor = "red";
    return false;
  } else {
    document.getElementById('fdate').style.borderColor = ''; 
  }

  if (to_date == '' ) {
    document.getElementById('tdate').style.borderColor = "red";
    return false;
  } else {
    document.getElementById('tdate').style.borderColor = ''; 
  }
   var form_date = $('#fdate').val();
   var to_date   = $('#tdate').val();
    var date_form = form_date.replace(/\//g, "-");
var date_to   = to_date.replace(/\//g, "-");
    $('#processing').show();
   $("#table").dataTable().fnDestroy();
    var formData = {date_form : date_form, date_to: date_to }
    //console.log(formData); 
    var urlnew =url+"index.php"+"/user/report_details";
    jQuery.ajax({
              type:"post",
              dataType:"json",
              url: urlnew,
              data: formData,
              success: function(data) {
                console.log(data);
              $('#processing').hide();
               var user_report = data.data;
              $.fn.dataTableExt.sErrMode = 'throw';
              var oTable =  $('#table').dataTable(
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
            
            oTable.fnClearTable();
            //oTable.fnAddData(row);
          return false;
          }

       
         // console.log(usertype);
        $.each(user_report, function(i, UserReport)    
            { 
              row[i] =  [];
              row[i][0] = "";
              row[i][1]  = UserReport['1'];
              row[i][2]  = UserReport['2'];
              row[i][3]  = UserReport['3'];
              row[i][4]  = UserReport['4'];
              row[i][5]  = UserReport['5'];
              row[i][6]  = UserReport['6'];
               
            }); 
                oTable.fnClearTable();
                oTable.fnAddData(row);
              },

          });
    $('.reportTable').show();
//  table = $('#table').DataTable({
//    destroy: true,
//    paging: true,
//    "processing": true, //Feature control the processing indicator.
//    "serverSide": true, //Feature control DataTables' server-side processing mode. //Initial no order.
//      "scrollX": true,
//    // Load data for the table's content from an Ajax source
//    "ajax": {
//        "url": url+"index.php"+"/user/report_details",
//         data : {date_form : date_from, date_to: date_to,},
//        "type": "POST"
//    },
//      //Set column definition initialisation properties.
//      "columnDefs": [{ 
//          "targets": [ 0 ], //first column / numbering column
//          "orderable": false, //set not orderable
//      },],
//  });
}

</script>
<?php
require_once(APPPATH.'views/footer.php');
?>   
<style type="text/css">
  div#projectreport_datatable3_filter {
  display: none;
}
#form form{
margin-left:24%;
margin-top:-9%;
width:100%
}
</style>

