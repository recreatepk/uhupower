<!DOCTYPE html>
<html lang="en">

<? $this->view('inc/header.php'); ?>
<title>User Profile - UHU</title>
<body class="dark-sidenav">
<!-- Left Sidenav -->
<? $this->view('inc/sidebar.php'); ?>
<!-- end left-sidenav-->


<div class="page-wrapper">
	<!-- Top Bar Start -->
	<? $this->view('inc/nav_bar.php'); ?>
	<!-- Top Bar End -->

	<!-- Page Content-->
	<div class="page-content">
		<div class="container-fluid">
			<!-- Page-Title -->
			<div class="row">
				<div class="col-sm-12">
					<div class="page-title-box">
						<div class="row">
							<div class="col">
								<h4 class="page-title">Update Profle</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item active">Profile</li>
								</ol>
							</div><!--end col-->
						</div><!--end row-->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Update Your Profile</h4>
										<p class="text-muted mb-0">Update your basic information</p>
									</div><!--end card-header-->
									<div class="card-body">
										<form
											action="<?= base_url() ?>user/editing_profile/<?= $users['employee_id'] ?>"
											method="POST">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>Employee Code</label>
														<input type="text" class="form-control"
															   value="<?= $users['employee_code'] ?>" readonly>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Employee Name *</label>
														<input type="text" value="<?= $users['employee_name'] ?>"
															   class="form-control">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Employee Designation *</label>
														<input type="text" value="<?= $users['employee_designation'] ?>"
															   class="form-control">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label>Employee Salary *</label>
														<input type="number" value="<?= $users['employee_salary'] ?>"
															   class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Employee Email </label>
														<input type="text" value="<?= $users['employee_email'] ?>"
															   class="form-control" name="employee_email" readonly>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Password *</label>
														<input type="password" class="form-control"
															   name="employee_password"
															   value="<?= $users['employee_password'] ?>" required>
													</div>
												</div>


												<div class="col-md-3">
													<div class="form-group">
														<label>Employee Phone 1 *</label>
														<input type="tel" value="<?= $users['employee_phone1'] ?>"
															   class="form-control" name="employee_phone1" required>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Employee Phone 2 (Optional)</label>
														<input type="tel" value="<?= $users['employee_phone2'] ?>"
															   class="form-control" name="employee_phone2">
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label>Employee Address *</label>
														<input type="text" value="<?= $users['employee_address'] ?>"
															   class="form-control" name="employee_address" required>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-sm-12 text-right">
													<button type="submit" class="btn btn-primary px-4">Update Profile
													</button>
												</div>
											</div>
										</form>
									</div><!--end card-body-->
								</div><!--end card-->
							</div>
						</div>
					</div><!--end page-title-box-->
				</div><!--end col-->
			</div><!--end row-->
			<!-- end page title end breadcrumb -->


		</div><!-- container -->

		<? $this->view('inc/footer_text.php'); ?>
	</div>
	<!-- end page content -->
</div>
<!-- end page-wrapper -->


<? $this->view('inc/footer.php'); ?>
<?
if ($this->session->flashdata('edit')) {
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
				icon: 'success',
				title: 'Your Data Updated successfully'
			});
		});
	</script>
	<?
}
?>
<script>
	// Get the current page or section identifier (you can customize this part)
	var currentPage = "hrm"; // Example: If you're on 1, set it to "1"


</script>

</body>

</html>
