<?
    // print_r($_SESSION['module_id']);die;
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title><?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?> - UHU</title>
    <body class="dark-sidenav">
        <!-- Left Sidenav -->
       <? $this->view('inc/sidebar.php'); ?>
        <!-- end left-sidenav-->

    <link href="<?=base_url()?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?=base_url()?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 
        

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
                                        <h4 class="page-title"><?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?></h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active"><?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?></li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title"><?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?></h4>
                                                <p class="text-muted mb-0">View <?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?>, Add or Delete. <code>(Deleting will delete all objects associated with that <?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?>)</code></p>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="table" class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Type</th>
                                                            <th>Company</th>
                                                            <th>Phone</th>
                                                            <th>Email</th>
                                                            <th>Address</th>
                                                            <th>Billing</th>
                                                            <th>Options</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?
                                                                $count = 1;
                                                                foreach ($suppliers as $supplier) {
                                                            ?>
                                                            <tr>
                                                                <td><?=$count?></td>
                                                                <td><?=$retVal = ($supplier['cat'] == 1) ? 'Supplier' : 'Customer' ;?></td>
                                                                <td style="text-decoration: underline dotted;" title="<?=$supplier['sup_cus_name']?>"><?=$supplier['sup_cus_company']?></td>
                                                                <td><?=$supplier['sup_cus_phone1']?><br><?=$supplier['sup_cus_phone2']?></td>
                                                                <td><?=$supplier['sup_cus_email']?></td>
                                                                <td><?=$supplier['sup_cus_address']?></td>
                                                                <td>
                                                                <?
                                                                    if ($supplier['sup_cus_billing_cycle'] == 1) {
                                                                        echo "1 Day";
                                                                    }
                                                                    if ($supplier['sup_cus_billing_cycle'] == 3) {
                                                                        echo "3 Days";
                                                                    }
                                                                    if ($supplier['sup_cus_billing_cycle'] == 7) {
                                                                        echo "Weekly";
                                                                    }
                                                                    if ($supplier['sup_cus_billing_cycle'] == 14) {
                                                                        echo "2 Week";
                                                                    }
                                                                    if ($supplier['sup_cus_billing_cycle'] == 30) {
                                                                        echo "Monthly";
                                                                    }
                                                                ?>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                                    <div class="dropdown-menu">
                                                                        <? if (in_array(20, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>Supplier/edit_supplier/<?=$supplier['sup_cus_id']?>/<?=$type?>"><i class="mdi mdi-grease-pencil"></i> Edit <?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?></a>
                                                                        <?}?>
                                                                        <? if (in_array(22, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>Supplier/delete_supplier/<?=$supplier['sup_cus_id']?>/<?=$type?>"><i class="mdi mdi-delete"></i> Delete <?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?></a>
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
<!-- Required datatable js -->
        <script src="<?=base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?=base_url()?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/datatables/jszip.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="<?=base_url()?>assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?=base_url()?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?=base_url()?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="<?=base_url()?>assets/pages/jquery.datatable.init.js"></script>
<script type="text/javascript">
     $('#table').DataTable();
</script>
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
        title: 'A Customer or Supplier has been Deleted'
      });
    });
</script>
<?
}
?>

 <script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "Sales"; // Example: If you're on 1, set it to "1"

  
</script> 
        

        
    </body>

</html>