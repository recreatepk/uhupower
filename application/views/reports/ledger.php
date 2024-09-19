
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Client Ledger - UHU</title>
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
                                        <h4 class="page-title">Client Ledgers</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">All Ledgers</li>
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
                                    <h4 class="card-title">Ledgers </h4>
                                    <form action="<?=base_url()?>Reports/cus_sup_ledger" method="POST">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Select <?=$retVal = ($check == 2) ? 'Supplier' : 'Customer' ;?>*</label>
                                                    <select class="form-control custom-select" style="width: 100%; height:36px;" name="supplier_id">
                                                        <? 
                                                        if($check == 1){
                                                        ?>
                                                        <optgroup label="Select Customer">
                                                            <?
                                                                foreach ($suppliers as $supplier) {
                                                                    if ($supplier['cat'] == 2) {
                                                            ?>
                                                            <option value="<?=$supplier['sup_cus_id']?>"><?=$supplier['sup_cus_company']?> - <?=$supplier['sup_cus_name']?></option>
                                                            <?
                                                                    }
                                                                }
                                                            ?>
                                                        </optgroup>
                                                        <?
                                                            }if($check == 2){
                                                        ?>
                                                        <optgroup label="Select Supplier">
                                                            <?
                                                                foreach ($suppliers as $supplier) {
                                                                    if ($supplier['cat'] == 1) {
                                                                
                                                            ?>
                                                            <option value="<?=$supplier['sup_cus_id']?>"><?=$supplier['sup_cus_company']?> - <?=$supplier['sup_cus_name']?></option>
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
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Select dates *</label>        
                                                    <input type="text" class="form-control" name="dates" value="">
                                                    <input type="hidden" class="form-control" name="check" value="<?=$check?>">
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-2">
                                                <label style="visibility: hidden;">Select Customer *</label>
                                                <button type="submit" class="btn btn-primary px-4 form-control">Select</button>
                                            </div>
                                        </div>
                                    </form>
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
<script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "Accounts"; // Example: If you're on 1, set it to "1"

  
</script>  
        
    </body>

</html>