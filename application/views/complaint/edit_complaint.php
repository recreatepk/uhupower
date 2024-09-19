
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
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>News">News</a></li>
                                            <li class="breadcrumb-item active">Edit News</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Edit a News</h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <form action="<?=base_url()?>News/editing_news/<?=$news[0]['news_id']?>" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>News Heading</label>
                                                                <input type="text" class="form-control" name="news_heading" required="" value="<?=$news[0]['news_heading']?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label>News Description</label>
                                                                <input type="text" class="form-control" name="news_description" maxlength="250" id="defaultconfig" required="" value="<?=$news[0]['news_description']?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-top: 10px">
                                                        <div class="col-sm-12 text-right">
                                                            <button type="submit" class="btn btn-primary px-4">Create News</button>
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
        icon: 'success',
        title: 'news has been Updated'
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