<form role="form" name="test" action="<?php echo base_url(); ?>index.php/home/sendOtp" method="post" auto-complete="false">
	<div class="col-xs-2">
		<span style="color: red;"><?php echo $errorMsg;?></span>
		<input type="text" name="emp_code" id="emp_code_for_otp" class="form-control" value="" placeholder="Enter employee code" autocomplete="false" required="true">
		<button type="submit" id="submit-inspection1" class="btn btn-info">Submit</button>
	</div>
</form>

<script type="text/javascript">
	// 921bd12f-eccb-11e8-a895-0200cd936042
/*$("#emp_code_for_otp").click(function() {
	alert("click");
});*/
/*$("#submit-inspection1").click(function()  {
	alert($("#emp_code_for_otp").val());
	// document.getElementById("submit-inspection1").submit();
});*/
</script>