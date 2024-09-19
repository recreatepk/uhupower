
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>User - UHU</title>
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
                                        <h4 class="page-title">Add User</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>user/user">Users</a></li>
                                            <li class="breadcrumb-item active">Add User</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Add a New User</h4>
                                                    <p class="text-muted mb-0">Add a new user and define user group for this user</p>
                                                </div><!--end card-header-->
                                                <div class="card-body">
                                                        <form action="<?=base_url()?>user/adding_user" method="POST" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Employee Code</label>
                                                                        <input type="text" class="form-control" name="employee_code" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Employee Name *</label>
                                                                        <input type="text" class="form-control" name="employee_name" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>CNIC No *</label>
                                                                        <input type="text" class="form-control" name="cnic_no" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Qualification *</label>
                                                                        <input type="text" class="form-control" name="qualification" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Gender</label>
                                                                        <select class="form-control custom-select" style="width: 100%; height:36px;" name="gender">
                                                                                <option value="1">Male</option>
                                                                                <option value="2">Female</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Joining Date *</label>
                                                                        <input type="date" class="form-control" name="joining_date" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Initial Salary *</label>
                                                                        <input type="number" class="form-control" name="employee_initial_salary" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Current Salary *</label>
                                                                        <input type="number" class="form-control" name="employee_salary" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Employee Phone 1 *</label>
                                                                        <input type="text" class="form-control" name="employee_phone1" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Employee Phone 2</label>
                                                                        <input type="text" class="form-control" name="employee_phone2">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Employe Email *</label>
                                                                        <input type="text" class="form-control" name="employee_email" id="employee_email" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Password *</label>
                                                                        <input type="password" class="form-control" name="employee_password" id="employee_password" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label>Active / Inactive</label>
                                                                    <div class="checkbox my-2">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" name="account_active" class="custom-control-input" id="customCheck02" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                                            <label class="custom-control-label" for="customCheck02">Can Login</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Employe Address *</label>
                                                                        <input type="text" class="form-control" name="employee_address" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Warehousing * <code>(What can he see)</code></label>
                                                                        <select class="form-control custom-select" style="width: 100%; height:36px;" name="employee_warehousing_access">
                                                                            <option value="0">None</option>
                                                                            <optgroup label="He can see">
                                                                                
                                                                                <option value="1">Warehouse</option>
                                                                                <option value="2">Store</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Select Employee Type * <code>(Attach to Warehouse/Store)</code></label>
                                                                        <select class="form-control custom-select" style="width: 100%; height:36px;" name="employee_warehousing_id">
                                                                            <option value="0">None</option>
                                                                            <optgroup label="Warehouses">
                                                                                <?
                                                                                    foreach ($warehouses as $warehouse) {
                                                                                        if($warehouse['warehouse_location'] == 0){
                                                                                ?>
                                                                                        <option value="<?=$warehouse['warehouse_id']?>"><?=$warehouse['warehouse_name']?></option>
                                                                                <?
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                
                                                                            </optgroup>
                                                                            <optgroup label="Stores">
                                                                                <?
                                                                                    foreach ($stores as $store) {
                                                                                        if($store['store_location'] == 0){
                                                                                ?>
                                                                                        <option value="<?=$store['store_id']?>"><?=$store['store_name']?></option>
                                                                                <?
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                                
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Employee Designation *</label>
                                                                        <input type="text" class="form-control" name="employee_designation" required="">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Employee User Group *</label>
                                                                        <select class="form-control custom-select" style="width: 100%; height:36px;" name="user_group_id">
                                                                            <optgroup label="Working as">
                                                                                <?
                                                                                    foreach ($user_groups as $user_group) {
                                                                                    
                                                                                ?>
                                                                                <option value="<?=$user_group['user_group_id']?>"><?=$user_group['user_group_name']?></option>
                                                                                <?
                                                                            }
                                                                                ?>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Employee Department *</label>
                                                                        <select class="form-control custom-select" style="width: 100%; height:36px;" name="department_id">
                                                                            <optgroup label="Working in">
                                                                                <?
                                                                                    foreach ($departments as $department) {
                                                                                    
                                                                                ?>
                                                                                <option value="<?=$department['department_id']?>"><?=$department['department_name']?> - <?=$department['department_description']?></option>
                                                                                <?
                                                                            }
                                                                                ?>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <h4 class="card-title">Document Details</h4>  
                                                                    <hr>

                                                                </div>
                                                                
                                                                <div class="col-md-3">
                                                                    <label>Signature<code> (Foramts .png) </code></label>
                                                                    <div class="custom-file mb-3">
                                                                        <input type="file" name="signFile" accept=".png" class="custom-file-input" id="signFile" onchange="showFileName('signFile', 'signLabel')">
                                                                        <label class="custom-file-label" id="signLabel" for="signFile">Choose Signature</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>CV<code> (Foramts .pdf, .jpg, .jpeg, .png) </code></label>
                                                                    <div class="custom-file mb-3">
                                                                        <input type="file" name="cv" accept=".pdf,.jpg,.jpeg,.png" class="custom-file-input" id="cvFile" onchange="showFileName('cvFile', 'cvLabel')">
                                                                        <label class="custom-file-label" id="cvLabel" for="cvFile">Choose CV</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Contract Document<code> (Foramts .pdf, .jpg, .jpeg, .png) </code></label>
                                                                    <div class="custom-file mb-3">
                                                                        <input type="file" name="cd" accept=".pdf,.jpg,.jpeg,.png" class="custom-file-input" id="contractFile" onchange="showFileName('contractFile', 'contractLabel')">
                                                                        <label class="custom-file-label" id="contractLabel" for="contractFile">Choose Contract</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Personal Particulars<code> (Foramts .pdf, .jpg, .jpeg, .png) </code></label>
                                                                    <div class="custom-file mb-3">
                                                                        <input type="file" name="cnic" accept=".pdf,.jpg,.jpeg,.png" class="custom-file-input" id="cnicFile" onchange="showFileName('cnicFile', 'cnicLabel')">
                                                                        <label class="custom-file-label" id="cnicLabel" for="cnicFile">Choose Personal Particulars</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <h4 class="card-title">Resgination (<code>Fill this when Employee is Leaving</code>)</h4>  
                                                                    <hr>

                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Resignation Date</label>
                                                                        <input type="date" class="form-control" name="leaving_date">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Resignation Type</label>
                                                                        <select class="form-control custom-select" style="width: 100%; height:36px;" name="resignation_type">
                                                                                <option value="0">None</option>
                                                                                <option value="1">Resignation</option>
                                                                                <option value="2">Termination</option>
                                                                                <option value="3">Absconder</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Reason</label>
                                                                        <input type="text" class="form-control" name="resignation_reason">
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-sm-12 text-right">
                                                                    <button type="submit" class="btn btn-primary px-4">Create Employee</button>
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
        title: 'User added successfully'
      });
    });
</script>
<?
}
?>
<script>
function showFileName(fileInputId, labelId) {
    var fileInput = document.getElementById(fileInputId);
    var fileName = fileInput.files[0].name;
    var label = document.getElementById(labelId);
    label.innerText = fileName;
}
</script>
<script>
    $(document).ready(function($) {
        document.getElementById("customCheck02").onclick = function(){
        document.getElementById("employee_email").disabled = !this.checked;
        document.getElementById("employee_password").disabled = !this.checked;
}
  });
</script>
<script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "hrm"; // Example: If you're on 1, set it to "1"
  
</script> 
    </body>

</html>