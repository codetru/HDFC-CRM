<?php
require_once(APPPATH.'views/header.php');
?>
<input type="hidden" value="<?php echo site_url()?>" id="url">
<script type="text/javascript">
$(document).ready(function()
    {
        createDataTableShowReports1();
    });
  </script>
        <script src="<?php echo BASE_PATH.'assets/media/js/jquery.dataTables.js'?>" type="text/javascript"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo BASE_PATH.'assets/media/js/ZeroClipboard.js'?>"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo BASE_PATH.'assets/media/js/TableTools.js'?>"></script>
        <style type="text/css">
        @import "<?php echo BASE_PATH.'assets/media/css/demo_table_jui.css'?>";
        @import "<?php echo BASE_PATH.'assets/media/themes/smoothness/jquery-ui-1.8.4.custom.css'?>";
        @import "<?php echo BASE_PATH.'assets/media/css/TableTools.css'?>";
        </style>
          <div class="widgetcontent" align="center">
            <table id="projectreport_datatable1" class="display">
              <thead>
                <tr>   
                  <th>S.No</th>
                  <th>StatusCode</th>
                  <th>ProductType</th>
                  <th>CustomerName</th>
                  <th>EmployeeCode</th>
                  <th>EmployeeName</th>
                  <th>BranchCode</th>
                  <th>BranchName</th>
                  <th>Premium</th>
                  <th>PolicyNo</th>
                  <th>LeadNo</th>
                  <th>Comment</th>
                  <th>View/Edit</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <br/><br/>
          </div>
  
    </div>
    <script type="text/javascript">
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
             row[i][5] = UserReport['EmployeeName'];   
            row[i][6] = UserReport['BranchCode'];                   
            row[i][7] = UserReport['BranchName'];
            row[i][8] = UserReport['Premium'];  
            row[i][9] = UserReport['PolicyNo']; 
            row[i][10] = UserReport['LeadNo'];  
            row[i][11] = UserReport['Comment'];    
            row[i][12] = '<button type="submit" id="edit" Onclick="inspectionEdit('+UserReport['id']+')" class="btnn" >View/Edit</button>';                                         
            var start_date = new Date(UserReport['UpdateDate']);
            var end_date   = new Date(today);
            var diff = ((end_date - start_date)/ 86400000);
       
        }); 
    oTable.fnClearTable();
    oTable.fnAddData(row);
}
//hdfc details end

//lead edit
function inspectionEdit(id){
  console.log(id);
var url = $('#url').val();
//window.location.href= url+"user/edit?id="+id;
window.location.href= url+"index.php"+"/user/edit?id="+id;
}
//lead update
    </script>
<script>
var user_report = <?php echo json_encode($result)?>;
console.log(user_report);

</script> 
<?php
require_once(APPPATH.'views/footer.php');
?>
<style type="text/css">
    button#edit {
  width: 100%;
}
div.DTTT_container {
  position: relative;
  float: right;
  margin-bottom: 1em;
  display: none;
}
</style>