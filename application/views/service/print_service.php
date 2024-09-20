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

// print_r($quotes);die;
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Services - UHU</title>
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
                                        <h4 class="page-title">Print Invoice</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Service/view_rendering_services">Services</a></li>
                                            <li class="breadcrumb-item active">Print Service Invoice</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12" id="printme">
                                        <div class="card">
                                            <div class="card-body invoice-head"> 
                                                <div class="row">
                                                    <div class="col-md-4 align-self-center" style="display: flex;align-items: center;flex-direction: column;">
                                                        <img src="<?=base_url()?>uploads/company/<?=$office_data->company_logo_name?>" style="    height: 60px;">
                                                    </div><!--end col-->
                                                    <div class="col-md-4 align-self-center" style="display: flex;align-items: center;flex-direction: column;">
                                                        <h2 style="font-size: 35px;text-shadow: 1px 3px #0000004a;font-weight: 800;">Service <?=$retVal = ($rendered_services[0]['status'] == 1) ? 'Quotation' : 'Invoice' ;?></h2>
                                                    </div><!--end col-->    
                                                    <div class="col-md-4">
                                                            
                                                        <ul class="list-inline mb-0 contact-detail float-right">
                                                            <li class="list-inline-item">
                                                                <div class="pl-3">
                                                                    <i class="mdi mdi-web"></i>
                                                                    <p class="text-muted mb-0" <?=$retVal = ($office_data->company_email1 == '') ? "style='visibility: hidden'" : '' ;?>><?=$retVal = ($office_data->company_email1 != '') ? $office_data->company_email1 : 'dasdsdas' ;?></p>
                                                                    <p class="text-muted mb-0" <?=$retVal = ($office_data->company_email2 == '') ? "style='visibility: hidden'" : '' ;?>><?=$retVal = ($office_data->company_email2 != '') ? $office_data->company_email2 : 'dasdsdas' ;?></p>
                                                                </div>                                                
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <div class="pl-3">
                                                                    <i class="mdi mdi-phone"></i>
                                                                    <p class="text-muted mb-0" <?=$retVal = ($office_data->company_phone1 == '') ? "style='visibility: hidden'" : '' ;?>><?=$retVal = ($office_data->company_phone1 != '') ? $office_data->company_phone1 : 'dasdsdas' ;?></p>
                                                                    <p class="text-muted mb-0" <?=$retVal = ($office_data->company_phone2 == '') ? "style='visibility: hidden'" : '' ;?>><?=$retVal = ($office_data->company_phone2 != '') ? $office_data->company_phone2 : 'dasdsdas' ;?></p>
                                                                </div>
                                                            </li>
                                                            
                                                            
                                                        </ul>
                                                    </div>
                                                </div><!--end row-->     
                                            </div><!--end card-body-->
                                            <div class="card-body">
                                                <div class="row" style="border-bottom: 4px double #b6c2e4;">
                                                    <div class="col-md-3" style="display: flex;flex-direction: row;justify-content: space-around;">
                                                        <div class="">
                                                            <h6 class="mb-0"><b>Quotation Date :</b> <?=date('d/M/Y',strtotime($rendered_services[0]['date']))?></h6>
                                                            <h6><b>Service ID :</b> SR - 0<?=$rendered_services[0]['render_service_id']?></h6>
                                                        </div>
                                                    </div><!--end col--> 
                                                    <div class="col-md-7" style="display: flex;flex-direction: row;justify-content: space-around;">                                            
                                                        <div class="float-left">
                                                            <address class="font-13">
                                                                <strong class="font-14"><?=$retVal = ($rendered_services[0]['status'] == 1) ? 'Quotation For' : 'Billed To' ;?> :</strong><br>
                                                                <?=$service_customer[0]['sup_cus_company']?><br>
                                                                <?=$service_customer[0]['sup_cus_name']?><br>
                                                                <?=$service_customer[0]['sup_cus_address']?><br>
                                                                <abbr title="Phone">P:</abbr> <?=$service_customer[0]['sup_cus_phone1']?>
                                                            </address>
                                                        </div>
                                                        <?
                                                            if ($rendered_services[0]['status'] == 2 || $rendered_services[0]['status'] == 3 || $rendered_services[0]['status'] == 4) {
                                                                if (!isset($rendered_services[0]['company_name']) || empty($rendered_services[0]['company_name']) || $rendered_services[0]['company_name'] == '') {
                                                        ?>
                                                            <form action="<?=base_url()?>Service/change_delivery_address_service/<?=$rendered_services[0]['render_service_id']?>/<?=$rendered_services[0]['status']?>" method="POST">
                                                                <div class="float-right">
                                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                                        <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="<?=$service_customer[0]['sup_cus_company']?>" required>
                                                                    </div>
                                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                                        <input type="text" class="form-control" placeholder="Contact Person" name="contact_person" required>
                                                                    </div>
                                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                                        <input type="text" class="form-control" placeholder="Delivery Address" name="delivery_address" required>
                                                                    </div>
                                                                    <div class="form-group" style="margin-bottom: 5px;">
                                                                        <input type="text" class="form-control" placeholder="Number" name="number" required>
                                                                    </div> 
                                                                    <button style="margin-bottom: 5px;" type="submit" class="btn btn-primary px-4 text-right">Save and Change Status</button>
                                                                </div>
                                                            </form>
                                                        <?
                                                                }
                                                                else{
                                                        ?>
                                                                    <div class="float-right">
                                                                        <address class="font-13">
                                                                            <strong class="font-14">Delivery To :</strong><br>
                                                                            <?=$rendered_services[0]['company_name']?><br>
                                                                            <?=$rendered_services[0]['contact_person']?><br>
                                                                            <?=$rendered_services[0]['delivery_address']?><br>
                                                                            <abbr title="Phone">P:</abbr> <?=$rendered_services[0]['number']?>
                                                                        </address>
                                                                    </div>
                                                        <?
                                                                }
                                                            }
                                                        ?>
                                                    </div><!--end col--> 
                                                    <div class="col-md-2 no-print">                                            
                                                        <div class="float-left">
                                                            <strong class="font-14">Status :</strong><br>
                                                            <?
                                                                if ($rendered_services[0]['status'] == 1) {
                                                                    echo "<span class='badge badge-pill badge-light'>Draft</span>";
                                                                }
                                                                if ($rendered_services[0]['status'] == 2) {
                                                                    echo "<span class='badge badge-pill badge-info'>Finalized</span>";
                                                                }
                                                                if ($rendered_services[0]['status'] == 3) {
                                                                    echo "<span class='badge badge-pill badge-warning'>In Progress</span>";
                                                                }
                                                                if ($rendered_services[0]['status'] == 4) {
                                                                    echo "<span class='badge badge-pill badge-success'>Completed</span>";
                                                                }
                                                            ?>
                                                        </div>
                                                    </div><!--end col--> 
                                                                                         
                                                    
                                                                                 
                                                </div><!--end row-->

                                                <div class="row" style="border-bottom: 4px double #b6c2e4;">
                                                    <div class="col-lg-12" style="text-align: center;margin-top: 20px;">
                                                        <h4 style="font-size: 30px;font-weight: 200;">Services</h4>
                                                    </div>
                                                    <div class="col-lg-12" style="padding-bottom: 10px;">
                                                        <div class="table-responsive project-invoice">
                                                            <table class="table table-bordered mb-0">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Service Name</th>
                                                                        <th>Cost</th>
                                                                        <th>Tax</th>
                                                                        <th>Total</th>
                                                                    </tr><!--end tr-->
                                                                </thead>
                                                                <tbody>
                                                                    <?  
                                                                        $count = 1;
                                                                        $taxed_amount = 0;
                                                                        $tax_inclusive = 0;
                                                                        $sub_total = 0;
                                                                        foreach ($rendered_services as $rendered_service) {

                                                                    ?>
                                                                        <tr>
                                                                            <td><?=$count?></td>
                                                                            <td title="<?=$rendered_service['service_description']?>"><?=$rendered_service['service_name']?></td>
                                                                            <td><?=$rendered_service['service_cost']?></td>
                                                                            <td><?=$rendered_service['service_tax']?></td>
                                                                            <td>
                                                                            <?
                                                                                $taxed_amount = ($rendered_service['service_cost'])*($rendered_service['service_tax']/100);
                                                                                $tax_inclusive = $taxed_amount+$rendered_service['service_cost'];
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
                                                                        <th colspan="3" class="border-0"></th>                                                        
                                                                        <td class="border-0 font-14"><b>Total</b></td>
                                                                        <td><?=$sub_total?></td>
                                                                    </tr><!--end tr-->
                                                                </tbody>
                                                            </table><!--end table-->
                                                        </div>  <!--end /div-->                                          
                                                    </div>  <!--end col-->                                      
                                                </div><!--end row-->
                                                <div class="row">
                                                    <div class="col-lg-12" style="text-align: center;margin-top: 20px;">
                                                        <h4 style="font-size: 30px;font-weight: 200;">Products</h4>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="table-responsive project-invoice">
                                                            <table class="table table-bordered mb-0">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Product Name</th>
                                                                        <th>Quantity</th>
                                                                        <th>Cost</th>
                                                                        <th>Tax</th>
                                                                        <th>Total</th>
                                                                    </tr><!--end tr-->
                                                                </thead>
                                                                <tbody>
                                                                    <?
                                                                        $num = 1;
                                                                        $tpcostAfterTax = 0;
                                                                        $sub_total_p = 0;
                                                                        foreach ($rendered_services_product as $rendered_services_product) {
                                                                            
                                                                    ?>
                                                                            <tr>
                                                                                <td><?=$num?></td>
                                                                                <td title="<?=$rendered_services_product['product_description']?>"><?=$rendered_services_product['product_name']?></td>
                                                                                <td><?=$rendered_services_product['product_qty']?></td>
                                                                                <td><?=$rendered_services_product['product_cost']?></td>
                                                                                <td><?=$rendered_services_product['product_tax']?></td>
                                                                                <td>
                                                                                    <?

                                                                                        if ($rendered_services_product['product_tax'] == 0) {
                                                                                            $ptaxPercentage = 1;
                                                                                        }else{
                                                                                            $ptaxPercentage = $rendered_services_product['product_tax'];
                                                                                        }
                                                                                        $pcostBeforeTax = $rendered_services_product['product_cost']*$rendered_services_product['product_qty'];
                                                                                        $ptaxAmount = ($pcostBeforeTax * $ptaxPercentage) / 100;
                                                                                        $pcostAfterTax = $pcostBeforeTax + $ptaxAmount;
                                                                                        echo $pcostAfterTax;
                                                                                        $tpcostAfterTax += $pcostAfterTax;
                                                                                        $sub_total_p = $tpcostAfterTax;
                                                                                        
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                    <?
                                                                                $num++;
                                                                            }
                                                                    ?>
                                                                   
                                                                   
                                                                    <tr class="bg-black text-white">
                                                                        <th colspan="4" class="border-0"></th>                                                        
                                                                        <td class="border-0 font-14"><b>Total</b></td>
                                                                        <td><?=$tpcostAfterTax?></td>
                                                                    </tr><!--end tr-->
                                                                    <tr>
                                                                        <th colspan="4" class="border-0"></th>                                                        
                                                                        <td class="border-0 font-14"><b>Sub Total</b></td>
                                                                        <td class="font-14" style="border-bottom:3px double black; border-left: none; border-right: none;"><?=$sub_total+$sub_total_p?></td>
                                                                    </tr><!--end tr-->
                                                                </tbody>
                                                            </table><!--end table-->
                                                        </div>  <!--end /div-->                                          
                                                    </div>  <!--end col-->                                      
                                                </div><!--end row-->
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6">
                                                       <h5 class="mt-4">Assigned Workers on these Services</h5>
                                                           <ul class="pl-3">
                                                           <?
                                                                foreach ($service_workers as $service_worker) {
                                                           ?>
                                                            
                                                                <li><small class="font-12"></small><span style="font-family: cursive;font-weight: 600;color: #b7042c;">(<?=$service_worker['employee_code']?>)</span> <?=$service_worker['employee_name']?></li>    
                                                            
                                                            <?
                                                                }
                                                            ?>
                                                            </ul>
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
                                                        <?
                                                            if ($rendered_services[0]['status'] != 2) {
                                                        ?>
                                                        <div class="float-right d-print-none">
                                                            <button onclick="printContent('printme');" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                                                        </div>
                                                        <?  
                                                            }
                                                        ?>
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
        title: 'Quotation Status has been changed'
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
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "service"; // Example: If you're on 1, set it to "1"

  
</script>
        
    </body>

</html>
