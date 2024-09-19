
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Services - UHU</title>
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
                                        <h4 class="page-title">Services</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Services</li>
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
                                    <h4 class="card-title">All Services</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                                            <table class="table table-hover mb-0">
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Service</th>
                                                                    <th>Options</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?
                                                                        $count = 1;
                                                                        foreach ($services as $service) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?=$count?></td>
                                                                        <td>
                                                                            <div class="accordion" id="accordionExample">
                                                                                <div class="card border mb-1 shadow-none">
                                                                                    <div class="card-header custom-accordion rounded-0" id="heading<?=$service['service_id']?>" style="background-color: #b7042c !important;">
                                                                                        <a href="" class="text-dark" data-toggle="collapse" data-target="#collapse<?=$service['service_id']?>" aria-expanded="true" aria-controls="collapse<?=$service['service_id']?>">
                                                                                            <?=$service['service_name']?>
                                                                                            <span style="float:right;">Show more <i class="mdi mdi-arrow-down"></i></span>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div id="collapse<?=$service['service_id']?>" class="collapse" aria-labelledby="heading<?=$service['service_id']?>" data-parent="#accordionExample">
                                                                                        <div class="card-body">
                                                                                        <p class="mb-0">
                                                                                            <?=$service['service_description']?>
                                                                                        </p> 
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                                            <div class="dropdown-menu">
                                                                                <? if (in_array(66, $_SESSION['module_id'])){ ?>
                                                                                <a class="dropdown-item" href="<?=base_url()?>Service/edit_service/<?=$service['service_id']?>"><i class="mdi mdi-grease-pencil"></i> Edit Service</a>
                                                                                <?}?>
                                                                                <? if (in_array(68, $_SESSION['module_id'])){ ?>
                                                                                <a class="dropdown-item" href="<?=base_url()?>Service/delete_service/<?=$service['service_id']?>"><i class="mdi mdi-delete"></i> Delete Service</a>
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
                                                        </div><!--end /tableresponsive-->
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
        title: 'A Service has been Deleted'
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