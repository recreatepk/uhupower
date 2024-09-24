<?
// print_r($suppliers);die;
?>
<!DOCTYPE html>
<html lang="en">

<? $this->view('inc/header.php'); ?>
<title>Client Ledger - UHU</title>
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
								<h4 class="page-title">Client Ledgers</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item active">All Ledgers</li>
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
							<h4 class="card-title">Ledgers </h4>
							<form action="<?= base_url() ?>Reports/cus_sup_ledger" method="POST">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label>Select <?= $retVal = ($check == 2) ? 'Supplier' : 'Customer'; ?>
												*</label>
											<select class="form-control custom-select" style="width: 100%; height:36px;"
													name="supplier_id">

												<?
												if ($check == 1) {
													?>
													<optgroup label="Select Customer">
														<?
														foreach ($suppliers as $supplier) {
															if ($supplier['cat'] == 2) {
																?>
																<option
																	value="<?= $supplier['sup_cus_id'] ?>" <?= $retVal = ($supplier['sup_cus_id'] == $sup[0]['sup_cus_id']) ? 'selected' : ''; ?>><?= $supplier['sup_cus_company'] ?>
																	- <?= $supplier['sup_cus_name'] ?></option>
																<?
															}
														}
														?>
													</optgroup>
													<?
												}
												if ($check == 2) {
													?>
													<optgroup label="Select Supplier">
														<?
														foreach ($suppliers as $supplier) {
															if ($supplier['cat'] == 1) {

																?>
																<option
																	value="<?= $supplier['sup_cus_id'] ?>" <?= $retVal = ($supplier['sup_cus_id'] == $sup[0]['sup_cus_id']) ? 'selected' : ''; ?>><?= $supplier['sup_cus_company'] ?>
																	- <?= $supplier['sup_cus_name'] ?></option>
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
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Select Dates *</label>
											<input type="text" class="form-control" name="dates" value="<?= $date ?>">
											<input type="hidden" class="form-control" name="check"
												   value="<?= $check ?>">
										</div>
									</div>

									<div class="col-sm-2">
										<div class="form-group">
											<label style="visibility: hidden;">Select Customer *</label><br>
											<button type="submit" class="btn btn-primary px-4 text-right">Select
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="card-body" id="printme">
							<div class="col-sm-12">
								<h4 style="text-align:center;"><?= $sup[0]['sup_cus_company'] ?></h4>
								<h4 style="text-align:center;"><?= $date ?></h4>
								<h4 style="text-align:center;">Account
									of <?= $sup[0]['sup_cus_name'] . ' ' . $sup[0]['sup_cus_phone1'] ?></h4>
							</div>

							<div class="table-responsive">
								<table class="table table-hover table-bordered mb-0">
									<thead>
									<tr>
										<th>Date</th>
										<th>Transaction Type</th>
										<th>Particulars</th>
										<th>Unit(s)</th>
										<th>Folio/Rate (PKR)</th>
										<th>Debit (PKR)</th>
										<th>Credit (PKR)</th>
										<th>Balance (PKR)</th>
										<th class="no-print">Remarks</th>
									</tr>
									</thead>
									<tbody>
									<?php
									$balance = 0;
									$total_invoice_cost = 0;
									$total_po_cost = 0;
									$total_service_cost = 0;
									$total_debt_note = 0;
									$total_credit_note = 0;
									$balanceValue = 0;
									$total_payment_amount = 0;
									$total_credit = 0;
									$total_debit = 0;
									$sub_total = 0;
									$balanceSubTotal = 0;
									$tax_sub_total = 0;
									$invoice_cost_sub_total = 0;
									foreach ($combinedArray as $item) {

										$taxed_amount = ($item['invoice_cost']) * ($item['invoice_tax'] / 100);
										$tax_inclusive = ($taxed_amount * $item['invoice_qty']) + ($item['invoice_cost'] * $item['invoice_qty']);

										$tax_sub_total += $item['invoice_tax'];
										$sub_total += $tax_inclusive;

										?>
										<tr>
											<td>
												<?
												if (isset($item['purchase_order_id'])) {
													echo $item['purchase_order_date'];
												}
												if (isset($item['invoice_id'])) {
													echo $item['invoice_date'];
												}
												if (isset($item['render_service_id'])) {
													echo $item['date'];
												}
												if (isset($item['deb_cred_note_id'])) {
													echo $item['date'];
												}
												if (isset($item['payment_id'])) {
													echo $item['payment_date'];
												}
												?>
											</td>
											<td>
												<?
												if (isset($item['purchase_order_id'])) {
													echo 'Purchase';
												}
												if (isset($item['invoice_id'])) {
													echo 'Sale';
												}
												if (isset($item['render_service_id'])) {
													echo 'Sale - Services';
												}
												if (isset($item['deb_cred_note_id'])) {
													echo 'Adjustment';
												}
												if (isset($item['payment_id'])) {
													echo 'Payment';
												}
												?>
											</td>
											<td>

												<?
												if (isset($item['purchase_order_id'])) {
													echo "<div style='float:left;width:50%;'>";
													echo $item['product_name'];
													echo "<br><span class='text-muted'>";
													echo $item['product_description'];
													echo "</span>";
													echo "</div>";
												}
												if (isset($item['invoice_id'])) {
													echo "<div style='float:left;width:50%;'>";
													echo $item['product_name'];
													echo "<br><span class='text-muted'>";
													echo $item['product_description'];
													echo "</span>";
													echo "</div>";
												}
												if (isset($item['render_service_id'])) {
													echo "<div style='float:left;width:50%;'>";
													echo $item['service_name'];
													echo "<br><span class='text-muted'>";
													echo $item['service_description'];
													echo "</span>";
													echo "</div>";
												}
												if (isset($item['deb_cred_note_id'])) {
													echo $item['particular'];
												}
												if (isset($item['payment_id'])) {
													echo $item['particular'];
												}
												?>
											</td>
											<td>
												<?
												if (isset($item['purchase_order_id'])) {
													echo $item['purchase_order_product_qty'];
												}
												if (isset($item['invoice_id'])) {
													echo $item['invoice_qty'];
												}
												?>
											</td>
											<td>
												<?
												if (isset($item['purchase_order_id'])) {
													echo $item['purchase_order_product_cost'] + $taxed_amount;
												}
												if (isset($item['invoice_id'])) {
													echo $item['invoice_cost'] + $taxed_amount;

//													$invoice_cost_sub_total += ($item['invoice_cost'] + $taxed_amount);
//													echo number_format($invoice_cost_sub_total, 2, '.', ',');
												}
												if (isset($item['render_service_id'])) {
													echo $item['service_cost'] + $taxed_amount;
												}
												?>
											</td>
											<td>
												<?
												if ($check == 1) {
													if (isset($item['invoice_id'])) {
														$invoice_cost = $item['invoice_cost'] * $item['invoice_qty'];
														echo $invoice_cost;
														$total_debit += $invoice_cost;
														$balance += $invoice_cost;
													}
													if (isset($item['render_service_id'])) {
														echo $item['service_cost'];
														$total_debit += $item['service_cost'];
														$balance += $item['service_cost'];
													}
												}
												if ($check == 2) {
													if (isset($item['purchase_order_id'])) {
														$po_cost = $item['purchase_order_product_cost'] * $item['purchase_order_product_qty'];
														echo $po_cost;
														$total_debit += $po_cost;
														$balance += $po_cost;
													}
												}

												if (isset($item['deb_cred_note_id'])) {
													if ($item['deb_cred_type'] == 2) {
														echo $item['amount'];
														$total_debit += $item['amount'];
														$balance += $item['amount'];
													}

												}
												?>
											</td>
											<td>
												<?
												if ($check == 1) {
													if (isset($item['purchase_order_id'])) {
														$po_cost = $item['purchase_order_product_cost'] * $item['purchase_order_product_qty'];
														echo $po_cost;
														$total_credit += $po_cost;
														$balance -= $po_cost;
													}
													if (isset($item['payment_id'])) {
														echo $item['payment_amount'];
														$total_credit += $item['payment_amount'];
														$balance -= $item['payment_amount'];
													}
												}
												if ($check == 2) {
													if (isset($item['invoice_id'])) {
														$invoice_cost = $item['invoice_cost'] * $item['invoice_qty'];
														echo $invoice_cost;
														$total_credit += $invoice_cost;
														$balance -= $invoice_cost;
													}
													if (isset($item['render_service_id'])) {
														echo $item['service_cost'];
														$total_credit += $item['service_cost'];
														$balance -= $item['service_cost'];
													}
													if (isset($item['payment_id'])) {
														echo $item['payment_amount'];
														$total_credit += $item['payment_amount'];
														$balance -= $item['payment_amount'];
													}
												}


												if (isset($item['deb_cred_note_id'])) {
													if ($item['deb_cred_type'] == 1) {
														echo $item['amount'];
														$total_credit += $item['amount'];
														$balance -= $item['amount'];
													}
												}
												?>
											</td>
											<td>
												<?
												$balanceValue = $balance;
												$balanceTotal = ((($item['invoice_cost'] + $taxed_amount) * $item['invoice_qty']) + $balance);
												if ($balance < 0) {
													$balanceValue = "<code>";
													$balanceValue .= "(" . abs($balance) . ")";
													$balanceValue .= "</code>";
													echo $balanceValue .' '. 'here 3';
												} else {
													echo $balanceTotal;
												}
												$balanceSubTotal += $balanceTotal;
												?>
											</td>
											<td class="no-print">

												<?
												if (isset($item['purchase_order_id'])) {

													echo "<div>";
													echo 'PO - ' . $item['purchase_order_id'];
													echo "<br><span class='text-muted'>";
													echo "<a href='" . base_url() . "Purchase_order/print_purchase_order/" . $item['purchase_order_id'] . "' target='_blank'>View this Purchase Order</>";
													echo "</span>";
													echo "</div>";
												}
												if (isset($item['invoice_id'])) {
													echo "<div>";
													echo 'INV - ' . $item['invoice_id'];
													echo "<br><span class='text-muted'>";
													echo "<a href='" . base_url() . "Purchase_order/print_purchase_order/" . $item['invoice_id'] . "' target='_blank'>View this Invoice</>";
													echo "</span>";
													echo "</div>";
												}
												if (isset($item['render_service_id'])) {
													echo "<div>";
													echo 'Payment for: SR - ' . $item['render_service_id'];
													echo "<br><span class='text-muted'>";
													echo "<a href='" . base_url() . "Purchase_order/print_purchase_order/" . $item['render_service_id'] . "' target='_blank'>View this Service</>";
													echo "</span>";
													echo "</div>";
												}
												if (isset($item['payment_id'])) {
													if ($item['type'] == 1) {
														echo "<div>";
														echo 'Payment for: SR - ' . $item['payment_ref'];
														echo "<br><span class='text-muted'>";
														echo "<a href='" . base_url() . "Purchase_order/print_purchase_order/" . $item['payment_ref'] . "' target='_blank'>View this Service</>";
														echo "</span>";
														echo "</div>";
													}
													if ($item['type'] == 2) {
														echo "<div>";
														echo 'SR - ' . $item['payment_ref'];
														echo "<br><span class='text-muted'>";
														echo "<a href='" . base_url() . "Purchase_order/print_purchase_order/" . $item['payment_ref'] . "' target='_blank'>View this Service</>";
														echo "</span>";
														echo "</div>";
													}
													if ($item['type'] == 3) {
														echo "<div>";
														echo 'Payment for: SR - ' . $item['payment_ref'];
														echo "<br><span class='text-muted'>";
														echo "<a href='" . base_url() . "Purchase_order/print_purchase_order/" . $item['payment_ref'] . "' target='_blank'>View this Service</>";
														echo "</span>";
														echo "</div>";
													}
												}

												?>
											</td>
										</tr>
										<?php
									}
									?>
									</tbody>
									<tfoot>
									<tr>
										<td colspan="5"
											style="text-align: center; vertical-align: middle;font-size: 25px;border-top: 1px solid">
											<b>TOTAL</b></td>
										<td style="border-bottom: 3px double; border-top: 1px solid">
											<b><?= $total_debit ?> (PKR)</b></td>
										<td style="border-bottom: 3px double; border-top: 1px solid">
											<b><?= $total_credit ?> (PKR)</td>
										<td style="border-bottom: 3px double; border-top: 1px solid">
											<b><?= $balanceSubTotal ?> (PKR)</b></td>
									</tr>
									</tfoot>
								</table><!--end /table-->
								<div class="float-right">
									<button onclick="printContent('printme');" class="btn btn-info no-print"><i
											class="fa fa-print"></i> Print
									</button>
								</div>
							</div>
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
<script>
	// Get the current page or section identifier (you can customize this part)
	var currentPage = "Accounts"; // Example: If you're on 1, set it to "1"


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
