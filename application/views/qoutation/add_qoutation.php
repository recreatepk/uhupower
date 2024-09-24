<!DOCTYPE html>
<html lang="en">

<? $this->view('inc/header.php'); ?>
<link href="<?= base_url() ?>assets/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
<title>Quotations - UHU</title>
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
								<h4 class="page-title">Quotations</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?= base_url() ?>Quotation">Quotations</a></li>
									<li class="breadcrumb-item active">Add Quotations</li>
								</ol>
							</div><!--end col-->
						</div><!--end row-->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Creating Quotations</h4>
										<p class="text-muted mb-0">For creating Quotations<code> (Please review the
												Quotations before locking)</code></p>
									</div><!--end card-header-->
									<div class="card-body">
										<form action="<?= base_url() ?>Quotation/adding_quotation" method="POST"
											  enctype="multipart/form-data">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label>Select Company * (<code>For Logo and Name</code>)</label>
														<select class="form-control custom-select"
																style="width: 100%; height:36px;" name="compnay_name">

															<optgroup label="Companies">
																<option value="1">UHU Power</option>
																<option value="2">Usman Engineering Works</option>
																<option value="3">Umer Brothers</option>
															</optgroup>
														</select>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Subject *</label>
														<input type="text"
															   class="form-control purchase-order-product-cost"
															   name="subject" required="">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Select Customer *</label>
														<select class="form-control custom-select"
																style="width: 100%; height:36px;"
																name="purchase_order_supplier_id">

															<optgroup label="Select Customer">
																<?
																foreach ($suppliers as $supplier) {
																	if ($supplier['cat'] == 2) {

																		?>
																		<option
																			value="<?= $supplier['sup_cus_id'] ?>"><?= $supplier['sup_cus_company'] ?>
																			- <?= $supplier['sup_cus_name'] ?></option>
																		<?
																	}
																}
																?>
															</optgroup>
															<optgroup label="Select Supplier">
																<?
																foreach ($suppliers as $supplier) {
																	if ($supplier['cat'] == 1) {

																		?>
																		<option
																			value="<?= $supplier['sup_cus_id'] ?>"><?= $supplier['sup_cus_company'] ?>
																			- <?= $supplier['sup_cus_name'] ?></option>
																		<?
																	}
																}
																?>
															</optgroup>
														</select>
													</div>
												</div>
												<div class="col-sm-6">
													<label>Select Date *</label>
													<div class="col-sm-12">
														<input class="form-control" name="purchase_order_date"
															   type="date" value="<?= date('y-m-d') ?>" id="mdate"
															   required>
													</div>
												</div>

												<div class="col-sm-12">
													<p><b>Dear Sir,</b></p>
													<p>UHU Group is one of the leading authorized Importers &
														Distributors in Pakistan of Perkins (UK) and Cummins Diesel
														Engines coupled with Stamford-UK / Leroy Somer-EU Alternators,
														ranging from 10kVA upto 2,000kVA, and FAW Diesel/Gasoline
														Generators which are one of China’s best brand in power
														generation ranging from 8.5kVA upto 50kVA. We are also the
														importer and distributor of other China-made Gasoline gensets
														ranging from 2. 5 kVA up to 7.5 kVA, and Solar Power complete
														solutions ranging from 5 kW up to 1 MW.</p>
													<p>
													<ul>
														<li>Well experience supervisory staff</li>
														<li>Quality control system to achieve the production as per
															required specification
														</li>
														<li>All kind of machinery</li>
														<li>Unit working round the clock to achieve the targets</li>
													</ul>
													</p>
													<p>
														All our Generators are backed by a superb warranty of at least
														One Year or 1,000 hours, whichever may come first. Therefore,
														all products purchased through us are of top quality
														international standard
													</p>
													<p>We look forward to a favourable response and assure you that our
														services will meet your standard and expectations. We are always
														there to server to the best of customer's convinence.</p>

												</div>

												<div class="col-sm-12 mt-3">
													<h3 class="text-center"
														style="background-color: #1761FD; color: white;">COMMERCIAL
														OFFER</h3>
												</div>
												<fieldset>
													<div class="repeater-custom-show-hide">
														<div data-repeater-list="products">
															<div data-repeater-item="">
																<div class="col-sm-12">
																	<div class="form-group row">
																		<div class="col-sm-3">
																			<label>Select Products for Quotes *</label>
																			<select
																				class="form-control custom-select product-select"
																				style="width: 100%; height:36px;"
																				name="purchase_order_product_id"
																				required>
																				<option>Please Select</option>
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

																		<div class="col-sm-3">
																			<div class="form-group">
																				<label>Quantity *</label>
																				<input type="number"
																					   class="form-control purchase-order-product-qty"
																					   name="purchase_order_product_qty"
																					   required="" min="1" max="">
																			</div>
																		</div>
																		<div class="col-sm-3">
																			<div class="form-group">
																				<label>Cost/Piece *</label>
																				<input type="number"
																					   class="form-control purchase-order-product-cost"
																					   name="purchase_order_product_cost"
																					   required="" min="">
																			</div>
																		</div>
																		<div class="col-sm-2">
																			<div class="form-group">
																				<label>Tax *</label>
																				<input type="number"
																					   class="form-control"
																					   name="purchase_order_product_tax"
																					   required="">
																			</div>
																		</div>
																		<div class="col-sm-1">
																			<div class="form-group">
																				<label>Option</label>
																				<span data-repeater-delete=""
																					  class="btn btn-danger btn-sm">
                                                                                        <span
																							class="far fa-trash-alt mr-1"></span> Delete
                                                                                    </span>
																			</div>
																		</div><!--end col-->
																	</div>
																</div>
															</div>
														</div>
														<span data-repeater-create=""
															  class="btn btn-info waves-effect waves-light">
                                                                        <span class="fa fa-plus"></span> Add
                                                                    </span>

													</div>
												</fieldset>
											</div>

											<div class="col-sm-12">
												<div class="col-sm-12"><h5 style="text-align: center;">Choose Services</h5></div>
												<fieldset style="background: #1761fd30; border-radius: 16px; padding: 20px;">
													<div class="repeater-custom-show-hide">
														<div data-repeater-list="service">
															<div data-repeater-item="">
																<div class="col-sm-12">

																	<div class="form-group row">
																		<div class="col-sm-6">
																			<label>Select Services needs to be Rendered *</label>
																			<select class="form-control custom-select" style="width: 100%; height:36px;" name="service_id" required>
																				<?
																				foreach ($services as $service) {
																					?>
																					<option value="<?=$service['service_id']?>"><?=$service['service_name']?></option>

																					<?
																				}
																				?>
																			</select>
																		</div>


																		<div class="col-sm-3">
																			<div class="form-group">
																				<label>Cost *</label>
																				<input type="number" class="form-control" name="service_cost" required>
																			</div>
																		</div>
																		<div class="col-sm-2">
																			<div class="form-group">
																				<label>Tax *</label>
																				<input type="number" class="form-control" name="service_tax" required>
																			</div>
																		</div>
																		<div class="col-sm-1">
																			<label>Option</label>
																			<span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                                                            <span class="far fa-trash-alt mr-1"></span> Delete
                                                                                        </span>
																		</div><!--end col-->
																	</div>
																</div>
															</div>
														</div>
														<span data-repeater-create="" class="btn btn-info waves-effect waves-light">
                                                                        <span class="fa fa-plus"></span> Add
                                                                    </span>
													</div>
												</fieldset>
											</div>

											<div class="row">
												<div class="col-sm-12 mt-3">
													<h3 class="text-center"
														style="background-color: #1761FD; color: white;">TERMS AND
														CONDITIONS</h3>
												</div>
												<div class="col-sm-12">
													<h5>Warranty Period:</h5>
													<textarea name="warranty" rows="2" cols="150">01 Year(s) or 1000 running hours, whichever comes first against any manufacturing defect(s) from the date of commissioning of Genset.</textarea>
													<h5>Payment Terms:</h5>
													<textarea name="p_terms" rows="2" cols="150">100% Advance along with confirm purchase order, or as agreed mutually.</textarea>
													<h5>Delivery:</h5>
													<textarea name="delivery" rows="2" cols="150">Ready stock, subject to prior sales / With Canopy delivery, would be made within 15 to 20 working days from the date of confirm purchase order or advance payment.</textarea>
													<h5>Validity:</h5>
													<textarea name="validity" rows="6" cols="150">1. days from date hereof.&#13;&#10;2.The Price is based on today's exchange rate.&#13;&#10;3.Our offer is subject to FORCE MAJURE CONDITION</textarea>

													<h5>NOTES:</h5>
													<textarea name="notes" rows="8" cols="150">1. We are exempt from deduction of Income Tax as per S.R.O 97(I)/2002 dated 12-02-2002" as the income tax has been paid at the import stage.&#13;&#10;2. Present Government rules "18% or 20%" GST will be charged to the sales tax registered or unregistered buyers respectively, or further Tax will be charged as per prevailing rule.&#13;&#10;3. Any additional taxes / duties if levied by the government or devaluation of Pak Rupees more than 2% subsequent to this offer will be additional to the above price.&#13;&#10;4. Transportation and Installation related activities like civil works, piping, valves, instruments, expansion tanks, supply, laying and termination of power & control cables, diesel / gas, lube oil & supply of consumable are in customer's scope unless mentioned specifically in quotation.</textarea>
												</div>
												<div class="col-sm-12 text-right">
													<button type="submit" class="btn btn-primary px-4 text-right"
															style="float:right;">Create Quotation
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
<?
if ($this->session->flashdata('add')) {
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
				title: 'Quotation has been Created'
			});
		});
	</script>
	<?
}
?>
<script type="text/javascript">
	var input = document.querySelectorAll('input');
	for (i = 0; i < input.length; i++) {
		input[i].setAttribute('size', input[i].getAttribute('placeholder').length);
	}
</script>


<script>
	// Get the current page or section identifier (you can customize this part)
	var currentPage = "Sales"; // Example: If you're on 1, set it to "1"


</script>

</body>

</html>
