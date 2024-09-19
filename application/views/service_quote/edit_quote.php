<!DOCTYPE html>
<html lang="en">

<? $this->view('inc/header.php'); ?>
<title>Service Quotes- UHU</title>
<body class="dark-sidenav">
<!-- Left Sidenav -->
<? $this->view('inc/sidebar.php'); ?>
<!-- end left-sidenav-->


<div class="page-wrapper">
	<!-- Top Bar Start -->
	<? $this->view('inc/nav_bar.php'); ?>
	<!-- Top Bar End -->


	<div class="page-content"><!-- Page Content-->
		<div class="container-fluid">
			<!-- Page-Title -->
			<div class="row">
				<div class="col-sm-12">
					<div class="page-title-box">
						<div class="row">
							<div class="col">
								<h4 class="page-title">Services Quote</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url() ?>service_quote">Service
											Quotes</a></li>
									<li class="breadcrumb-item active">Service Quote</li>
								</ol>
							</div><!--end col-->
						</div><!--end row-->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Update Service Quotaion</h4>
									</div><!--end card-header-->
									<div class="card-body">
										<form
											action="<?= base_url() ?>Service_quote/editing_quote/<?= $service_quotes[0]['service_quote_id'] ?>"
											method="POST" enctype="multipart/form-data">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label>Select Company * <code>(For Logo and Name)</code></label>
														<select class="form-control custom-select"
																style="width: 100%; height:36px;" name="company_id">
															<optgroup label="Companies">
																<option
																	value="1" <?= $retVal = ($service_quotes[0]['company_id'] == 1) ? 'selected' : ''; ?>>
																	UHU Power
																</option>
																<option
																	value="2" <?= $retVal = ($service_quotes[0]['company_id'] == 2) ? 'selected' : ''; ?>>
																	Usman Engineering Works
																</option>
																<option
																	value="3" <?= $retVal = ($service_quotes[0]['company_id'] == 3) ? 'selected' : ''; ?>>
																	Umer Brothers
																</option>
															</optgroup>
														</select>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Subject *</label>
														<input type="text" class="form-control" name="subject"
															   value="<?= $service_quotes[0]['subject'] ?>" required="">
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label>Select Customer *</label>
														<select class="form-control custom-select"
																style="width: 100%; height:36px;" name="sup_cus_id">
															<optgroup label="Select Supplier / Customer">
																<?
																foreach ($suppliers as $supplier) {

																	?>
																	<option <?= $retVal = ($supplier['sup_cus_id'] == $service_quotes[0]['sup_cus_id']) ? 'selected' : ''; ?>
																		value="<?= $supplier['sup_cus_id'] ?>"><?= $supplier['sup_cus_company'] ?>
																		- <?= $supplier['sup_cus_name'] ?></option>
																	<?
																}
																?>
															</optgroup>
														</select>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label>Select Complaint *</label>
														<select class="form-control custom-select"
																style="width: 100%; height:36px;" name="complaint_id">
															<optgroup label="Select Complaint">
																<option>No Complaint</option>
																<?
																foreach ($complaints as $complaint) {

																	?>
																	<option
																		value="<?= $complaint['complaint_id'] ?>" <?= $retVal = ($complaint['complaint_id'] == $service_quotes[0]['complaint_id']) ? 'selected' : ''; ?>><?= $complaint['complaint_id'] ?>
																		- <?= $complaint['complaint_description'] ?></option>
																	<?
																}
																?>
															</optgroup>
														</select>
													</div>
												</div>
												<div class="col-sm-4">
													<label>Select Date *</label>
													<div class="col-sm-12">
														<input class="form-control" name="date" type="date"
															   value="<?= $service_quotes[0]['date'] ?>"
															   id="example-date-input" required>
													</div>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-12"><h5 style="text-align: center;">Update
															Services</h5></div>
													<fieldset
														style="background: #1761fd30;border-radius: 16px;padding: 20px;">
														<div class="repeater-custom-show-hide">
															<div data-repeater-list="service">
																<?
																foreach ($quote_services as $service_quote) {
																	?>
																	<div data-repeater-item="">
																		<div class="col-sm-12">

																			<div class="form-group row">
																				<div class="col-sm-6">
																					<label>Select Services needs to be
																						Rendered *</label>
																					<select
																						class="form-control custom-select"
																						style="width: 100%; height:36px;"
																						name="render_service_id"
																						required>
																						<?
																						foreach ($services as $service) {
																							?>
																							<option <?= $retVal = ($service['service_id'] == $service_quote['render_service_id']) ? 'selected' : ''; ?>
																								value="<?= $service['service_id'] ?>"><?= $service['service_name'] ?></option>

																							<?
																						}
																						?>
																					</select>
																				</div>


																				<div class="col-sm-3">
																					<div class="form-group">
																						<label>Cost *</label>
																						<input type="text"
																							   class="form-control"
																							   name="cost"
																							   value="<?= $service_quote['cost'] ?>"
																							   required="">
																					</div>
																				</div>
																				<div class="col-sm-2">
																					<div class="form-group">
																						<label>Tax *</label>
																						<input type="text"
																							   class="form-control"
																							   name="tax"
																							   value="<?= $service_quote['tax'] ?>"
																							   required="">
																					</div>
																				</div>
																				<div class="col-sm-1">
																					<label>Option</label>
																					<span data-repeater-delete=""
																						  class="btn btn-danger btn-sm">
                                                                                                <span
																									class="far fa-trash-alt mr-1"></span> Delete
                                                                                            </span>
																				</div><!--end col-->
																			</div>
																		</div>
																	</div>
																	<?
																}
																?>
															</div>
															<span data-repeater-create=""
																  class="btn btn-info waves-effect waves-light">
                                                                            <span class="fa fa-plus"></span> Add
                                                                        </span>
														</div>
													</fieldset>
												</div>
												<div class="col-sm-12">
													<div class="col-sm-12"><h5 style="text-align: center;">Update
															Parts</h5></div>
													<fieldset
														style="background: #1761fd30;border-radius: 16px;padding: 20px;margin-top: 10px;">
														<div class="repeater-custom-show-hide">
															<div data-repeater-list="products">
																<?
																foreach ($service_quote_products as $service_quote_product) {
																	if ($service_quote_product['service_quote_id'] != '') {
																		?>

																		<div data-repeater-item="">
																			<div class="col-sm-12">
																				<div class="form-group row">
																					<div class="col-sm-6">
																						<label>Select Parts as Need
																							*</label>
																						<select
																							class="form-control custom-select product-select"
																							style="width: 100%; height:36px;"
																							name="product_id" required>
																							<?
																							foreach ($product_categories as $product_category) {
																								?>
																								<optgroup
																									label="<?= $product_category['product_category_name'] ?>">
																									<?
																									foreach ($products as $product) {
																										if ($product['product_category_id'] == $product_category['product_category_id']) {
																											?>
																											<option <?= $retVal = ($product['product_id'] == $service_quote_product['product_id']) ? 'selected' : ''; ?>
																												value="<?= $product['product_id'] ?>"><?= $product['product_name'] ?> </option>
																											<?
																										}
																									}
																									?>
																								</optgroup>
																								<?
																							}
																							?>
																						</select>
																					</div>
																					<div class="col-sm-1">
																						<div class="form-group">
																							<label>Qty *</label>
																							<input type="text"
																								   class="form-control"
																								   name="qty"
																								   value="<?= $service_quote_product['qty'] ?>"
																								   required="">
																						</div>
																					</div>
																					<div class="col-sm-2">
																						<div class="form-group">
																							<label>Cost *</label>
																							<input type="text"
																								   class="form-control"
																								   name="cost"
																								   value="<?= $service_quote_product['cost'] ?>"
																								   required="">
																						</div>
																					</div>
																					<div class="col-sm-2">
																						<div class="form-group">
																							<label>Tax *</label>
																							<input type="text"
																								   class="form-control"
																								   name="tax"
																								   value="<?= $service_quote_product['tax'] ?>"
																								   required="">
																						</div>
																					</div>
																					<div class="col-sm-1">
																						<label>Option</label>
																						<span data-repeater-delete=""
																							  class="btn btn-danger btn-sm">
                                                                                            <span
																								class="far fa-trash-alt mr-1"></span> Delete
                                                                                        </span>
																					</div><!--end col-->

																				</div>
																			</div>
																		</div>

																		<?
																	} else {
																		?>
																		<div data-repeater-item="">
																			<div class="col-sm-12">
																				<div class="form-group row">
																					<div class="col-sm-6">
																						<label>Select Parts as Need
																							*</label>
																						<select
																							class="form-control custom-select product-select"
																							style="width: 100%; height:36px;"
																							name="product_id" required>
																							<?
																							foreach ($product_categories as $product_category) {
																								?>
																								<optgroup
																									label="<?= $product_category['product_category_name'] ?>">
																									<?
																									foreach ($products as $product) {
																										if ($product['product_category_id'] == $product_category['product_category_id']) {
																											?>
																											<option
																												value="<?= $product['product_id'] ?>"><?= $product['product_name'] ?> </option>
																											<?
																										}
																									}
																									?>
																								</optgroup>
																								<?
																							}
																							?>
																						</select>
																					</div>
																					<div class="col-sm-1">
																						<div class="form-group">
																							<label>Qty *</label>
																							<input type="text"
																								   class="form-control"
																								   name="qty"
																								   required="">
																						</div>
																					</div>
																					<div class="col-sm-2">
																						<div class="form-group">
																							<label>Cost *</label>
																							<input type="text"
																								   class="form-control"
																								   name="cost"
																								   required="">
																						</div>
																					</div>
																					<div class="col-sm-2">
																						<div class="form-group">
																							<label>Tax *</label>
																							<input type="text"
																								   class="form-control"
																								   name="tax"
																								   required="">
																						</div>
																					</div>
																					<div class="col-sm-1">
																						<label>Option</label>
																						<span data-repeater-delete=""
																							  class="btn btn-danger btn-sm">
                                                                                            <span
																								class="far fa-trash-alt mr-1"></span> Delete
                                                                                        </span>
																					</div><!--end col-->
																				</div>
																			</div>
																		</div>
																		<?
																	}
																}
																?>
															</div>
															<span data-repeater-create=""
																  class="btn btn-info waves-effect waves-light">
                                                                            <span class="fa fa-plus"></span> Add
                                                                        </span>
														</div>
													</fieldset>
												</div>
												<div class="col-sm-12" style="margin-top: 20px">
													<p style="text-decoration: underline;"><b>Terms & Conditions:</b>
													</p>
													<textarea name="tnc" clas="form-control" rows="8"
															  cols="150"><?= $service_quotes[0]['tnc'] ?></textarea>

												</div>


												<div class="col-sm-12" style="margin-top: 5px">
													<button type="submit" class="btn btn-primary px-4 text-right"
															style="float: right;">Render Service
													</button>
												</div>

											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div><!--end page-title-box-->
				</div><!--end col-->
			</div><!--end row-->
		</div><!-- container -->
		<? $this->view('inc/footer_text.php'); ?>
	</div><!-- end page content -->
</div><!-- end page-wrapper -->


<? $this->view('inc/footer.php'); ?>
<script src="<?= base_url() ?>assets/plugins/repeater/jquery.repeater.min.js"></script>
<script src="<?= base_url() ?>assets/pages/jquery.form-repeater.js"></script>
<script>
	$(document).ready(function () {
		$(document).on("change input", ".product-select", function () {
			updateInputFields($(this));
		});

		$(document).on("input", ".purchase-order-product-qty", function () {
			validateQuantityInput($(this));
		});

		function updateInputFields(selectElement) {
			var selectedOption = selectElement.find(":selected");
			var cost = selectedOption.data("cost");
			var qty = selectedOption.data("qty");
			var po = selectedOption.data("po");

			var row = selectElement.closest(".form-group.row");
			row.find(".purchase-order-product-cost").val(cost);
			row.find(".invoice_purchase_order_id").val(po);
			row.find(".purchase-order-product-cost").attr("min", cost); // Set the max attribute to the available cost


		}


	});
</script>
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
				title: 'Services Quotes Updated'
			});
		});
	</script>
	<?
}
?>
<script>
	// Get the current page or section identifier (you can customize this part)
	var currentPage = "service"; // Example: If you're on 1, set it to "1"


</script>

</body>

</html>
