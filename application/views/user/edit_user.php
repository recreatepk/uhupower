
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
                                        <h4 class="page-title">Edit User</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>user/user">Users</a></li>
                                            <li class="breadcrumb-item active">Edit User</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Edit a User</h4>
                                                    <p class="text-muted mb-0">Edit user and define user group for this user</p>
                                                </div><!--end card-header-->
                                                <div class="card-body">
                                                    <form action="<?=base_url()?>user/editing_user/<?=$users[0]['employee_id']?>" method="POST">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Employee Code</label>
                                                                        <input type="text" class="form-control" name="employee_code" required="" value="<?=$users[0]['employee_code']?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Employee Name *</label>
                                                                        <input type="text" class="form-control" name="employee_name" required="" value="<?=$users[0]['employee_name']?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>CNIC No *</label>
                                                                        <input type="text" class="form-control" name="cnic_no" required="" value="<?=$users[0]['cnic_no']?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Qualification *</label>
                                                                        <input type="text" class="form-control" name="qualification" required="" value="<?=$users[0]['qualification']?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Gender</label>
                                                                        <select class="form-control custom-select" style="width: 100%; height:36px;" name="gender">
                                                                                <option value="1" <?=$retVal = ($users[0]['gender'] == 1) ? 'selected' : '' ;?>>Male</option>
                                                                                <option value="2" <?=$retVal = ($users[0]['gender'] == 2) ? 'selected' : '' ;?>>Female</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Joining Date *</label>
                                                                        <input type="date" class="form-control" name="joining_date" required="" value="<?=$users[0]['joining_date']?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Initial Salary *</label>
                                                                        <input type="number" class="form-control" name="employee_initial_salary" required="" value="<?=$users[0]['employee_initial_salary']?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>Current Salary *</label>
                                                                        <input type="number" class="form-control" name="employee_salary" required="" value="<?=$users[0]['employee_salary']?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Employee Phone 1 *</label>
                                                                        <input type="text" class="form-control" name="employee_phone1" required="" value="<?=$users[0]['employee_phone1']?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Employee Phone 2</label>
                                                                        <input type="text" class="form-control" name="employee_phone2" value="<?=$users[0]['employee_phone2']?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>Employee Email *</label>
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
                                                                        <input type="text" class="form-control" name="employee_address" required="" value="<?=$users[0]['employee_address']?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Warehousing * <code>(What can he see)</code></label>
                                                                        <select class="form-control custom-select" style="width: 100%; height:36px;" name="employee_warehousing_access">
                                                                            <option value="0">None</option>
                                                                            <optgroup label="He can see">
                                                                                
                                                                                <option value="1" <?=$retVal = ($users[0]['employee_warehousing_access'] == 1) ? 'selected' : '' ;?>>Warehouse</option>
                                                                                <option value="2" <?=$retVal = ($users[0]['employee_warehousing_access'] == 2) ? 'selected' : '' ;?>>Store</option>
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
                                                                                        <option <?=$retVal = ($users[0]['employee_warehousing_id'] == $warehouse['warehouse_id'] && $users[0]['employee_warehousing_access'] == 1) ? 'selected' : '' ;?> value="<?=$warehouse['warehouse_id']?>"><?=$warehouse['warehouse_name']?></option>
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
                                                                                        <option <?=$retVal = ($users[0]['employee_warehousing_id'] == $store['store_id'] && $users[0]['employee_warehousing_access'] == 2) ? 'selected' : '' ;?> value="<?=$store['store_id']?>"><?=$store['store_name']?></option>
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
                                                                        <input type="text" class="form-control" name="employee_designation" required="" value="<?=$users[0]['employee_designation']?>">
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
                                                                                <option <?=$retVal = ($users[0]['user_group_id'] == $user_group['user_group_id']) ? 'selected' : '' ;?> value="<?=$user_group['user_group_id']?>"><?=$user_group['user_group_name']?></option>
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
                                                                                <option <?=$retVal = ($department['department_id'] == $users[0]['department_id']) ? 'selected' : '' ;?> value="<?=$department['department_id']?>"><?=$department['department_name']?> - <?=$department['department_description']?></option>
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
                                                                    <?
                                                                    if (isset($users[0]['employee_sign_file']) && !empty($users[0]['employee_sign_file'])) {
                                                                    ?>
                                                                        <a class="btn btn-primary px-4" href="<?=base_url()?>uploads/<?=$users[0]['employee_code']?>/<?=$users[0]['employee_sign_file']?>" download>CV Donwload</a>
                                                                    <?
                                                                    }else{
                                                                    ?>
                                                                        <a class="btn btn-primary px-4" style="color: white; pointer-events: none;">No file Found</a>
                                                                    <?
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>CV<code> (Foramts .pdf, .jpg, .jpeg, .png) </code></label>
                                                                    <div class="custom-file mb-3">
                                                                        <input type="file" name="cv" accept=".pdf,.jpg,.jpeg,.png" class="custom-file-input" id="cvFile" onchange="showFileName('cvFile', 'cvLabel')">
                                                                        <label class="custom-file-label" id="cvLabel" for="cvFile">Choose CV</label>
                                                                    </div>
                                                                    <?
                                                                    if (isset($users[0]['employee_cv_file']) && !empty($users[0]['employee_cv_file'])) {
                                                                    ?>
                                                                        <a class="btn btn-primary px-4" href="<?=base_url()?>uploads/<?=$users[0]['employee_code']?>/<?=$users[0]['employee_cv_file']?>" download>CV Donwload</a>
                                                                    <?
                                                                    }else{
                                                                    ?>
                                                                        <a class="btn btn-primary px-4" style="color: white; pointer-events: none;">No file Found</a>
                                                                    <?
                                                                    }
                                                                    ?>
                                                                    
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Contract Document<code> (Foramts .pdf, .jpg, .jpeg, .png) </code></label>
                                                                    <div class="custom-file mb-3">
                                                                        <input type="file" name="cd" accept=".pdf,.jpg,.jpeg,.png" class="custom-file-input" id="contractFile" onchange="showFileName('contractFile', 'contractLabel')">
                                                                        <label class="custom-file-label" id="contractLabel" for="contractFile">Choose Contract</label>
                                                                    </div>
                                                                    <?
                                                                    if (isset($users[0]['employee_cd_file']) && !empty($users[0]['employee_cd_file'])) {
                                                                    ?>
                                                                        <a class="btn btn-primary px-4" href="<?=base_url()?>uploads/<?=$users[0]['employee_code']?>/<?=$users[0]['employee_cd_file']?>" download>Contract Document Donwload</a>
                                                                    <?
                                                                    }else{
                                                                    ?>
                                                                        <a class="btn btn-primary px-4" style="color: white; pointer-events: none;">No file Found</a>
                                                                    <?
                                                                    }
                                                                    ?>
                                                                    
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label>Personal Particulars<code> (Foramts .pdf, .jpg, .jpeg, .png) </code></label>
                                                                    <div class="custom-file mb-3">
                                                                        <input type="file" name="cnic" accept=".pdf,.jpg,.jpeg,.png" class="custom-file-input" id="cnicFile" onchange="showFileName('cnicFile', 'cnicLabel')">
                                                                        <label class="custom-file-label" id="cnicLabel" for="cnicFile">Choose CNIC</label>
                                                                    </div>
                                                                    <?
                                                                    if (isset($users[0]['employee_cnic_file']) && !empty($users[0]['employee_cnic_file'])) {
                                                                    ?>
                                                                        <a class="btn btn-primary px-4" href="<?=base_url()?>uploads/<?=$users[0]['employee_code']?>/<?=$users[0]['employee_cnic_file']?>" download>Personal Particulars Donwload</a>
                                                                    <?
                                                                    }else{
                                                                    ?>
                                                                        <a class="btn btn-primary px-4" style="color: white;pointer-events: none;" >No file Found</a>
                                                                    <?
                                                                    }
                                                                    ?>

                                                                </div>
                                                                <div class="col-md-12">
                                                                    <h4 class="card-title">Resgination (<code>Fill this when Employee is Leaving</code>)</h4>  
                                                                    <hr>

                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Resignation Date</label>
                                                                        <input type="date" class="form-control" value="<?=$users[0]['leaving_date']?>" name="leaving_date">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Resignation Type</label>
                                                                        <select class="form-control custom-select" style="width: 100%; height:36px;" name="resignation_type">
                                                                                <option <?=$retVal = ($users[0]['resignation_type'] == 0) ? 'selected' : '' ;?> value="0">None</option>
                                                                                <option <?=$retVal = ($users[0]['resignation_type'] == 1) ? 'selected' : '' ;?> value="1">Resignation</option>
                                                                                <option <?=$retVal = ($users[0]['resignation_type'] == 2) ? 'selected' : '' ;?> value="2">Termination</option>
                                                                                <option <?=$retVal = ($users[0]['resignation_type'] == 3) ? 'selected' : '' ;?> value="3">Absconder</option>
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Reason</label>
                                                                        <input type="text" class="form-control" name="resignation_reason" value="<?=$users[0]['resignation_reason']?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-sm-12 text-right">
                                                                    <button type="submit" class="btn btn-primary px-4">Edit Employee</button>
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
        icon: 'warning',
        title: 'User has been Edited successfully'
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