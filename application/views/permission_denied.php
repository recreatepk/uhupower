<!DOCTYPE html>
<html lang="en">

<head>
	<title>Error :-(</title>
	<meta charset="utf-8"/>

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
	<link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>/assets/css/jquery-ui.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url() ?>/assets/css/app.min.css" rel="stylesheet" type="text/css"/>

</head>


<body class="account-body accountbg">

<!-- Eror-404 page -->
<div class="container">
	<div class="row vh-100 d-flex justify-content-center">
		<div class="col-12 align-self-center">
			<div class="row">
				<div class="col-lg-5 mx-auto">
					<div class="card">
						<div class="card-body p-0 auth-header-box">
							<div class="text-center p-3">
								<a href="index.html" class="logo logo-admin">
									<img src="<?= base_url() ?>assets/images/uhulogo_light.png" height="50" alt="logo"
										 class="auth-logo">
								</a>
								<h4 class="mt-3 mb-1 font-weight-semibold text-white font-18">Oops! Permission
									Denied</h4>
								<p class="text-muted  mb-0">Back to dashboard of UHU ERP.</p>
							</div>
						</div>
						<div class="card-body">
							<div class="ex-page-content text-center">
								<img src="<?= base_url() ?>assets/images/error.svg" alt="0" class="" height="170">
								<h1 class="mt-5 mb-4"> <?= $retVal = (isset($error_code) && !empty($error_code)) ? $error_code : '403!'; ?> </h1>
								<h5 class="font-16 text-muted mb-5"><?= $retVal = (isset($msg) && !empty($msg)) ? $msg : 'You dont have necessary Permission to Access this Module'; ?></h5>
							</div>
							<a class="btn btn-primary btn-block waves-effect waves-light"
							   href="<?= base_url() ?>Dashboard">Back to Dashboard <i class="fas fa-redo ml-1"></i></a>
						</div>
						<div class="card-body bg-light-alt text-center">
							<span class="text-muted d-none d-sm-inline-block">UHU ERP © <?= date('Y') ?></span>
						</div>
					</div><!--end card-->
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end col-->
	</div><!--end row-->
</div><!--end container-->
<!-- End Eror-404 page -->


<!-- jQuery  -->
<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/js/waves.js"></script>
<script src="<?= base_url() ?>assets/js/feather.min.js"></script>
<script src="<?= base_url() ?>assets/js/simplebar.min.js"></script>


</body>

</html>
