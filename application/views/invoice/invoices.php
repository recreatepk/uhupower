<?
    // print_r($pos);die;
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Invoices - UHU</title>
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
                                        <h4 class="page-title">Invoices</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Invoices</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Invoices <code>(Finalizing the invoice will deduct inventory)</code> </h4>
                                                <p class="text-muted mb-0">Select Time Frame</p>
                                                <form action="<?=base_url()?>Quotation/invoice" method="POST">
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
                                                            <th>Invoice #</th>
                                                            <th>Customer</th>
                                                            <th>Invoice Amount</th>
                                                            <th>Status</th>
                                                            <th>Options</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?
                                                                $count = 1;
                                                                foreach ($invoices as $invoice) {
                                                            ?>
                                                            <tr>
                                                                <td><?=$count?></td>
                                                                <td>INV - 0<?=$invoice['invoice_id']?></td>
                                                                <td><?=$invoice['sup_cus_company']?></td>
                                                                <td>
                                                                    <?
                                                                        foreach ($invoice_sum as $sum) {
                                                                            if ($sum['invoice_id'] == $invoice['invoice_id']) {
                                                                                echo $sum['total_cost'];
                                                                            }
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                <?
                                                                    if ($invoice['invoice_status'] == 1) {
                                                                ?>
                                                                        <span class="badge badge-pill badge-info"><i class="fas fa-lock-open"></i> Draft</span>
                                                                <?
                                                                    }if ($invoice['invoice_status'] == 2){
                                                                ?>
                                                                        <span class="badge badge-pill badge-warning"><i class="fas fa-lock"></i> locked</span>
                                                                <?
                                                                    }if ($invoice['invoice_status'] == 3){
                                                                ?>
                                                                        <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> Finalized (DC Genrated)</span>
                                                                <?
                                                                    }
                                                                ?>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="<?=base_url()?>Quotation/print_invoice/<?=$invoice['invoice_id']?>"><i class="fas fa-exchange-alt"></i>
                                                                        <?
                                                                            if ($invoice['invoice_status'] == 3) {
                                                                                echo "View Invoice & Print";
                                                                            }
                                                                            if ($invoice['invoice_status'] == 2) {
                                                                                echo "Finalize Invoice & Print";
                                                                            }
                                                                            if ($invoice['invoice_status'] == 1) {
                                                                                echo "Lock Invoice & Print";
                                                                            }
                                                                        ?></a>
                                                                        <? if (in_array(45, $_SESSION['module_id']) && $invoice['invoice_status'] != 3){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>Quotation/edit_invoice/<?=$invoice['invoice_id']?>"><i class="mdi mdi-grease-pencil"></i> Edit Invoice</a>
                                                                        <?}?>
                                                                        <? if (in_array(46, $_SESSION['module_id']) && $invoice['invoice_status'] == 1){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>Quotation/delete_invoice/<?=$invoice['invoice_id']?>"><i class="mdi mdi-delete"></i> Delete Invoices</a>
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
        title: 'A Invoice has been Deleted'
      });
    });
</script>
<?
}
?>
<script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "Accounts"; // Example: If you're on 1, set it to "1"

  
</script> 
        
    </body>

</html>