<!DOCTYPE html>
<html lang="en">

<? $this->view('inc/header.php'); ?>
<title>Settings - UHU</title>
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
								<h4 class="page-title">Company Settings</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item active">Settings</li>
								</ol>
							</div><!--end col-->
						</div><!--end row-->
						<div>
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Editing Company Details</h4>
										<p class="text-muted mb-0">Change company settings</p>
									</div><!--end card-header-->
									<div class="card-body">
										<form
											action="<?= base_url() ?>settings/editing_company/<?= $settings['company_id'] ?>"
											method="POST" enctype="multipart/form-data">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Company Name *</label>
														<input type="text" class="form-control" name="company_name"
															   value="<?= $settings['company_name'] ?>" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Company Address *</label>
														<input type="text" class="form-control"
															   value="<?= $settings['company_address'] ?>"
															   name="company_address" required>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Company Phone1 *</label>
														<input type="tel" class="form-control"
															   value="<?= $settings['company_phone1'] ?>"
															   name="company_phone1" required>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Company Phone 2 (Optional)</label>
														<input type="tel" class="form-control"
															   value="<?= $settings['company_phone2'] ?>"
															   name="company_phone2">
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Company Email 1 *</label>
														<input type="text" class="form-control"
															   value="<?= $settings['company_email1'] ?>"
															   name="company_email1" required>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Company Email 2 (Optional)</label>
														<input type="text" class="form-control"
															   value="<?= $settings['company_email2'] ?>"
															   name="company_email2">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Company NTN *</label>
														<input type="text" class="form-control"
															   value="<?= $settings['company_NTN'] ?>"
															   name="company_NTN" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Company SRTN (Optional)</label>
														<input type="text" class="form-control"
															   value="<?= $settings['company_SRTN'] ?>"
															   name="company_SRTN">
													</div>
												</div>
												<div class="col-md-3">
													<label>Company logo Dark<code>(Formats .png) </code></label>
													<div class="custom-file mb-3">
														<input type="file" name="company_logo_name" accept=".png"
															   class="custom-file-input" id="logoFile"
															   onchange="showFileAndName('logoFile', 'logoLabel', 'logoPreview')">
														<label class="custom-file-label" id="logoLabel" for="logoFile">
															Choose Image
														</label>
													</div>
													<div class="col-md-12"
														 style="display: flex;justify-content: space-around;">
														<img id="logoPreview"
															 src="<?= base_url() ?>uploads/company/<?= $settings['company_logo_name'] ?>"
															 alt="No File Uploaded"
															 style="max-width: 250px; max-height: 250px;">
													</div>
												</div>

												<div class="col-md-3">
													<label>Company logo Light<code>(Formats .png) </code></label>
													<div class="custom-file mb-3">
														<input type="file" name="company_logo_name2" accept=".png"
															   class="custom-file-input" id="logoFile2"
															   onchange="showFileAndName('logoFile2', 'logoLabel2', 'logoPreview2')">
														<label class="custom-file-label" id="logoLabel2"
															   for="logoFile2">Choose Image</label>
													</div>
													<div class="col-md-12"
														 style="display: flex;justify-content: space-around;">
														<img id="logoPreview2"
															 src="<?= base_url() ?>uploads/company/<?= $settings['company_logo_name2'] ?>"
															 alt="No File Uploaded"
															 style="max-width: 250px; max-height: 250px;">
													</div>
												</div>

												<div class="col-md-3">
													<label>Company Favicon<code>(Formats .png) </code></label>
													<div class="custom-file mb-3">
														<input type="file" name="company_favicon" accept=".png"
															   class="custom-file-input" id="company_favicon_File"
															   onchange="showFileAndName('company_favicon_File', 'company_favicon_Label', 'company_favicon_Preview')">
														<label class="custom-file-label" id="company_favicon_Label"
															   for="company_favicon_File">Choose Image</label>
													</div>
													<div class="col-md-12"
														 style="display: flex;justify-content: space-around;">
														<img id="company_favicon_Preview"
															 src="<?= base_url() ?>uploads/company/<?= $settings['company_favicon'] ?>"
															 alt="No File Uploaded"
															 style="max-width: 250px; max-height: 250px;">
													</div>

												</div>

												<div class="col-md-3">
													<label>Login Background Image<code> (Formats .jpg, .jpeg,
															.png) </code></label>
													<div class="custom-file mb-3">
														<input type="file" name="company_loginpic_name"
															   accept=".jpg,.jpeg,.png" class="custom-file-input"
															   id="loginFile"
															   onchange="showFileAndName('loginFile', 'loginLabel', 'loginPreview')">
														<label class="custom-file-label" id="loginLabel"
															   for="loginFile">Choose Image</label>
													</div>
													<div class="col-md-12"
														 style="display: flex;justify-content: space-around;">
														<img id="loginPreview"
															 src="<?= base_url() ?>uploads/company/<?= $settings['company_loginpic_name'] ?>"
															 alt="No file Uploaded"
															 style="max-width: 250px; max-height: 250px;">
													</div>
												</div>
												<div class="col-md-6" style="margin-top: 10px;">
													<div class="form-group">
														<label class="mb-3">Buttons Color <code> (Please delete Cache to
																veiw color changes) </code></label>
														<div id="b_color-default" class="input-group"
															 title="Using input value">
															<input type="text" name="company_button_color"
																   class="form-control input-lg"
																   value="<?= $settings['company_button_color'] ?>"/>
															<span class="input-group-append">
																<span
																	class="input-group-text colorpicker-input-addon"><i></i>
																</span>
															</span>
														</div>
													</div>
												</div>
												<div class="col-md-6" style="margin-top: 10px;">
													<label class="mb-3">Sidebar Color <code> (Please delete Cache to
															veiw color changes) </code></label>
													<div id="b_color-default" class="input-group"
														 title="Using input value">
														<input type="text" name="company_sidebar_color"
															   class="form-control input-lg"
															   value="<?= $settings['company_sidebar_color'] ?>"/>
														<span class="input-group-append">
															<span
																class="input-group-text colorpicker-input-addon"><i></i>
															</span>
                                                        </span>
													</div>
												</div>
											</div>

											<div class="row" style="margin-top: 10px;">
												<div class="col-sm-12 text-right">
													<button type="submit" class="btn btn-primary px-4">
														Edit Company Details
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

<!-- JavaScript code to display the uploaded image -->
<script>
	function showFileAndName(inputId, labelId, imageId) {
		var input = document.getElementById(inputId);
		var label = document.getElementById(labelId);
		var image = document.getElementById(imageId);

		// Get the uploaded file
		var file = input.files[0];
		var reader = new FileReader();

		// Display the file name in the label
		if (file) {
			label.innerHTML = file.name;
		} else {
			label.innerHTML = 'Choose Image';
		}

		// Display the uploaded image preview
		if (file && file.type.match('image.*')) {
			reader.onload = function (e) {
				image.src = e.target.result;
				image.style.display = 'block'; // Show the image element
			};
			reader.readAsDataURL(file);
		} else {
			// If the file is not an image, hide the image element
			image.style.display = 'none';
		}
	}
</script>
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
				title: 'Error Uploading Files'
			});
		});
	</script>
	<?
}
?>
<?
if ($this->session->flashdata('update')) {
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
				title: 'Company Settings has been updated'
			});
		});
	</script>
	<?
}
?>
<script>
	// Get the current page or section identifier (you can customize this part)
	var currentPage = "Settings"; // Example: If you're on 1, set it to "1"


</script>

</body>

</html>
