
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Invoice - UHU</title>
    <body class="dark-sidenav">
        <!-- Left Sidenav -->
       <? $this->view('inc/sidebar.php'); ?>
        <!-- end left-sidenav-->
        

        <div class="page-wrapper">
            <!-- Top Bar Start -->
            <? $this->view('inc/nav_bar.php'); ?>
            <!-- Top Bar End -->

            
            <div class="page-content"><!-- Page Content-->
                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="page-title">Invoices</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Quotation/invoice">Invoices</a></li>
                                            <li class="breadcrumb-item active">Edit Invoice</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->     
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Editing Invoice</h4>
                                                <p class="text-muted mb-0">For any type of company Selling<code> (Please review the Invoice before Locking)</code></p>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <form  action="<?=base_url()?>Quotation/editing_invoice/<?=$invoices[0]['invoice_id']?>" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Select Supplier *</label>
                                                                <select class="form-control custom-select" style="width: 100%; height:36px;" name="invoice_supplier_id">
                                                                    <optgroup label="Select Customer">
                                                                        <?
                                                                            foreach ($all_suppliers as $supplier) {
                                                                                if ($supplier['cat'] == 2) {
                                                                            
                                                                        ?>
                                                                        <option value="<?=$supplier['sup_cus_id']?>" <? if ($invoices[0]['supplier_id'] == $supplier['sup_cus_id']) {
                                                                           echo "selected";
                                                                        } ?>><?=$supplier['sup_cus_company']?> - <?=$supplier['sup_cus_name']?></option>
                                                                        <?
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </optgroup>
                                                                    <optgroup label="Select Supplier">
                                                                        <?
                                                                            foreach ($all_suppliers as $supplier) {
                                                                                if ($supplier['cat'] == 1) {
                                                                            
                                                                        ?>
                                                                        <option value="<?=$supplier['sup_cus_id']?>" <? if ($invoices[0]['supplier_id'] == $supplier['sup_cus_id']) {
                                                                           echo "selected";
                                                                        } ?>><?=$supplier['sup_cus_company']?> - <?=$supplier['sup_cus_name']?></option>
                                                                        <?
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Select Date *</label>
                                                            <div class="form-group">
                                                                <input class="form-control" name="invoice_date" type="date" value="<?=$invoices[0]['invoice_date']?>" id="example-date-input" required>
                                                            </div>
                                                        </div>
                                                        <?
                                                            $index = 2000;
                                                            foreach ($invoices_products as $invoices_product) {
                                                        ?>
                                                        <div class="col-sm-12">
                                                            <div class="form-group row">
                                                                <div class="col-sm-3">
                                                                    <label>Select Products for Purchase *</label>
                                                                    <select class="form-control custom-select product-select" style="width: 100%; height:36px;" name="products[<?= $index ?>][product_id]" required>
                                                                        <?
                                                                            foreach ($all_product_categories as $product_category) {
                                                                        ?>
                                                                            <optgroup label="<?=$product_category['product_category_name']?>">
                                                                                <?
                                                                                    foreach ($all_products as $product) {
                                                                                        if ($product['product_category_id'] == $product_category['product_category_id']) {
                                                                                ?>
                                                                                            <option value="<?=$product['product_id']?>" 
                                                                                            <?
                                                                                                if ($invoices_product['product_id'] == $product['product_id']) {
                                                                                                    echo "selected";
                                                                                                }
                                                                                            ?>
                                                                                            ><?=$product['product_name']?></option>
                                                                                <?
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </optgroup>
                                                                        <?
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label>Quantity *</label>
                                                                        <input type="number" class="form-control" name="products[<?= $index ?>][invoice_qty]" required="" value="<?=$invoices_product['invoice_qty']?>">
                                                                        <input type="text"  name="products[<?= $index ?>][invoice_poduct_id]" value="<?=$invoices_product['invoice_poduct_id']?>" hidden>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label>Cost *</label>
                                                                        <input type="text" class="form-control purchase-order-product-cost" name="products[<?= $index ?>][invoice_cost]" required=""value="<?=$invoices_product['invoice_cost']?>" min="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label>Tax *</label>
                                                                        <input type="text" class="form-control" name="products[<?= $index ?>][invoice_tax]" required=""value="<?=$invoices_product['invoice_tax']?>">
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <?
                                                            $index++;
                                                            }
                                                        ?>
                                                        <fieldset>
                                                            <div class="repeater-custom-show-hide">
                                                                <div data-repeater-list="products">
                                                                    <div data-repeater-item="">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-3">
                                                                                    <label>Select Products for Purchase *</label>
                                                                                    <select class="form-control custom-select product-select" style="width: 100%; height:36px;" name="product_id" required>
                                                                                        <option>Select Product</option>
                                                                                        <?
                                                                                            foreach ($all_product_categories as $product_category) {
                                                                                        ?>

                                                                                            <optgroup label="<?=$product_category['product_category_name']?>">
                                                                                                <?
                                                                                                    foreach ($all_products as $product) {
                                                                                                        if ($product['product_category_id'] == $product_category['product_category_id']) {
                                                                                                ?>
                                                                                                            <option data-po="<?=$product['purchase_order_id']?>" data-cost="<?=$product['inventory_product_cost']?>" data-qty="<?=$product['inventory_product_qty']?>" value="<?=$product['product_id']?>"><?=$product['product_name']?></option>
                                                                                                <?
                                                                                                        }
                                                                                                    }
                                                                                                ?>
                                                                                            </optgroup>
                                                                                        <?
                                                                                            }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                                
                                                                                <div class="col-sm-3">
                                                                                    <div class="form-group">
                                                                                        <label>Quantity *</label>
                                                                                        <input type="text" name="invoice_purchase_order_id" class="invoice_purchase_order_id"  hidden>
                                                                                        <input type="number" class="form-control" name="invoice_qty" required="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-3">
                                                                                    <div class="form-group">
                                                                                        <label>Cost *</label>
                                                                                        <input type="text" class="form-control purchase-order-product-cost" name="invoice_cost" required="" min="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    <div class="form-group">
                                                                                        <label>Tax *</label>
                                                                                        <input type="text" class="form-control" name="invoice_tax" required="">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-1">
                                                                                    <label>Option</label>
                                                                                    <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                                                        <span class="far fa-trash-alt mr-1"></span> Delete
                                                                                    </span>
                                                                                </div><!--end col-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <span data-repeater-create="" class="btn btn-info waves-effect waves-light">
                                                                    <span class="fa fa-plus"></span> Add
                                                                </span>
                                                                <button type="submit" class="btn btn-primary px-4 text-right">Update Invoice</button>
                                                               </div>
                                                        </fieldset>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                         
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!-- container -->
                <?$this->view('inc/footer_text.php');?>
            </div><!-- end page content -->
        </div><!-- end page-wrapper -->
        

        

<?$this->view('inc/footer.php');?>
<script src="<?=base_url()?>assets/plugins/repeater/jquery.repeater.min.js"></script>
<script src="<?=base_url()?>assets/pages/jquery.form-repeater.js"></script>
<?
if($this->session->flashdata('edit')){
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
        title: 'invoices has been Updated'
      });
    });
</script>
<?
}
?>
<script>
    $(document).ready(function () {
        $(document).on("change input", ".product-select", function () {
            updateInputFields($(this));
        });

        $(document).on("input", ".purchase-order-product-qty", function () {
            validateQuantityInput($(this));
        });

        function updateInputFields(selectElement) {
            var selectedOption = selectElement.find(":selected");
            var cost = selectedOption.data("cost");
            var qty = selectedOption.data("qty");
            var po = selectedOption.data("po");

            var row = selectElement.closest(".form-group.row");
            row.find(".purchase-order-product-cost").val(cost);
            row.find(".invoice_purchase_order_id").val(po);
            row.find(".purchase-order-product-cost").attr("min", cost); // Set the max attribute to the available cost
            
            
        }

        
    });
</script>
       <script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "Accounts"; // Example: If you're on 1, set it to "1"

  
</script>  
    </body>

</html>