<?
    // print_r($_SESSION['module_id']);die;
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Departments - UHU</title>
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
                                        <h4 class="page-title">Departments</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Departments</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Departments</h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Description</th>
                                                            <th>Options</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?
                                                                $count = 1;
                                                                foreach ($departments as $department) {
                                                            ?>
                                                            <tr>
                                                                <td><?=$count?></td>
                                                                <td><?=$department['department_name']?></td>
                                                                <td><?=$department['department_description']?></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                                    <div class="dropdown-menu">
                                                                        <? if (in_array(85, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>Department/edit_department/<?=$department['department_id']?>"><i class="mdi mdi-grease-pencil"></i> Edit department</a>
                                                                        <?}?>
                                                                        <? if (in_array(86, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>department/delete_department/<?=$department['department_id']?>"><i class="mdi mdi-delete"></i> Delete department</a>
                                                                        <?}?>
                                                                    </div>
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
if($this->session->flashdata('del')){
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
        title: 'A Department has been Deleted'
      });
    });
</script>
<?
}
?>
<script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "Settings"; // Example: If you're on 1, set it to "1"

  
</script>

        
    </body>

</html>