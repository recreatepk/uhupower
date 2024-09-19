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
                                        <h4 class="page-title">User Attendance Data</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Attendance/<?=$retVal = (isset($check)) ? 'attendance_overview_department' : 'attendance_overview' ;?>">Attendance</a></li>
                                            <li class="breadcrumb-item active">Monthly Attendance</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <form action="<?=base_url()?>Attendance/view_summary/<?=$employee[0]['employee_id']?>/<?=$retVal = (isset($check)) ? '1' : '' ;?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <label class="mb-3"><b>Check Attendance for <a href="<?=base_url()?>user/edit_user/<?=$employee[0]['employee_id']?>"><?=$employee[0]['employee_name']?> (<?=$employee[0]['employee_code']?>)</a></b></label>
                                                            <input type="month" name="date" class="form-control mb-3" value="<?=$date?>" >
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label class="mb-3" style="visibility: hidden;"><b>Check Attendance</b></label><br>
                                                            <button type="submit" style="width: 100%;" class="btn btn-primary px-4">Check Attendance</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                
                                                <h4 class="card-title">Attendance data for Month <?= date('F, Y', strtotime($date));?></h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Attendance</th>
                                                                    <th>Notes</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                    foreach ($attendance as $att){
                                                                ?>
                                                                        <tr>
                                                                            <td>
                                                                                <?=date('l, dS, M',strtotime($att['date']))?>
                                                                            </td>
                                                                            <td>
                                                                                <?
                                                                                    if ($att['attendance_present'] == 1) {
                                                                                ?>
                                                                                        <a href="#" class="badge badge-pill badge-success">Present</a>
                                                                                <?
                                                                                    }if ($att['attendance_present'] == 2) {
                                                                                ?>
                                                                                        <a href="#" class="badge badge-pill badge-danger">Absent</a>
                                                                                <?
                                                                                    }if ($att['attendance_present'] == 3) {
                                                                                ?>
                                                                                        <a href="#" class="badge badge-pill badge-warning">Late</a>
                                                                                <?
                                                                                    }if ($att['attendance_present'] == 4) {
                                                                                ?>
                                                                                        <a href="#" class="badge badge-pill badge-info">Leave</a>
                                                                                <?
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                            <td><?=$att['notes']?></td>
                                                                        </tr>
                                                                <?       
                                                                    }
                                                                ?>
                                                                
                                                            </tbody>
                                                        </table><!--end /table-->
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

               <?$this->view('inc/footer_text.php');?>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        <?$this->view('inc/footer.php');?>
   <script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "hrm"; // Example: If you're on 1, set it to "1"

  
</script>
    </body>

</html>