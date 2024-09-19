
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Debit/Credit - UHU</title>
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
                                        <h4 class="page-title">Debit/Credit Note</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Reports/ledger/<?=$retVal = ($check == 2) ? '2' : '1' ;?>"><?=$retVal = ($check == 2) ? 'Supplier' : 'Customer' ;?> Ledger</a></li>
                                            <li class="breadcrumb-item active">Add Debit/Credit Note</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Add Debit/Credit Note <code>(Please check before adding a note)</code></h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <form action="<?=base_url()?>Reports/adding_deb_cred_note" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>Select <?=$retVal = ($check == 2) ? 'Supplier' : 'Customer' ;?> *</label>
                                                                <select class="form-control custom-select" style="width: 100%; height:36px;" name="sup_cus_id" id="customerSelect">
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
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>Select Date *</label>
                                                                <div class="col-sm-12">
                                                                    <input class="form-control" name="date" type="date" id="example-date-input" required>
                                                                    <input type="hidden" name="check" value="<?=$check?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>Select Type *</label>
                                                                <select class="form-control custom-select" style="width: 100%; height:36px;" name="deb_cred_type">
                                                                    <option value="1">Credit</option>
                                                                    <option value="2">Debit</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Particular</label>
                                                                <input type="text" class="form-control" name="particular" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Amount</label>
                                                                <input type="text" class="form-control" name="amount" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-top: 10px">
                                                        <div class="col-sm-12 text-right">
                                                            <button type="submit" class="btn btn-primary px-4">Add Note</button>
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
        title: 'A Note has Adjusted'
      });
    });
</script>
<?
}
?>

<script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "Accounts"; // Example: If you're on 1, set it to "1"
  
</script>
        
    </body>

</html>