<!DOCTYPE html>
<html lang="en" class="no-js">

<head profile="http://www.w3.org/1999/xhtml/vocab">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Expires" content="1" />
    <meta http-equiv="Content-Length" content="1032" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">-->
    <link href="<?php echo BASE_PATH.'assets/fonts/font.css'?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo BASE_PATH.'assets/images/favicon.ico'?>" type="image/vnd.microsoft.icon" />
    <!-- close -->
    <script type="text/javascript" src="<?php echo BASE_PATH.'assets/js/jquery-1.9.1.min.js'?>"></script>


    <style type="text/css">
    
	@import url(https://fonts.googleapis.com/css?family=Roboto:300);
        html,
        body {
            /*
			  background: #50a3a2;
			  background: -webkit-linear-gradient(top left, #50a3a2 0%, #53e3a6 100%);
			  background: linear-gradient(to bottom right, #50a3a2 0%, #53e3a6 100%);
			*/
            
            background-image: url('<?php echo base_url(); ?>assets/images/bg1.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Open Sans', sans-serif;
            font-weight: 300;
            height: 100%;
            /*Allow spacing based on window height*/
            
            margin: 0;
            min-height: 240px;
        }
        /*The form part*/
        
        .content {
            /*A box that the form resides in - centered vertically and horizontally based on the window. The max-width and % width combo allow it to resize for small devices*/
            
            background: #FFF;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: block;
            left: 50%;
            max-width: 360px;
            position: absolute;
            padding: 40px;
            top: 50%;
            -ms-transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            width: 90%;
            z-index: 2;
            border: 1px solid #dedcdc;
        }
        .textInfo {
            font-size: 14px;
            margin-bottom: 30px;
            line-height: 21px;
            text-align: center;
            margin-top: 10px;
        }
        form {
            display: block;
            margin: auto;
            padding: 27px 0;
            width: 85%;
        }
        /*Text-inputs*/
        
        .mat-in {
            position: relative;
            margin-bottom: 32px;
        }
        input {
            border: none;
            border-bottom: 1px solid #9E9E9E;
            display: block;
            font-size: 16px;
            padding: 8px 0px;
            -webkit-transition: 0.2s border-bottom;
            transition: 0.2s border-bottom;
            width: 100%;
        }
        input:focus,
        input:invalid {
            box-shadow: none;
            outline: none;
        }
        input:focus {
            border-bottom: 1px solid #2196f3;
        }
        .copyright {
            font-size: 12px;
            color: gray;
            text-align: center
        }
        /*Labels*/
        
        label {
            color: #9E9E9E;
            font-size: 16px;
            pointer-events: none;
            position: absolute;
            top: 10px;
            -webkit-transition: 0.2s ease all;
            transition: 0.2s ease all;
        }
        input:focus ~ label,
        input:valid ~ label {
            color: #2196f3;
            font-size: 12px;
            top: -16px;
        }
        /*Bar that appears when an input is selected*/
        
        .bar:before,
        .bar:after {
            background: #2196f3;
            bottom: 1px;
            content: '';
            height: 2px;
            position: absolute;
            -webkit-transition: 0.2s ease all;
            transition: 0.2s ease all;
            width: 0;
        }
        .bar:before {
            left: 50%;
        }
        .bar:after {
            right: 50%;
        }
        input:focus ~ .bar:before,
        input:focus ~ .bar:after {
            width: 50%;
        }
        /*Submit Button*/
        
        .buttonForm {
            background: #2196f3;
            border: none;
            border-radius: 2px;
            color: #FFF;
            cursor: pointer;
            font-size: 16px;
            opacity: 0.999;
            padding: 8px 0;
            position: relative;
            -webkit-transition: 0.2s ease background;
            transition: .2s ease background;
            width: 100%;
        }
        .buttonForm:hover {
            background: #1976d2;
        }
        .buttonForm:before,
        .buttonForm:after {
            border-radius: 2px;
            content: '';
            height: 0;
            left: 0;
            opacity: 0;
            position: absolute;
            width: 100%;
            -webkit-transition: 0.2s ease all;
            transition: .2s ease all;
            z-index: -1;
        }
        .buttonForm:before {
            top: 50%;
        }
        .buttonForm:after {
            bottom: 50%;
        }
        .buttonForm:active:before,
        .buttonForm:active:after {
            background: #0d47a1;
            height: 50%;
            opacity: 1;
        }
        /*Error Messages*/
        
        .error {
            color: #F44336;
            margin: 16px auto 0;
            text-align: center;
            width: 90%;
            margin-bottom: 30px;
        }
        /*The Background Part - Each svg element will act as a column that rises. Within each svg column will be a rect element that rotates. Due to an error FF regarding the transform-origin of objects in an svg, the transform-orgin must be explicitly given without percents*/
        
        .bg-boxes {
            /*Set the container for the svg elements to take up the whole window and hide objects outside of the window*/
            
            height: 100%;
            min-height: 240px;
            position: absolute;
            overflow: hidden;
            width: 100%;
            z-index: 1;
        }
        .text-center {
            text-align: center
        }
        .cool-link {
            display: inline-block;
            color: #000;
            text-decoration: none;
        }
        .linkContainer {
            padding: 10px 0px 20px 0px;
            text-align: center;
        }
        .linkContainer a {
            font-size: 14px;
            color: #207eca;
            font-weight: bold;
        }
        .cool-link::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #207eca;
            transition: width .3s;
        }
        .cool-link:hover::after {
            width: 100%;
            //transition: width .3s;
        }
        .hideIt {
            display: none
        }
    </style>
</head>
<title>Bharti AXA General Insurance</title>
<!--
    <form role="form" name="test" action="<?php echo base_url(); ?>index.php/home/sendOtp" method="post" auto-complete="false">
        <div class="form-group col-xs-2 align-center">
            <span style="color: red;"><?php echo $errorMsg;?></span>
            <input type="text" name="emp_code" id="emp_code_for_otp" class="form-control" value="" placeholder="Enter employee code" autocomplete="false" required="true">
            <button type="submit" id="submit-inspection1" class="btn btn-primary btn-lg btn-block">Submit</button>
        </div>
    </form>
    -->

<body>
    <div class="content">
        <div class="text-center">
            <img src="<?php echo base_url(); ?>assets/images/logo.png" class="bagiLogo">
        </div>
        <!--Echo out errors here. See example-->
        <p class="error loginCred hideIt">Error, wrong username or password used. Please, try again.</p>
        <div class="" style="text-align: center;"><b>Credit Mapping Tool</b></div>
        <div class=" textInfo">The UserID is a combination of Company Name and Employee Code, example. HDFCV10725</div>
        <form autocomplete="off" id="loginForm">
            <div class="mat-in login">
                <input maxlength="16" type="text" name="emp_code" value="" autofocus required />
                <span class="bar"></span>
                <label>User ID</label>
            </div>
            <div class="mat-in login">
                <input type="password" name="password" autofocus value="" required />
                <span class="bar"></span>
                <label>Password</label>
            </div>
            <div class="linkContainer loginQuick">
                <a id="forgotPass" class="cool-link" href="javascript:void(0)">Forgot Password OR First Time Login?</a>
            </div>
            <button type="submit" class="loginQuick buttonForm" name="submit" id="login">Login</button>
        </form>
	<div class="mat-in login">
        <div class="text-center" style="color:red">Please Open in <strong>GOOGLE CHROME</strong> only.</div>
        </div>
        
        <form id="forgotForm" class="hideIt">
            <div class=" textInfo">Please enter the Employee code. We will send an OTP to your registered mobile number.</div>
            <div class="mat-in">
                <input maxlength="16" type="text" autofocus name="emp_code" autofocus value="" required />
                <span class="bar"></span>
                <label>User ID</label>
            </div>
			
            <div class="linkContainer">
                <a id="goToLoginOtp1" class="cool-link" href="javascript:void(0)">&larr; Go to Login</a>
            </div>
            <button type="submit" class="buttonForm" name="submit" id="otpButton">Send OTP</button>
        </form>

        <form id="otpForm" class="hideIt">
            <!--<div class="  textInfo">An OTP is been sent to <span id="mobileNumber"></span>. Please enter the OTP Below</div> -->
            <div class="  textInfo">An OTP is been sent to <span id="mobileNumber"></span> and <span id="emailID"></span>. Please enter the OTP Below</div>
            <p class="error otpErr hideIt">Invalid OTP. Please try again</p>
            <div class=" mat-in  ">
                <input type="text" autofocus name="otp_code" autofocus value="" required />
                <span class="bar"></span>
                <label>OTP</label>
            </div>
            <div class="linkContainer  ">
                <a id="resendOtp" class="cool-link" href="javascript:void(0)">Resend OTP</a> |
                <a id="goToLoginOtp2" class="cool-link" href="javascript:void(0)">Go to Login</a>
            </div>
            <button type="submit" class="buttonForm" name="submit" id="verify">Verify</button>
        </form>
        
        <form id="changeForm" class="hideIt">
            <div class="  textInfo">Please enter the new password below</div>
            <p class="error passerror hideIt">Password Mismatch</p>
            <div class=" mat-in  ">
                <input type="password" autofocus id="pass" name="password" autofocus value="" required />
                <span class="bar"></span>
                <label>New Password</label>
            </div>
            <div class=" mat-in  ">
                <input type="password" autofocus id="changepass" name="change_password" autofocus value="" required />
                <span class="bar"></span>
                <label>Confirm New Password</label>
            </div>
			<?php /*
            <div class="linkContainer">
                <a id="goToLoginOtp2" class="cool-link" href="javascript:void(0)">Go to Login</a>
            </div>
			*/ ?>
            <button type="submit" class="buttonForm" name="submit" id="passChange">Change Password</button>
        </form>
        
        <div class="copyright">Copyright
            <script>
                document.write(new Date().getFullYear())
            </script>. All Rights Reserved.</div>
    </div>
    <div class="bg-boxes">

    </div>
    <script>
        $('#forgotPass').click(function() {
            $('#loginForm').slideUp(200);
            //$('.loginQuick').hide();
            $('#forgotForm').slideDown(200);
            $('.loginCred').hide();
           // $('.forgotQuick').show();
        });

        $('#otpButton').click(function() {
            $('#forgotForm').slideUp(200);
            $('#otpForm').slideDown(200);
            $('.loginCred').hide();
        });

        $('#goToLoginOtp1').click(function() {
            $('#forgotForm').slideUp(200);
            $('.loginCred').hide();
            $('#loginForm').slideDown(200);
        });

        $('#goToLoginOtp2').click(function() {
            $('#otpForm').slideUp(200);
            $('#loginForm').slideDown(200);
            $('.loginCred').hide();
        });
        
//        $('#verify').click(function(){
//            
//        });

        $('#loginForm').on('submit', function(e) {
            //prevent the form from doing a submit
            e.preventDefault();
            $('.loginCred').hide();
            var form=$(this);
            $.ajax({
               type: "POST",
               url: '<?php echo base_url(); ?>index.php/home/login',
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                   data=JSON.parse(data);
                   if(data.loggedIn){
                       window.location.replace("<?php echo base_url(); ?>index.php/home/leadView");
                       localStorage.setItem("user",data.empName);
                   }else{
                       $('.loginCred').show();
                   }
               }
            });
            return false;
        });
        $('#forgotForm').on('submit', function(e) {
            e.preventDefault();
            var form=$(this);
            $.ajax({
               type: "POST",
               url: '<?php echo base_url(); ?>index.php/home/forgotPassword',
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                   data=JSON.parse(data);
                   $('#mobileNumber').text(data.MobileNumber);
                   $('#emailID').text(data.EmailID);
               }
            });
            return false;
        });
        
        var otp=1;
        $('#resendOtp').click(function(){
            otp++;
            if(otp<5){
               $('#forgotForm').trigger('submit');
            }
            
        });
        
        $('#otpForm').on('submit', function(e) {
            e.preventDefault();
            var form=$(this);
            $.ajax({
               type: "POST",
               url: '<?php echo base_url(); ?>index.php/home/verifyOtp',
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                   if(data=="success"){
                      $('#otpForm').slideUp(200);
                        $('#changeForm').slideDown(200);
                        $('.loginCred').hide();
                   }else{
                       $('.otpErr').show();
                   }
               }
            });
            return false;
        });
        
        $('#changeForm').on('submit', function(e) {
            e.preventDefault();
            var form=$(this);
            if($('#pass').val()!=$('#changepass').val()){
               $('.passerror').show();
                return false;
            }
            $.ajax({
               type: "POST",
               url: '<?php echo base_url(); ?>index.php/home/savePassword',
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                   if(data=="success"){
                       $('#changeForm').slideUp(200);
                       $('#loginForm').slideDown(200);
                   }
               }
            });
            return false;
        });
        
    </script>
</body>

</html>