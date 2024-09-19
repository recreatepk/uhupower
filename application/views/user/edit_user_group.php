<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>User Group - UHU</title>
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
                                        <h4 class="page-title">Edit User Group</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>user/user_group">User Groups</a></li>
                                            <li class="breadcrumb-item active">Edit User Group</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">User Group</h4>
                                                <p class="text-muted mb-0">Edit a group and define permission for that group</p>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <form action="<?=base_url()?>user/editing_user_group/<?=$user_group[0]['user_group_id']?>" method="POST">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="username">Name</label>
                                                                <input type="text" class="form-control" name="user_group_name" value="<?=$user_group[0]['user_group_name']?>" id="username" required="">
                                                            </div>
                                                        </div>
                                                            
                                                        
                                                            
                                                    </div>
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Module Name</th>
                                                                        <th>Create</th>
                                                                        <th>View</th>
                                                                        <th>Update</th>
                                                                        <th>Delete</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <? foreach ($main_modules as $module) { ?>
                                                                    <tr>
                                                                        <td>
                                                                        <?
                                                                            echo $module['name'];
                                                                        ?>
                                                                        </td>
                                                                        <td>
                                                                             <? 
                                                                            foreach ($modules as $permission) { 
                                                                                if ($permission['main_module_id'] == $module['main_module_id']) {
                                                                                    if (substr($permission['module_name'],0,1) == 'A') { ?>
                                                                                         <div class="checkbox my-2">
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input" id="customCheck<?=$permission['module_id']?>" data-parsley-multiple="groups" data-parsley-mincheck="2" name="permission[]" value="<?=$permission['module_id']?>" <?
                                                                                                foreach ($permissions_given as $permission2) {
                                                                                                    if ($permission2['module_id'] == $permission['module_id']) {
                                                                                                        echo "checked";
                                                                                                    }
                                                                                                }
                                                                                                ?>>
                                                                                                <label class="custom-control-label" for="customCheck<?=$permission['module_id']?>"><?=$permission['module_name']?></label>
                                                                                            </div>
                                                                                        </div>
                                                                            <?
                                                                                    }
                                                                                }
                                                                            }   
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                             <? 
                                                                            foreach ($modules as $permission) { 
                                                                                if ($permission['main_module_id'] == $module['main_module_id']) {
                                                                                    if (substr($permission['module_name'],0,1) == 'V') { ?>
                                                                                         <div class="checkbox my-2">
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input" id="customCheck<?=$permission['module_id']?>" data-parsley-multiple="groups" data-parsley-mincheck="2" name="permission[]" value="<?=$permission['module_id']?>" <?
                                                                                                foreach ($permissions_given as $permission2) {
                                                                                                    if ($permission2['module_id'] == $permission['module_id']) {
                                                                                                        echo "checked";
                                                                                                    }
                                                                                                }
                                                                                                ?>>
                                                                                                <label class="custom-control-label" for="customCheck<?=$permission['module_id']?>"><?=$permission['module_name']?></label>
                                                                                            </div>
                                                                                        </div>
                                                                            <?
                                                                                    }
                                                                                }
                                                                            }   
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <? 
                                                                            foreach ($modules as $permission) { 
                                                                                if ($permission['main_module_id'] == $module['main_module_id']) {
                                                                                    if (substr($permission['module_name'],0,1) == 'E' || substr($permission['module_name'],0,1) == 'R') { ?>
                                                                                         <div class="checkbox my-2">
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input" id="customCheck<?=$permission['module_id']?>" data-parsley-multiple="groups" data-parsley-mincheck="2" name="permission[]" value="<?=$permission['module_id']?>" <?
                                                                                                foreach ($permissions_given as $permission2) {
                                                                                                    if ($permission2['module_id'] == $permission['module_id']) {
                                                                                                        echo "checked";
                                                                                                    }
                                                                                                }
                                                                                                ?>>
                                                                                                <label class="custom-control-label" for="customCheck<?=$permission['module_id']?>"><?=$permission['module_name']?></label>
                                                                                            </div>
                                                                                        </div>
                                                                            <?
                                                                                    }
                                                                                }
                                                                            }   
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <? 
                                                                            foreach ($modules as $permission) { 
                                                                                if ($permission['main_module_id'] == $module['main_module_id']) {
                                                                                    if (substr($permission['module_name'],0,1) == 'D') { ?>
                                                                                         <div class="checkbox my-2">
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                <input type="checkbox" class="custom-control-input" id="customCheck<?=$permission['module_id']?>" data-parsley-multiple="groups" data-parsley-mincheck="2" name="permission[]" value="<?=$permission['module_id']?>" <?
                                                                                                foreach ($permissions_given as $permission2) {
                                                                                                    if ($permission2['module_id'] == $permission['module_id']) {
                                                                                                        echo "checked";
                                                                                                    }
                                                                                                }
                                                                                                ?>>
                                                                                                <label class="custom-control-label" for="customCheck<?=$permission['module_id']?>"><?=$permission['module_name']?></label>
                                                                                            </div>
                                                                                        </div>
                                                                            <?
                                                                                    }
                                                                                }
                                                                            }   
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?
                                                                        }
                                                                    ?>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="row">
                                                        <div class="col-sm-12 text-right">
                                                            <button type="submit" class="btn btn-primary px-4">Edit Group</button>
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
    title: 'A User Group has been edited successfully'
  });
});
</script>
<?
}
?>
<script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "Settings"; // Example: If you're on 1, set it to "1"

  
</script>
    </body>

</html>