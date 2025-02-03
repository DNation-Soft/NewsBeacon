<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('admin/dashboard') ?>" class="brand-link">
        <img src="<?php echo base_url() ?>/admin_assets/dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo get_lebel_by_value_in_settings('store_name'); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php
                $pic = get_data_by_id('pic', 'nb_users', 'user_id', newSession()->adUserId);
                echo image_view('uploads/user', '', $pic, 'noimage.png', 'img-circle elevation-2 size-50x50');
                ?>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo admin_user_name(); ?></a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <?php
                $adRoleId = newSession()->adRoleId;
                $modArrayPur = ['Dashboard'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) {
                ?>
                    <?php echo add_main_based_menu_with_permission('Dashboard', base_url('admin/dashboard'), $adRoleId, 'fa-tachometer-alt', 'Dashboard'); ?>

                <?php } ?>



                <li class="nav-header">Modules</li>



                <?php
                $modArrayPur = ['Module'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) {
                    ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/module'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Module
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $modArrayPur = ['Album'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) {
                    ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/album'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Album
                            </p>
                        </a>
                    </li>
                <?php } ?>


                <li class="nav-header">Users</li>

                <?php
                $modArrayPur = ['User'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) {
                ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/user'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $modArrayPur = ['Role'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) {
                ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/role'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p> User Role </p>
                        </a>
                    </li>
                <?php } ?>





                <li class="nav-header">System</li>
                <?php
                $modArrayPur = ['News_category'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) {
                    ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/news_category'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                News Category
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $modArrayPur = ['Post'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) {
                    ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/post'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Post
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $modArrayPur = ['Comments'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) {
                    ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/comments'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Comments
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $modArrayPur = ['Settings'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) { ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/settings'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Settings
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $modArrayPur = ['Theme_settings'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) { ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/theme_settings'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Theme Settings
                            </p>
                        </a>
                    </li>
                <?php } ?>





                <?php
                $modArrayPur = ['Page_settings'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) { ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/page_list'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Page
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $modArrayPur = ['Notice'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) { ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/notice'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Notice
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $modArrayPur = ['Newsletter'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) {
                ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/newsletter'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Subscriber
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <?php
                $modArrayPur = ['Email_send'];
                $menuAccessPur = all_menu_permission_check($modArrayPur, $adRoleId);
                if ($menuAccessPur == true) { ?>
                    <li class="nav-item">
                        <a href="<?php echo base_url('admin/email_send'); ?>" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Email Send
                            </p>
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>