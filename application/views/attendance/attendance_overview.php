<?
    // print_r($attendance);die;
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
                                            <li class="breadcrumb-item active">Attendance</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <form action="<?=base_url()?>Attendance/<?=$retVal = (isset($check)) ? 'attendance_overview_department' : 'attendance_overview' ;?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <label class="mb-3"><b>Check Attendance</b></label>
                                                            <input type="month" name="date" class="form-control mb-3" value="<?=$date?>" >
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="mb-3" style="visibility: hidden;"><b>Check Attendance</b></label><br>
                                                            <button type="submit" style="width: 100%;" class="btn btn-primary px-4">Check Attendance</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                
                                                <h4 class="card-title">Attendance for <?= date('F, Y', strtotime($date));?></h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Presents</th>
                                                            <th>Absents</th>
                                                            <th>Lates</th>
                                                            <th>Leaves</th>
                                                            <th>Options</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?
                                                                $count = 1;
                                                                foreach ($employees as $employee) {
                                                            ?>
                                                            <tr>
                                                                <td><?=$count?></td>
                                                                <td><?=$employee['employee_name']?> (<?=$employee['employee_code']?>)</td>
                                                                <td>
                                                                    <?
                                                                        foreach ($attendance as $att) {
                                                                            if ($att['attendance_employee_id'] == $employee['employee_id']) {
                                                                                echo $att['Present'];
                                                                            }
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?
                                                                        foreach ($attendance as $att) {
                                                                            if ($att['attendance_employee_id'] == $employee['employee_id']) {
                                                                                echo $att['Absent'];
                                                                            }
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?
                                                                        foreach ($attendance as $att) {
                                                                            if ($att['attendance_employee_id'] == $employee['employee_id']) {
                                                                                echo $att['Late'];
                                                                            }
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?
                                                                        foreach ($attendance as $att) {
                                                                            if ($att['attendance_employee_id'] == $employee['employee_id']) {
                                                                                echo $att['Leave'];
                                                                            }
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <a href="<?=base_url()?>Attendance/view_summary/<?=$employee['employee_id']?>/<?=$retVal = (isset($check)) ? '1' : '' ;?>" class="btn btn-sm btn-outline-light d-inline-block">View Summary</a>
                                                                </td>
                                                            </tr>
                                                            <?
                                                                $count++;
                                                                }
                                                            ?>
                                                        </tbody>
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