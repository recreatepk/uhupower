    
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
?>
    <head>
        <meta charset="utf-8" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="UHU ERP Application" name="description" />
        <meta content="Re Create Technologies" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>uploads/company/<?=$office_data->company_favicon?>">

        <!-- Sweet Alert -->
        <link href="<?=base_url()?>assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">

        <!-- App css -->
        <link href="<?=base_url()?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/jquery-ui.min.css" rel="stylesheet">
        <link href="<?=base_url()?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <script src="<?=base_url()?>/assets/plugins/tippy/tippy.all.min.js"></script>

        <!-- color picker -->
        <link href="<?=base_url()?>/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />

    </head>
<style type="text/css">
    label{
        color: #000000 !important;
    }
    .btn-primary {
            background-color: <?=$office_data->company_button_color?> !important;
            border-color: <?=$office_data->company_button_color?> !important;
        }
    .form-control {
        border: 1px solid <?=$office_data->company_button_color?> !important;
    }
    .print-text-size-big{
            font-size: 20px;
        }
    @media print
    {    
        .no-print, .no-print *
        {
            display: none !important;
        }
        .pagebreak {
        clear: both;
        page-break-after: always;
        }
        .float-to-right{
            float: right;
        }

    }
    @media screen {
       .onlyPrint {
           display: none;
       }
    }
        
</style>