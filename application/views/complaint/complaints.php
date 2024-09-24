<?
// print_r($_SESSION['module_id']);die;
?>
<!DOCTYPE html>
<html lang="en">

<? $this->view('inc/header.php'); ?>
<title>Complaints - UHU</title>
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
								<h4 class="page-title">Complaint</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item active">Complaints</li>
								</ol>
							</div><!--end col-->
						</div><!--end row-->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<p class="text-muted mb-0">Select Time Frame</p>
										<form action="<?= base_url() ?>Complaint" method="POST">
											<div class="row">
												<div class="col-sm-10">
													<div class="input-group">
														<input type="text" class="form-control" name="dates"
															   value="<?= $date ?>">
														<div class="input-group-append">
															<span class="input-group-text"><i
																	class="dripicons-calendar"></i></span>
														</div>
													</div>
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-primary px-4 text-right">
														Select
													</button>
												</div>
											</div>
										</form>
									</div><!--end card-header-->
									<div class="card-body">
										<div class="nav-tabs-custom text-center">
											<ul class="nav nav-tabs" role="tablist">
												<li class="nav-item">
													<a class="nav-link text-center active" data-toggle="tab"
													   href="#unac" role="tab"><i class="mdi mdi-link-off d-block"
																				  style="color: #ffb822 !important;"></i>Unassigned
														Complaints</a>
												</li>
												<li class="nav-item">
													<a class="nav-link text-center" data-toggle="tab" href="#ac"
													   role="tab"><i class="mdi mdi-link d-block"
																	 style="color: #02b269 !important;"></i>Assigned
														Complaints</a>
												</li>
												<li class="nav-item">
													<a class="nav-link text-center" data-toggle="tab" href="#ip"
													   role="tab"><i class="mdi mdi-cogs d-block"
																	 style="color: #1761FD !important;"></i>In Progress</a>
												</li>
												<li class="nav-item">
													<a class="nav-link text-center" data-toggle="tab" href="#cc"
													   role="tab"><i class="mdi mdi-progress-check d-block"
																	 style="color: #02b269 !important;"></i>Completed
														Complaints</a>
												</li>
												<li class="nav-item">
													<a class="nav-link text-center" data-toggle="tab" href="#cac"
													   role="tab"><i class="mdi mdi-currency-usd-off d-block"
																	 style="color: #f5325c !important;"></i>Cancelled
														Complaint</a>
												</li>
											</ul>
										</div>
										<div class="tab-content">
											<div class="tab-pane active p-3" id="unac" role="tabpanel">
												<div class="table-responsive">
													<center><h4 style="background: #ffb822; color: white">Unassigned
															Complaints</h4></center>
													<p class="text-muted">Create service to assign it to complaint</p>
													<table class="table table-hover mb-0">
														<thead>
														<tr>
															<th>#</th>
															<th>Date Added</th>
															<th>Customer</th>
															<th>Description</th>
															<th>Options</th>
														</tr>
														</thead>
														<tbody>
														<?
														$count = 1;
														foreach ($complaints as $complaint) {
															if ($complaint['status'] == 0) {
																?>
																<tr>
																	<td><?= $count ?></td>
																	<td><?= $complaint['date'] ?></td>
																	<td>(Cus - <?= $complaint['sup_cus_id'] . ') - ' . $complaint['sup_cus_company'] ?></td>
																	<td><?= $complaint['complaint_description'] ?></td>
																	<td>
																		<button type="button" class="btn btn-primary dropdown-toggle"
																				data-toggle="dropdown" aria-expanded="false"><i
																				class="mdi mdi-arrow-down-bold"></i> Options <span
																				class="caret"></span></button>
																		<div class="dropdown-menu">
<!--																			<a class="dropdown-item"-->
<!--																			   href="--><?php //= base_url() ?><!--Service_quote/add_service_quote/--><?php //= $complaint['complaint_id'] ?><!--"><i-->
<!--																					class="mdi mdi-delete"></i>-->
<!--																				Delete Quotes-->
<!--																			</a>-->
																			<a class="dropdown-item"
																			   href="<?= base_url() ?>Complaint/change_status/<?= $complaint['complaint_id'] ?>"><i
																					class="mdi mdi-delete"></i>
																				Cancel Complaint
																			</a>
																		</div>
																	</td>
																</tr>
																<?
																$count++;
															}
														}
														?>
														</tbody>
													</table><!--end /table-->
												</div>
											</div>
											<div class="tab-pane p-3" id="ac" role="tabpanel">
												<div class="table-responsive">
													<center><h4 style="background: #02b269; color: white">Assigned
															Complaints</h4></center>
													<table class="table table-hover mb-0">
														<thead>
														<tr>
															<th>#</th>
															<th>Date Added</th>
															<th>Customer</th>
															<th>Complaint Ref</th>
															<th>Description</th>
															<th>Options</th>
														</tr>
														</thead>
														<tbody>
														<?
														$count = 1;
														foreach ($complaints as $complaint) {
															if ($complaint['status'] == 1) {
																?>
																<tr>
																	<td><?= $count ?></td>
																	<td><?= $complaint['date'] ?></td>
																	<td>(Cus
																		- <?= $complaint['sup_cus_id'] . ') - ' . $complaint['sup_cus_company'] ?></td>
																	<td>SR - <?= $complaint['complaint_ref'] ?></td>
																	<td><?= $complaint['complaint_description'] ?></td>
																	<td>
																		<a href="<?= base_url() ?>Complaint/change_status/<?= $complaint['complaint_id'] ?>/2"
																		   class="btn btn-primary">Change Status to In
																			Progress</a>
																	</td>
																</tr>
																<?
																$count++;
															}
														}
														?>
														</tbody>
													</table><!--end /table-->
												</div>
											</div>
											<div class="tab-pane p-3" id="ip" role="tabpanel">
												<div class="table-responsive">
													<center><h4 style="background: #1761FD; color: white">In
															Progress</h4></center>
													<table class="table table-hover mb-0">
														<thead>
														<tr>
															<th>#</th>
															<th>Date Added</th>
															<th>Customer</th>
															<th>Complaint Ref</th>
															<th>Description</th>
															<th>Options</th>
														</tr>
														</thead>
														<tbody>
														<?
														$count = 1;
														foreach ($complaints as $complaint) {
															if ($complaint['status'] == 2) {
																?>
																<tr>
																	<td><?= $count ?></td>
																	<td><?= $complaint['date'] ?></td>
																	<td>(Cus
																		- <?= $complaint['sup_cus_id'] . ') - ' . $complaint['sup_cus_company'] ?></td>
																	<td>SR - <?= $complaint['complaint_ref'] ?></td>
																	<td><?= $complaint['complaint_description'] ?></td>
																	<td>
																		<a href="<?= base_url() ?>Complaint/change_status/<?= $complaint['complaint_id'] ?>/3"
																		   class="btn btn-primary">Change Status to
																			Complete</a>
																	</td>
																</tr>
																<?
																$count++;
															}
														}
														?>
														</tbody>
													</table><!--end /table-->
												</div>
											</div>
											<div class="tab-pane p-3" id="cc" role="tabpanel">
												<div class="table-responsive">
													<center><h4 style="background: #02b269; color: white">Completed
															Complaints</h4></center>
													<table class="table table-hover mb-0">
														<thead>
														<tr>
															<th>#</th>
															<th>Date Added</th>
															<th>Customer</th>
															<th>Complaint Ref</th>
															<th>Description</th>
														</tr>
														</thead>
														<tbody>
														<?
														$count = 1;
														foreach ($complaints as $complaint) {
															if ($complaint['status'] == 3) {
																?>
																<tr>
																	<td><?= $count ?></td>
																	<td><?= $complaint['date'] ?></td>
																	<td>(Cus
																		- <?= $complaint['sup_cus_id'] . ') - ' . $complaint['sup_cus_company'] ?></td>
																	<td>SR - <?= $complaint['complaint_ref'] ?></td>
																	<td><?= $complaint['complaint_description'] ?></td>
																</tr>
																<?
																$count++;
															}
														}
														?>
														</tbody>
													</table><!--end /table-->
												</div>
											</div>
											<div class="tab-pane p-3" id="cac" role="tabpanel">
												<div class="table-responsive">
													<center><h4 style="background: #f5325c; color: white">Cancelled
															Complaint</h4></center>
													<table class="table table-hover mb-0">
														<thead>
														<tr>
															<th>#</th>
															<th>Date Added</th>
															<th>Customer</th>
															<th>Description</th>
															<th>Options</th>
														</tr>
														</thead>
														<tbody>
														<?
														$count = 1;
														foreach ($complaints as $complaint) {
															if ($complaint['status'] == 4) {
																?>
																<tr>
																	<td><?= $count ?></td>
																	<td><?= $complaint['date'] ?></td>
																	<td>(Cus
																		- <?= $complaint['sup_cus_id'] . ') - ' . $complaint['sup_cus_company'] ?></td>

																	<td><?= $complaint['complaint_description'] ?></td>
																	<td>
																		<a href="<?= base_url() ?>Complaint/delete_complaint/<?= $complaint['complaint_id'] ?>"
																		   class="btn btn-primary">Delete Complaint</a>
																	</td>
																</tr>
																<?
																$count++;
															}
														}
														?>
														</tbody>
													</table><!--end /table-->
												</div>
											</div>
										</div>
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
				title: 'A Complaint has been Deleted'
			});
		});
	</script>
	<?
}
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
				title: 'Complaint Status changed'
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
