
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <link href="<?=base_url()?>assets/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
   <title>Complaint - UHU</title>
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
                                        <h4 class="page-title">Complaint</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Complaint">Complaint</a></li>
                                            <li class="breadcrumb-item active">Add Complaint</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Add a Complaint</h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <form action="<?=base_url()?>Complaint/adding_complaint" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>Select Customer *</label>
                                                                <select class="form-control custom-select" style="width: 100%; height:36px;" name="customer_id">

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
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <label>Complaint Date</label>
                                                            <input type="text" name="date" class="form-control" id="mdate">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Complaint Description</label>
                                                                <input type="text" class="form-control" name="complaint_description" maxlength="250" id="defaultconfig" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-top: 10px">
                                                        <div class="col-sm-12 text-right">
                                                            <button type="submit" class="btn btn-primary px-4">Create Complaint</button>
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
        title: 'A Complaint has been added'
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