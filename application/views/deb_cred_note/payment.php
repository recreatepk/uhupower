
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Payments - UHU</title>
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
                                        <h4 class="page-title">Payments</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Reports/ledger/<?=$retVal = ($check == 2) ? '2' : '1' ;?>"><?=$retVal = ($check == 2) ? 'Supplier' : 'Customer' ;?> Ledger</a></li>
                                            <li class="breadcrumb-item active">Add Payment</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Add Payment <code>(Please check before adding a Payment)</code></h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <form action="<?=base_url()?>Reports/adding_payments" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>Select <?=$retVal = ($check == 2) ? 'Supplier' : 'Customer' ;?> *</label>
                                                                <select class="form-control custom-select" style="width: 100%; height:36px;" name="sup_cus_id" id="customerSelect" onchange="updateSecondDropdown(this)">
                                                                    <option>Select</option>
                                                                    <?php
                                                                        foreach ($suppliers as $supplier) {
                                                                            if (($check == 1 && $supplier['cat'] == 2) || ($check == 2 && $supplier['cat'] == 1)) {
                                                                        ?>
                                                                        <option value="<?=$supplier['sup_cus_id']?>"><?=$supplier['sup_cus_company']?> - <?=$supplier['sup_cus_name']?></option>
                                                                        <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>Select Date *</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" name="date" type="date" id="example-date-input" required>
                                                                    <input type="hidden" name="check" value="<?=$check?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>Select Referance *</label>
                                                                <select class="form-control custom-select" style="width: 100%; height:36px;" name="ref" id="referenceSelect">
                                                                    <!-- Dynimicly created in js -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Particular</label>
                                                                <input type="text" class="form-control" name="particular" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Amount</label>
                                                                <input type="text" class="form-control" name="amount" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-top: 10px">
                                                        <div class="col-sm-12 text-right">
                                                            <button type="submit" class="btn btn-primary px-4">Add Payment</button>
                                                        </div>
                                                    </div>
                                                </form>
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
        title: 'Payment has been added'
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
<script>
    function updateSecondDropdown(selectElement) {
        // Get the selected value from the first dropdown.
        var selectedValue = selectElement.value;

        // Define arrays for invoices, purchase orders, and rendering services.
        var invoices = <?php echo json_encode($invoices); ?>;
        var purchaseOrders = <?php echo json_encode($purchase_orders); ?>;
        var renderServices = <?php echo json_encode($render_services); ?>;

        // Filter and populate the second dropdown based on the selected value.
        var options = '';
        if (selectedValue) {
            // Filter invoices based on the selected value.
            var invoiceOptions = invoices.filter(function(invoice) {
                return invoice.supplier_id == selectedValue;
            }).map(function(invoice) {
                return '<option value="' + invoice.invoice_id + '-1">INV - ' + invoice.invoice_id + '</option>';
            }).join('');

            // Filter purchase orders based on the selected value.
            var purchaseOrderOptions = purchaseOrders.filter(function(order) {
                return order.purchase_order_supplier_id == selectedValue;
            }).map(function(order) {
                return '<option value="' + order.purchase_order_id + '-2">PO - ' + order.purchase_order_id + '</option>';
            }).join('');

            // Filter rendering services based on the selected value.
            var renderServiceOptions = renderServices.filter(function(service) {
                return service.sup_cus_id == selectedValue;
            }).map(function(service) {
                return '<option value="' + service.render_service_id + '-3">SR - ' + service.render_service_id + '</option>';
            }).join('');

            // Combine all options and update the second dropdown.
            options = '<optgroup label="Select Invoice">' + invoiceOptions + '</optgroup>' +
                      '<optgroup label="Select Purchase Orders">' + purchaseOrderOptions + '</optgroup>' +
                      '<optgroup label="Select Servicing">' + renderServiceOptions + '</optgroup>';
        }

        // Update the second dropdown.
        document.getElementById('referenceSelect').innerHTML = options;
    }
    </script>
        
    </body>

</html>