<?php

/**
 * @var cache
 * 
 */

$CI = &get_instance(); // Access CodeIgniter's instance

$CI->load->database(); // Load the database library if not already loaded
$CI->load->driver('cache', ['adapter' => 'file']); // Load the cache driver

$cache_key = 'office_data';

if (!($office_data = $CI->cache->get($cache_key))) {
    // Cache not available or expired, fetch data from the database
    $query = $CI->db->get('office');
    $office_data = $query->row();

    // Save data in the cache for future use
    $CI->cache->save($cache_key, $office_data);
}
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>GRN - UHU</title>
    <body class="dark-sidenav" >
        <!-- Left Sidenav -->
       <? $this->view('inc/sidebar.php'); ?>
        <!-- end left-sidenav-->
        

        <div class="page-wrapper">
            <!-- Top Bar Start -->
            <? $this->view('inc/nav_bar.php'); ?>
            <!-- Top Bar End -->
<style type="text/css">
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row" >
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="page-title">Goods Receive Notes</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>Quotation/gate_pass">GRNs</a></li>
                                            <li class="breadcrumb-item active">Goods Receive Note</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row--> 
                                <div class="row" id='printme' >
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h2 style="text-align: center;margin: 0px;">Goods Receiving Note</h2>
                                                <h4 style="text-align: center;margin: 0px;">GRN - 0<?=$pos[0]['purchase_order_id']?></h4>
                                                <h4 style="text-align: center;margin-top: 0px;"><?=date('d-m-Y',strtotime($dcs[0]['purchase_dc_date']))?></h4>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p style="background: #b7042c;color: white;font-size: 17px;font-weight: 700;padding-left: 10px;">Purchase From:</p>
                                                        <p style="margin: 0;font-size: 17px;"><?=$suppliers[0]['sup_cus_company']?></p>
                                                        <p style="margin: 0;font-size: 17px;"><?=$suppliers[0]['sup_cus_phone1']?></p>
                                                        <p style="margin: 0;font-size: 17px;"><?=$suppliers[0]['sup_cus_address']?></p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p style="background: #b7042c;color: white;font-size: 17px;font-weight: 700;padding-left: 10px;">Ship to:</p>
                                                        <p style="margin: 0;font-size: 17px; text-align: right;"><?=$office_data->company_name?></p>
                                                        <p style="margin: 0;font-size: 17px; text-align: right;"><?=$office_data->company_phone1?></p>
                                                        <p style="margin: 0;font-size: 17px; text-align: right;"><?=$office_data->company_address?></p>
                                                    </div>
                                                </div>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Product</th>
                                                                <th>Receivable Quantity</th>
                                                                <th>Received Quantity</th>
                                                                <th>Receive</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?
                                                                $count = 1;
                                                                foreach ($dcs as $dc) {
                                                            ?>
                                                                        <tr>
                                                                            <td><?=$count?></td>
                                                                            <td><?=$dc['product_name']?><p style="font-size: 12px;"><?=$dc['product_description']?></p></td>
                                                                            <td><?=$dc['purchase_dc_qty']?></td>
                                                                            <td><?=$dc['purchase_dc_qty_rcv']?></td>
                                                                            <td>
                                                                                <?
                                                                                    if ($dc['purchase_dc_qty'] == $dc['purchase_dc_qty_rcv']) {
                                                                                ?>
                                                                                         <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> Received</span>
                                                                                <?
                                                                                    }else{
                                                                                ?>
                                                                                    <button type="button" class="btn btn-primary no-print" data-toggle="modal" data-target="#bd-example-modal-xl" onclick="setReceivedQty(<?=$dc['purchase_dc_qty']?>,<?=$dc['purchase_dc_qty_rcv']?>,<?=$dc['purchase_dc_id']?>,<?=$dc['purchase_dc_product_id']?>)" data-loop-count="<?=$dc['purchase_dc_qty']?>">Click Here to Receive</button>

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
                                                    </table>
                                                </div>
                                            </div><!--end card-body-->
                                        </div><!--end card-->
                                    </div>
                                </div>                                                             
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <button id="print" class="btn btn-primary" onclick="printContent('printme');" >Print</button>
                    <!-- end page title end breadcrumb -->
                    
<div class="modal fade bd-example-modal-xl" id="bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title m-0" id="myExtraLargeModalLabel">Receiving Details</h6>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="la la-times"></i></span>
                </button>
            </div><!--end modal-header-->
            
            <div class="modal-body">
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-toggle="tab" href="#nosr" role="tab" aria-selected="true">Without Sr #</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-toggle="tab" href="#sr" role="tab" aria-selected="false">With Sr #</a>
                    </li>
                </ul>
                 <div class="tab-content">
                    <div class="tab-pane p-3 active" id="nosr" role="tabpanel">
                        <form action="<?=base_url()?>Delivery_challan/receive_items/1/<?=$pos[0]['purchase_order_id']?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Quantity Received</label>
                                        <input type="number" class="form-control" name="purchase_dc_qty_rcv" id="purchase_dc_qty_rcv" required="">
                                        <input type="text" class="form-control" name="purchase_dc_id" id="purchase_dc_id" hidden>
                                        <input type="text" class="form-control" name="product_id" id="product_id" hidden>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary px-4">Receive Items</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane p-3" id="sr" role="tabpanel">
                        <form action="<?=base_url()?>Delivery_challan/receive_items/2/<?=$pos[0]['purchase_order_id']?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Quantity Received</label>
                                        <input type="number" class="form-control" name="purchase_dc_qty_rcv" id="purchase_dc_qty_rcv2" required="">
                                        <input type="text" class="form-control" name="product_id" id="product_id2" hidden>
                                        <input type="text" class="form-control" name="purchase_dc_id" id="purchase_dc_id2" hidden>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group" id="dynamic-input-container">
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-4">Receive Items</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--end modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div><!--end modal-footer-->
            
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div><!--end modal-->
                </div><!-- container -->

               <?$this->view('inc/footer_text.php');?>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        

<?$this->view('inc/footer.php');?>

        <script>
            function printContent(el){
                var restorepage = $('body').html();
                var printcontent = $('#' + el).clone();
                $('body').empty().html(printcontent);
                window.print();
                $('body').html(restorepage);
            }
        </script>
        <script>
            function setReceivedQty(qty,rcv_qty,id,product_id) {
                var qty_limit = qty - rcv_qty;
                document.getElementById("purchase_dc_qty_rcv").value = qty_limit;
                document.getElementById("purchase_dc_qty_rcv2").value = qty_limit;
                document.getElementById("purchase_dc_id").value = id;
                document.getElementById("purchase_dc_id2").value = id;
                document.getElementById("product_id").value = product_id;
                document.getElementById("product_id2").value = product_id;
                var dynamicInputContainer = $("#dynamic-input-container");

                // Clear previous dynamic inputs
                dynamicInputContainer.empty();

                // Generate and append the dynamic inputs
                for (var i = 0; i < qty_limit; i++) {
                    var inputHtml = '<div clas="col-md-6">' +
                                        '<div class="form-group">' +
                                            '<label>Sr #</label>' +
                                            '<input type="text" class="form-control" name="sr_no[]">' +
                                        '</div>'+
                                    '</div>';

                    dynamicInputContainer.append(inputHtml);
                }

                 // Set the maximum value for the input field
                $("#purchase_dc_qty_rcv").attr("max", qty_limit);
                
                // Add an event listener to the input field to restrict input
                $("#purchase_dc_qty_rcv").on("input", function() {
                    var inputValue = $(this).val();
                    if (inputValue > qty_limit) {
                        $(this).val(qty_limit);
                    }
                    if (inputValue <= 0) {
                        $(this).val(1);
                    }
                });
                // Set the maximum value for the input field
                $("#purchase_dc_qty_rcv2").attr("max", qty_limit);
                
                // Add an event listener to the input field to restrict input
                $("#purchase_dc_qty_rcv2").on("input", function() {
                    var inputValue = $(this).val();
                    if (inputValue > qty_limit) {
                        $(this).val(qty_limit);
                    }
                    if (inputValue <= 0) {
                        $(this).val(1);
                    }
                });

            }
        </script>
         <script>
    // const inputField = document.getElementById('purchase_dc_qty_rcv2');
    // const inputContainer = document.getElementById('dynamic-input-container');
    const inputCountField = document.getElementById('purchase_dc_qty_rcv2');
    const inputContainer = document.getElementById('dynamic-input-container');

     inputCountField.addEventListener('input', () => {
      const inputCount = parseInt(inputCountField.value);

      // Remove existing input boxes
      inputContainer.innerHTML = '';

      if (inputCount > 0) {
        for (let i = 1; i <= inputCount; i++) {
          const newInputHtml = '<div class="col-md-12">' +
            '<div class="form-group">' +
            '<label>Sr #</label>' +
            `<input type="text" class="form-control" name="sr_no[]">` +
            '</div>' +
            '</div>';

          const newInput = document.createElement('div');
          newInput.innerHTML = newInputHtml;
          inputContainer.appendChild(newInput);
        }
      }
    });
  </script>
  <script>
  // Get the current page or section identifier (you can customize this part)
  var currentPage = "Inventory"; // Example: If you're on 1, set it to "1"

  
</script>
    </body>

</html>
