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
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Purchase Order - UHU</title>
    <body class="dark-sidenav" >
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
                    <div class="row" >
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="page-title">Purchase Order</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Purchase_order">Purchase Order</a></li>
                                            <li class="breadcrumb-item active">Purchase Order</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row" id='printme' >
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 style="text-align: center;margin: 0px;">Purchase Order</h2>
                                                <h4 style="text-align: center;margin: 0px;">PO - 0<?=$pos[0]['purchase_order_id']?></h4>
                                                <h4 style="text-align: center;margin-top: 0px;"><?=date('d-m-Y',strtotime($pos[0]['purchase_order_date']))?></h4>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p style="background: #1761FD;color: white;font-size: 17px;font-weight: 700;padding-left: 10px;">Purchase From:</p>
                                                        <p style="margin: 0;font-size: 17px;"><?=$suppliers[0]['sup_cus_company']?></p>
                                                        <p style="margin: 0;font-size: 17px;"><?=$suppliers[0]['sup_cus_phone1']?></p>
                                                        <p style="margin: 0;font-size: 17px;"><?=$suppliers[0]['sup_cus_address']?></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p style="background: #1761FD;color: white;font-size: 17px;font-weight: 700;padding-left: 10px;">Ship to:</p>
                                                        <p style="margin: 0;font-size: 17px; text-align: right;"><?=$office_data->company_name?></p>
                                                        <p style="margin: 0;font-size: 17px; text-align: right;"><?=$office_data->company_phone1?></p>
                                                        <p style="margin: 0;font-size: 17px; text-align: right;"><?=$office_data->company_address?></p>
                                                    </div>
                                                </div>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Product</th>
                                                                <th>Quntity</th>
                                                                <th>Unit Price</th>
                                                                <th>Tax</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?
                                                                $count = 1;
                                                                $total = 0;
                                                                $tax_cost = 0;
                                                                $taxed_cost = 0;
                                                                $total_tax = 0;
                                                                $grand_total = 0;
                                                                foreach ($Products as $product) {
                                                                    foreach ($product as $pro) {
                                                            ?>
                                                                        <tr>
                                                                            <td><?=$count?></td>
                                                                            <td><?=$pro['product_name']?><p style="font-size: 12px;"><?=$pro['product_description']?></p></td>
                                                                            <td><?=$pro['purchase_order_product_qty']?></td>
                                                                            <td><?=$pro['purchase_order_product_cost']?></td>
                                                                            <td><?=$pro['purchase_order_product_tax']?></td>
                                                                            <td>
                                                                                <?
                                                                                    
                                                                                    if ($pro['purchase_order_product_tax'] == 0) {
                                                                                        $total = $pro['purchase_order_product_qty'] * $pro['purchase_order_product_cost'];
                                                                                        $grand_total += $total;
                                                                                    }else{
                                                                                        $tax_cost = $pro['purchase_order_product_cost'] * ($pro['purchase_order_product_tax']/100);
                                                                                        $total_tax += $tax_cost;
                                                                                        $taxed_cost = $pro['purchase_order_product_cost'] + $tax_cost;
                                                                                        $total = $taxed_cost * $pro['purchase_order_product_qty'];
                                                                                        $grand_total += $total;
                                                                                    }
                                                                                    echo $total;
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                            <?
                                                                        $count++;
                                                                    }
                                                                }
                                                            ?>
                                                            
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="5" class="text-center" style="font-weight: 700;">
                                                                    GRAND TOTAL
                                                                </td>
                                                                <td>
                                                                    <?=$grand_total?>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div><!--end card-body-->
                                        </div><!--end card-->
                                    </div>
                                </div>                                                             
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <button id="print" class="btn btn-primary" onclick="printContent('printme');" >Print</button>
                    <!-- end page title end breadcrumb -->
                    

                </div><!-- container -->

               <?$this->view('inc/footer_text.php');?>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        

<?$this->view('inc/footer.php');?>

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
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "purchase"; // Example: If you're on 1, set it to "1"

  
</script> 
    </body>

</html>