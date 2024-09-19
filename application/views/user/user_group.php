
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>User Groups - UHU</title>
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
                                        <h4 class="page-title">User Groups</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">User Groups</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">User Groups</h4>
                                                <p class="text-muted mb-0">
                                                    <code>User Grouping</code> (What user can do in the software).
                                                </p>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Group Name</th>
                                                            <th>Permission</th>
                                                            <th>Option</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <? $count = 1;
                                                            foreach ($user_groups as $user_group){
                                                            ?>
                                                             <tr>
                                                                <th scope="row"><?=$count?></th>
                                                                <td><?=$user_group['user_group_name']?></td>
                                                                <td>
                                                                    <?
                                                                        $this->db->select('mm.name AS main_module_name');
                                                                        $this->db->from('permission AS p');
                                                                        $this->db->join('module AS m', 'p.module_id = m.module_id');
                                                                        $this->db->join('main_module AS mm', 'm.main_module_id = mm.main_module_id');
                                                                        $this->db->where('p.user_group_id', $user_group['user_group_id']);
                                                                        $this->db->distinct();
                                                                        $mainModules = $this->db->get()->result_array();
                                                                    ?>
                                                                    <a class="btn btn-primary mb-2 mb-lg-0" data-toggle="collapse" href="#collapseExample<?=$user_group['user_group_id']?>" aria-expanded="true" aria-controls="collapseExample">
                                                                        <i class="mdi mdi-arrow-down-bold"></i> Show All Modules
                                                                    </a>
                                                                    <? 
                                                                        foreach ($mainModules as $mainModules) {

                                                                    ?>
                                                                            <div class="collapse" id="collapseExample<?=$user_group['user_group_id']?>">
                                                                                <div class="card mb-0 card-body">
                                                                                    <ul class="list-group">
                                                                                        <li class="list-group-item"><i class='la la-unlock text-info mr-2'></i><?=$mainModules['main_module_name']?></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                    <?
                                                                        }

                                                                    ?>
                                                                    
                                            
                                                                </td>
                                                                <td>
                                                                    <?
                                                                    if ($user_group['user_group_id'] == 1) {
                                                                        echo "System genrated Group (Can't modify)";
                                                                    }elseif ($user_group['user_group_id'] == 2) {
                                                                        ?>
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                                    <div class="dropdown-menu">
                                                                        <? if (in_array(10, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>user/edit_user_group/<?=$user_group['user_group_id']?>"><i class="mdi mdi-grease-pencil"></i> Edit Group</a>
                                                                        <?}?>
                                                                    </div>
                                                                        <?
                                                                    }else{
                                                                        ?>
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                                    <div class="dropdown-menu">
                                                                        <? if (in_array(10, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>user/edit_user_group/<?=$user_group['user_group_id']?>"><i class="mdi mdi-grease-pencil"></i> Edit Group</a>
                                                                        <?}?>
                                                                        <? if (in_array(12, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>user/delete_user_group/<?=$user_group['user_group_id']?>"><i class="mdi mdi-delete"></i> Delete Group</a>
                                                                        <?}?>
                                                                    </div>
                                                                    <?
                                                                     }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?
                                                            $count++;
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table><!--end /table-->
                                                </div><!--end /tableresponsive-->
                                            </div><!--end card-body-->
                                        </div><!--end card-->
                                    </div> <!-- end col -->
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
        title: 'User Group Deleted successfully'
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