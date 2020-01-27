<?php
	require_once(APPPATH.'views/login-header.php');
?>
<form role="form" name="test" action="<?php echo base_url(); ?>index.php/home/verifyPassword" method="post" auto-complete="false">
	<div class="form-group col-xs-2 align-center">
		<input type="hidden" name="emp_master_id" class="form-control" value="<?php echo $empMasterId; ?>">
		<input type="password" name="pwd" class="form-control" value="" placeholder="Enter your Password" auto-complete="false" max="10" required="true">
		<p style="color: red;"><?php echo $errorMsg;?></p>
		<button type="submit" id="submit-inspection1" class="btn btn-primary btn-lg btn-block">Login</button>
		<u><a href="<?php echo base_url(); ?>index.php/home/forgotPassword/<?php echo $empMasterId; ?>">Forgot password?</a></u>
	</div>
</form>
<?php
	require_once(APPPATH.'views/login-footer.php');
?>