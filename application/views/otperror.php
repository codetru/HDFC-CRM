<?php
	require_once(APPPATH.'views/login-header.php');
?>
<span style="color: red"><?php echo $errorMsg;?></span>
<script type="text/javascript">
	window.setTimeout(function(){

        // Move to a new location or you can do something else
        var url = '<?php echo site_url()?>';
        window.location.href = url+"index.php";

    }, 4000);
</script>

<?php
	require_once(APPPATH.'views/login-footer.php');
?>