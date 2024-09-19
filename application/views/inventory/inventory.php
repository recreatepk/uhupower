<?
    // print_r($_SESSION['module_id']);die;
?>
<!DOCTYPE html>
<html lang="en">

<? $this->view('inc/header.php'); ?>
<title>Inventory - UHU</title>

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
                                    <h4 class="page-title">Inventory</h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">Inventory</li>
                                    </ol>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">All Goods
                                                <?if ($check == 1) {
                                                    echo "in ";
                                                    echo "<code>".$warehouses[0]['warehouse_name']."</code>";
                                                }if ($check == 0) {
                                                    echo "in ";
                                                    echo "<code>".$stores[0]['store_name']."</code>";
                                                } ?>
                                            </h4>
                                            <p class="text-muted mb-0">Goods in
                                                <? if ($check == 1) {
                                                    echo "Warehouse";
                                                }if ($check == 0) {
                                                    echo "Store";
                                                }if ($check == 3){
                                                    echo "Multiple locations";
                                                } ?> can be viewed here
                                            </p>
                                        </div>
                                        <!--end card-header-->
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Category</th>
                                                            <th>Quantity</th>
                                                            <th
                                                                <?= $retVal = ($check == 1 || $check == 0) ? "style='display: none;'" : '' ;?>>
                                                                Storage Name</th>
                                                            <th
                                                                <?=$retVal = ($check == 1 || $check == 0) ? "style='display: none;'" : '' ;?>>
                                                                Storage Location</th>
                                                            <th>View Sr. #</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?
                                                                $count = 1;
                                                                foreach ($inventory as $inv) {
                                                            ?>
                                                        <tr>
                                                            <td><?=$count?></td>
                                                            <td style="text-decoration: underline dotted;"
                                                                title="<?=$inv['product_description']?>">
                                                                <?=$inv['product_name']?></td>
                                                            <td style="text-decoration: underline dotted;"
                                                                title="<?=$inv['product_category_desc']?>">
                                                                <?=$inv['product_category_name']?></td>
                                                            <td><?=$inv['inventory_product_qty']?></td>
                                                            <td
                                                                <?=$retVal = ($check == 1 || $check == 0) ? "style='display: none;'" : '' ;?>>
                                                                <?
                                                                        if ($inv['inventory_location'] == 1) {
                                                                           foreach ($warehouses as $warehouse) {
                                                                               if ($inv['inventory_loc_id'] == $warehouse['warehouse_id']) {
                                                                                    echo $warehouse['warehouse_name'];
                                                                                    $location = $warehouse['warehouse_address'];
                                                                               }
                                                                           }
                                                                        }else{
                                                                            foreach ($stores as $store) {
                                                                               if ($inv['inventory_loc_id'] == $store['store_id']) {
                                                                                    echo $store['store_name'];
                                                                               }
                                                                           }
                                                                        }
                                                                    ?>
                                                            </td>
                                                            <td
                                                                <?=$retVal = ($check == 1 || $check == 0) ? "style='display: none;'" : '' ;?>>
                                                                <?=$location?></td>
                                                            <td>
                                                                <a class="btn btn-primary mb-2 mb-lg-0"
                                                                    data-toggle="collapse"
                                                                    href="#collapseExample<?=$inv['inventory_id']?>"
                                                                    aria-expanded="true"
                                                                    aria-controls="collapseExample">
                                                                    <i class="mdi mdi-arrow-down-bold"></i> Check Sr. #
                                                                </a>
                                                                <? 
                                                                        foreach ($unique_identifiers as $unique_identifier) {
                                                                            if ($unique_identifier['product_id'] == $inv['inventory_product_id']) {
                                                                            

                                                                    ?>
                                                                <div class="collapse"
                                                                    id="collapseExample<?= $inv['inventory_id'] ?>">
                                                                    <ul class="list-group">
                                                                        <li class="list-group-item"><i
                                                                                class='mdi mdi-barcode-scan text-info mr-2'></i><?= $unique_identifier['sr_no'] ?>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <?
                                                                            }
                                                                        }

                                                                    ?>
                                                            </td>

                                                        </tr>
                                                        <?
                                                                $count++;
                                                                }
                                                            ?>
                                                    </tbody>
                                                </table>
                                                <!--end /table-->
                                            </div>
                                        </div>
                                        <!--end card-body-->
                                    </div>
                                    <!--end card-->
                                </div>
                            </div>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
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
            title: 'A Product has been Deleted'
        });
    });
    </script>
    <?
}
?>
    <script>
    // Get the current page or section identifier (you can customize this part)
    var currentPage = "Inventory"; // Example: If you're on 1, set it to "1"
    </script>

</body>

</html>
