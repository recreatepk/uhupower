<?
    // print_r($Today_attendance);die;
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <link href="<?=base_url()?>assets/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
   <title>Attendance - UHU</title>
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
                                        <h4 class="page-title">Attendance</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">Mark Attendance</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <form action="<?=base_url()?>Attendance/<?=$retVal = (isset($check)) ? 'check_attendance_department' : 'check_attendance' ;?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <label class="mb-3"><b>Check Attendance</b></label>
                                                            <input type="text" name="date" class="form-control mb-3" value="<?=$date?>" id="mdate">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="mb-3" style="visibility: hidden;"><b>Check Attendance</b></label><br>
                                                            <button type="submit" style="width: 100%;" class="btn btn-primary px-4">Check Attendance</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                
                                                <h4 class="card-title">Mark Attendance for <?= date('D, dS, M-Y', strtotime($date));?></h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>Employee</th>
                                                            <th>Present</th>
                                                            <th>Absent</th>
                                                            <th>Late</th>
                                                            <th>Leave</th>
                                                            <th>Reason</th>
                                                        </tr>
                                                        </thead>
                                                        <form action="<?=base_url()?>Attendance/<?
                                                                        if (isset($Today_attendance) && !empty($Today_attendance)) {
                                                                            echo "change_attendance/".$Today_attendance[0]['date'];
                                                                            if(isset($check)){
                                                                                echo '/1';
                                                                            }
                                                                        }else{
                                                                            echo "mark_todays_attendance/".$date;
                                                                            if(isset($check)){
                                                                                echo '/1';
                                                                            }
                                                                        }
                                                                    ?>" method="POST">
                                                            <tbody>
                                                                <?

                                                                    foreach ($employees as $employee) {
                                                                ?>
                                                                <tr>
                                                                    <td><?=$employee['employee_code']?> <?=$employee['employee_name']?></td>
                                                                    <td>
                                                                        <div class="checkbox checkbox-success checkbox-circle">
                                                                            <input id="checkbox-<?=$employee['employee_id']?>" type="checkbox" name="present[]" value="<?=$employee['employee_id']?>"
                                                                            <?
                                                                                foreach ($Today_attendance as $attendance) {
                                                                                    if ($attendance['attendance_employee_id'] == $employee['employee_id']) {
                                                                                        if ($attendance['attendance_present'] == 1) {
                                                                                            echo "checked";
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>>
                                                                            <label for="checkbox-<?=$employee['employee_id']?>">
                                                                                Present
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox checkbox-danger checkbox-circle">
                                                                            <input id="checkbox-absent<?=$employee['employee_id']?>" type="checkbox"  name="absent[]" value="<?=$employee['employee_id']?>" 
                                                                            <?
                                                                                foreach ($Today_attendance as $attendance) {
                                                                                    if ($attendance['attendance_employee_id'] == $employee['employee_id']) {
                                                                                        if ($attendance['attendance_present'] == 2) {
                                                                                            echo "checked";
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>>
                                                                            <label for="checkbox-absent<?=$employee['employee_id']?>">
                                                                                Absent
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox checkbox-warning checkbox-circle">
                                                                            <input id="checkbox-late<?=$employee['employee_id']?>" type="checkbox"  name="late[]" value="<?=$employee['employee_id']?>"
                                                                            <?
                                                                                foreach ($Today_attendance as $attendance) {
                                                                                    if ($attendance['attendance_employee_id'] == $employee['employee_id']) {
                                                                                        if ($attendance['attendance_present'] == 3) {
                                                                                            echo "checked";
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>>
                                                                            <label for="checkbox-late<?=$employee['employee_id']?>">
                                                                                Late
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox checkbox-info checkbox-circle">
                                                                            <input id="checkbox-leave<?=$employee['employee_id']?>" type="checkbox"  name="leave[]" value="<?=$employee['employee_id']?>"
                                                                            <?
                                                                                foreach ($Today_attendance as $attendance) {
                                                                                    if ($attendance['attendance_employee_id'] == $employee['employee_id']) {
                                                                                        if ($attendance['attendance_present'] == 4) {
                                                                                            echo "checked";
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>>
                                                                            <label for="checkbox-leave<?=$employee['employee_id']?>">
                                                                                Leave
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label>Reason for Leave</label>
                                                                            <input type="text" class="form-control" name="reason[<?=$employee['employee_id']?>]" value="<?
                                                                                foreach ($Today_attendance as $attendance) {
                                                                                    if ($attendance['attendance_employee_id'] == $employee['employee_id']) {
                                                                                        if ($attendance['attendance_present'] == 4) {
                                                                                            echo $attendance['notes'];
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?>">
                                                                        </div>
                                                                    </td>
                                                                    
                                                                </tr>
                                                                <?
                                                                    }
                                                                ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="5"></td>
                                                                    <td><button type="submit" class="btn btn-primary px-4">Save Attendance</button></td>
                                                                </tr>
                                                            </tfoot>
                                                        </form>
                                                    </table><!--end /table-->
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

               <?$this->view('inc/footer_text.php');?>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        

<?$this->view('inc/footer.php');?>
<?
if($this->session->flashdata('mark')){
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
        title: 'Attendance Marked Successfully'
      });
    });
</script>
<?
}
?>
<?
if($this->session->flashdata('change')){
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
        icon: 'warning',
        title: 'Attendance Record Changed Successfully'
      });
    });
</script>
<?
}
?>
<script>
const checkboxes = document.querySelectorAll('.checkbox input[type="checkbox"]');
const reasons = document.querySelectorAll('.reason');

checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', () => {
        const row = checkbox.closest('tr');
        const otherCheckboxes = row.querySelectorAll('.checkbox input[type="checkbox"]');
        
        otherCheckboxes.forEach((cb) => {
            if (cb !== checkbox) {
                cb.checked = false;
            }
        });

        const reasonInput = row.querySelector('.reason');
        if (reasonInput) {
            reasonInput.disabled = !checkbox.checked;
        }
    });
});
</script>

       <script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "hrm"; // Example: If you're on 1, set it to "1"

  
</script> 
    </body>

</html>