<?php

$CI = &get_instance(); // Access CodeIgniter's instance

$CI->load->database(); // Load the database library if not already loaded
$CI->load->driver('cache', ['adapter' => 'file']); // Load the cache driver

$cache_key = 'office_data';

if (!($office_data = $CI->cache->get($cache_key))) {
    // Cache not available or expired, fetch data from the database
    $query = $CI->db->get('office');
    $office_data = $query->row();

    // Save data in the cache for future use
    $CI->cache->save($cache_key, $office_data);
}

// print_r($invoices);die;
?>
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

            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12" >
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="page-title">Invoice</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Invoices</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12" id="printme">
                                        <div class="card">
                                            <div class="card-body invoice-head"> 
                                                 <div class="row">
                                                    <div class="col-md-4 align-self-center" style="display: flex;align-items: center;flex-direction: column;">
                                                        <img src="<?=base_url()?>uploads/company/<?=$office_data->company_logo_name?>" style="height: 60px;">
                                                    </div><!--end col-->
                                                       
                                                    <div class="col-md-4" style="display: flex;flex-direction: column;align-items: center;">
                                                            
                                                        <h4 style="font-weight: 900;"><?=$office_data->company_name?></h4>
                                                        <p style="text-align: center;font-weight: 600; margin: 0;"><?=$office_data->company_address?></p>
                                                        <p style="text-align: center;font-weight: 500; margin: 0;"><?=$office_data->company_phone1?></p>
                                                        <p style="text-align: center;font-weight: 500; margin: 0;"><?=$office_data->company_email1?></p>
                                                    </div>
                                                    <div class="col-md-4 align-self-center" style="display: flex;align-items: center;flex-direction: column;">
                                                        <h2 style="font-size: 70px;text-shadow: 1px 3px #0000004a;font-weight: 800;">Invoice</h2>
                                                    </div><!--end col--> 
                                                </div><!--end row-->     
                                            </div><!--end card-body-->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="">
                                                            <h6 class="mb-0"><b>Invoice Date :</b> <?=date('d/M/Y',strtotime($invoices[0]['invoice_date']))?></h6>
                                                            <h6><b>Invoice ID :</b> INV - 0<?=$invoices[0]['invoice_id']?></h6>
                                                        </div>
                                                    </div><!--end col--> 
                                                    <div class="col-md-7">                                            
                                                        <div class="float-right">
                                                            <address class="font-13">
                                                                <strong class="font-14">Billed To :</strong><br>
                                                                <?=$invoices[0]['sup_cus_company']?><br>
                                                                <?=$invoices[0]['sup_cus_name']?><br>
                                                                <?=$invoices[0]['sup_cus_address']?><br>
                                                                <abbr title="Phone">P:</abbr> <?=$invoices[0]['sup_cus_phone1']?>
                                                            </address>
                                                        </div>
                                                    </div><!--end col--> 
                                                    <div class="col-md-2 no-print">                                            
                                                        <div class="float-left">
                                                            <strong class="font-14">Status :</strong><br>
                                                            <?
                                                                if ($invoices[0]['invoice_status'] == 1) {
                                                                    echo "<span class='badge badge-pill badge-info'><i class='fas fa-lock-open'></i> Draft</span>";
                                                                }
                                                                if ($invoices[0]['invoice_status'] == 2) {
                                                                    echo "<span class='badge badge-pill badge-warning'><i class='fas fa-lock'></i> locked</span>";
                                                                }
                                                                if ($invoices[0]['invoice_status'] == 3) {
                                                                    echo "<span class='badge badge-pill badge-success'><i class='fas fa-check'></i> Finalized</span>";
                                                                }
                                                            ?>
                                                        </div>
                                                    </div><!--end col--> 
                                                                                         
                                                    
                                                                                 
                                                </div><!--end row-->

                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="table-responsive project-invoice">
                                                            <table class="table table-bordered mb-0">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Items</th>
                                                                        <th>QTY</th>
                                                                        <th>Rate</th>
                                                                        <th>Tax</th>
                                                                        <th>Subtotal</th>
                                                                    </tr><!--end tr-->
                                                                </thead>
                                                                <tbody>
                                                                    <?  
                                                                        $count = 1;
                                                                        $taxed_amount = 0;
                                                                        $tax_inclusive = 0;
                                                                        $sub_total = 0;
                                                                        $total_qty = 0;
                                                                        foreach ($iv_products as $product) {

                                                                    ?>
                                                                        <tr>
                                                                            <td><?=$count?></td>
                                                                            <td><?=$product['product_name']?></td>
                                                                            <td><?=$product['invoice_qty']?></td>
                                                                            <?
                                                                                $total_qty += $product['invoice_qty'];
                                                                            ?>
                                                                            <td><?=$product['invoice_cost']?></td>
                                                                            <td><?=$product['invoice_tax']?></td>
                                                                            <td>
                                                                            <?
                                                                                $taxed_amount = ($product['invoice_cost'])*($product['invoice_tax']/100);
                                                                                $tax_inclusive = ($taxed_amount*$product['invoice_qty'])+($product['invoice_cost']*$product['invoice_qty']);
                                                                                echo $tax_inclusive;

                                                                                $sub_total += $tax_inclusive;
                                                                            ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?
                                                                        $count++;
                                                                        }
                                                                    ?>
                                                                   
                                                                   
                                                                    <tr class="bg-black text-white">
                                                                        <th colspan="4" class="border-0"></th>                                                        
                                                                        <td class="border-0 font-14"><b>Total</b></td>
                                                                        <td><?=$sub_total?></td>
                                                                    </tr><!--end tr-->
                                                                </tbody>
                                                            </table><!--end table-->
                                                        </div>  <!--end /div-->                                          
                                                    </div>  <!--end col-->                                      
                                                </div><!--end row-->

                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6">
                                                        
                                                    </div> <!--end col-->                                       
                                                    <div class="col-lg-6 align-self-end" style="margin-top: 60px;">
                                                        <div class="float-right" style="width: 30%;">
                                                            <small>Manager Signature</small>
                                                            <p class="border-top">Signature</p>
                                                        </div>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                                <hr>
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                                                        <div class="text-center"><small class="font-12">Pleasure doing business with you.</small></div>
                                                    </div><!--end col-->
                                                    <div class="col-lg-12 col-xl-4">
                                                        <div class="float-right d-print-none">
                                                            <button onclick="printContent('printme');" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                                                            <?
                                                                if ($invoices[0]['invoice_status'] != 3) {
                                                                    if ($invoices[0]['invoice_status'] == 2 && !empty($unique_identifiers) && in_array(47, $_SESSION['module_id'])) {
                                                            ?> 
                                                                        <button type="button" class="btn btn-primary no-print" data-toggle="modal" data-target="#bd-example-modal-xl">Finalize Invoice</button>
                                                            <?
                                                                    }else{
                                                            ?>
                                                                        <a href="<?=base_url()?>Quotation/change_invoice_status/<?if ($invoices[0]['invoice_status'] == 1) {
                                                                            echo '2';
                                                                            echo "/";
                                                                            echo $invoices[0]['invoice_id'];
                                                                        }else{
                                                                            if (in_array(47, $_SESSION['module_id']) && $invoices[0]['invoice_status'] == 2) {
                                                                                echo "3";
                                                                                echo "/";
                                                                                echo $invoices[0]['invoice_id'];
                                                                                
                                                                            }
                                                                        }?>" class="btn btn-primary"><?if ($invoices[0]['invoice_status'] == 1) {
                                                                            echo 'Lock Invoice';
                                                                        }else{
                                                                            echo "Finilize Invoice";
                                                                        }?></a>
                                                            <?
                                                                    }
                                                                }
                                                            ?>

                                                        </div>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                            </div><!--end card-body-->
                                        </div><!--end card-->
                                    </div><!--end col-->
                                </div><!--end row-->                                                       
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->
                    <div class="modal fade bd-example-modal-xl" id="bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <form action="<?=base_url()?>Quotation/change_invoice_status/3/<?=$invoices[0]['invoice_id']?>" method="POST">
                                        
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Select Unique Identifiers</h6>
                                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="la la-times"></i></span>
                                        </button>
                                    </div><!--end modal-header-->
                                    
                                    <div class="modal-body" style="display: flex;justify-content: space-around;">
                                        <div class="col-md-6">
                                        <?php
                                            // Assuming $unique_identifiers is an array containing product information
                                            $grouped_products = [];

                                            // Group products by product_id
                                            foreach ($unique_identifiers as $products) {
                                                foreach ($products as $product) {
                                                    $product_id = $product['product_id'];

                                                    // Check if the product_id is already in the grouped array
                                                    if (!isset($grouped_products[$product_id])) {
                                                        $grouped_products[$product_id] = [];
                                                    }

                                                    // Add the product to the corresponding group
                                                    $grouped_products[$product_id][] = $product;
                                                }
                                            }

                                            // Display grouped products
                                            foreach ($grouped_products as $product_id => $group) {
                                                // Output heading for each group
                                                foreach($iv_products as $prod){
                                                    if($prod['product_id'] == $product_id){
                                                        $product_name = $prod['product_name'];
                                                    }
                                                }
                                                echo "<p class='active btn-primary' style='font-size: 24px; text-align: center;'> $product_name</p>";

                                                // Output checkboxes for each product in the group
                                                foreach ($group as $product) {
                                                    ?>
                                                    <div class="checkbox my-2">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="unique_identifier[]" value="<?= $product['unique_identifier_id'] ?>" class="custom-control-input checkboxes" id="customCheck<?= $product['unique_identifier_id'] ?>" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                            <label class="custom-control-label" for="customCheck<?= $product['unique_identifier_id'] ?>"><?= $product['sr_no'] ?></label>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div><!--end modal-body-->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                    </div><!--end modal-footer-->
                                </div><!--end modal-content-->
                            </form>
                        </div><!--end modal-dialog-->
                    </div><!--end modal-->
                </div><!-- container -->

               <?$this->view('inc/footer_text.php');?>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        

<?$this->view('inc/footer.php');?>
<?
if($this->session->flashdata('status')){
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
        title: 'Invoice Status has been changed'
      });
    });
</script>
<?
}
?>

<?
if($this->session->flashdata('qty_error')){
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
        icon: 'danger',
        title: 'You dont have enough Goods to Sell'
      });
      
    });
</script>
<?
}
?>

<script>
    function printContent(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>
<script>
    const checkboxes = document.querySelectorAll('.checkboxes');
    let checkedCount = 0;

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                checkedCount++;
            } else {
                checkedCount--;
            }

            if (checkedCount > <?=$total_qty?>) {
                this.checked = false; // Prevent checking more than 2 checkboxes
                checkedCount--;
            }
        });
    });
</script>
       <script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "Accounts"; // Example: If you're on 1, set it to "1"
 
</script>  
    </body>

</html>
