
<div class="topbar">           
                <!-- Navbar -->
                <nav class="navbar-custom">    
                    <ul class="list-unstyled topbar-nav float-right mb-0">  
                             

                        <!-- Notification Area -->

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <span class="ml-1 nav-user-name hidden-sm"><?=$_SESSION['username']?></span>
                                <img src="<?=base_url()?>assets/images/users/user.png" alt="profile-user" class="rounded-circle" />                                 
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <? if (in_array(14, $_SESSION['module_id'])){ ?>
                                <a class="dropdown-item" href="<?=base_url()?>User/profile/<?=$_SESSION['id']?>"><i data-feather="user" class="align-self-center icon-xs icon-dual mr-1"></i> Profile</a>
                                <?}?>
                                <? if (in_array(13, $_SESSION['module_id'])){ ?>
                                <a class="dropdown-item" href="<?=base_url()?>Settings/settings"><i data-feather="settings" class="align-self-center icon-xs icon-dual mr-1"></i> Settings</a>
                                <?}?>
                                <div class="dropdown-divider mb-0"></div>
                                <a class="dropdown-item" href="<?=base_url()?>User/ses_dis/<?=$_SESSION['id']?>"><i data-feather="power" class="align-self-center icon-xs icon-dual mr-1"></i> Logout</a>
                            </div>
                        </li>
                    </ul><!--end topbar-nav-->
        
                    <ul class="list-unstyled topbar-nav mb-0">                        
                        <li>
                            <button class="nav-link button-menu-mobile">
                                <i data-feather="menu" class="align-self-center topbar-icon"></i>
                            </button>
                        </li>
                        <? if (in_array(32, $_SESSION['module_id'])){ ?> 
                        <li class="creat-btn">
                            <div class="nav-link">
                                <a class=" btn btn-sm btn-soft-primary" href="<?=base_url()?>Inventory" role="button"><i data-feather="box" class="align-self-center menu-icon"></i> View Inventory</a>
                            </div>                                
                        </li>
                        <?
                        }if (in_array(23, $_SESSION['module_id'])){
                        ?> 
                        <li class="creat-btn">
                            <div class="nav-link">
                                <a class=" btn btn-sm btn-soft-primary" href="<?=base_url()?>Purchase_order/add_purchase_order" role="button"><i data-feather="shopping-cart" class="align-self-center menu-icon"></i> Add Purchase Order</a>
                            </div>                                
                        </li>
                        <?
                        }if (in_array(39, $_SESSION['module_id'])){
                        ?>
                        <li class="creat-btn">
                            <div class="nav-link">
                                <a class=" btn btn-sm btn-soft-primary" href="<?=base_url()?>Quotation/add_qoutation" role="button"><i data-feather="file-text" class="align-self-center menu-icon"></i> Add Quotation</a>
                            </div>                                
                        </li>
                        <?
                        }if (in_array(44, $_SESSION['module_id'])){
                        ?>
                        <li class="creat-btn">
                            <div class="nav-link">
                                <a class=" btn btn-sm btn-soft-primary" href="<?=base_url()?>Quotation/add_invoice" role="button"><i data-feather="dollar-sign" class="align-self-center menu-icon"></i> Add Invoice</a>
                            </div>                                
                        </li>
                        <?
                        }if (in_array(56, $_SESSION['module_id'])){
                        ?>
                        <li class="creat-btn">
                            <div class="nav-link">
                                <a class=" btn btn-sm btn-soft-primary" href="<?=base_url()?>Expense/add_expense" role="button"><i data-feather="pie-chart" class="align-self-center menu-icon"></i> Add Expense</a>
                            </div>                                
                        </li>
                        <?
                        }if (in_array(63, $_SESSION['module_id'])){
                        ?>
                        <li class="creat-btn">
                            <div class="nav-link">
                                <a class=" btn btn-sm btn-soft-primary" href="<?=base_url()?>Attendance" role="button"><i data-feather="user-check" class="align-self-center menu-icon"></i> Mark Attendance</a>
                            </div>                                
                        </li> 
                        <?
                        }
                        ?>                         
                    </ul>
                </nav>
                <!-- end navbar-->
            </div>