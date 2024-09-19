<!--<script>
	// Get the current page or section identifier (you can customize this part)
	var currentPage = "Sales"; // Example: If you're on 1, set it to "1"


</script>
--><?/*
// print_r($pos);die;
*/?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Quotations - UHU</title>
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
                                        <h4 class="page-title">Quotations</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Quotations</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Quotations</h4>
                                                <p class="text-muted mb-0">Select Time Frame</p>
                                                <form action="<?=base_url()?>Quotation" method="POST">
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
                                                            <th>Quotation #</th>
                                                            <th>Customer</th>
															<th>Service Information</th>
                                                            <th>Status</th>
                                                            <th>Options</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?
                                                                $count = 1;
                                                                foreach ($qoutations as $qoutation) {
                                                            ?>
                                                            <tr>
                                                                <td><?=$count?></td>
                                                                <td>QT - 0<?=$qoutation['quotation_id']?></td>
                                                                <td><?=$qoutation['sup_cus_company']?></td>
																<td>
																	<div class="accordion" id="accordionExample">
																		<div class="card border mb-1 shadow-none">
																			<div class="card-header custom-accordion rounded-0"
																				 id="heading<?= $qoutation['quotation_id'] ?>"
																				 style="background-color: #b7042c !important;">
																				<a href="" class="text-dark" data-toggle="collapse"
																				   data-target="#collapse<?= $qoutation['quotation_id'] ?>"
																				   aria-expanded="true"
																				   aria-controls="collapse<?= $qoutation['quotation_id'] ?>">
																					SR - 0<?= $qoutation['quotation_id'] ?>
																					<span style="float:right;">Show more <i
																							class="mdi mdi-arrow-down"></i></span>
																				</a>
																			</div>
																			<div id="collapse<?= $qoutation['quotation_id'] ?>"
																				 class="collapse"
																				 aria-labelledby="heading<?= $qoutation['quotation_id'] ?>"
																				 data-parent="#accordionExample">
																				<div class="card-body">
																					<p class="mb-0">
																					<div class="col-sm-12" style="text-align: center;"><h4>
																							Services</h4></div>
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
																						foreach ($quotes_service as $rendered_service) {
																							if ($rendered_service['quotation_id'] == $qoutation['quotation_id']) {

																								?>
																								<tr>
																									<td><?= $num ?></td>
																									<td title="<?= $rendered_service['service_description'] ?>"><?= $rendered_service['service_name'] ?></td>
																									<td><?= $rendered_service['cost'] ?></td>
																									<td><?= $rendered_service['tax'] ?></td>
																									<td>
																										<?

																										if ($rendered_service['tax'] == 0) {
																											$taxPercentage = 1;
																										} else {
																											$taxPercentage = $rendered_service['tax'];
																										}
																										$costBeforeTax = $rendered_service['cost'];
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
																							<td style="border-bottom: 1px solid black;border-top: 1px solid black;"
																								colspan="4" class="text-center"><b>Total</b>
																							</td>
																							<td style="border-bottom: 3px double black; border-top: 1px solid black;">
																								<b><?= $totalCostAfterTax ?></b></td>
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
                                                                    if ($qoutation['quotation_order_status'] == 1) {
                                                                ?>
                                                                        <span class="badge badge-pill badge-info"><i class="fas fa-lock-open"></i> Draft</span>
                                                                <?
                                                                    }if ($qoutation['quotation_order_status'] == 2){
                                                                ?>
                                                                        <span class="badge badge-pill badge-warning"><i class="fas fa-lock"></i> locked</span>
                                                                <?
                                                                    }if ($qoutation['quotation_order_status'] == 3){
                                                                ?>
                                                                        <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> Finalized</span>
                                                                <?
                                                                    }
                                                                    if ($qoutation['quotation_order_status'] == 4){
                                                                ?>
                                                                        <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> Invoice Genrated</span>
                                                                <?
                                                                    }
                                                                ?>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="<?=base_url()?>Quotation/change_quotation_status/<?=$qoutation['quotation_id']?>"><i class="fas fa-exchange-alt"></i>
                                                                        <?
                                                                            if ($qoutation['quotation_order_status'] == 4) {
                                                                                echo "View Quotes & print";
                                                                            }
                                                                            if ($qoutation['quotation_order_status'] == 3) {
                                                                                echo "Genrate Invoice";
                                                                            }
                                                                            if ($qoutation['quotation_order_status'] == 2) {
                                                                                echo "Finalize Quotes & print";
                                                                            }
                                                                            if ($qoutation['quotation_order_status'] == 1) {
                                                                                echo "Lock Quotes & print";
                                                                            }
                                                                        ?></a>
                                                                        <? if (in_array(40, $_SESSION['module_id']) && $qoutation['quotation_order_status'] != 4){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>Quotation/edit_quotation/<?=$qoutation['quotation_id']?>"><i class="mdi mdi-grease-pencil"></i> Edit Quotes</a>
                                                                        <?}?>
                                                                        <? if (in_array(41, $_SESSION['module_id']) && $qoutation['quotation_order_status'] == 1){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>Quotation/delete_quotation/<?=$qoutation['quotation_id']?>"><i class="mdi mdi-delete"></i> Delete Quotes</a>
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
        title: 'A Quotation has been Deleted'
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
        icon: 'warning',
        title: 'Can not convert to invoice, Not enough quantity in Inventory'
      });
    });
</script>
<?
}
?>
 <script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "Sales"; // Example: If you're on 1, set it to "1"

  
</script> 
        
    </body>

</html>
