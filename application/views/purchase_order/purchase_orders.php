<?
    // print_r($pos);die;
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Purchase Orders - UHU</title>
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
                                        <h4 class="page-title">Purchase Orders</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Purchase Orders</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">PO</h4>
                                                <p class="text-muted mb-0">Select Time Frame</p>
                                                <form action="<?=base_url()?>Purchase_order" method="POST">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <div class="input-group">                                        
                                                                <input type="text" class="form-control" name="dates" value="<?=$date?>">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="dripicons-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-primary px-4 text-right">Select</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                
                                                
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>PO #</th>
                                                            <th>Supplier</th>
                                                            <th>Status</th>
                                                            <th>Options</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?
                                                                $count = 1;
                                                                foreach ($pos as $po) {
                                                            ?>
                                                            <tr>
                                                                <td><?=$count?></td>
                                                                <td>PO - 0<?=$po['purchase_order_id']?></td>
                                                                <td><?=$po['sup_cus_company']?></td>
                                                                <td>
                                                                <?
                                                                    if ($po['purchase_order_status'] == 0) {
                                                                ?>
                                                                        <span class="badge badge-pill badge-danger"><i class="fas fa-lock-open"></i> Unlocked & Requires Approval</span>
                                                                <?
                                                                    }if ($po['purchase_order_status'] == 1){
                                                                ?>
                                                                        <span class="badge badge-pill badge-warning"><i class="fas fa-lock"></i> locked & Approved</span>
                                                                <?
                                                                    }if ($po['purchase_order_status'] == 2){
                                                                ?>
                                                                        <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> Finalized (GRN Created)</span>
                                                                <?
                                                                    }
                                                                ?>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="<?=base_url()?>Purchase_order/print_purchase_order/<?=$po['purchase_order_id']?>"><i class="fas fa-print"></i> Print PO</a>
                                                                        <? if (in_array(27, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>Purchase_order/change_purchase_order_status/<?=$po['purchase_order_id']?>"><i class="fas fa-exchange-alt"></i>
                                                                        <?
                                                                            if ($po['purchase_order_status'] == 2) {
                                                                                echo "View PO";
                                                                            }
                                                                            if ($po['purchase_order_status'] == 1) {
                                                                                echo "Finalize PO";
                                                                            }
                                                                            if ($po['purchase_order_status'] == 0) {
                                                                                echo "Lock PO";
                                                                            }
                                                                        ?></a>
                                                                        <?}?>
                                                                        <? if (in_array(24, $_SESSION['module_id']) && $po['purchase_order_status'] == 0 || $po['purchase_order_status'] == 1){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>Purchase_order/edit_purchase_order/<?=$po['purchase_order_id']?>"><i class="mdi mdi-grease-pencil"></i> Edit PO</a>
                                                                        <?}?>
                                                                        <? if (in_array(26, $_SESSION['module_id']) && $po['purchase_order_status'] == 0 || $po['purchase_order_status'] == 1){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>Purchase_order/delete_purchase_order/<?=$po['purchase_order_id']?>"><i class="mdi mdi-delete"></i> Delete PO</a>
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
        title: 'A PO has been Deleted'
      });
    });
</script>
<?
}
?>
<?
if($this->session->flashdata('status_lock')){
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
        title: 'PO has been Locked and Requires Approval'
      });
    });
</script>
<?
}
?>
<?
if($this->session->flashdata('status_approve')){
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
        title: 'PO Approved, GRN Created'
      });
    });
</script>
<?
}
?>

 <script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "purchase"; // Example: If you're on 1, set it to "1"

  
</script> 
        
        
    </body>

</html>