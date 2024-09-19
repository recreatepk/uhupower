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

// print_r($dcs);die;
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>DO - UHU</title>
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
                                        <h4 class="page-title">Delivery Order</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Quotation/delivery_challan">Delivery Orders</a></li>
                                            <li class="breadcrumb-item active">Delivery Order</li>
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
                                                        <h2 style="font-size: 40px;text-shadow: 1px 3px #0000004a;font-weight: 800;">Delivery Order</h2>
                                                    </div><!--end col--> 
                                                </div><!--end row-->     
                                            </div><!--end card-body-->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="">
                                                            <h6 class="mb-0"><b>Invoice Date :</b> <?=date('d/M/Y',strtotime($dcs[0]['date']))?></h6>
                                                            <h6><b>DC ID :</b> DC - 0<?=$dcs[0]['sell_dc_id']?></h6>
                                                        </div>
                                                    </div><!--end col--> 
                                                    <div class="col-md-7 float-to-right" style="display: flex;flex-direction: row;justify-content: space-around;">                                            
                                                        <div class="float-left">
                                                            <address class="font-13">
                                                                <strong class="font-14">Billed To :</strong><br>
                                                                <?=$dcs[0]['sup_cus_company']?><br>
                                                                <?=$dcs[0]['sup_cus_name']?><br>
                                                                <?=$dcs[0]['sup_cus_address']?><br>
                                                                <abbr title="Phone">P:</abbr> <?=$dcs[0]['sup_cus_phone1']?>
                                                            </address>
                                                        </div>
                                                        <?
                                                            if ($dcs[0]['status'] == 1) {
                                                        ?>
                                                        <form action="<?=base_url()?>Quotation/change_delivery_address_dc/<?=$dcs[0]['sell_dc_id']?>" method="POST">
                                                            <div class="float-right">
                                                                <div class="form-group" style="margin-bottom: 5px;">
                                                                    <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="<?=$dcs[0]['sup_cus_company']?>" required>
                                                                </div>
                                                                <div class="form-group" style="margin-bottom: 5px;">
                                                                    <input type="text" class="form-control" placeholder="Contact Person" name="contact_person" value="<?=$dcs[0]['contact_person']?>" required>
                                                                </div>
                                                                <div class="form-group" style="margin-bottom: 5px;">
                                                                    <input type="text" class="form-control" placeholder="Delivery Address" name="delivery_address" value="<?=$dcs[0]['delivery_address']?>" required>
                                                                </div>
                                                                <div class="form-group" style="margin-bottom: 5px;">
                                                                    <input type="text" class="form-control" value="<?=$dcs[0]['number']?>" placeholder="Number" name="number" required>
                                                                </div> 
                                                                <button style="margin-bottom: 5px;" type="submit" class="btn btn-primary px-4 text-right">Update Delivery Information</button>
                                                            </div>
                                                        </form>
                                                        <?
                                                            }
                                                            else{
                                                        ?>
                                                                <div class="float-right">
                                                                    <address class="font-13">
                                                                        <strong class="font-14">Delivery To :</strong><br>
                                                                        <?=$dcs[0]['company_name']?><br>
                                                                        <?=$dcs[0]['contact_person']?><br>
                                                                        <?=$dcs[0]['delivery_address']?><br>
                                                                        <abbr title="Phone">P:</abbr> <?=$dcs[0]['number']?>
                                                                    </address>
                                                                </div>
                                                        <?
                                                            }
                                                        ?>
                                                    </div><!--end col--> 
                                                    <div class="col-md-2 no-print">                                            
                                                        <div class="float-left">
                                                            <strong class="font-14">Status :</strong><br>
                                                            <?
                                                                if ($dcs[0]['status'] == 1) {
                                                                    echo "<span class='badge badge-pill badge-info'><i class='fas fa-ban'></i> Not Delivered</span>";
                                                                }
                                                                if ($dcs[0]['status'] == 2) {
                                                                    echo "<span class='badge badge-pill badge-success'><i class='fas fa-check'></i> Delivered</span>";
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
                                                                        <th class="no-print">Options</th>
                                                                    </tr><!--end tr-->
                                                                </thead>
                                                                <tbody>
                                                                    <?  
                                                                        $count = 1;
                                                                        foreach ($dcs as $dc) {

                                                                    ?>
                                                                        <tr>
                                                                            <td><?=$count?></td>
                                                                            <td style="display: flex;flex-direction: column;"><?=$dc['product_name']?> 
                                                                            <?
                                                                                foreach ($unique_identifiers as $unique_identifier) {
                                                                                    ?>
                                                                                    <span style="font-size: 12px;font-weight: 700;background: #ffff0042;">
                                                                                    <?php
                                                                                    if ($unique_identifier['invoice_product_id'] == $dc['product_id']) {
                                                                                        echo $unique_identifier['sr_no'];
                                                                                    }
                                                                                    ?>
                                                                                    </span>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                                
                                                                            </td>
                                                                            <td><?=$dc['invoice_qty']?></td>
                                                                            <td class="no-print">
                                                                            <?
                                                                                if ($dc['receiving'] == 1) {
                                                                                    echo "<span class='badge badge-pill badge-success'><i class='fas fa-check'></i> Delivered</span>";
                                                                                }else{
                                                                            ?>
                                                                                    <a class="btn btn-primary" href="<?=base_url()?>Quotation/deliver_items/<?=$dc['sell_dc_product_id']?>/<?=$dc['sell_dc_id']?>">Deliver Items</a>
                                                                            <?
                                                                                }
                                                                            ?>
                                                                            </td>
                                                                        </tr>
                                                                    <?
                                                                        $count++;
                                                                        }
                                                                    ?>
                                                                   
                                                                   
                                                                    
                                                                </tbody>
                                                            </table><!--end table-->
                                                        </div>  <!--end /div-->                                          
                                                    </div>  <!--end col-->                                      
                                                </div><!--end row-->

                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6">
                                                        
                                                    </div> <!--end col-->                                       
                                                    <div class="col-lg-6 align-self-end" style="margin-top: 60px;">
                                                        <div class="float-right" style="width: 25%;margin-top: 41px;">
                                                            <small style="border-top: 1px solid;">Manager Signature</small>
                                                        </div>
                                                    </div><!--end col-->
                                                </div><!--end row-->
                                                <hr>
                                                <div class="row d-flex justify-content-center">
                                                    <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                                                        <div class="text-center"><small class="font-12">Pleasure doing business with You..</small></div>
                                                    </div><!--end col-->
                                                    <div class="col-lg-12 col-xl-4">
                                                        <div class="float-right d-print-none">
                                                            <button onclick="printContent('printme');" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
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
<?
if($this->session->flashdata('d_address')){
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
        title: 'Delivery Details Updated Successfully'
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
  var currentPage = "Inventory"; // Example: If you're on 1, set it to "1"

  
</script> 
    </body>

</html>