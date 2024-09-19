
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
<style type="text/css">
    .left-sidenav {
        background-color: <?=$office_data->company_sidebar_color?> !important;
    }
</style>
 <div class="left-sidenav" >
            <!-- LOGO -->
            <div class="brand">
                <a href="<?=base_url()?>Dashboard" class="logo">
                    <span>
                        <img src="<?=base_url()?>uploads/company/<?=$office_data->company_logo_name2?>" style="height: 35px;">
                    </span>
                </a>
            </div>
            <!--end logo-->
            <div class="menu-content h-100" data-simplebar>
                <ul class="metismenu left-sidenav-menu">
                    <li id="product" class="menu-label mt-0">Main</li>
                    <li class="nav-item"><a class="nav-link" href="<?=base_url()?>Dashboard"><i data-feather="home" class="align-self-center menu-icon"></i>Dashboard</a></li>
                    <? if (in_array(1, $_SESSION['module_id']) || in_array(2, $_SESSION['module_id']) || in_array(3, $_SESSION['module_id']) || in_array(7, $_SESSION['module_id'])){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="slack" class="align-self-center menu-icon"></i><span>Products</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a  href="javascript: void(0);"><i class="ti-control-record"></i>Product Category <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <? if (in_array(15, $_SESSION['module_id'])){ ?>
                                    <li><a  href="<?=base_url()?>Product/product_cat">View Categories</a></li>
                                    <?}?>
                                    <? if (in_array(18, $_SESSION['module_id'])){ ?>
                                    <li><a  href="<?=base_url()?>Product/add_product_cat">Add Categories</a></li>
                                    <?}?>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="ti-control-record"></i>Products<span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <? if (in_array(1, $_SESSION['module_id'])){ ?>
                                    <li><a  href="<?=base_url()?>Product">View Products</a></li>
                                    <?}?>
                                    <? if (in_array(7, $_SESSION['module_id'])){ ?>
                                    <li><a  href="<?=base_url()?>Product/add_product">Add Products</a></li>
                                    <?}?>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <?}?>
                    <hr class="hr-dashed hr-menu">
                    <li id="Inventory" class="menu-label my-2">Inventory</li>

                    <li>
                        <a href="javascript: void(0);"><i data-feather="box" class="align-self-center menu-icon"></i><span>Stock</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(32, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Inventory"><i class="ti-control-record"></i>View Inventory</a>
                            </li>
                            <?}
                                if ($_SESSION['employee_warehousing_access'] == 1 || $_SESSION['id'] == 1){
                                    foreach ($warehouses as $warehouse) {
                                        if ($warehouse['warehouse_id'] == $_SESSION['employee_warehousing_id'] || $_SESSION['id'] == 1) {

                                ?>
                                            <li>
                                                <a href="<?=base_url()?>Inventory/check_warehouse_inventory/<?=$warehouse['warehouse_id']?>"><i class="ti-control-record"></i><?=$warehouse['warehouse_name']?></a>
                                            </li>
                                <?
                                        }
                                    }
                                }
                                if ($_SESSION['employee_warehousing_access'] == 2 || $_SESSION['id'] == 1){
                                    foreach ($stores as $store) {
                                        if ($store['store_id'] == $_SESSION['employee_warehousing_id'] || $_SESSION['id'] == 1) {
                                ?>
                                            <li>
                                                <a href="<?=base_url()?>Inventory/check_store_inventory/<?=$store['store_id']?>"><i class="ti-control-record"></i><?=$store['store_name']?></a>
                                            </li>
                                <?
                                        }
                                    }
                                }
                                ?>

                        </ul>
                    </li>
                    <? if (in_array(33, $_SESSION['module_id'])){ ?>
                    <li>

                        <a href="javascript: void(0);"><i data-feather="archive" class="align-self-center menu-icon"></i><span>Goods Receive Note</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">

                            <li>
                                <a href="<?=base_url()?>Delivery_challan"><i class="ti-control-record"></i>View GRN</a>
                            </li>

                        </ul>
                    </li>
                    <?}?>

                    <? if (in_array(48, $_SESSION['module_id'])){ ?>
                    <li>

                        <a href="javascript: void(0);"><i data-feather="file-text" class="align-self-center menu-icon"></i><span>Delivery Order</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">

                            <li>
                                <a href="<?=base_url()?>Quotation/delivery_challan"><i class="ti-control-record"></i>View Delivery Order</a>
                            </li>

                        </ul>
                    </li>
                    <?}?>

                    <? if (in_array(50, $_SESSION['module_id'])){ ?>
                    <li>

                        <a href="javascript: void(0);"><i data-feather="sidebar" class="align-self-center menu-icon"></i><span>Gate Pass</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">

                            <li>
                                <a href="<?=base_url()?>Quotation/gate_pass"><i class="ti-control-record"></i>View Gate Pass</a>
                            </li>

                        </ul>
                    </li>
                    <?}?>


                    <? if (in_array(19, $_SESSION['module_id']) || in_array(20, $_SESSION['module_id']) || in_array(21, $_SESSION['module_id']) || in_array(22, $_SESSION['module_id'])){ ?>
                    <hr class="hr-dashed hr-menu">
                    <li id="Sales" class="menu-label my-2">Sales</li>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="truck" class="align-self-center menu-icon"></i><span>Customers</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(21, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Supplier/supplier/2"><i class="ti-control-record"></i>View Customers</a>
                            </li>
                            <?}?>
                            <? if (in_array(19, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Supplier/add_supplier/2"><i class="ti-control-record"></i>Add Customers</a>
                            </li>
                            <?}?>

                        </ul>
                    </li>

                    <? if (in_array(38, $_SESSION['module_id']) || in_array(39, $_SESSION['module_id'])){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="file-text" class="align-self-center menu-icon"></i><span>Quotations</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(38, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Quotation"><i class="ti-control-record"></i>View Quotation</a>
                            </li>
                            <?}?>
                            <? if (in_array(39, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Quotation/add_qoutation"><i class="ti-control-record"></i>Add Quotation</a>
                            </li>
                            <?}?>
                        </ul>
                    </li>
                    <?}?>
                    <?}?>
                    <? if (in_array(19, $_SESSION['module_id']) || in_array(20, $_SESSION['module_id']) || in_array(21, $_SESSION['module_id']) || in_array(22, $_SESSION['module_id'])){ ?>
                    <hr class="hr-dashed hr-menu">
                    <li id="purchase" class="menu-label my-2">Purchases</li>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="truck" class="align-self-center menu-icon"></i><span>Supplier</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(21, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Supplier/supplier/1"><i class="ti-control-record"></i>View Suppliers</a>
                            </li>
                            <?}?>
                            <? if (in_array(19, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Supplier/add_supplier/1"><i class="ti-control-record"></i>Add Suppliers</a>
                            </li>
                            <?}?>
                        </ul>

                        </ul>
                    </li>
                    <?}?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="shopping-cart" class="align-self-center menu-icon"></i><span>Purchasing</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="javascript: void(0);"><i class="ti-control-record"></i>Purchase Order<span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <? if (in_array(25, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>Purchase_order">View PO</a></li>
                                    <?}?>
                                    <? if (in_array(23, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>Purchase_order/add_purchase_order">Add PO</a></li>
                                    <?}?>
                                </ul>
                            </li>

                        </ul>
                    </li>



                    <? if (in_array(25, $_SESSION['module_id']) || in_array(23, $_SESSION['module_id'])){ ?>
                    <hr class="hr-dashed hr-menu">

                    <li id="Accounts" class="menu-label my-2">Accounts</li>

                    <li>
                        <a href="javascript: void(0);"><i data-feather="bar-chart-2" class="align-self-center menu-icon"></i><span>Ledger</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(81, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="javascript: void(0);"><i class="ti-control-record"></i>Suppliers<span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul>
                                    <? if (in_array(21, $_SESSION['module_id'])){ ?>
                                    <li>
                                        <a href="<?=base_url()?>Reports/ledger/2"><i class="ti-control-record"></i>View Ledger</a>
                                    </li>
                                    <?}?>
                                    <? if (in_array(81, $_SESSION['module_id'])){ ?>
                                    <li>
                                        <a href="<?=base_url()?>Reports/deb_cred_note/2"><i class="ti-control-record"></i>Debit/Credit Note</a>
                                    </li>
                                    <?}?>
                                    <? if (in_array(89, $_SESSION['module_id'])){ ?>
                                    <li>
                                        <a href="<?=base_url()?>Reports/payments/2"><i class="ti-control-record"></i>Payment</a>
                                    </li>
                                    <?}?>
                                </ul>
                            </li>
                            <?}?>
                            <? if (in_array(81, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="javascript: void(0);"><i class="ti-control-record"></i>Customer<span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul>
                                    <? if (in_array(81, $_SESSION['module_id'])){ ?>
                                    <li>
                                        <a href="<?=base_url()?>Reports/ledger/1"><i class="ti-control-record"></i>View Ledger</a>
                                    </li>
                                    <?}?>
                                    <? if (in_array(81, $_SESSION['module_id'])){ ?>
                                    <li>
                                        <a href="<?=base_url()?>Reports/deb_cred_note/1"><i class="ti-control-record"></i>Debit/Credit Note</a>
                                    </li>
                                    <?}?>
                                    <? if (in_array(89, $_SESSION['module_id'])){ ?>
                                    <li>
                                        <a href="<?=base_url()?>Reports/payments/1"><i class="ti-control-record"></i>Payment</a>
                                    </li>
                                    <?}?>
                                </ul>
                            </li>
                            <?}?>
                        </ul>
                    </li>
                    <?}?>

                     <? if (in_array(43, $_SESSION['module_id']) || in_array(44, $_SESSION['module_id'])){ ?>
                    <li class="nav-item"><a href="javascript: void(0);"><i data-feather="dollar-sign" class="align-self-center menu-icon"></i><span>Invoicing </span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(43, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Quotation/invoice"><i class="ti-control-record"></i>View Invoices</a>
                            </li>
                            <?}?>
                            <? if (in_array(44, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Quotation/add_invoice"><i class="ti-control-record"></i>Add Invoices</a>
                            </li>
                            <?}?>
                        </ul>
                    </li>
                    <?}?>
                    <? if (in_array(59, $_SESSION['module_id']) || in_array(60, $_SESSION['module_id']) || in_array(55, $_SESSION['module_id']) || in_array(56, $_SESSION['module_id'])){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="pie-chart" class="align-self-center menu-icon"></i><span>Expense</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="javascript: void(0);"><i class="ti-control-record"></i>Expense Category <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <? if (in_array(59, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>Expense/expense_category">View Categories</a></li>
                                    <?}?>
                                    <? if (in_array(60, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>Expense/add_expense_category">Add Categories</a></li>
                                    <?}?>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="ti-control-record"></i>Expense<span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <? if (in_array(55, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>Expense">View Expense</a></li>
                                    <?}?>
                                    <? if (in_array(56, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>Expense/add_expense">Add Expense</a></li>
                                    <?}?>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <?}?>
                    <? if (in_array(4, $_SESSION['module_id']) || in_array(8, $_SESSION['module_id']) || in_array(63, $_SESSION['module_id']) || in_array(83, $_SESSION['module_id']) || in_array(84, $_SESSION['module_id']) || in_array(87, $_SESSION['module_id']) ){ ?>
                    <hr class="hr-dashed hr-menu">
                    <li id="hrm" class="menu-label my-2">HRM</li>
                    <? if (in_array(83, $_SESSION['module_id']) || in_array(84, $_SESSION['module_id'])){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="git-pull-request" class="align-self-center menu-icon"></i><span>Departments</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(83, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Department"><i class="ti-control-record"></i>View Departments</a>
                            </li>
                            <?}?>
                            <? if (in_array(84, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Department/add_department"><i class="ti-control-record"></i>Add Department</a>
                            </li>
                            <?}?>
                        </ul>
                    </li>
                    <?}?>
                    <? if (in_array(4, $_SESSION['module_id']) || in_array(8, $_SESSION['module_id'])){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="users" class="align-self-center menu-icon"></i><span>Users</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(4, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>User/user"><i class="ti-control-record"></i>View Users</a>
                            </li>
                            <?}?>
                            <? if (in_array(8, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>User/add_user"><i class="ti-control-record"></i>Add Users</a>
                            </li>
                            <?}?>
                        </ul>
                    </li>
                    <?}?>
                    <? if (in_array(63, $_SESSION['module_id'])){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="user-check" class="align-self-center menu-icon"></i><span>Attendance</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(63, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Attendance/attendance_overview"><i class="ti-control-record"></i>Check Attendance</a>
                            </li>
                            <?
                            } if (in_array(63, $_SESSION['module_id'])){
                            ?>
                            <li>
                                <a href="<?=base_url()?>Attendance"><i class="ti-control-record"></i>Mark Attendance</a>
                            </li>
                            <?
                        }?>
                        </ul>
                    </li>
                    <?}?>
                    <? if (in_array(87, $_SESSION['module_id']) && $_SESSION['id'] != 1){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="git-branch" class="align-self-center menu-icon"></i><span>Department Attendance</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(87, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Attendance/attendance_overview_department"><i class="ti-control-record"></i>Check Department Attendance</a>
                            </li>
                            <?
                            } if (in_array(87, $_SESSION['module_id'])){
                            ?>
                            <li>
                                <a href="<?=base_url()?>Attendance/attendance_department"><i class="ti-control-record"></i>Mark Department Attendance</a>
                            </li>
                            <?
                        }?>
                        </ul>
                    </li>
                    <?}?>
                     <? if (in_array(75, $_SESSION['module_id']) || in_array(76, $_SESSION['module_id'])){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="dollar-sign" class="align-self-center menu-icon"></i><span>Salaries</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(75, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Salary"><i class="ti-control-record"></i>View Salaries</a>
                            </li>
                            <?}?>
                            <? if (in_array(76, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Salary/get_salary_all"><i class="ti-control-record"></i>Make Salaries</a>
                            </li>
                            <?}?>
                        </ul>
                    </li>
                    <?}}?>
                     <? if (
                        in_array(67, $_SESSION['module_id'])
                        || in_array(65, $_SESSION['module_id'])
                        || in_array(71, $_SESSION['module_id'])
                        || in_array(69, $_SESSION['module_id'])
                        || in_array(90, $_SESSION['module_id'])
                        || in_array(91, $_SESSION['module_id'])
                    ){ ?>
                    <hr class="hr-dashed hr-menu">
                    <li id="service" class="menu-label my-2">Servicing</li>
                   <li>
                        <a href="javascript: void(0);"><i data-feather="phone-incoming" class="align-self-center menu-icon"></i><span>Complaint</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(91, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Complaint"><i class="ti-control-record"></i>View Complaint</a>
                            </li>
                            <?}?>
                            <? if (in_array(90, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Complaint/add_complaint"><i class="ti-control-record"></i>Add Complaint</a>
                            </li>
                            <?}?>
                        </ul>
                    </li>
                    <? if (in_array(94, $_SESSION['module_id']) || in_array(95, $_SESSION['module_id'])){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="file-text" class="align-self-center menu-icon"></i><span>Service Quotations</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(94, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Service_quote"><i class="ti-control-record"></i>View Quotation</a>
                            </li>
                            <?}?>
                            <? if (in_array(95, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>Service_quote/add_service_quote"><i class="ti-control-record"></i>Add Quotation</a>
                            </li>
                            <?}?>
                        </ul>
                    </li>
                    <?}?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="tool" class="align-self-center menu-icon"></i><span>Servicing</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="javascript: void(0);"><i class="ti-control-record"></i>Services Type <span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <? if (in_array(67, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>service">View Services</a></li>
                                    <? }if (in_array(65, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>service/add_service">Add Services</a></li>
                                    <?}?>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="ti-control-record"></i>Render Services<span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <? if (in_array(71, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>Service/view_rendering_services">View Rendered Services</a></li>
                                    <?} if (in_array(69, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>Service/render_service">Rendering Services</a></li>
                                    <?}?>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <?}?>
                    <? if (in_array(30, $_SESSION['module_id']) || in_array(28, $_SESSION['module_id'])){ ?>
                    <hr class="hr-dashed hr-menu">
                    <li id="Settings" class="menu-label my-2">Settings</li>

                    <li>
                        <a href="javascript: void(0);"><i data-feather="archive" class="align-self-center menu-icon"></i><span>Warehousing</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">

                            <li>
                                <a href="javascript: void(0);"><i class="ti-control-record"></i>Warehouse<span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <? if (in_array(30, $_SESSION['module_id'])){ ?>
                                    <li><a id="" href="<?=base_url()?>Warehouse">View Warehouses</a></li>
                                    <?}if (in_array(28, $_SESSION['module_id'])){ ?>
                                    <li><a id="" href="<?=base_url()?>Warehouse/add_warehouse">Add Warehouse</a></li>
                                    <?}?>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="ti-control-record"></i>Store<span class="menu-arrow left-has-menu"><i class="mdi mdi-chevron-right"></i></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <? if (in_array(30, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>Store">View Store</a></li>
                                    <?}if (in_array(28, $_SESSION['module_id'])){ ?>
                                    <li><a href="<?=base_url()?>Store/add_store">Add Store</a></li>
                                    <?}?>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <?}?>
                    <? if (in_array(11, $_SESSION['module_id']) || in_array(9, $_SESSION['module_id'])){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="users" class="align-self-center menu-icon"></i><span>User Role</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(11, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>User/user_group"><i class="ti-control-record"></i>User Groups</a>
                            </li>
                            <?}?>
                            <? if (in_array(9, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>User/add_user_group"><i class="ti-control-record"></i>Add User Groups</a>
                            </li>
                            <?}?>
                        </ul>
                    </li>
                    <?}?>

                    <? if (in_array(51, $_SESSION['module_id'])){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="radio" class="align-self-center menu-icon"></i><span>News</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <? if (in_array(51, $_SESSION['module_id'])){ ?>
                            <li>
                                <a href="<?=base_url()?>News"><i class="ti-control-record"></i>View News</a>
                            </li>
                            <?
                                } if (in_array(52, $_SESSION['module_id'])){
                            ?>
                            <li>
                                <a href="<?=base_url()?>News/add_news"><i class="ti-control-record"></i>Add News</a>
                            </li>
                            <?}?>

                        </ul>
                    </li>
                     <?}?>
                    <? if (in_array(13, $_SESSION['module_id'])){ ?>
                    <li>
                        <a href="javascript: void(0);"><i data-feather="settings" class="align-self-center menu-icon"></i><span>Settings</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                        <ul class="nav-second-level" aria-expanded="false">

                            <li>
                                <a href="<?=base_url()?>Settings/settings"><i class="ti-control-record"></i>Company Settings</a>
                            </li>

                        </ul>
                    </li>
                     <?}?>

                </ul>


            </div>
        </div>
