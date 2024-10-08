
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Render Services - UHU</title>
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
                                        <h4 class="page-title">Rendering Services</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Service">Services</a></li>
                                            <li class="breadcrumb-item active">Rendering Services</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->     
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Providing Services</h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <form  action="<?=base_url()?>Service/editing_render_service/<?=$rendered_services[0]['render_service_id']?>" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Select Customer *</label>
                                                                <select class="form-control custom-select" style="width: 100%; height:36px;" name="supplier_id">
                                                                    <optgroup label="Select Supplier / Customer">
                                                                        <?
                                                                            foreach ($customers as $customer) {
                                                                            
                                                                        ?>
                                                                        <option <?=$retVal = ($customer['sup_cus_id'] == $rendered_services[0]['sup_cus_id']) ? 'selected' : '' ;?> value="<?=$customer['sup_cus_id']?>"><?=$customer['sup_cus_company']?> - <?=$customer['sup_cus_name']?></option>
                                                                        <?
                                                                    }
                                                                        ?>
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label>Select Date *</label>
                                                            <div class="col-sm-12">
                                                                <input class="form-control" name="date" type="date" value="<?=$rendered_services[0]['date']?>" id="example-date-input" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-12"><h5 style="text-align: center;">Update Services</h5></div>
                                                                <fieldset style="background: #1761fd30;border-radius: 16px;padding: 20px;">
                                                                    <div class="repeater-custom-show-hide">
                                                                        <div data-repeater-list="service">
                                                        <?
                                                            foreach ($rendered_services as $rendered_service) {
                                                        ?>
                                                                            <div data-repeater-item="">
                                                                                <div class="col-sm-12">
                                                                                    
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <label>Select Services needs to be Rendered *</label>
                                                                                            <select class="form-control custom-select" style="width: 100%; height:36px;" name="service_id" required>
                                                                                                <?
                                                                                                    foreach ($services as $service) {
                                                                                                ?>
                                                                                                    <option <?=$retVal = ($service['service_id'] == $rendered_service['service_id']) ? 'selected' : '' ;?> value="<?=$service['service_id']?>"><?=$service['service_name']?></option>
                                                                                                    
                                                                                                <?
                                                                                                    }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                        
                                                                                        
                                                                                        <div class="col-sm-3">
                                                                                            <div class="form-group">
                                                                                                <label>Cost *</label>
                                                                                                <input type="text" class="form-control" name="service_cost" value="<?=$rendered_service['service_cost']?>" required="">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-2">
                                                                                            <div class="form-group">
                                                                                                <label>Tax *</label>
                                                                                                <input type="text" class="form-control" name="service_tax" value="<?=$rendered_service['service_tax']?>" required="">
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
                                                        <?
                                                            }
                                                        ?>
                                                                        </div>
                                                                        <span data-repeater-create="" class="btn btn-info waves-effect waves-light">
                                                                            <span class="fa fa-plus"></span> Add
                                                                        </span>
                                                                       </div>
                                                                </fieldset>
                                                            </div>
                                                        <div class="col-sm-12">
                                                            <div class="col-sm-12"><h5 style="text-align: center;">Update Parts</h5></div>
                                                                <fieldset style="background: #1761fd30;border-radius: 16px;padding: 20px;margin-top: 10px;">
                                                                    <div class="repeater-custom-show-hide">
                                                                        <div data-repeater-list="products">
                                                        <?
                                                            foreach ($rendered_services_product as $rendered_service_product) {
                                                                if ($rendered_service_product['render_service_id'] != '') {
                                                        ?>
                                                        
                                                                        <div data-repeater-item="">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-6">
                                                                                        <label>Select Parts as Need *</label>
                                                                                        <select class="form-control custom-select product-select" style="width: 100%; height:36px;" name="product_id" required>
                                                                                        <?
                                                                                            foreach ($product_categories as $product_category) {
                                                                                      ?>
                                                                                            <optgroup label="<?=$product_category['product_category_name']?>">
                                                                                                <?
                                                                                                    foreach ($products as $product) {
                                                                                                        if ($product['product_category_id'] == $product_category['product_category_id']) {
                                                                                                ?>
                                                                                                            <option data-po="<?=$product['purchase_order_id']?>" <?=$retVal = ($product['product_id'] == $rendered_service_product['product_id']) ? 'selected' : '' ;?>  value="<?=$product['product_id']?>"><?=$product['product_name']?> </option>
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
                                                                                    <div class="col-sm-1">
                                                                                        <div class="form-group">
                                                                                            <label>Qty *</label>
                                                                                            <input type="text" name="purchase_order_id" class="invoice_purchase_order_id" value="<?=$rendered_service_product['purchase_order_id']?>"  hidden>
                                                                                            <input type="text" class="form-control" name="product_qty" value="<?=$rendered_service_product['product_qty']?>" required="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <div class="form-group">
                                                                                            <label>Cost *</label>
                                                                                            <input type="text" class="form-control" name="product_cost" value="<?=$rendered_service_product['product_cost']?>" required="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <div class="form-group">
                                                                                            <label>Tax *</label>
                                                                                            <input type="text" class="form-control" name="product_tax" value="<?=$rendered_service_product['product_tax']?>" required="">
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
                                                                    
                                                        <?
                                                                }else{
                                                                    ?>
                                                                        <div data-repeater-item="">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-6">
                                                                                        <label>Select Parts as Need *</label>
                                                                                        <select class="form-control custom-select product-select" style="width: 100%; height:36px;" name="product_id" required>
                                                                                        <?
                                                                                            foreach ($product_categories as $product_category) {
                                                                                      ?>
                                                                                            <optgroup label="<?=$product_category['product_category_name']?>">
                                                                                                <?
                                                                                                    foreach ($products as $product) {
                                                                                                        if ($product['product_category_id'] == $product_category['product_category_id']) {
                                                                                                ?>
                                                                                                            <option data-po="<?=$product['purchase_order_id']?>" value="<?=$product['product_id']?>"><?=$product['product_name']?> </option>
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
                                                                                    <div class="col-sm-1">
                                                                                        <div class="form-group">
                                                                                            <label>Qty *</label>
                                                                                            <input type="text" name="purchase_order_id" class="invoice_purchase_order_id" hidden>
                                                                                            <input type="text" class="form-control" name="product_qty" required="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <div class="form-group">
                                                                                            <label>Cost *</label>
                                                                                            <input type="text" class="form-control" name="product_cost" required="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-2">
                                                                                        <div class="form-group">
                                                                                            <label>Tax *</label>
                                                                                            <input type="text" class="form-control" name="product_tax" required="">
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
                                                                    <?
                                                                }
                                                            }
                                                        ?>
                                                                        </div>
                                                                        <span data-repeater-create="" class="btn btn-info waves-effect waves-light">
                                                                            <span class="fa fa-plus"></span> Add
                                                                        </span>
                                                                    </div>
                                                                </fieldset>
                                                                </div>
                                                        

                                                        <div class="col-sm-12" style="margin-top: 5px">
                                                            <button type="submit" class="btn btn-primary px-4 text-right" style="float: right;">Render Service</button>
                                                        </div>
                                                        
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
        title: 'Services Updated'
      });
    });
</script>
<?
}
?>
<script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "service"; // Example: If you're on 1, set it to "1"

  
</script>
        
    </body>

</html>