
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Servicing - UHU</title>
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
                                        <h4 class="page-title">Servicing</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Servicing</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->                                                              
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Services <code>(Providing services to Customer)</code></h4>
                                    <p class="text-muted mb-0">Select Time Frame</p>
                                    <form action="<?=base_url()?>Service/view_rendering_services" method="POST">
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
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer</th>
                                                <th>Service Information</th>
                                                <th>Assigned To</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                    $count = 1;
                                                    foreach ($main_services as $main_service) {
                                                ?>
                                                <tr>
                                                    <td><?=$count?></td>
                                                    <td>
                                                        <?
                                                            foreach ($customers as $customer) {
                                                                if ($customer['sup_cus_id'] == $main_service['sup_cus_id']) {
                                                                    echo $customer['sup_cus_company'].' ('.$customer['sup_cus_company'].')';
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="accordion" id="accordionExample">
                                                            <div class="card border mb-1 shadow-none">
                                                                <div class="card-header custom-accordion rounded-0" id="heading<?=$main_service['render_service_id']?>" style="background-color: #b7042c !important;">
                                                                    <a href="" class="text-dark" data-toggle="collapse" data-target="#collapse<?=$main_service['render_service_id']?>" aria-expanded="true" aria-controls="collapse<?=$main_service['render_service_id']?>">
                                                                        SR - 0<?=$main_service['render_service_id']?>
                                                                        <span style="float:right;">Show more <i class="mdi mdi-arrow-down"></i></span>
                                                                    </a>
                                                                </div>
                                                                <div id="collapse<?=$main_service['render_service_id']?>" class="collapse" aria-labelledby="heading<?=$main_service['render_service_id']?>" data-parent="#accordionExample">
                                                                    <div class="card-body">
                                                                    <p class="mb-0">
                                                                        <div class="col-sm-12" style="text-align: center;"><h4>Services</h4></div>
                                                                        <table class="table table-hover mb-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Service Name</th>
                                                                                    <th>Cost</th>
                                                                                    <th>Tax</th>
                                                                                    <th>Total</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?
                                                                                    $num = 1;
                                                                                    $totalCostAfterTax = 0;
                                                                                    foreach ($rendered_services as $rendered_service) {
                                                                                        if ($rendered_service['render_service_id'] == $main_service['render_service_id']) {
                                                                                        
                                                                                ?>
                                                                                        <tr>
                                                                                            <td><?=$num?></td>
                                                                                            <td title="<?=$rendered_service['service_description']?>"><?=$rendered_service['service_name']?></td>
                                                                                            <td><?=$rendered_service['service_cost']?></td>
                                                                                            <td><?=$rendered_service['service_tax']?></td>
                                                                                            <td>
                                                                                                <?

                                                                                                    if ($rendered_service['service_tax'] == 0) {
                                                                                                        $taxPercentage = 1;
                                                                                                    }else{
                                                                                                        $taxPercentage = $rendered_service['service_tax'];
                                                                                                    }
                                                                                                    $costBeforeTax = $rendered_service['service_cost'];
                                                                                                    $taxAmount = ($costBeforeTax * $taxPercentage) / 100;
                                                                                                    $costAfterTax = $costBeforeTax + $taxAmount;
                                                                                                    $totalCostAfterTax += $costAfterTax;
                                                                                                    echo $costAfterTax;
                                                                                                ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                <?
                                                                                            $num++;
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                
                                                                            </tbody>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <td style="border-bottom: 1px solid black;border-top: 1px solid black;" colspan="4" class="text-center"><b>Total</b></td>
                                                                                    <td style="border-bottom: 3px double black; border-top: 1px solid black;"><b><?=$totalCostAfterTax?></b></td>
                                                                                </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                        <div class="col-sm-12" style="text-align: center;"><h4>Products</h4></div>
                                                                        
                                                                        <table class="table table-hover mb-0">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Product Name</th>
                                                                                    <th>Quantity</th>
                                                                                    <th>Cost</th>
                                                                                    <th>Tax</th>
                                                                                    <th>Total</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?
                                                                                    $num = 1;
                                                                                    $tpcostAfterTax = 0;
                                                                                    foreach ($rendered_services_products as $rendered_services_product) {
                                                                                        if ($rendered_services_product['render_service_id'] == $main_service['render_service_id']) {
                                                                                        
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
                                                                                                    
                                                                                                ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                <?
                                                                                            $num++;
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                
                                                                            </tbody>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <td style="border-bottom: 1px solid black;border-top: 1px solid black;" colspan="5" class="text-center"><b>Total</b></td>
                                                                                    <td style="border-bottom: 3px double black; border-top: 1px solid black;"><b><?=$tpcostAfterTax?></b></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="border-bottom: 1px solid black;border-top: 1px solid black;" colspan="5" class="text-center"><b>Grand Total</b></td>
                                                                                    <td style="border-bottom: 3px double black; border-top: 1px solid black;"><b><?=$totalCostAfterTax + $tpcostAfterTax?></b></td>
                                                                                </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                            
                                                                    </p> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?
                                                            foreach ($service_assignments as $service_assignment) {
                                                                foreach ($employees as $employee) {
                                                                    if ($service_assignment['render_service_id'] == $main_service['render_service_id']) {
                                                                        if ($employee['employee_id'] == $service_assignment['employee_id']) {
                                                                            echo "<p>". "<span style='margin-right: 18px;font-family: cursive;font-weight: 600;color: #b7042c;'>(" .$employee['employee_code'] . ")</span>" . $employee['employee_name'] . "</p>";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?
                                                            if ($main_service['status'] == 1) {
                                                                echo "<span class='badge badge-pill badge-light'>Draft</span>";
                                                            }
                                                            if ($main_service['status'] == 2) {
                                                                echo "<span class='badge badge-pill badge-info'>Finalized</span>";
                                                            }
                                                            if ($main_service['status'] == 3) {
                                                                echo "<span class='badge badge-pill badge-warning'>In Progress</span>";
                                                            }
                                                            if ($main_service['status'] == 4) {
                                                                echo "<span class='badge badge-pill badge-success'>Completed</span>";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                        <div class="dropdown-menu">
                                                            <? if ($main_service['status'] == 2 || $main_service['status'] == 3 || $main_service['status'] == 4){ ?>
                                                            <a class="dropdown-item" href="<?=base_url()?>Service/print_service/<?=$main_service['render_service_id']?>"><i class="mdi mdi-printer"></i> Print Service Invoice</a>
                                                            <?}?>
                                                            <? if (in_array(73, $_SESSION['module_id']) && $main_service['status'] == 1 || $main_service['status'] == 2){ ?>
                                                            <a class="dropdown-item" href="<?=base_url()?>Service/assign_personel/<?=$main_service['render_service_id']?>"><i class="mdi mdi-account-multiple-outline"></i> Assign to Workers</a>
                                                            <?}?>
                                                            <? if ($main_service['status'] == 1){ ?>
                                                            <a class="dropdown-item" href="<?=base_url()?>Service/change_status/<?=$main_service['render_service_id']?>/<?=$main_service['status']?>"><i class="mdi mdi-redo"></i> Change Status</a>
                                                            <a class="dropdown-item" href="<?=base_url()?>Service/print_service/<?=$main_service['render_service_id']?>"><i class="mdi mdi-printer"></i> Print Service Invoice</a>
                                                            <?}else{
                                                                if (in_array(74, $_SESSION['module_id']) && $main_service['status'] == 2 || $main_service['status'] == 3) {
                                                            ?>
                                                                    <a class="dropdown-item" href="<?=base_url()?>Service/change_status/<?=$main_service['render_service_id']?>/<?=$main_service['status']?>"><i class="mdi mdi-check"></i> Change Status</a>
                                                            <?
                                                                }
                                                            }?>
                                                            <? if (in_array(70, $_SESSION['module_id']) && $main_service['status'] == 1){ ?>
                                                            <a class="dropdown-item" href="<?=base_url()?>Service/edit_render_service/<?=$main_service['render_service_id']?>"><i class="mdi mdi-grease-pencil"></i> Edit Service</a>
                                                            <?}elseif(in_array(74, $_SESSION['module_id']) && $main_service['status'] == 2){
                                                            ?>
                                                                <a class="dropdown-item" href="<?=base_url()?>Service/edit_render_service/<?=$main_service['render_service_id']?>"><i class="mdi mdi-grease-pencil"></i> Edit Service</a>
                                                            <?
                                                                }
                                                            ?>
                                                            <? if (in_array(72, $_SESSION['module_id']) && $main_service['status'] == 1 || $main_service['status'] == 2){ ?>
                                                            <a class="dropdown-item" href="<?=base_url()?>Service/delete_render_service/<?=$main_service['render_service_id']?>"><i class="mdi mdi-delete"></i> Delete Service</a>
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
                                    </div><!--end /tableresponsive-->
                                </div>
                            </div>
                        </div>
                    </div>
                    

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
        title: 'A Service has been Deleted'
      });
    });
</script>
<?
}
?>
<?
if($this->session->flashdata('assign')){
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
        title: 'Worker Assigned to Service'
      });
    });
</script>
<?
}
?>
<?
if($this->session->flashdata('dc')){
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
        title: 'Service is now in progress, check with warehouse manager for Parts'
      });
    });
</script>
<?
}
?>
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
        title: 'Status Changed'
      });
    });
</script>
<?
}
?>
<?
if($this->session->flashdata('completed')){
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
        title: 'Services has been rendered and completed'
      });
    });
</script>
<?
}
?>
<?
if($this->session->flashdata('invoice')){
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
        title: 'Product Invoice is not Finialized, please check with accounts'
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