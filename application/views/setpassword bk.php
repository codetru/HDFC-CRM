<form role="form" name="test" action="<?php echo base_url(); ?>index.php/home/savePassword" method="post" auto-complete="false">
	<div class="col-xs-2">
		<input type="hidden" name="emp_master_id" class="form-control" value="<?php echo $empMasterId; ?>">
		<input type="password" name="password" id="pwd" class="form-control" value="" placeholder="Enter your password" auto-complete="false" required="true">
		<input type="password" id="confirm_pwd" class="form-control" value="" placeholder="Re-enter your password" auto-complete="false" required="true">
		<span id="message"></span>
		<p style="color: red;"><?php echo $errorMsg;?></p>
		<button type="submit" id="submit" class="btn btn-info" disabled="true">Submit</button>
	</div>
</form>

<script type="text/javascript">
	$('#pwd, #confirm_pwd').on('keyup', function () {
	  if ($('#pwd').val() != "" && $('#pwd').val() == $('#confirm_pwd').val()) {
	    $('#message').html('Matched').css('color', 'green');
	    document.getElementById('submit').disabled = false;
	  } else {
	    $('#message').html('Password Not Matched').css('color', 'red');
	    document.getElementById('submit').disabled = true;
	  }
	});
</script>