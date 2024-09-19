<!DOCTYPE html>
<html lang="en">

<? $this->view('inc/header.php'); ?>
<title>User - UHU</title>
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
								<h4 class="page-title">Users</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item active">Users</li>
								</ol>
							</div><!--end col-->
						</div><!--end row-->
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">User</h4>
										<p class="text-muted mb-0">View Users, Add or Delete. <code>(Deleting will
												delete all the work done by that Employee)</code></p>
									</div><!--end card-header-->
									<div class="card-body">
										<div class="nav-tabs-custom text-center">
											<ul class="nav nav-tabs" role="tablist">
												<li class="nav-item">
													<a class="nav-link text-center active" data-toggle="tab"
													   href="#office" role="tab"><i class="mdi mdi-power d-block"
																					style="color: #02b269 !important;"></i>Active
														Employee</a>
												</li>
												<li class="nav-item">
													<a class="nav-link text-center" data-toggle="tab" href="#factory"
													   role="tab"><i class="mdi mdi-power d-block"
																	 style="color: #f5325c !important;"></i>Inacive
														Employee</a>
												</li>
											</ul>
										</div>
										<div class="tab-content">
											<div class="tab-pane active p-3" id="office" role="tabpanel">
												<div class="table-responsive">
													<table class="table table-hover mb-0">
														<thead>
														<tr>
															<th>#</th>
															<th>Employee Code</th>
															<th>Employee Name</th>
															<th>Employee Phones</th>
															<th>Employee Email</th>
															<th>Employee Address</th>
															<th>Employee Designation</th>
															<th>Employee Salary</th>
															<th>Access Group</th>
															<th>Options</th>
														</tr>
														</thead>
														<tbody>
														<?
														$count = 1;
														foreach ($users as $user) {
															if ($user['account_active'] == 1) {
																?>
																<tr>
																	<td><?= $count ?></td>
																	<td><?= $user['employee_code'] ?></td>
																	<td><?= $user['employee_name'] ?></td>
																	<td><?= $user['employee_phone1'] ?>
																		- <?= $user['employee_phone2'] ?></td>
																	<td><?= $user['employee_email'] ?></td>
																	<td><?= $user['employee_address'] ?></td>
																	<td><?= $user['employee_designation'] ?></td>
																	<td><?= $user['employee_salary'] ?></td>
																	<td>
																		<?
																		foreach ($user_groups as $user_group) {
																			if ($user['user_group_id'] == $user_group['user_group_id']) {
																				echo $user_group['user_group_name'];
																			}
																		}
																		?>
																	</td>
																	<td>
																		<button type="button"
																				class="btn btn-primary dropdown-toggle"
																				data-toggle="dropdown"
																				aria-expanded="false"><i
																				class="mdi mdi-arrow-down-bold"></i>
																			Options <span class="caret"></span></button>
																		<div class="dropdown-menu">
																			<? if (in_array(5, $_SESSION['module_id'])) { ?>
																				<a class="dropdown-item"
																				   href="<?= base_url() ?>user/edit_user/<?= $user['employee_id'] ?>"><i
																						class="mdi mdi-grease-pencil"></i>
																					Edit User</a>
																			<?
																			} ?>
																			<? if (in_array(6, $_SESSION['module_id']) && $user['employee_id'] != 1) { ?>
																				<a class="dropdown-item"
																				   href="<?= base_url() ?>user/delete_user/<?= $user['employee_id'] ?>"><i
																						class="mdi mdi-delete"></i>
																					Delete User</a>
																			<?
																			} ?>
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
												</div><!--end /tableresponsive-->
											</div>
											<div class="tab-pane p-3" id="factory" role="tabpanel">
												<div class="table-responsive">
													<table class="table table-hover mb-0">
														<thead>
														<tr>
															<th>#</th>
															<th>Employee Code</th>
															<th>Employee Name</th>
															<th>Employee Phones</th>
															<th>Employee Email</th>
															<th>Employee Address</th>
															<th>Employee Designation</th>
															<th>Employee Salary</th>
															<th>Access Group</th>
															<th>Options</th>
														</tr>
														</thead>
														<tbody>
														<?
														$count = 1;
														foreach ($users as $user) {
															if ($user['account_active'] == 0) {
																?>
																<tr>
																	<td><?= $count ?></td>
																	<td><?= $user['employee_code'] ?></td>
																	<td><?= $user['employee_name'] ?></td>
																	<td><?= $user['employee_phone1'] ?>
																		- <?= $user['employee_phone2'] ?></td>
																	<td><?= $user['employee_email'] ?></td>
																	<td><?= $user['employee_address'] ?></td>
																	<td><?= $user['employee_designation'] ?></td>
																	<td><?= $user['employee_salary'] ?></td>
																	<td>
																		<?
																		foreach ($user_groups as $user_group) {
																			if ($user['user_group_id'] == $user_group['user_group_id']) {
																				echo $user_group['user_group_name'];
																			}
																		}
																		?>
																	</td>
																	<td>
																		<button type="button"
																				class="btn btn-primary dropdown-toggle"
																				data-toggle="dropdown"
																				aria-expanded="false"><i
																				class="mdi mdi-arrow-down-bold"></i>
																			Options <span class="caret"></span></button>
																		<div class="dropdown-menu">
																			<a class="dropdown-item"
																			   href="<?= base_url() ?>user/edit_user/<?= $user['employee_id'] ?>"><i
																					class="mdi mdi-grease-pencil"></i>
																				Edit User</a>
																			<a class="dropdown-item"
																			   href="<?= base_url() ?>user/delete_user/<?= $user['employee_id'] ?>"><i
																					class="mdi mdi-delete"></i> Delete
																				User</a>
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
												</div><!--end /tableresponsive-->
											</div>
										</div> <!--end tab-content-->
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
				title: 'User has been Deleted successfully'
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
