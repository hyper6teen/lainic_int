<?php
     if (!defined('BASEPATH'))
         exit('No direct script access allowed');
     //$user_type = $this->session->userdata('login_type');
?>

<div class='sidebar'>
    <div class='sidebar-header'>
        <div>Menu</div>
        <div></div>
    </div>
    <div class='sidebar-body'>
        <ul>
            <li>
                <div class='sidebar-menu'>Student
                <span class='fa fa-angle-down'></span>
                </div>
                <ul class='sidebar-dropdown'>
                        <li><a href='#'>Add Student</a></li>
                        <li>
                            <a href='#'>Student Information</a>
                            <span class='left-arrow fa fa-angle-right'></span>
                            <ul class='dropdown-dropdown'>
                                    <li><a href='#'>Add Student</a></li>
                                    <li><a href='#'>Student Information</a></li>
                                    <li><a href='#'>Add Student</a></li>
                            </ul>
                        </li>
                </ul>
            </li>
            <li>
                <div class='sidebar-menu'>Teacher
                <span class='fa fa-angle-down'></span>
                </div>
                <ul class='sidebar-dropdown'>
                        <li><a href='<?php echo 'index.php?admin/view_teacher'; ?>'>View All</a></li>
                        <li>
                            <a href='#'>Penalty Reports</a>
                            <span class='left-arrow fa fa-angle-right'></span>
                            <ul class='dropdown-dropdown'>
                                    <li><a href='#'>Add Student</a></li>
                            </ul>
                        </li>
                </ul>
            </li>
            <li>
                <div class='sidebar-menu'>Subscription
                <span class='fa fa-angle-down'></span>
                </div>
                <ul class='sidebar-dropdown'>
                        <li><a href='#'>Manage Plans</a></li>
                </ul>
            </li>
            <li>
                <div class='sidebar-menu'>Materials
                <span class='fa fa-angle-down'></span>
                </div>
                <ul class='sidebar-dropdown'>
                        <li><a href='#'>Add Material</a></li>
                        <li><a href='#'>View All</a></li>
                </ul>
            </li>
            <li>
                <div class='sidebar-menu'>Noticeboard
                <span class='fa fa-angle-down'></span>
                </div>
                <ul class='sidebar-dropdown'>
                </ul>
            </li>
            <li>
                <div class='sidebar-menu'>Accounting
                <span class='fa fa-angle-down'></span>
                </div>
                <ul class='sidebar-dropdown'>
                        <li><a href='#'>Create Student Payment</a></li>
                        <li><a href='#'>Student Payments</a></li>
                        <li><a href='#'>Teacher Salary</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class='sidebar-footer'>
        <div></div>
        <div></div>
    </div>
</div>