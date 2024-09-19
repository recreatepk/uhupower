<?
    // print_r($_SESSION['module_id']);die;
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>News - UHU</title>
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
                                        <h4 class="page-title">News</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">News</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">News</h4>
                                                <p class="text-muted mb-0">View News, Add or Delete.</p>
                                                <p class="text-muted mb-0">Select Time Frame</p>
                                                <form action="<?=base_url()?>News" method="POST">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <div class="input-group">                                        
                                                                <input type="text" class="form-control" name="dates" value="<?=$date?>">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="dripicons-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-primary px-4 text-right">Select</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Date Added</th>
                                                            <th>Name</th>
                                                            <th>Description</th>
                                                            <th>Options</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?
                                                                $count = 1;
                                                                foreach ($newses as $news) {
                                                            ?>
                                                            <tr>
                                                                <td><?=$count?></td>
                                                                <td><?=$news['add_date']?></td>
                                                                <td><?=$news['news_heading']?></td>
                                                                <td><?=$news['news_description']?></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-arrow-down-bold"></i> Options <span class="caret"></span> </button>
                                                                    <div class="dropdown-menu">
                                                                        <? if (in_array(2, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>news/edit_news/<?=$news['news_id']?>"><i class="mdi mdi-grease-pencil"></i> Edit news</a>
                                                                        <?}?>
                                                                        <? if (in_array(3, $_SESSION['module_id'])){ ?>
                                                                        <a class="dropdown-item" href="<?=base_url()?>news/delete_news/<?=$news['news_id']?>"><i class="mdi mdi-delete"></i> Delete news</a>
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
                                                </div> 
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
        title: 'A News has been Deleted'
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