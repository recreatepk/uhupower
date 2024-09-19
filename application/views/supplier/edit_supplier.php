
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title><?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?> - UHU</title>
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
                                        <h4 class="page-title"><?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?></h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Supplier/supplier/<?=$type?>"><?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?></a></li>
                                            <li class="breadcrumb-item active">Edit <?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?></li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Edit a <?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?></h4>
                                                <p class="text-muted mb-0">Edit <?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?></p>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <form action="<?=base_url()?>Supplier/editing_supplier/<?=$supplier[0]['sup_cus_id']?>/<?=$type?>" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                         
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Contact Person Name *</label>
                                                                <input type="text" value="<?=$supplier[0]['sup_cus_name']?>" class="form-control" name="sup_cus_name" required="">
                                                                <input type="hidden" class="form-control" value="<?=$supplier[0]['cat']?>" name="cat" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Company Name *</label>
                                                                <input type="text" value="<?=$supplier[0]['sup_cus_company']?>" class="form-control" name="sup_cus_company" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Phone *</label>
                                                                <input type="text" value="<?=$supplier[0]['sup_cus_phone1']?>" class="form-control" name="sup_cus_phone1" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Phone 2</label>
                                                                <input type="text" value="<?=$supplier[0]['sup_cus_phone1']?>" class="form-control" name="sup_cus_phone2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" value="<?=$supplier[0]['sup_cus_email']?>" class="form-control" name="sup_cus_email">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Address *</label>
                                                                <input type="text" value="<?=$supplier[0]['sup_cus_address']?>" class="form-control" name="sup_cus_address" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>NTN</label>
                                                                <input type="text" class="form-control" name="ntn" value="<?=$supplier[0]['ntn']?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>STRN</label>
                                                                <input type="text" class="form-control" name="strn" value="<?=$supplier[0]['strn']?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Billing Cycle *</label>
                                                                <select class="form-control custom-select" style="width: 100%; height:36px;" name="sup_cus_billing_cycle">
                                                                    <optgroup label="Select Days">
                                                                        
                                                                        <option value="1" <?=$retVal = ($supplier[0]['sup_cus_billing_cycle'] == 1) ? 'selected' : '' ;?>> 1 Day</option>
                                                                        <option value="3" <?=$retVal = ($supplier[0]['sup_cus_billing_cycle'] == 3) ? 'selected' : '' ;?>> 3 Days</option>
                                                                        <option value="7" <?=$retVal = ($supplier[0]['sup_cus_billing_cycle'] == 7) ? 'selected' : '' ;?>> 1 Week</option>
                                                                        <option value="14" <?=$retVal = ($supplier[0]['sup_cus_billing_cycle'] == 14) ? 'selected' : '' ;?>> 2 Weeks</option>
                                                                        <option value="30" <?=$retVal = ($supplier[0]['sup_cus_billing_cycle'] == 30) ? 'selected' : '' ;?>> 1 month</option>
                                                                        
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-top: 10px">
                                                        <div class="col-sm-12 text-right">
                                                            <button type="submit" class="btn btn-primary px-4">Edit <?=$retVal = ($type == 1) ? 'Supplier' : 'Customers' ;?></button>
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
        title: 'A Customer & Supplier Edited successfully'
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