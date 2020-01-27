<form role="form" name="test" action="<?php echo base_url(); ?>index.php/home/verifyPassword" method="post" auto-complete="false">
	<div class="col-xs-2">
		<input type="hidden" name="emp_master_id" class="form-control" value="<?php echo $empMasterId; ?>">
		<input type="text" name="pwd" class="form-control" value="" placeholder="Enter your Password" auto-complete="false" required="true">
		<p style="color: red;"><?php echo $errorMsg;?></p>
		<button type="submit" id="submit-inspection1" class="btn btn-info">Submit</button>
	</div>
</form>