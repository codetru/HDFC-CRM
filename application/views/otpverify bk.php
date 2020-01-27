<form role="form" name="test" action="<?php echo base_url(); ?>index.php/home/verifyOtp" method="post" auto-complete="false">
	<div class="col-xs-2">
		<input type="hidden" name="session_id" class="form-control" value="<?php echo $sessionId; ?>">
		<input type="hidden" name="emp_master_id" class="form-control" value="<?php echo $empMasterId; ?>">
		<input type="text" name="otp_code" class="form-control" value="" placeholder="Enter your OTP" auto-complete="false" required="true">
		<span style="color: red"><?php echo $errorMsg;?></span>
		<button type="submit" id="submit-inspection1" class="btn btn-info">Verify</button>
	</div>
</form>
<script type="text/javascript">
    function preventBack() { window.history.forward(); }
    setTimeout("preventBack()", 0);
    window.onunload = function () { null };
</script>