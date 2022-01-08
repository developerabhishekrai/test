<?php
    require($_SERVER['DOCUMENT_ROOT'].'/kamgaro/config/config.php');
    require(APP_PATH.'/kamgaro/config/helper.php');
    
    if (isset($_SESSION['authority'])) {
        redirect('Authority/dashboard');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Authority Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= link_tag(['/kamgaro/backup1/bootstrap/vendor/bootstrap/css/bootstrap.min.css']); ?>
	<?= link_tag(['/kamgaro/backup1/bootstrap/fonts/font-awesome-4.7.0/css/font-awesome.min.css']); ?>
	<?= link_tag(['/kamgaro/backup1/bootstrap/fonts/iconic/css/material-design-iconic-font.min.css']); ?>
	<?= link_tag(['/kamgaro/backup1/bootstrap/vendor/animate/animate.css']); ?>
	<?= link_tag(['/kamgaro/backup1/bootstrap/vendor/css-hamburgers/hamburgers.min.css']); ?>
	<?= link_tag(['/kamgaro/backup1/bootstrap/vendor/animsition/css/animsition.min.css']); ?>
	<?= link_tag(['/kamgaro/backup1/bootstrap/vendor/select2/select2.min.css']); ?>
	<?= link_tag(['/kamgaro/backup1/bootstrap/vendor/daterangepicker/daterangepicker.css']); ?>
	<?= link_tag(['/kamgaro/backup1/bootstrap/css/util.css']); ?>
	<?= link_tag(['/kamgaro/backup1/bootstrap/css/main.css']); ?>
	<link href="https://www.jqueryscript.net/demo/Highly-Customizable-jQuery-Toast-Message-Plugin-Toastr/build/toastr.css" rel="stylesheet" type="text/css" />
	<style>
		.img-logo {
			height: 100px;
		}
		#toast-container > div {
            opacity: 1;
            font-size: 16px;
            font-weight: 600;
        }
	</style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?= base_url(); ?>bootstrap/image/bg-01.jpg');">
			<div class="wrap-login100">
				<?= form_open(['', 'login100-form validate-form', 'form-login']); ?>
					<span class="login100-form-logo">
						<?= img(['bootstrap/image/logo.png', 'img-logo']); ?>
					</span>

					<span class="login100-form-title p-b-30 p-t-25">
						Authority Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button type="button" id="btn-login" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-50">
						<a class="txt1" href="forgot">
							Forgot Password?
						</a>
					</div>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
	
	<div id="dropDownSelect1"></div>
	
	<?= script_tag(['/kamgaro/backup1/bootstrap/vendor/jquery/jquery-3.2.1.min.js']); ?>
	<?= script_tag(['/kamgaro/backup1/bootstrap/vendor/animsition/js/animsition.min.js']); ?>
	<?= script_tag(['/kamgaro/backup1/bootstrap/vendor/bootstrap/js/popper.js']); ?>
	<?= script_tag(['/kamgaro/backup1/bootstrap/vendor/bootstrap/js/bootstrap.min.js']); ?>
	<?= script_tag(['/kamgaro/backup1/bootstrap/vendor/select2/select2.min.js']); ?>
	<?= script_tag(['/kamgaro/backup1/bootstrap/vendor/daterangepicker/moment.min.js']); ?>
	<?= script_tag(['/kamgaro/backup1/bootstrap/vendor/daterangepicker/daterangepicker.js']); ?>
	<?= script_tag(['/kamgaro/backup1/bootstrap/vendor/countdowntime/countdowntime.js']); ?>
	<?= script_tag(['/kamgaro/backup1/bootstrap/js/main.js']); ?>
	<script src="https://www.jqueryscript.net/demo/Highly-Customizable-jQuery-Toast-Message-Plugin-Toastr/toastr.js"></script>
	<script src="https://kamgaro.com/bootstrap/js/toast.js"></script>

	<script>
	    $(document).ready(function() {
	        $('#btn-login').click(function() {
	            $.ajax({
	                type: "POST",
	                data: $('#form-login').serialize(),
	                url: "<?= site_url('Authority/code').'?flag=authority_login'; ?>",
	                success: function(response) {
						if (response == "success") {
							fire_toast('Login successful.', 'success');
	                        setTimeout(function() {
	                            window.location.href= 'dashboard';
	                        }, 1000);
	                    }
	                    else if (response == "required") {
	                        fire_toast('Fill all details.', 'info');
	                    }
	                    else if (response == "invalid") {
	                        fire_toast('Invalid login detail.', 'warning');
	                    }
	                    else {
	                        fire_toast('UserName went wrong.', 'error');
	                    }
	                },
	                error: function() {
	                    alert('Something went wrong.');
	                }
	            })
	        })
	    })
	</script>
</body>
</html>