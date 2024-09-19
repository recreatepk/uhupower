
<?php
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

$warehouses = $CI->db->where('warehouse_location',0)->get('warehouse')->result_array();
$stores = $CI->db->where('store_location',0)->get('store')->result_array();
?>
<?
    $att_count = 0;
    foreach ($today_attendances as $today_attendance) {
        if ($today_attendance['attendance_present'] == 1) {
            $att_count++;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

   <? $this->view('inc/header.php'); ?>
   <title>Dashboard - UHU</title>
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
                                        <h4 class="page-title">Dasboard</h4>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active">Home</li>
                                        </ol>
                                    </div><!--end col-->
                                </div><!--end row-->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body" style="justify-content: space-around;display: flex;">
                                                <span style="font-size: 25px;font-family: monospace;">
                                                    <?
                                                        date_default_timezone_set('asia/karachi'); // Set your timezone here

                                                        $currentTime = date('H:i'); // Get the current time in 24-hour format

                                                        $dayOfWeek = date('D'); // Get the current day of the week (3-letter abbreviation)

                                                        if ($currentTime >= '05:00' && $currentTime < '12:00') {
                                                            echo "<span><i data-feather='sun'></i></span>";
                                                            echo " Good Morning have a Beautiful Day, ";
                                                            echo $_SESSION['username'];
                                                            echo ", Current Time is: ";
                                                            echo "<span id='span'></span>";
                                                        } elseif ($currentTime >= '12:00' && $currentTime < '17:00') {
                                                            echo "<span><i data-feather='sun'></i></span>";
                                                            echo " Good Afternoon, ";
                                                            echo $_SESSION['username'];
                                                            echo ", Current Time is: ";
                                                            echo "<span id='span'></span>";
                                                        } elseif ($currentTime >= '17:00' && $currentTime < '20:00') {
                                                            echo "<span><i data-feather='sunset'></i></span>";
                                                            echo " Good Evening, ";
                                                            echo $_SESSION['username'];
                                                            echo ", Current Time is: ";
                                                            echo "<span id='span'></span>";
                                                        } else {
                                                            echo "<span><i data-feather='moon'></i></span>";
                                                            echo " Good Night, ";
                                                            echo $_SESSION['username'];
                                                            if ($dayOfWeek === 'Sat') {
                                                                echo " have a Beautiful Weekend";
                                                            }
                                                            echo ", Current Time is: ";
                                                            echo "<span id='span'></span>";
                                                        }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?
                                if (in_array(77, $_SESSION['module_id'])) {
                                    if (isset($news) || $news != '' || !empty($news)) {
                                ?>
                                <div class="row">
                                    <div class="col-lg-6 text-center">
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?
                                                    $iteration = 0;
                                                    foreach ($news as $new) {
                                                        $activeClass = ($iteration === 0) ? 'active' : '';
                                                ?>
                                                        <div class="carousel-item <?=$activeClass?>">
                                                            <div class="text-center cart-promo">
                                                            <img src="<?=base_url()?>uploads/company/<?=$office_data->company_logo_name?>" alt="" height="50" class="mb-2" style="margin-bottom: 2.5rem !important;">
                                                            <h4 class=""><?=$new['news_heading']?></h4>
                                                            <p class="font-13" style="padding: 10px;"><?=$new['news_description']?></p>
                                                                                                    
                                                            </div>
                                                        </div>
                                                <?
                                                        // Increment the iteration count
                                                        $iteration++;
                                                    }
                                                ?>
                                                
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div><!--end col-->
                                    <?
                                        if (isset($news[0]['news_description'])) {
                                    ?>
                                    <div class="col-lg-6  align-self-center">
                                        <div class="p-5">
                                            <span class="bg-soft-primary p-2 rounded">Most Recent News</span>
                                            <h1 class="my-4 font-weight-bold"><?=$retVal = (isset($news[0]['news_heading'])) ? $news[0]['news_heading'] : '' ;?></h1>
                                            <p class="font-14 text-muted"><?=$retVal = (isset($news[0]['news_description'])) ? $news[0]['news_description'] : '' ;?></p>
                                            
                                        </div>
                                    </div><!--end col-->
                                    <?
                                        }
                                    ?>
                                </div>
                                <?
                                }
                                    }
                                if (in_array(78, $_SESSION['module_id'])) {
                                ?>
                                <div class="row">
                                    <div class="row justify-content-center" style="display: contents;">
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card report-card">
                                                <div class="card-body">
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col">
                                                            <p class="text-dark mb-1 font-weight-semibold">Employee Present Today</p>
                                                            <h3 class="my-2"><?=$att_count?></h3>
                                                            <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i>98%</span> Attandence Today</p>
                                                        </div>
                                                        <div class="col-auto align-self-center">
                                                            <div class="report-main-icon bg-light-alt">
                                                                <i data-feather="users" class="align-self-center text-muted icon-md"></i>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!--end card-body--> 
                                            </div><!--end card--> 
                                        </div> <!--end col--> 
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card report-card">
                                                <div class="card-body">
                                                    <div class="row d-flex justify-content-center">
                                                        <?
                                                            // Get the current month and last month purchase sums
                                                            $currentMonthSum = isset($purchase_sum[0]['SUM(purchase_order_product_cost)']) ? $purchase_sum[0]['SUM(purchase_order_product_cost)'] : 0;
                                                            $lastMonthSum = isset($purchase_sum_Lmonth[0]['SUM(purchase_order_product_cost)']) ? $purchase_sum_Lmonth[0]['SUM(purchase_order_product_cost)'] : 0;

                                                            // Calculate the percentage increase, handling division by zero
                                                            if ($lastMonthSum != 0) {
                                                                $percentageIncrease = round((($currentMonthSum - $lastMonthSum) / $lastMonthSum) * 100, 1);
                                                            } else {
                                                                // If lastMonthSum is zero, set the percentage increase to 'N/A'
                                                                $percentageIncrease = '100';
                                                            }





                                                            $currentMonthsaleSum = isset($sale_sum[0]['SUM(invoice_cost)']) ? $sale_sum[0]['SUM(invoice_cost)'] : 0;
                                                            $lastMonthsaleSum = isset($sale_sum_Lmonth[0]['SUM(invoice_cost)']) ? $sale_sum_Lmonth[0]['SUM(invoice_cost)'] : 0;

                                                            if ($lastMonthsaleSum != 0) {
                                                                $percentagesaleIncrease = round((($currentMonthsaleSum - $lastMonthsaleSum) / $lastMonthsaleSum) * 100, 1);
                                                            } else {
                                                                // Handle division by zero case, maybe set $percentagesaleIncrease to 'N/A' or some appropriate value
                                                                $percentagesaleIncrease = '100';
                                                            }




                                                            // Get the current month and last month invoice sums
                                                            $currentMonthinvoiceSum = isset($invoice_sum[0]['SUM(purchase_order_product_cost)']) ? $invoice_sum[0]['SUM(purchase_order_product_cost)'] : 0;
                                                            $lastMonthinvoiceSum = isset($invoice_sum_Lmonth[0]['SUM(purchase_order_product_cost)']) ? $invoice_sum_Lmonth[0]['SUM(purchase_order_product_cost)'] : 0;

                                                            // Calculate the percentage increase, handling division by zero
                                                            if ($lastMonthinvoiceSum != 0) {
                                                                $percentageIncrease = round((($currentMonthinvoiceSum - $lastMonthinvoiceSum) / $lastMonthinvoiceSum) * 100, 1);
                                                            } else {
                                                                // If lastMonthinvoiceSum is zero, set the percentage increase to 'N/A'
                                                                $percentageIncrease = '100';
                                                            }

                                                        ?>
                                                        <div class="col">
                                                            <p class="text-dark mb-1 font-weight-semibold">Purchase Monthly</p>
                                                            <h3 class="my-2"><?=$purchase_sum[0]['sum']?> PKR</h3>
                                                            <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i><?=$percentageIncrease?>%</span> Last month</p>
                                                        </div>
                                                        <div class="col-auto align-self-center">
                                                            <div class="report-main-icon bg-light-alt">
                                                                <i data-feather="dollar-sign" class="align-self-center text-muted icon-md"></i>  
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div><!--end card-body--> 
                                            </div><!--end card--> 
                                        </div> <!--end col--> 
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card report-card">
                                                <div class="card-body">
                                                    <div class="row d-flex justify-content-center">                                                
                                                        <div class="col">
                                                            <p class="text-dark mb-1 font-weight-semibold">Sales Monthly</p>
                                                            <h3 class="my-2"><?=$sale_sum[0]['sum']?> PKR</h3>
                                                            <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i><?=$percentagesaleIncrease?>%</span> Last Month</p>
                                                        </div>
                                                        <div class="col-auto align-self-center">
                                                            <div class="report-main-icon bg-light-alt">
                                                                <i data-feather="dollar-sign" class="align-self-center text-muted icon-md"></i>  
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div><!--end card-body--> 
                                            </div><!--end card--> 
                                        </div> <!--end col--> 
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card report-card">
                                                <div class="card-body">
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col">  
                                                            <p class="text-dark mb-1 font-weight-semibold">Invoices</p>                                         
                                                            <h3 class="my-2"><?=$invoice_count[0]['COUNT(invoice_id)']?></h3>
                                                            <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i><?=$percentageIncrease?>%</span> Last Month</p>
                                                        </div>
                                                        <div class="col-auto align-self-center">
                                                            <div class="report-main-icon bg-light-alt">
                                                                <i data-feather="briefcase" class="align-self-center text-muted icon-md"></i>  
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div><!--end card-body--> 
                                            </div><!--end card--> 
                                        </div> <!--end col-->                               
                                    </div><!--end row-->
                                </div>
                                <?
                                }
                                if (in_array(79, $_SESSION['module_id'])) {
                                ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Sales/Purchase</h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="chart-demo">
                                                    <div id="apex_area1" class="apex-charts"></div>
                                                </div>                                        
                                            </div><!--end card-body-->
                                        </div><!--end card-->
                                    </div><!--end col-->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Sales/Expenses</h4>
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <div class="chart-demo">
                                                    <div id="apex_column1" class="apex-charts"></div>
                                                </div>                                        
                                            </div><!--end card-body-->
                                        </div><!--end card-->
                                    </div><!--end col-->
                                </div>
                                <?
                                }
                                if (in_array(80, $_SESSION['module_id'])) {
                                ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col">                      
                                                        <h4 class="card-title">Present Today</h4>                      
                                                    </div><!--end col-->
                                                    <div class="col-auto"> 
                                                        <?
                                                            $count = 0;
                                                            foreach ($today_attendances as $today_attendance) {
                                                                if ($today_attendance['attendance_present'] == 1 || $today_attendance['attendance_present'] == 3) {
                                                                    $count ++;
                                                                }
                                                            }
                                                            echo $count;
                                                        ?> Employees Present           
                                                    </div><!--end col-->
                                                </div>  <!--end row-->                                  
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <ul class="list-group custom-list-group">
                                                    <?
                                                        foreach ($employees as $employee) {
                                                            foreach ($today_attendances as $today_attendance) {
                                                                if ($today_attendance['employee_id'] == $employee['employee_id']) {
                                                                    if ($today_attendance['attendance_present'] == 1 || $today_attendance['attendance_present'] == 3) {
                                                    ?>
                                                                        <li class="list-group-item align-items-center d-flex justify-content-between">
                                                                            <div class="media">
                                                                                <span style="margin-right: 18px;font-family: cursive;font-weight: 600;color: #b7042c;">(<?=$employee['employee_code']?>)</span>
                                                                                <div class="media-body align-self-center"> 
                                                                                    <h6 class="m-0"><a href="<?=base_url()?>Attendance/view_summary/<?=$employee['employee_id']?>" target="_blank"><?=$employee['employee_name']?></a></h6>
                                                                                    <a target="_blank" href="https://wa.me/<?=$employee['employee_phone1']?>" class="font-12 text-primary">Phone: <?=$employee['employee_phone1']?></a>                                                                                           
                                                                                </div><!--end media body-->
                                                                            </div>
                                                                            <div class="align-self-center">
                                                                                <span class="text-muted mb-n2"><?foreach ($monthly_attendances as $monthly_attendance) {
                                                                                    if ($monthly_attendance['attendance_employee_id'] == $employee['employee_id']) {
                                                                                        echo $monthly_attendance['Present']+$monthly_attendance['Late'];
                                                                                    }
                                                                                }?> Days Present in <?=date('F')?></span>
                                                                                <div class="apexchart-wrapper w-30 align-self-center">                                                    
                                                                                    <div id="dash_spark_1" class="chart-gutters"></div>
                                                                                </div>
                                                                            </div>                                            
                                                                        </li>
                                                    <?
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    ?>

                                                </ul>                                    
                                            </div><!--end card-body--> 
                                        </div><!--end card--> 
                                    </div> <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row align-items-center">
                                                    <div class="col">                      
                                                        <h4 class="card-title">Absent Today</h4>                      
                                                    </div><!--end col-->
                                                    <div class="col-auto"> 
                                                        <div class="dropdown">
                                                            <?
                                                            $count = 0;
                                                            foreach ($today_attendances as $today_attendance) {
                                                                if ($today_attendance['attendance_present'] == 2 || $today_attendance['attendance_present'] == 4) {
                                                                    $count ++;
                                                                }
                                                            }
                                                            echo $count;
                                                        ?> Employees Present
                                                        </div>               
                                                    </div><!--end col-->
                                                </div>  <!--end row-->                                  
                                            </div><!--end card-header-->
                                            <div class="card-body">
                                                <ul class="list-group custom-list-group">
                                                   <?
                                                        foreach ($employees as $employee) {
                                                            foreach ($today_attendances as $today_attendance) {
                                                                if ($today_attendance['employee_id'] == $employee['employee_id']) {
                                                                    if ($today_attendance['attendance_present'] == 2 || $today_attendance['attendance_present'] == 4) {
                                                    ?>
                                                                        <li class="list-group-item align-items-center d-flex justify-content-between">
                                                                            <div class="media">
                                                                                <span style="margin-right: 18px;font-family: cursive;font-weight: 600;color: #b7042c;">(<?=$employee['employee_code']?>)</span>
                                                                                <div class="media-body align-self-center"> 
                                                                                    <h6 class="m-0"><a href="<?=base_url()?>Attendance/view_summary/<?=$employee['employee_id']?>" target="_blank"><?=$employee['employee_name']?></a></h6>
                                                                                    <a target="_blank" href="https://wa.me/<?=$employee['employee_phone1']?>" class="font-12 text-primary">Phone: <?=$employee['employee_phone1']?></a>                                                                                           
                                                                                </div><!--end media body-->
                                                                            </div>
                                                                            <div class="align-self-center">
                                                                                <span class="text-muted mb-n2"><?foreach ($monthly_attendances as $monthly_attendance) {
                                                                                    if ($monthly_attendance['attendance_employee_id'] == $employee['employee_id']) {
                                                                                        echo $monthly_attendance['Present']+$monthly_attendance['Leave'];
                                                                                    }
                                                                                }?> Days Present in <?=date('F')?></span>
                                                                                <div class="apexchart-wrapper w-30 align-self-center">                                                    
                                                                                    <div id="dash_spark_1" class="chart-gutters"></div>
                                                                                </div>
                                                                            </div>                                            
                                                                        </li>
                                                    <?
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    ?>

                                                </ul>                                    
                                            </div><!--end card-body--> 
                                        </div><!--end card--> 
                                    </div> <!--end col-->
                                </div>
                                <?
                                }
                                ?>
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

<script src="<?=base_url()?>assets/plugins/apex-charts/apexcharts.min.js"></script>
<script src="<?=base_url()?>assets/plugins/apex-charts/irregular-data-series.js"></script>
<script src="<?=base_url()?>assets/plugins/apex-charts/ohlc.js"></script>
<!-- <script src="<?=base_url()?>assets/pages/jquery.apexcharts.init.js"></script> -->

<script>
    var span = document.getElementById('span');

    function time() {
      var d = new Date();
      var s = d.getSeconds();
      var m = d.getMinutes();
      var h = d.getHours();
      span.textContent = 
        ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
    }

    setInterval(time, 1000);
</script>
<script>
    var options = {
        chart: {
            height: 360,
            type: 'area',
            stacked: true,
            toolbar: {
              show: false,
              autoSelected: 'zoom'
            },
        },
        colors: ['#2a77f4', '#a5c2f1'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: [3, 3],
            dashArray: [0, 4],
            lineCap: 'round'
        },
        grid: {
          borderColor: "#45404a2e",
          padding: {
            left: 0,
            right: 0
          },
          strokeDashArray: 4,
        },
        markers: {
          size: 0,
          hover: {
            size: 0
          }
        },
        series: [{
            name: 'Sales',
            data: [<?php
                    $currentYear = date('Y');

                    for ($month = 1; $month <= 12; $month++) {
                        $monthKey = sprintf('%s-%02d', $currentYear, $month);
                        $found = false;
                        
                        foreach ($yearly_sales as $sales) {
                            if ($sales['month'] === $monthKey) {
                                echo $sales['total_cost'] . ',';
                                $found = true;
                                break;
                            }
                        }
                        
                        if (!$found) {
                            echo '0,';
                        }
                    }
                    ?>]
        }, {
            name: 'Purchase',
            data: [<?php
                    $currentYear = date('Y');

                    for ($month = 1; $month <= 12; $month++) {
                        $monthKey = sprintf('%s-%02d', $currentYear, $month);
                        $found = false;
                        
                        foreach ($yearly_purchases as $yearly_purchase) {
                            if ($yearly_purchase['month'] === $monthKey) {
                                echo $yearly_purchase['total_cost'] . ',';
                                $found = true;
                                break;
                            }
                        }
                        
                        if (!$found) {
                            echo '0,';
                        }
                    }
                    ?>]
        }],
      
        xaxis: {
            type: 'month',
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            axisBorder: {
              show: true,
              color: '#45404a2e',
            },  
            axisTicks: {
              show: true,
              color: '#45404a2e',
            },                  
        },
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.4,
            opacityTo: 0.3,
            stops: [0, 90, 100]
          }
        },
        
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        },
        legend: {
          position: 'top',
          horizontalAlign: 'right'
        },
      }
      
      var chart = new ApexCharts(
        document.querySelector("#apex_area1"),
        options
      );
      
      chart.render();
</script>
<script>
    var options = {
  chart: {
      height: 396,
      type: 'bar',
      toolbar: {
          show: false
      },
  },
  plotOptions: {
      bar: {
          horizontal: false,
          endingShape: 'rounded',
          columnWidth: '55%',
      },
  },
  dataLabels: {
      enabled: false
  },
  stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
  },
  colors: ["rgba(42, 118, 244, .18)", '#2a76f4', "rgba(251, 182, 36, .6)"],
  series: [{
      name: 'Sales',
      data: [<?php
                    $currentYear = date('Y');

                    for ($month = 1; $month <= 12; $month++) {
                        $monthKey = sprintf('%s-%02d', $currentYear, $month);
                        $found = false;
                        
                        foreach ($yearly_sales as $sales) {
                            if ($sales['month'] === $monthKey) {
                                echo $sales['total_cost'] . ',';
                                $found = true;
                                break;
                            }
                        }
                        
                        if (!$found) {
                            echo '0,';
                        }
                    }
                    ?>]
  }, {
      name: 'Expense',
      data: [<?php
                    $currentYear = date('Y');

                    for ($month = 1; $month <= 12; $month++) {
                        $monthKey = sprintf('%s-%02d', $currentYear, $month);
                        $found = false;
                        
                        foreach ($yearly_expense as $expense) {
                            if ($expense['month'] === $monthKey) {
                                echo $expense['total_expenses'] . ',';
                                $found = true;
                                break;
                            }
                        }
                        
                        if (!$found) {
                            echo '0,';
                        }
                    }
                    ?>]
  }],
  xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      axisBorder: {
          show: true,
          color: '#bec7e0',
        },  
        axisTicks: {
          show: true,
          color: '#bec7e0',
      },    
  },
  legend: {
      offsetY: 6,
  },
  yaxis: {
      title: {
          text: 'PKR'
      }
  },
  fill: {
      opacity: 1

  },
  // legend: {
  //     floating: true
  // },
  grid: {
      row: {
          colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.2
      },
      borderColor: '#f1f3fa'
  },
  tooltip: {
      y: {
          formatter: function (val) {
              return val + " PKR"
          }
      }
  }
}

var chart = new ApexCharts(
  document.querySelector("#apex_column1"),
  options
);

chart.render();
</script>



        
    </body>

</html>