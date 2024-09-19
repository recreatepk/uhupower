<!DOCTYPE html>
<html lang="en">

<? $this->view('inc/header.php'); ?>
<title>Servicing - UHU</title>
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
								<h4 class="page-title">Service Quotations</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item active">Servicing</li>
								</ol>
							</div><!--end col-->
						</div><!--end row-->
					</div><!--end page-title-box-->
				</div><!--end col-->
			</div><!--end row-->
			<!-- end page title end breadcrumb -->
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">All Services Quotation</h4>
							<p class="text-muted mb-0">Select Time Frame</p>
							<form action="<?= base_url() ?>Service_quote" method="POST">
								<div class="row">
									<div class="col-sm-10">
										<div class="input-group">
											<input type="text" class="form-control" name="dates" value="<?= $date ?>">
											<div class="input-group-append">
												<span class="input-group-text"><i class="dripicons-calendar"></i></span>
											</div>
										</div>
									</div>
									<div class="col-sm-2">
										<button type="submit" class="btn btn-primary px-4 text-right">Select</button>
									</div>
								</div>
							</form>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover mb-0">
									<thead>
									<tr>
										<th>#</th>
										<th>Customer</th>
										<th>Service Information</th>
										<th>Status</th>
										<th>Options</th>
									</tr>
									</thead>
									<tbody>
									<?
									$count = 1;
									foreach ($quotes as $quote) {
										?>
										<tr>
											<td><?= $count ?></td>
											<td>
												<?
												foreach ($suppliers as $customer) {
													if ($customer['sup_cus_id'] == $quote['sup_cus_id']) {
														echo $customer['sup_cus_company'] . ' (' . $customer['sup_cus_company'] . ')';
													}
												}
												?>
											</td>

											<td>
												<div class="accordion" id="accordionExample">
													<div class="card border mb-1 shadow-none">
														<div class="card-header custom-accordion rounded-0"
															 id="heading<?= $quote['service_quote_id'] ?>"
															 style="background-color: #b7042c !important;">
															<a href="" class="text-dark" data-toggle="collapse"
															   data-target="#collapse<?= $quote['service_quote_id'] ?>"
															   aria-expanded="true"
															   aria-controls="collapse<?= $quote['service_quote_id'] ?>">
																SR - 0<?= $quote['service_quote_id'] ?>
																<span style="float:right;">Show more <i
																		class="mdi mdi-arrow-down"></i></span>
															</a>
														</div>
														<div id="collapse<?= $quote['service_quote_id'] ?>"
															 class="collapse"
															 aria-labelledby="heading<?= $quote['service_quote_id'] ?>"
															 data-parent="#accordionExample">
															<div class="card-body">
																<p class="mb-0">
																<div class="col-sm-12" style="text-align: center;"><h4>
																		Services</h4></div>
																<table class="table table-hover mb-0">
																	<thead>
																	<tr>
																		<th>#</th>
																		<th>Service Name</th>
																		<th>Cost</th>
																		<th>Tax</th>
																		<th>Total</th>
																	</tr>
																	</thead>
																	<tbody>
																	<?
																	$num = 1;
																	$totalCostAfterTax = 0;
																	foreach ($quotes_service as $rendered_service) {
																		if ($rendered_service['service_quote_id'] == $quote['service_quote_id']) {

																			?>
																			<tr>
																				<td><?= $num ?></td>
																				<td title="<?= $rendered_service['service_description'] ?>"><?= $rendered_service['service_name'] ?></td>
																				<td><?= $rendered_service['cost'] ?></td>
																				<td><?= $rendered_service['tax'] ?></td>
																				<td>
																					<?

																					if ($rendered_service['tax'] == 0) {
																						$taxPercentage = 1;
																					} else {
																						$taxPercentage = $rendered_service['tax'];
																					}
																					$costBeforeTax = $rendered_service['cost'];
																					$taxAmount = ($costBeforeTax * $taxPercentage) / 100;
																					$costAfterTax = $costBeforeTax + $taxAmount;
																					$totalCostAfterTax += $costAfterTax;
																					echo $costAfterTax;
																					?>
																				</td>
																			</tr>
																			<?
																			$num++;
																		}
																	}
																	?>

																	</tbody>
																	<tfoot>
																	<tr>
																		<td style="border-bottom: 1px solid black;border-top: 1px solid black;"
																			colspan="4" class="text-center"><b>Total</b>
																		</td>
																		<td style="border-bottom: 3px double black; border-top: 1px solid black;">
																			<b><?= $totalCostAfterTax ?></b></td>
																	</tr>
																	</tfoot>
																</table>
																<div class="col-sm-12" style="text-align: center;"><h4>
																		Products</h4></div>

																<table class="table table-hover mb-0">
																	<thead>
																	<tr>
																		<th>#</th>
																		<th>Product Name</th>
																		<th>Quantity</th>
																		<th>Cost</th>
																		<th>Tax</th>
																		<th>Total</th>
																	</tr>
																	</thead>
																	<tbody>
																	<?
																	$num = 1;
																	$tpcostAfterTax = 0;
																	foreach ($quotes_product as $rendered_services_product) {
																		if ($rendered_services_product['service_quote_id'] == $quote['service_quote_id']) {

																			?>
																			<tr>
																				<td><?= $num ?></td>
																				<td title="<?= $rendered_services_product['product_description'] ?>"><?= $rendered_services_product['product_name'] ?></td>
																				<td><?= $rendered_services_product['qty'] ?></td>
																				<td><?= $rendered_services_product['cost'] ?></td>
																				<td><?= $rendered_services_product['tax'] ?></td>
																				<td>
																					<?

																					if ($rendered_services_product['tax'] == 0) {
																						$ptaxPercentage = 1;
																					} else {
																						$ptaxPercentage = $rendered_services_product['tax'];
																					}
																					$pcostBeforeTax = $rendered_services_product['cost'] * $rendered_services_product['qty'];
																					$ptaxAmount = ($pcostBeforeTax * $ptaxPercentage) / 100;
																					$pcostAfterTax = $pcostBeforeTax + $ptaxAmount;
																					echo $pcostAfterTax;
																					$tpcostAfterTax += $pcostAfterTax;

																					?>
																				</td>
																			</tr>
																			<?
																			$num++;
																		}
																	}
																	?>

																	</tbody>
																	<tfoot>
																	<tr>
																		<td style="border-bottom: 1px solid black;border-top: 1px solid black;"
																			colspan="5" class="text-center"><b>Total</b>
																		</td>
																		<td style="border-bottom: 3px double black; border-top: 1px solid black;">
																			<b><?= $tpcostAfterTax ?></b></td>
																	</tr>
																	<tr>
																		<td style="border-bottom: 1px solid black;border-top: 1px solid black;"
																			colspan="5" class="text-center"><b>Grand
																				Total</b></td>
																		<td style="border-bottom: 3px double black; border-top: 1px solid black;">
																			<b><?= $totalCostAfterTax + $tpcostAfterTax ?></b>
																		</td>
																	</tr>
																	</tfoot>
																</table>

																</p>
															</div>
														</div>
													</div>
												</div>
											</td>

											<td>
												<?
												if ($quote['status'] == 1) {
													echo "<span class='badge badge-pill badge-light'>Draft</span>";
												}
												if ($quote['status'] == 2) {
													echo "<span class='badge badge-pill badge-info'>locked</span>";
												}
												if ($quote['status'] == 3) {
													echo "<span class='badge badge-pill badge-warning'>Approve</span>";
												}
												if ($quote['status'] == 4) {
													echo "<span class='badge badge-pill badge-success'>service created</span>";
												}
												?>
											</td>
											<td>
												<button type="button" class="btn btn-primary dropdown-toggle"
														data-toggle="dropdown" aria-expanded="false"><i
														class="mdi mdi-arrow-down-bold"></i> Options <span
														class="caret"></span></button>
												<div class="dropdown-menu">
													<? if ($quote['status'] == 1) { ?>
														<a class="dropdown-item"
														   href="<?= base_url() ?>Service_quote/change_status/<?= $quote['service_quote_id'] ?>/<?= $quote['status'] ?>"><i
																class="mdi mdi-redo"></i> Lock Qoutes and Print</a>
													<?
													} else {
														if (in_array(98, $_SESSION['module_id']) && $quote['status'] == 2 || $quote['status'] == 3) {
															?>
															<a class="dropdown-item"
															   href="<?= base_url() ?>Service_quote/change_status/<?= $quote['service_quote_id'] ?>/<?= $quote['status'] ?>"><i
																	class="mdi mdi-check"></i> Finilize Qoutes and Print</a>
															<?
														}
													} ?>
													<? if (in_array(96, $_SESSION['module_id']) && $quote['status'] == 1) { ?>
														<a class="dropdown-item"
														   href="<?= base_url() ?>Service_quote/edit_quote/<?= $quote['service_quote_id'] ?>"><i
																class="mdi mdi-grease-pencil"></i> Edit Qoutes</a>
													<?
													} elseif (in_array(98, $_SESSION['module_id']) && $quote['status'] == 2) {
														?>
														<a class="dropdown-item"
														   href="<?= base_url() ?>Service_quote/edit_quote/<?= $quote['service_quote_id'] ?>"><i
																class="mdi mdi-grease-pencil"></i> Edit Qoutes</a>
														<?
													}
													?>
													<? if (in_array(97, $_SESSION['module_id']) && $quote['status'] == 1) { ?>
														<a class="dropdown-item"
														   href="<?= base_url() ?>Service_quote/delete_quote/<?= $quote['service_quote_id'] ?>"><i
																class="mdi mdi-delete"></i> Delete Qoutes</a>
													<?
													} elseif (in_array(98, $_SESSION['module_id']) && $quote['status'] == 2) {
														?>
														<a class="dropdown-item"
														   href="<?= base_url() ?>Service_quote/delete_quote/<?= $quote['service_quote_id'] ?>"><i
																class="mdi mdi-delete"></i> Delete Qoutes</a>
														<?
													}
													?>
												</div>
											</td>
										</tr>
										<?
										$count++;
									}
									?>
									</tbody>
								</table><!--end /table-->
							</div><!--end /tableresponsive-->
						</div>
					</div>
				</div>
			</div>


		</div><!-- container -->

		<? $this->view('inc/footer_text.php'); ?>
	</div>
	<!-- end page content -->
</div>
<!-- end page-wrapper -->


<? $this->view('inc/footer.php'); ?>
<?
if ($this->session->flashdata('del')) {
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
				title: 'A Service has been Deleted'
			});
		});
	</script>
	<?
}
?>
<?
if ($this->session->flashdata('assign')) {
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
				title: 'Worker Assigned to Service'
			});
		});
	</script>
	<?
}
?>
<?
if ($this->session->flashdata('dc')) {
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
				title: 'Service is now in progress, check with warehouse manager for Parts'
			});
		});
	</script>
	<?
}
?>
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
				title: 'Status Changed'
			});
		});
	</script>
	<?
}
?>
<?
if ($this->session->flashdata('completed')) {
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
				title: 'Services has been rendered and completed'
			});
		});
	</script>
	<?
}
?>
<?
if ($this->session->flashdata('invoice')) {
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
				title: 'Product Invoice is not Finialized, please check with accounts'
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
