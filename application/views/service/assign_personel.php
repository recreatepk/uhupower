
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Assignment - UHU</title>
    <body class="dark-sidenav">
        <!-- Left Sidenav -->
        <link href="<?=base_url()?>assets/plugins/dragula/dragula.min.css" rel="stylesheet" type="text/css" />
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
                                        <h4 class="page-title">Services</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Service/view_rendering_services">Render Services</a></li>
                                            <li class="breadcrumb-item active">Create Assignment</li>
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
                                    <h4 class="card-title">Assign Workers to Service</h4>
                                </div>
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card" style="background: #f5f5dc4d;">
                                                    <div class="card-header">
                                                        <h4 class="card-title mt-0 mb-3" style="text-align:center;">Service Details of <span style="color: #b7042c;">(SR - 0<?=$rendered_services[0]['rendered_services_id']?>)</span></h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 style="text-align:center;">Services Included</h5>
                                                        <table class="table table-hover">
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
                                                                    $count = 1;
                                                                    $totalCostAfterTax_s = 0;
                                                                    foreach ($rendered_services as $rendered_service) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?=$count?></td>
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
                                                                                $totalCostAfterTax_s += $costAfterTax;
                                                                                echo $costAfterTax;
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                <?
                                                                        $count++;
                                                                    }
                                                                ?>
                                                                
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="3"></td>
                                                                    <td><b>TOTAL</b></td>
                                                                    <td><?=$totalCostAfterTax_s?></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        <h5 style="text-align:center;">Products Included</h5>
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Service Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Cost</th>
                                                                    <th>Tax</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?
                                                                    $count = 1;
                                                                    $totalCostAfterTax_product = 0;
                                                                    $totalCostAfterTax_p = 0;
                                                                    $costBeforeTax = 0;
                                                                    $taxAmount = 0;
                                                                    $product_total_cost = 0;
                                                                    foreach ($rendered_services_product as $product) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?=$count?></td>
                                                                        <td title="<?=$product['product_description']?>"><?=$product['product_name']?></td>
                                                                        <td><?=$product['product_qty']?></td>
                                                                        <td><?=$product['product_cost']?></td>
                                                                        <td><?=$product['product_tax']?></td>
                                                                        <td>
                                                                            <?

                                                                                if ($product['product_tax'] == 0) {
                                                                                    $taxPercentage = 1;
                                                                                }else{
                                                                                    $taxPercentage = $product['product_tax'];
                                                                                }
                                                                                $product_total_cost = $product['product_cost']*$product['product_qty'];
                                                                                $costBeforeTax = $product_total_cost;
                                                                                $taxAmount = ($costBeforeTax * $taxPercentage) / 100;
                                                                                $totalCostAfterTax_product = $costBeforeTax + $taxAmount;
                                                                                $totalCostAfterTax_p += $totalCostAfterTax_product;
                                                                                echo $totalCostAfterTax_product;
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                <?
                                                                        $count++;
                                                                    }
                                                                ?>
                                                                
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="4"></td>
                                                                    <td><b>TOTAL</b></td>
                                                                    <td><?=$totalCostAfterTax_p?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4"></td>
                                                                    <td style="border-bottom: 3px double;"><b>Grand Total</b></td>
                                                                    <td style="border-bottom: 3px double;"><?=$totalCostAfterTax_p + $totalCostAfterTax_s?></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="kanban-board">
                                                <div class="col-sm-6">
                                                    <div class="kanban-col">
                                                        <div class="kanban-main-card">                                                    
                                                            <div class="kanban-box-title">
                                                                <h4 class="card-title mt-0 mb-3">All Employees</h4>
                                                            </div>
                                                            
                                                            <div id="project-list-left" class="pb-1">
                                                                <?
                                                                    $assignedEmployeeIds = [];
                                                                    foreach ($service_assignments as $service_assignment) {
                                                                        $assignedEmployeeIds[] = $service_assignment['employee_id'];
                                                                    }

                                                                    foreach ($employees as $employee) {
                                                                        if (!in_array($employee['employee_id'], $assignedEmployeeIds)) {
                                                                ?>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <i class="mdi mdi-circle-outline d-block mt-n2 font-18 text-success"></i>
                                                                        <h5 class="my-1 font-14"><span style='margin-right: 18px;font-family: cursive;font-weight: 600;color: #b7042c;'>(<?=$employee['employee_code']?>)</span><?=$employee['employee_designation']?></h5>
                                                                        <p class="text-muted" style="margin-bottom: 0px;"><?=$employee['employee_name']?></p>
                                                                        <p class="text-muted mb-2"><?=$employee['employee_phone1']?></p>
                                                                        <input type="hidden" name="employee_ids[]" value="<?=$employee['employee_id']?>">
                                                                    </div><!--end card-body-->
                                                                </div>
                                                                <?
                                                                        }
                                                                    }
                                                                ?>

                                                            </div>
                                                        </div><!--end /div-->
                                                    </div><!--end kanban-col-->
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="kanban-col">
                                                        <div class="kanban-main-card">                                                    
                                                            <div class="kanban-box-title">
                                                                <h4 class="card-title mt-0 mb-3">Assigned</h4>
                                                                
                                                            </div>
                                                            <form method="POST" action="<?=base_url()?>Service/assigning_personel/<?=$rendered_services[0]['render_service_id']?>">
                                                                <div id="project-list-center-left" class="pb-1">
                                                                <?
                                                                    foreach ($employees as $employee) {
                                                                        foreach ($service_assignments as $service_assignment) {
                                                                            if ($service_assignment['employee_id'] == $employee['employee_id']) {
                                                                ?>
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <i class="mdi mdi-circle-outline d-block mt-n2 font-18 text-success"></i>
                                                                        <h5 class="my-1 font-14"><span style='margin-right: 18px;font-family: cursive;font-weight: 600;color: #b7042c;'>(<?=$employee['employee_code']?>)</span><?=$employee['employee_designation']?></h5>
                                                                        <p class="text-muted" style="margin-bottom: 0px;"><?=$employee['employee_name']?></p>
                                                                        <p class="text-muted mb-2"><?=$employee['employee_phone1']?></p>
                                                                        <input type="hidden" name="employee_ids[]" value="<?=$employee['employee_id']?>">
                                                                    </div><!--end card-body-->
                                                                </div>
                                                                <?
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                                </div>
                                                                <div class="col-sm-12 mt-3">
                                                                    <div class=" text-right">
                                                                        <button type="submit" class="btn btn-primary px-4">Assign Workers</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div><!--end /div-->
                                                    </div><!--end kanban-col-->
                                                </div>
                                            </div>
                                        </div>
                                        
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
<script src="<?=base_url()?>assets/plugins/dragula/dragula.min.js"></script>
<script src="<?=base_url()?>assets/pages/jquery.dragula.init.js"></script>
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
        title: 'A new Service has been Added successfully'
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