<?php
$CI = &get_instance(); // Access CodeIgniter's instance

$CI->load->database(); // Load the database library if not already loaded
$CI->load->driver('cache', ['adapter' => 'file']); // Load the cache driver

$cache_key = 'office_data';

if (!($office_data = $CI->cache->get($cache_key))) {
	// Cache not available or expired, fetch data from the database
	$query = $CI->db->get('office');
	$office_data = $query->row();

	// Save data in the cache for future use
	$CI->cache->save($cache_key, $office_data);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>UHU - UHU ERP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta content="UHU ERP Application" name="description"/>
	<meta content="Re Create Technologies" name="author"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png">

	<!-- Sweet Alert -->
	<link href="<?= base_url() ?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url() ?>assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">

	<!-- App css -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>assets/css/app-rtl.min.css" rel="stylesheet" type="text/css"/>

</head>
<style type="text/css">
	.Background_image {
		background-image: url("<?=base_url()?>uploads/company/<?=$office_data->company_loginpic_name?>");
		background-position: center center;
		background-size: cover;
		background-repeat: repeat;
		background-color: rgba(0, 0, 0, 0.04);
	}

	input {
		text-align: left !important;
		padding-left: 5px !important;
	}

	.btn-primary {
		background-color: <?=$office_data->company_button_color?> !important;
		border-color: <?=$office_data->company_button_color?> !important;
	}

</style>

<body class="account-body Background_image" style="text-align: left !important">

<!-- Log In page -->
<div class="container">
	<div class="row vh-100 d-flex justify-content-center">
		<div class="col-12 align-self-center">
			<div class="row">
				<div class="col-lg-5 mx-auto">
					<div class="card">
						<div class="card-body p-0 auth-header-box">
							<div class="text-center p-3">
								<a href="index.html" class="logo logo-admin">
									<img src="<?= base_url() ?>uploads/company/<?= $office_data->company_logo_name2 ?>"
										 height="50" alt="logo" class="auth-logo">
								</a>
								<h4 class="mt-3 mb-1 font-weight-semibold text-white font-18">ERP System</h4>
								<p class="text-muted  mb-0">Sign in to continue</p>
							</div>
						</div>
						<div class="card-body">

							<div class="tab-content">
								<div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
									<form class="form-horizontal my-4" action="<?= base_url() ?>user/login_submit"
										  method="POST">

										<div class="form-group">
											<label for="username">Email</label>
											<div class="input-group mb-3">
												<input type="email" dir="ltr" class="form-control" name="email"
													   placeholder="Enter Email">
											</div>
										</div><!--end form-group-->

										<div class="form-group">
											<label for="userpassword">Password</label>
											<div class="input-group mb-3">
												<input type="password" dir="ltr" class="form-control" name="password"
													   placeholder="Enter password">
											</div>
										</div><!--end form-group-->


										<div class="form-group mb-0 row">
											<div class="col-12 mt-2">
												<button class="btn btn-primary btn-block waves-effect waves-light"
														type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i>
												</button>
											</div><!--end col-->
										</div> <!--end form-group-->
									</form><!--end form-->

								</div>

							</div>
						</div><!--end card-body-->
						<div class="card-body bg-light-alt text-center">
							<span
								class="text-muted d-none d-sm-inline-block">Re Create Technologies © <?= date('Y') ?></span>
						</div>
					</div><!--end card-->
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end col-->
	</div><!--end row-->
</div><!--end container-->
<!-- End Log In page -->


<!-- jQuery  -->
<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/waves.js"></script>
<script src="<?= base_url() ?>assets/js/feather.min.js"></script>
<script src="<?= base_url() ?>assets/js/simplebar.min.js"></script>
<!-- Sweet-Alert  -->
<script src="<?= base_url() ?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>assets/pages/jquery.sweet-alert.init.js"></script>

<?
if ($this->session->flashdata('error')) {
	?>
	<script>
		$(document).ready(function () {
			var Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true,
				onOpen: function (toast) {
					toast.addEventListener('mouseenter', Swal.stopTimer)
					toast.addEventListener('mouseleave', Swal.resumeTimer)
				}
			});

			// Use Toast here or in any other event/function as needed
			Toast.fire({
				icon: 'warning',
				title: 'Invalid Credentials, Try Again'
			});
		});
	</script>
	<?
}
?>
</body>

</html>
