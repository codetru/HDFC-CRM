<?php
require_once(APPPATH.'views/admin/admin_header.php');
//var_dump($this->session->userdata);die();
?>

<ul class="breadcrumb">
  <li>Lead <span class="divider">/</span></li>
  <li><a href="<?php echo site_url();?>index.php/home/leadView">Update Lead Policy</a></li>
</ul>
 <fieldset style="">
    <legend>
      Upload Excel
    </legend>
     <p class="text-center titleText">Please select a xls or xlsx file to upload to update the policy number and status from the sheet.</p>
<form  role="form"  id="leadcreate" accept-charset="utf-8" auto-complete="false">
<div class="row" id="uploadFile2">
    <div class="col-sm-12 text-center inputType">
        <label class="inline-block" style="
    margin-left: 74px;
">Select a file&nbsp;&nbsp;&nbsp;</label>
        <input class="inline-block" type="file" id="uploadFile" name="userfile"/>
    </div>
</div>
    <div id="progressDiv" class="text-center" style="margin-bottom:30px;">
<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        <div id="uploadMsg">Uploading File</div>
        </div>
 <div class="row " style="">
<div class="col-md-4 text-center"> 
    <button  type="button" id="save2" name="save2" class="btn btn-primary formButtons">Upload and Update Leads</button> 
</div>
</div>
</form>
 </fieldset> 

<style type="text/css">
    #form form{
        margin:0 !important;
    }
    select, input[type="file"]{
        height:auto !important;
        line-height: normal !important;
    }
    
    .inline-block{
        display: inline-block
    }
    
    .titleText{
            padding: 10px;
    font-style: italic;
    }
    
    .inputType{
        margin-bottom: 20px
    }
    
    .lds-spinner {
  color: official;
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
}
.lds-spinner div {
  transform-origin: 32px 32px;
  animation: lds-spinner 1.2s linear infinite;
}
.lds-spinner div:after {
  content: " ";
  display: block;
  position: absolute;
  top: 3px;
  left: 29px;
  width: 5px;
  height: 14px;
  border-radius: 20%;
  background: #0080d6;
}
.lds-spinner div:nth-child(1) {
  transform: rotate(0deg);
  animation-delay: -1.1s;
}
.lds-spinner div:nth-child(2) {
  transform: rotate(30deg);
  animation-delay: -1s;
}
.lds-spinner div:nth-child(3) {
  transform: rotate(60deg);
  animation-delay: -0.9s;
}
.lds-spinner div:nth-child(4) {
  transform: rotate(90deg);
  animation-delay: -0.8s;
}
.lds-spinner div:nth-child(5) {
  transform: rotate(120deg);
  animation-delay: -0.7s;
}
.lds-spinner div:nth-child(6) {
  transform: rotate(150deg);
  animation-delay: -0.6s;
}
.lds-spinner div:nth-child(7) {
  transform: rotate(180deg);
  animation-delay: -0.5s;
}
.lds-spinner div:nth-child(8) {
  transform: rotate(210deg);
  animation-delay: -0.4s;
}
.lds-spinner div:nth-child(9) {
  transform: rotate(240deg);
  animation-delay: -0.3s;
}
.lds-spinner div:nth-child(10) {
  transform: rotate(270deg);
  animation-delay: -0.2s;
}
.lds-spinner div:nth-child(11) {
  transform: rotate(300deg);
  animation-delay: -0.1s;
}
.lds-spinner div:nth-child(12) {
  transform: rotate(330deg);
  animation-delay: 0s;
}
@keyframes lds-spinner {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}


</style>
<script type="text/javascript">
    $('#progressDiv').hide();
    $("#save2").click( function() {
var fileInput = document.getElementById('uploadFile');
var file = fileInput.files[0];
var formData = new FormData();
formData.append('userfile', file);

$('#progressDiv').show();
$('#uploadMsg').text("Uploading File...");
$("#uploadFile2").hide();
$('#save2').prop('disabled', true);
$.ajax({
       url: '<?php echo base_url(); ?>index.php/user/do_upload',
       data: formData,
       async: true,
       contentType: false,
       processData: false,
       cache: false,
       type: 'POST',
       success: function(data)
       {
            $('#uploadMsg').text("Processing File and Updating Leads...");
           data =JSON.parse(data);
           if(data.upload_data && data.upload_data.file_name){

               var formData2 = new FormData();
               formData2.append('fileName', data.upload_data.file_name);
               $.ajax({
               type: "POST",
                   async: true,
       contentType: false,
       processData: false,
       cache: false,
               url: '<?php echo base_url(); ?>index.php/user/processFile',
               data: formData2, // serializes the form's elements.
               success: function(data)
               {

                   data=JSON.parse(data);
                   if(data.error.length>0 && data.success.length==0){
                      $.toast({
                            heading: 'Error',
                            text: "Update Failed. No Matching Records were found for any row.",
                            position: 'bottom-center',
                            showHideTransition: 'slide',
                            icon: 'error',
                            loader: true,        // Change it to false to disable loader
                            hideAfter: 20000,
                            loaderBg: '#9EC600'  // To change the background
                        });
                   }else if(data.success.length>0 && data.error.length==0){
                        $.toast({
                            heading: 'Success',
                            text: "All records updated sucessfully.",
                            position: 'bottom-center',
                            showHideTransition: 'slide',
                            icon: 'success',
                            loader: true,        // Change it to false to disable loader
                            hideAfter: 20000,
                            loaderBg: '#9EC600'  // To change the background
                        });
                   }else{
                       $.toast({
                            heading: 'Records updated',
                            text: "Records updated sucessfully. Please check the summary for some of the failures",
                            position: 'bottom-center',
                            showHideTransition: 'slide',
                            icon: 'warning',
                            loader: true,        // Change it to false to disable loader
                            hideAfter: 20000,
                            loaderBg: '#9EC600'  // To change the background
                        });
                   }
                   $("#uploadFile2").show();
                   $('#save2').prop('disabled', false);
                   $('#progressDiv').hide();
               },error:function(){
                   $("#uploadFile2").show();
                   $('#save2').prop('disabled', false);
                   $('#progressDiv').hide();
               }
                });
           }else if(data.error){
               $.toast({
                heading: 'Error',
                text: data.error.replace("<p>","").replace("</p>",""),
                position: 'bottom-center',
                showHideTransition: 'slide',
                icon: 'error',
                loader: true,        // Change it to false to disable loader
                hideAfter: 20000,
                loaderBg: '#9EC600'  // To change the background
            })
           }else{
               $.toast({
                heading: 'Error',
                text: "Could not upload file",
                position: 'bottom-center',
                showHideTransition: 'slide',
                icon: 'error',
                loader: true,        // Change it to false to disable loader
                hideAfter: 20000,
                loaderBg: '#9EC600'  // To change the background
            })
           }
//           $("#uploadFile2").show();
//                   $('#save2').prop('disabled', false);
//                   $('#progressDiv').hide();
       },error:function(){
                   $("#uploadFile2").show();
                   $('#save2').prop('disabled', false);
                   $('#progressDiv').hide();
        }
     });
        return false;    
});
</script>


<?php
require_once(APPPATH.'views/footer.php');
?>
