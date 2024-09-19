<?
	// print_r($dcs);die;
?>

<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Delivery Order - UHU</title>
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
                                        <h4 class="page-title">Delivery Order</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">DOs</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">DO</h4>
                                                 <p class="text-muted mb-0">Select Time Frame</p>
                                                <form action="<?=base_url()?>Quotation/delivery_challan" method="POST">
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
                                                            <th>DO #</th>
                                                            <th>Status</th>
                                                            <th>Options</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?
                                                                $count = 1;
                                                                foreach ($dcs as $dc) {
                                                            ?>
                                                            <tr>
                                                                <td><?=$count?></td>
                                                                <td>DO - 0<?=$dc['sell_dc_id']?></td>
                                                                <td>
                                                                	<?
                                                                		if ($dc['status'] == 1) {
                                                                	?>
                                                                			<span class="badge badge-pill badge-danger"><i class="fas fa-ban"></i> Not Yet Delivered</span>
                                                                	<?
                                                                		}if ($dc['status'] == 2) {
                                                                	?>
                                                                			<span class="badge badge-pill badge-success"><i class="fas fa-check"></i> Delivered</span>
                                                                	<?
                                                                		}
                                                                	?>
                                                                </td>
                                                                
                                                                <td>
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                                    <div class="dropdown-menu">
                                                                        <? if (in_array(49, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>Quotation/view_dc/<?=$dc['sell_dc_id']?>"><i class="fas fa-handshake"></i> Deliver Items</a>
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
        title: 'A Deliver Order has been Deleted'
      });
    });
</script>
<?
}
?>
<script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "Inventory"; // Example: If you're on 1, set it to "1"

  
</script>
        
    </body>

</html>