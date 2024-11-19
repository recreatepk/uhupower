<!DOCTYPE html>
<html lang="en">

<?php $this->view('inc/header.php'); ?>
<title>Salary - UHU</title>

<body class="dark-sidenav">
<!-- Left Sidenav -->
<?php $this->view('inc/sidebar.php'); ?>
<!-- end left-sidenav-->


<div class="page-wrapper">
<!-- Top Bar Start -->
<?php $this->view('inc/nav_bar.php'); ?>
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
<h4 class="page-title">Salary</h4>
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?= base_url() ?>Salary">Salary</a></li>
	<li class="breadcrumb-item active">Make Salary</li>
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
<div class="col-sm-12">
<form action="<?= base_url() ?>Salary/get_salary_all" method="POST">
	<div class="row">
		<div class="col-sm-8">
			<label class="mb-3"><b>Make Salaries</b></label>
			<input type="month" name="date" class="form-control mb-3" value="<?= $date ?>">
		</div>
		<div class="col-sm-4">
			<label class="mb-3" style="visibility: hidden;"><b>Check Attendance</b></label><br>
			<button type="submit" style="width: 100%;" class="btn btn-primary px-4">Check Salaries</button>
		</div>
	</div>
</form>
</div>
</div>
<div class="card-body">
<div class="table-responsive">
<form action="<?= base_url() ?>Salary/make_salary" method="POST">
	<table class="table table-hover mb-0">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Attandence</th>
				<th>Yearly Leaves</th>
				<th>Calculations</th>
				<th>Deductions</th>
				<th>Additions</th>
				<th>Fuel Allowance</th>
				<th>Total Salary</th>

			</tr>
		</thead>
		<tbody>
			<?php
			$count = 1;
			foreach ($users as $user) {
			?>
				<tr>
					<td><?= $count ?></td>
					<td>
						<code>
							(<?= $user['employee_code'] ?>)
						</code>
						<br>
						<b>
							<?= $user['employee_name'] ?>
						</b>
						<br>
						<span style="color: #1761fd;"><?= $user['employee_designation'] ?></span>
					</td>
					<td>
						<?php
						$presents = 0;
						$absents = 0;
						$lates = 0;
						$leaves = 0;

						foreach ($monthly_atts as $monthly_att) {
							if ($monthly_att['attendance_present'] == 1) {
								if ($monthly_att['employee_id'] == $user['employee_id']) {
									$presents++;
								}
							}
							if ($monthly_att['attendance_present'] == 2) {
								if ($monthly_att['employee_id'] == $user['employee_id']) {
									$absents++;
								}
							}
							if ($monthly_att['attendance_present'] == 3) {
								if ($monthly_att['employee_id'] == $user['employee_id']) {
									$lates++;
								}
							}
							if ($monthly_att['attendance_present'] == 4) {
								if ($monthly_att['employee_id'] == $user['employee_id']) {
									$leaves++;
								}
							}
						}
						echo "<span class='badge badge-pill badge-success'>";
						echo 'Presents = ' . $presents;
						echo "</span>";
						echo "<br>";
						echo "<span class='badge badge-pill badge-warning'>";
						echo 'Lates = ' . $lates;
						echo "</span>";
						echo "<br>";
						echo "<span class='badge badge-pill badge-danger'>";
						echo 'Absents = ' . $absents;
						echo "</span>";
						echo "<br>";
						echo "<span class='badge badge-pill badge-info'>";
						echo 'Leaves = ' . $leaves;
						echo "</span>";
						?>
					</td>
					<td>
						 <?php
//                                                             $yearly_leaves = 0;
//                                                             foreach ($yearly_leave as $leave) {
//                                                                 if ($leave['employee_id'] == $user['employee_id']) {
//                                                                     $yearly_leaves++;
//                                                                 }
//                                                             }
//                                                             echo $yearly_leaves;
//
					echo "Total : " . $user['allowed_leaves'];
							echo "<br>";

					echo "Availed : " . $leaves;
							echo "<br>";

					echo "Remain : " .  ($user['allowed_leaves'] - $leaves);
							echo "<br>";

						?>
					</td>
					<td>
						<?php
						echo "Current Salary = PKR. " . $user['employee_salary'];
						echo "<br>";
						$day_salary = $user['employee_salary'] / 30;
						$day_salary = round($day_salary);
						echo '1 day Salary = PKR. ' . round($day_salary);
						echo "<br>";
						$all_attendances = $presents + $lates + $leaves + $total_sun;
						if ($presents == 0) {
							$salary = 0;
						} else {
							$salary = $day_salary * $all_attendances;
						}

						$deductions = 0;
						if ($lates > 3) {
							$deductions = floor($lates / 3) * $day_salary;
						}
						echo "1 day Salary x (Presents+Lates+Leaves) = PKR. " . $salary;
						if ($leaves > 30) {
							$bad_leaves = $leaves - 30;
							$bad_leaves_deduction = $day_salary * $bad_leaves;
							echo "Un Paid Leaves = " . $bad_leaves . ' x ' . $day_salary;
							$deductions += $bad_leaves_deduction;
							echo 'Leave Deductions = PKR. ' . $deductions;
						}
						$final_salary = $salary - $deductions;
						echo "<br>";
						echo "Salary = <b>PKR. " . $final_salary . "<b>";
						?>
						<input type="hidden" id="final_salary<?= $user['employee_id'] ?>" value="<?= $final_salary ?>">
						<input type="hidden" name="employee_id[]" value="<?= $user['employee_id'] ?>">
						<input type="hidden" name="salary_date[]" value="<?= $date ?>">

					</td>
					<td>
						<div class="form-group">
							<label>Advances</label>
							<input type="number" class="form-control calculations" data-employee_id="<?= $user['employee_id'] ?>" id="advance<?= $user['employee_id'] ?>" name="advance[]" value="<?php
								if (isset($monthly_salary) && $monthly_salary != '') {
									foreach ($monthly_salary as $salaries) {
										if ($salaries['salary_employee_id'] == $user['employee_id']) {
											echo $salaries['salary_advance'];
										}
									}
								}
							?>" required>
						</div>

						<div class="form-group">
							<label>Loans</label>
							<input type="number" class="form-control calculations" data-employee_id="<?= $user['employee_id'] ?>" id="loan<?= $user['employee_id'] ?>" name="loan[]" value="<?php
								if (isset($monthly_salary) && $monthly_salary != '') {
									foreach ($monthly_salary as $salaries) {
										if ($salaries['salary_employee_id'] == $user['employee_id']) {
											echo $salaries['salary_loan'];
										}
									}
								}
							?>" required>
						</div>
					<div class="form-group">
																					<label>Insurance</label>
																					<input type="number" class="form-control calculations" data-employee_id="<?= $user['employee_id'] ?>" id="insurance<?= $user['employee_id'] ?>" name="insurance[]" value="<?php
																																																if (isset($monthly_salary) && $monthly_salary != '') {
																																																	foreach ($monthly_salary as $salaries) {
																																																		if ($salaries['salary_employee_id'] == $user['employee_id']) {
																																																			echo $salaries['salary_insurance'];
																																																		}
																																																	}
																																																}
																																																?>" required>
																				</div>
					</td>
					<td>
						<div class="form-group">
							<label>Bonus</label>
							<input type="number" class="form-control calculations" data-employee_id="<?= $user['employee_id'] ?>" id="bonus<?= $user['employee_id'] ?>" name="bonus[]" value="<?php
																																if (isset($monthly_salary) && $monthly_salary != '') {
																																	foreach ($monthly_salary as $salaries) {
																																		if ($salaries['salary_employee_id'] == $user['employee_id']) {
																																			echo $salaries['salary_bonus'];
																																		}
																																	}
																																}
																																?>" required>
						</div>
						<div class="form-group">
							<label>Commission</label>
							<input type="number" class="form-control calculations" data-employee_id="<?= $user['employee_id'] ?>" id="commision<?= $user['employee_id'] ?>" name="commision[]" value="<?php
																																		if (isset($monthly_salary) && $monthly_salary != '') {
																																			foreach ($monthly_salary as $salaries) {
																																				if ($salaries['salary_employee_id'] == $user['employee_id']) {
																																					echo $salaries['salary_commision'];
																																				}
																																			}
																																		}
																																		?>" required>
						</div>
						<div class="form-group">
							<label>Allowances</label>
							<input type="number" class="form-control calculations" data-employee_id="<?= $user['employee_id'] ?>" id="allowances<?= $user['employee_id'] ?>" name="allowances[]" value="<?php
																																			if (isset($monthly_salary) && $monthly_salary != '') {
																																				foreach ($monthly_salary as $salaries) {
																																					if ($salaries['salary_employee_id'] == $user['employee_id']) {
																																						echo $salaries['salary_allowances'];
																																					}
																																				}
																																			}
																																			?>" required>
						</div>
					</td>
					<td>
						<div class="form-group">
							<label>Milage (KM)</label>
							<input type="number" class="form-control calculations" data-employee_id="<?= $user['employee_id'] ?>" id="milage<?= $user['employee_id'] ?>" name="milage[]" value="<?php
																																	if (isset($monthly_salary) && $monthly_salary != '') {
																																		foreach ($monthly_salary as $salaries) {
																																			if ($salaries['salary_employee_id'] == $user['employee_id']) {
																																				echo $salaries['salary_milage'];
																																			}
																																		}
																																	}
																																	?>" required>
						</div>
						<div class="form-group">
							<label>Fuel Price PKR.</label>
							<input type="number" class="form-control calculations" data-employee_id="<?= $user['employee_id'] ?>"  id="fuelprice<?= $user['employee_id'] ?>" name="fuelprice[]"
								value="<?php
										if (isset($monthly_salary) && $monthly_salary != '') {
											foreach ($monthly_salary as $salaries) {
												if ($salaries['salary_employee_id'] == $user['employee_id']) {
													echo $salaries['salary_fuelprice'];
													$salary_id = $salaries['salary_id'];
												}
											}
										}
										?>" required>
							<?php
							if (isset($salary_id) && $salary_id != '') {
							?>
								<input type="hidden" name="salary_id[]" value="<?= $salary_id ?>">
							<?php
							}
							?>

						</div>

						<div class="form-group">
							<label>Total Fuel PKR.</label>
							<input type="number" readonly class="form-control" id="fuelprice_total<?= $user['employee_id'] ?>" name="fuelprice_total[]"
								value="<?php
										if (isset($monthly_salary) && $monthly_salary != '') {
											foreach ($monthly_salary as $salaries) {
												if ($salaries['salary_employee_id'] == $user['employee_id']) {
													echo $salaries['salary_fuelprice_total'];
													$salary_id = $salaries['salary_id'];
												}
											}
										}
										?>" required>
							<?php
							if (isset($salary_id) && $salary_id != '') {
							?>
								<input type="hidden" name="salary_id[]" value="<?= $salary_id ?>">
							<?php
							}
							?>

						</div>
					</td>
					<td>
						<div class="form-group">
							<label>Final Salary PKR.</label>
							<input type="number" class="form-control" id="salary<?= $user['employee_id'] ?>" name="salary[]" value="<?php
																																	if (isset($monthly_salary) && $monthly_salary != '') {
																																		foreach ($monthly_salary as $salaries) {
																																			if ($salaries['salary_employee_id'] == $user['employee_id']) {
																																				echo $salaries['salary_salary'];
																																			}
																																		}
																																	}
																																	?>" required>
						</div>
					</td>


				</tr>
			<?php
				$count++;
			}
			?>
		</tbody>
	</table><!--end /table-->
	<button type="submit" class="btn btn-primary px-4 text-right" style="float:right;">Save</button>
</form>
</div>
</div>
</div>
</div>
</div>


</div><!-- container -->

<?php $this->view('inc/footer_text.php'); ?>
</div>
<!-- end page content -->
</div>
<!-- end page-wrapper -->



<?php $this->view('inc/footer.php'); ?>
<?php
if ($this->session->flashdata('del')) {
?>
<script>
$(document).ready(function() {
var Toast = Swal.mixin({
toast: true,
position: 'top-end',
showConfirmButton: false,
timer: 3000,
timerProgressBar: true,
onOpen: function(toast) {
toast.addEventListener('mouseenter', Swal.stopTimer)
toast.addEventListener('mouseleave', Swal.resumeTimer)
}
});

// Use Toast here or in any other event/function as needed
Toast.fire({
icon: 'success',
title: 'Salary has been Made'
});
});
</script>
<?php
}
?>

<script>
// <?php
// foreach ($users as $user) {
// ?>
// document.getElementById('fuelprice<?= $user['employee_id'] ?>').addEventListener('input', function() {
//     // Get the value entered in the Fuel Price input box
//     var fuelPrice = parseFloat(this.value) || 0; // Parse as a float, default to 0 if not a number (fuelprice)

//     // Get the current Final Salary value
//     var finalSalary = parseFloat(document.getElementById('final_salary<?= $user['employee_id'] ?>').value) || 0;

//     // Get the milage value
//     var milage = parseFloat(document.getElementById('milage<?= $user['employee_id'] ?>').value) || 0;

//     // Add the fuel price to the final salary
//     finalSalary += fuelPrice * milage;

//     // Update the Final Salary input box with the new value
//     document.getElementById('salary<?= $user['employee_id'] ?>').value = finalSalary.toFixed(2); // Display with 2 decimal places
// });

function calculate(){

}

$(document).on('ready', function(){
calculate()
})
$(document).on('change', '.calculations', function(){
	let employeeId = $(this).data('employee_id');
	let advance = parseFloat($(`#advance${employeeId}`).val());
	let loan = parseFloat($(`#loan${employeeId}`).val());
	let insurance = parseFloat($(`#insurance${employeeId}`).val());
	let bonus = parseFloat($(`#bonus${employeeId}`).val());
	let commision = parseFloat($(`#commision${employeeId}`).val());
	let allowances = parseFloat($(`#allowances${employeeId}`).val());
	let mileage = parseFloat($(`#milage${employeeId}`).val());
	let fuelprice = parseFloat($(`#fuelprice${employeeId}`).val());
	var finalSalary =parseFloat($(`#final_salary${employeeId}`).val());
	var totalFuel = fuelprice * mileage;

	finalSalary += totalFuel;
	finalSalary = finalSalary + bonus + commision + allowances - advance - loan - insurance;
	$(`#fuelprice_total${employeeId}`).val(totalFuel)
	$(`#salary${employeeId}`).val(finalSalary)
})
// <?php
// }
// ?>
</script>
<script>
// Get the current page or section identifier (you can customize this part)
var currentPage = "hrm"; // Example: If you're on 1, set it to "1"
</script>



</body>

</html>
