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

<? $this->view('inc/header.php'); ?>
<title>Quotation - UHU</title>
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
								<h4 class="page-title">Quotation</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item active">Quotations</li>
								</ol>
							</div><!--end col-->
						</div><!--end row-->
						<div class="row">
							<div class="col-lg-12" id="printme">
								<div class="card">
									<div class="card-body invoice-head">
										<div class="row">
											<div class="col-md-4 align-self-center"
												 style="display: flex;align-items: center;flex-direction: column;">
												<?
												if ($quotation_details[0]['compnay_name'] == 1) {
													?>
													<img
														src="<?= base_url() ?>uploads/company/<?= $office_data->company_logo_name ?>"
														style="height: 60px;">
													<?
												}
												if ($quotation_details[0]['compnay_name'] == 2) {
													?>
													<img src="<?= base_url() ?>assets/images/uewlogo.png"
														 style="height: 80px;min-height: 100%;width: 50%;">
													<?
												}
												if ($quotation_details[0]['compnay_name'] == 3) {
													?>
													<img src="<?= base_url() ?>assets/images/ub_logo.png"
														 style="height: 80px;min-height: 100%;width: 70%;">
													<?
												}
												?>
											</div><!--end col-->
											<div class="col-md-4"
												 style="display: flex;flex-direction: column;align-items: center;">


												<p style="text-align: center;font-weight: 600; margin: 0;"><?= $office_data->company_address ?></p>
												<p style="text-align: center;font-weight: 500; margin: 0;"><?= $office_data->company_phone1 ?></p>
												<?php
												if ($quotation_details[0]['compnay_name'] == 1) {
													?>
													<p style="text-align: center;font-weight: 500; margin: 0;"><?= $office_data->company_email1 ?></p>
													<?php
												}
												?>
												<?php
												if ($quotation_details[0]['compnay_name'] == 1) {
													?>
													<div>
														<p style="margin-bottom: 0px">NTN:
															<b><?= $office_data->company_NTN ?></b></p>
														<p style="margin-bottom: 0px">STRN:
															<b><?= $office_data->company_SRTN ?></b></p>
													</div>
													<?php
												}
												if ($quotation_details[0]['compnay_name'] == 2) {

												} else {

												}
												?>
											</div>
											<div class="col-md-4 align-self-center"
												 style="display: flex;align-items: center;flex-direction: column;">
												<h2 style="font-size: 50px;text-shadow: 1px 3px #0000004a;font-weight: 800;">
													Quotation</h2>
											</div><!--end col-->

										</div><!--end row-->
									</div><!--end card-body-->
									<div class="card-body">
										<div class="row">

											<div class="col-md-7">
												<div class="float-left">
													<address class="font-13">
														<strong class="font-14">Quotes To :</strong><br>
														<?= $quotes[0]['sup_cus_company'] ?><br>
														<?= $quotes[0]['sup_cus_name'] ?><br>
														<?= $quotes[0]['sup_cus_address'] ?><br>
														<?= $quotes[0]['ntn'] ?><br>
														<?= $quotes[0]['strn'] ?><br>

													</address>
												</div>
											</div><!--end col-->
											<div class="col-md-3">
												<div class="float-to-right">
													<h6 class="mb-0"><b>Quotation Date
															:</b> <?= date('d/M/Y', strtotime($quotes[0]['quotation_order_date'])) ?>
													</h6>
													<h6><b>Quotation ID :</b> QT - 0<?= $quotes[0]['quotation_id'] ?>
													</h6>
												</div>
											</div><!--end col-->
											<div class="col-md-2 no-print">
												<div class="float-left">
													<strong class="font-14">Status :</strong><br>
													<?
													if ($quotes[0]['quotation_order_status'] == 1) {
														echo "<span class='badge badge-pill badge-info'><i class='fas fa-lock-open'></i> Draft</span>";
													}
													if ($quotes[0]['quotation_order_status'] == 2) {
														echo "<span class='badge badge-pill badge-warning'><i class='fas fa-lock'></i> locked</span>";
													}
													if ($quotes[0]['quotation_order_status'] == 3) {
														echo "<span class='badge badge-pill badge-success'><i class='fas fa-check'></i> Finalized</span>";
													}
													if ($quotes[0]['quotation_order_status'] == 4) {
														echo "<span class='badge badge-pill badge-success'><i class='fas fa-check'></i> Finalized (Invoie Generated)</span>";
													}
													?>
												</div>
											</div><!--end col-->
											<div class="row">
												<div class="col-sm-12" style="padding-left: 70px; padding-right: 70px;">
													<center><h4>
															<span>Subject: </span><?= $quotation_details[0]['subject'] ?>
														</h4></center>
													<p style="margin-top: 10px;" class="print-text-size-big"><b>Dear
															Sir,</b></p>
													<p class="print-text-size-big">UHU Group is one of the leading
														authorized Importers & Distributors in Pakistan of Perkins (UK)
														and Cummins Diesel Engines coupled with Stamford-UK / Leroy
														Somer-EU Alternators, ranging from 10kVA upto 2,000kVA, and FAW
														Diesel/Gasoline Generators which are one of China’s best brand
														in power generation ranging from 8.5kVA upto 50kVA. We are also
														the importer and distributor of other China-made Gasoline
														gensets ranging from 2.5 kVA up to 7.5 kVA, and Solar Power
														complete solutions ranging from 5 kW up to 1 MW.</p>
													<p>
													<ul class="print-text-size-big">
														<li>Well experience supervisory staff</li>
														<li>Quality control system to achieve the production as per
															required specification
														</li>
														<li>All kind of machinery</li>
														<li>Unit working round the clock to achieve the targets</li>
													</ul>
													</p>
													<p class="print-text-size-big">
														All our Generators are backed by a superb warranty of at least
														One Year or 1,000 hours, whichever may come first. Therefore,
														all products purchased through us are of top quality
														international standard
													</p>
													<p class="print-text-size-big">We look forward to a favourable
														response and assure you that our services will meet your
														standard and expectations. We are always there to server to the
														best of customer's convinence.</p>

												</div>
											</div>
											<?
											if ($quotes[0]['quotation_order_status'] == 3 || $quotes[0]['quotation_order_status'] == 4) {
												?>
												<div class="row">
													<div class="col-md-12"
														 style="padding-left: 70px; padding-right: 70px;">
														<p class="print-text-size-big">Thanks & Best Regards,</p>
													</div>
													<div class="col-md-12 align-self-center"
														 style="display: flex;align-items: center;flex-direction: column; align-items: flex-start;padding-left: 70px; padding-right: 70px;">
														<?
														if ($quotation_details[0]['compnay_name'] == 1) {
															?>

															<img src="<?= base_url() ?>assets/images/uhu.png"
																 style="height: 140px;">
															<img
																src="<?= base_url() ?>uploads/<?= $employee_data[0]['employee_code'] ?>/<?= $employee_data[0]['employee_sign_file'] ?>"
																style="height: 120px; position: absolute; top: 0; left: 9%;">

															<?
														}
														if ($quotation_details[0]['compnay_name'] == 2) {
															?>
															<div
																style="position: relative; width: 140px; min-height: 100%;">

																<img src="<?= base_url() ?>assets/images/ue.png"
																	 style="height: 140px;min-height: 100%;">
																<img
																	src="<?= base_url() ?>uploads/<?= $employee_data[0]['employee_code'] ?>/<?= $employee_data[0]['employee_sign_file'] ?>"
																	style="height: 140px; position: absolute; top: 0; left: 0;">
															</div>

															<?
														}
														if ($quotation_details[0]['compnay_name'] == 3) {
															?>

															<img src="<?= base_url() ?>assets/images/ub.png"
																 style="height: 140px;min-height: 100%;">
															<img
																src="<?= base_url() ?>uploads/<?= $employee_data[0]['employee_code'] ?>/<?= $employee_data[0]['employee_sign_file'] ?>"
																style="height: 140px; position: absolute; top: 0; left: 9%;">

															<?
														}
														?>
													</div><!--end col-->
													<div class="col-md-12 align-self-center"
														 style="display: flex;align-items: center;flex-direction: column; align-items: flex-start;padding-left: 70px; padding-right: 70px;">
														<h4 class="mb-0">
															<b><?= $employee_data[0]['employee_name'] ?></b></h4>
														<p class="print-text-size-big mt-0 mb-0">
															[<?= $employee_data[0]['employee_designation'] ?>]</p>
														<p class="print-text-size-big mt-0 mb-0">
															<?
															if ($quotation_details[0]['compnay_name'] == 1) {
																echo "UHU Powers";
															}
															if ($quotation_details[0]['compnay_name'] == 2) {
																echo "Usman Engineering Works";
															}
															if ($quotation_details[0]['compnay_name'] == 3) {
																echo "Umer Brothers";
															}
															?>
														</p>
													</div>

												</div>
												<?
											}
											?>


										</div><!--end row-->
										<div class="pagebreak"></div>

										<div class="row">
											<div class="col-md-4 align-self-center onlyPrint" style="margin-top:30px;">
												<?
												if ($quotation_details[0]['compnay_name'] == 1) {
													?>
													<img
														src="<?= base_url() ?>uploads/company/<?= $office_data->company_logo_name ?>"
														style="height: 60px;">
													<?
												}
												if ($quotation_details[0]['compnay_name'] == 2) {
													?>
													<img src="<?= base_url() ?>assets/images/uewlogo.png"
														 style="height: 80px;min-height: 100%;width: 50%;">
													<?
												}
												if ($quotation_details[0]['compnay_name'] == 3) {
													?>
													<img src="<?= base_url() ?>assets/images/ub_logo.png"
														 style="height: 80px;min-height: 100%;width: 70%;">
													<?
												}
												?>
											</div><!--end col-->
											<div class="col-sm-12 mt-3">
												<h3 class="text-center" style="background-color: <?
												if ($quotation_details[0]['compnay_name'] == 1) {
													echo '#b7042c';
												}
												if ($quotation_details[0]['compnay_name'] == 2) {
													echo '#2a2662';
												}
												if ($quotation_details[0]['compnay_name'] == 3) {
													echo '#5a3524';
												}
												?>; color: white;">COMMERCIAL OFFER</h3>
											</div>
											<div class="col-lg-12">
												<div class="table-responsive project-invoice">
													<table class="table table-bordered mb-0">
														<thead class="thead-light">
														<tr>
															<th>#</th>
															<th>Items</th>
															<th>QTY</th>
															<th>Rate</th>
															<th>Tax</th>
															<th>Total</th>
														</tr><!--end tr-->
														</thead>
														<tbody>
														<?
														$count = 1;
														$taxed_amount = 0;
														$tax_inclusive = 0;
														$sub_total = 0;
														foreach ($products as $product) {

															?>
															<tr>
																<td><?= $count ?></td>
																<td>
																	<?= $product['product_name'] ?>
																	<br>
																	<span
																		class="text-muted"><?= $product['product_description'] ?></span>
																</td>
																<td><?= $product['quotation_qty'] ?></td>
																<td><?= $product['quotation_cost'] ?></td>
																<td>
																	<?php
																	if ($product['quotation_tax'] != 0) {
																		echo $product['quotation_tax'];
																	} else {
																		echo '-';
																	}
																	?>
																</td>
																<td>
																	<?
																	$taxed_amount = ($product['quotation_cost']) * ($product['quotation_tax'] / 100);
																	$tax_inclusive = ($taxed_amount * $product['quotation_qty']) + ($product['quotation_cost'] * $product['quotation_qty']);
																	echo $tax_inclusive;

																	$sub_total += $tax_inclusive;
																	?>
																</td>
															</tr>
															<?
															$count++;
														}
														?>


														<tr class="">
															<th colspan="4" class="border-0"></th>
															<td class="border-0 font-14"><b>Sub Total</b></td>
															<td><?= $sub_total ?></td>
														</tr><!--end tr-->
														</tbody>
													</table><!--end table-->
												</div>  <!--end /div-->
											</div>  <!--end col-->
										</div><!--end row-->
										<div class="pagebreak"></div>
										<div class="row">
											<div class="col-md-4 align-self-center onlyPrint" style="margin-top:30px;">
												<?
												if ($quotation_details[0]['compnay_name'] == 1) {
													?>
													<img
														src="<?= base_url() ?>uploads/company/<?= $office_data->company_logo_name ?>"
														style="height: 60px;">
													<?
												}
												if ($quotation_details[0]['compnay_name'] == 2) {
													?>
													<img src="<?= base_url() ?>assets/images/uewlogo.png"
														 style="height: 80px;min-height: 100%;width: 50%;">
													<?
												}
												if ($quotation_details[0]['compnay_name'] == 3) {
													?>
													<img src="<?= base_url() ?>assets/images/ub_logo.png"
														 style="height: 80px;min-height: 100%;width: 70%;">
													<?
												}
												?>
											</div><!--end col-->
											<div class="col-sm-12 mt-3">
												<h3 class="text-center" style="background-color: <?
												if ($quotation_details[0]['compnay_name'] == 1) {
													echo '#b7042c';
												}
												if ($quotation_details[0]['compnay_name'] == 2) {
													echo '#2a2662';
												}
												if ($quotation_details[0]['compnay_name'] == 3) {
													echo '#5a3524';
												}
												?>; color: white;">TERMS AND CONDITIONS</h3>
											</div>
											<div class="col-sm-12">
												<h5><b>Warranty Period:</b></h5>
												<p class="print-text-size-big"><?= nl2br($quotation_details[0]['warranty']) ?></p>
												<h5><b>Payment Terms:</b></h5>
												<p class="print-text-size-big"><?= nl2br($quotation_details[0]['p_terms']) ?></p>
												<h5><b>Delivery:</b></h5>
												<p class="print-text-size-big"><?= nl2br($quotation_details[0]['delivery']) ?></p>
												<h5><b>Validity:</b></h5>
												<p class="print-text-size-big"><?= nl2br($quotation_details[0]['validity']) ?></p>
												<h5><b>NOTES:</b></h5>
												<p class="print-text-size-big"><?= nl2br($quotation_details[0]['notes']) ?></p>

											</div>
										</div>


										<hr>
										<div class="row d-flex justify-content-center">
											<div class="col-lg-12 col-xl-4 ml-auto align-self-center">
												<div class="text-center print-text-size-big">Pleasure doing business
													with you.
												</div>
											</div><!--end col-->
											<div class="col-lg-12 col-xl-4">
												<div class="float-right d-print-none">
													<button onclick="printContent('printme');" class="btn btn-info"><i
															class="fa fa-print"></i> Print
													</button>
													<?
													if ($quotes[0]['quotation_order_status'] != 4) {
														if ($quotes[0]['quotation_order_status'] == 1) {
															$link = '2/' . $quotes[0]['quotation_id'];
															$name = 'Save Quotes';
														}
														if ($quotes[0]['quotation_order_status'] == 2) {
															$link = '3/' . $quotes[0]['quotation_id'];
															$name = 'Approve Quotes';
														}
														if ($quotes[0]['quotation_order_status'] == 3) {
															$link = '4/' . $quotes[0]['quotation_id'];
															$name = 'Make Invoice';
														}
														?>
														<a class="btn btn-primary"
														   href="<?= base_url() ?>Quotation/change_status/<?= $link ?>"><?= $name ?></a>
														<?
													}
													?>

												</div>
											</div><!--end col-->
										</div><!--end row-->
									</div><!--end card-body-->
								</div><!--end card-->
							</div><!--end col-->
						</div><!--end row-->
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
if ($this->session->flashdata('status')) {
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
				title: 'Quotation Status has been changed'
			});
		});
	</script>
	<?
}
?>
<script>
	// Get the current page or section identifier (you can customize this part)
	var currentPage = "Sales"; // Example: If you're on 1, set it to "1"


</script>

<script>
	function printContent(el) {
		var restorepage = $('body').html();
		var printcontent = $('#' + el).clone();
		$('body').empty().html(printcontent);
		window.print();
		$('body').html(restorepage);
	}
</script>


</body>

</html>
