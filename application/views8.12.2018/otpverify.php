<?php
	require_once(APPPATH.'views/login-header.php');
?>
<form role="form" name="test" action="<?php echo base_url(); ?>index.php/home/verifyOtp" method="post" auto-complete="false">
	<div class="form-group col-xs-2 align-center">
		<input type="hidden" name="session_id" class="form-control" value="<?php echo $sessionId; ?>">
		<input type="hidden" name="emp_master_id" class="form-control" value="<?php echo $empMasterId; ?>">
		<input type="hidden" name="is_forgot_pwd_user" class="form-control" value="<?php echo $isForgotPasswordUser; ?>">
		<input type="text" name="otp_code" class="form-control" value="" placeholder="Enter your OTP" auto-complete="false" required="true">
		<span style="color: red"><?php echo $errorMsg;?></span>
		<button type="submit" id="submit-inspection1" class="btn btn-primary btn-lg btn-block">Verify</button>
		<u><a href="<?php echo base_url(); ?>index.php/home/resendOtp/<?php echo $empMasterId; ?>">Resend OTP</a></u>
	</div>
</form>
<script type="text/javascript">
    function preventBack() { window.history.forward(); }
    setTimeout("preventBack()", 0);
    window.onunload = function () { null };
</script>
<?php
	require_once(APPPATH.'views/login-footer.php');
?>