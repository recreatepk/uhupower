
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Expense - UHU</title>
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
                                        <h4 class="page-title">Expense</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Expense">Expense</a></li>
                                            <li class="breadcrumb-item active">Add Expense</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Add a new Expense</h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <form action="<?=base_url()?>Expense/adding_expense" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Select Category *</label>
                                                                <select class="form-control custom-select" style="width: 100%; height:36px;" name="expense_category_id">

                                                                    <optgroup label="Select an Expense Category">
                                                                        <?
                                                                            foreach ($expense_categories as $expense_category) {
                                                                            
                                                                        ?>
                                                                        <option value="<?=$expense_category['expense_category_id']?>"><?=$expense_category['expense_name']?></option>
                                                                        <?
                                                                    }
                                                                        ?>
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Expense Date *</label>
                                                                <input class="form-control" type="date" value="<?=date('Y-m-d')?>" id="example-date-input"  name="expense_date" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Cost *</label>
                                                                <input type="text" class="form-control" name="expense_cost" maxlength="10" id="defaultconfig" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-top: 10px">
                                                        <div class="col-sm-12 text-right">
                                                            <button type="submit" class="btn btn-primary px-4">Add Expense</button>
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
        title: 'A new News has been added'
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