<?
    // print_r($_SESSION['module_id']);die;
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Warehouse - UHU</title>
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
                                        <h4 class="page-title">Warehouses</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Warehouses</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Warehouses</h4>
                                                <p class="text-muted mb-0">View Warehouse, Add or Delete. <code>(Deleting will delete all objects associated with that Warehouse)</code></p>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Warehouse Name</th>
                                                            <th>Warehouse Location</th>
                                                            <th>Options</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?
                                                                $count = 1;
                                                                foreach ($warehouses as $warehouse) {
                                                            ?>
                                                            <tr>
                                                                <td><?=$count?></td>
                                                                <td><?=$warehouse['warehouse_name']?></td>
                                                                <td><?=$warehouse['warehouse_address']?></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                                    <div class="dropdown-menu">
                                                                        <? if (in_array(29, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>warehouse/edit_warehouse/<?=$warehouse['warehouse_id']?>"><i class="mdi mdi-grease-pencil"></i> Edit Warehouse</a>
                                                                        <?}?>
                                                                        <? if (in_array(31, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>warehouse/delete_warehouse/<?=$warehouse['warehouse_id']?>"><i class="mdi mdi-delete"></i> Delete Warehouse</a>
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
        title: 'A Product has been Deleted'
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