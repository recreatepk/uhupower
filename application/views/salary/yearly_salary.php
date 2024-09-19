
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Salary - UHU</title>
    <body class="dark-sidenav">
        <!-- Left Sidenav -->
       <? $this->view('inc/sidebar.php'); ?>
        <!-- end left-sidenav-->
        

        <div class="page-wrapper">
            <!-- Top Bar Start -->
            <? $this->view('inc/nav_bar.php'); ?>
            <!-- Top Bar End -->
    <link rel="stylesheet" href="<?=base_url()?>assets/year_picker/style.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/year_picker/yearpicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
</style>
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
                                            <li class="breadcrumb-item active">Salary</li>
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
                                    <form action="<?=base_url()?>Salary" method="POST">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Select Year </label>
                                                    <input type="text" name="date" class="yearpicker form-control" value="" style="width:100%;margin: 0px;" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label style="visibility: hidden;"><b>Check Attendance</b></label><br>
                                                <button type="submit" style="width: 100%;margin: 0px;" class="btn btn-primary px-4">Check Salaries</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                            <?php
                                            // Separate PHP logic from HTML
                                            $monthSalaries = [];

                                            foreach ($users as $user) {
                                                $userSalaries = [];

                                                foreach ($salary_months as $salary_month) {
                                                    $monthSalary = 0;

                                                    foreach ($salary as $sal) {
                                                        if ($salary_month['months'] == date('m', strtotime($sal['salary_date'])) && $user['employee_id'] == $sal['salary_employee_id']) {
                                                            $monthSalary = $sal['salary_salary'];
                                                            break;
                                                        }
                                                    }

                                                    $userSalaries[] = $monthSalary;
                                                }

                                                $monthSalaries[] = $userSalaries;
                                            }

                                            ?>

                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <?php
                                                        foreach ($salary_months as $salary_month) {
                                                            echo '<th>' . date('M', strtotime('2023-' . $salary_month['months'] . '-01')) . ' (PKR)</th>';
                                                        }
                                                        ?>
                                                        <th>Total (PKR)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $count = 1;
                                                    
                                                    foreach ($users as $index => $user) {
                                                        $salary_total = 0;
                                                        echo '<tr>';
                                                        echo '<td>' . $count . '</td>';
                                                        echo '<td>'. $user['employee_name'] . '</td>';
                                                        foreach ($monthSalaries[$index] as $salary) {
                                                            echo '<td>' . $salary . '</td>';
                                                            $salary_total += $salary;
                                                        }
                                                        echo '<td>' . $salary_total . '</td>';
                                                        echo '</tr>';
                                                        $count++;
                                                    }
                                                    ?>
                                                </tbody>

                                            </table>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div><!-- container -->

               <?$this->view('inc/footer_text.php');?>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        

<?$this->view('inc/footer.php');?>
<?
if($this->session->flashdata('add')){
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
        title: 'Salary submitted Successfully'
      });
    });
</script>
<?
}
?>
<script src="<?=base_url()?>assets/year_picker/yearpicker.js"></script>
    <script>
      $(document).ready(function() {
        $(".yearpicker").yearpicker({
          year: <?=$date?>,
          startYear: 2012,
          endYear: 2070
        });
      });
    </script>
    <script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "hrm"; // Example: If you're on 1, set it to "1"

  
</script>
        
    </body>

</html>