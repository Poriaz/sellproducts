<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Foodequipments</title>
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
    <link rel="stylesheet" href="<?php echo str_replace('/index.php','',base_url());?>assets/admin/bootstrap/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <link rel="stylesheet" href="<?php echo str_replace('/index.php','',base_url());?>assets/admin/dist/css/AdminLTE.min.css">
    
    <link rel="stylesheet" href="<?php echo str_replace('/index.php','',base_url());?>assets/admin/dist/css/skins/skin-blue.min.css">
	<style>
	.table-striped>tbody>tr:nth-of-type(odd){background-color: #EEEEEE !important;}
	td:last-child {
    width: 150px;
}
section.content-header h1 small > a {
    font-weight: bold;
    margin: 0 0 0 18px;
    background: #3c8dbc;
    padding: 5px 7px;
	color: #fff !important;
}
thead{
	background: #367fa9;
    color: #fff;
	}
	.box-header{
		display:none;
	}
	</style>
  
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <?php $admin_details = $this->db->get_where('users',array('id' => $_SESSION['user_id']))->result_array();
  
  ?>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
				  <?php if(!empty($admin_details[0]['image']) && file_exists('assets/uploads/user_images/'.$admin_details[0]['image'])){ ?>
                  <img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/<?php echo $admin_details[0]['image'];?>" class="user-image" alt="User Image" style="height: 35px;width: 35px;">
				  <?php } else { ?>
				   <img src="<?php echo str_replace('/index.php','',base_url());?>assets/admin/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
				  <?php } ?>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">Foodeuipments</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
				  <?php if(!empty($admin_details[0]['image']) && file_exists('assets/uploads/user_images/'.$admin_details[0]['image'])){ ?>
                    <img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/<?php echo $admin_details[0]['image'];?>" class="img-circle" alt="User Image" style="max-height: 70%;max-width: 100%;height: auto;width: auto;">
					<?php } else { ?>
				    <img src="<?php echo str_replace('/index.php','',base_url());?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
				  <?php } ?>
                    <p>
                      
                      <small>Member since <?php echo date('M, Y',strtotime($admin_details[0]['created']));?></small>
                    </p>
                  </li>
                 
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url();?>admin/profile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url();?>auth/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              
            </ul>
          </div>
        </nav>
      </header>
       <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!--<div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo str_replace('/index.php','',base_url());?>assets/admin/dist/img/user2-160x160.jpg"" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Foodequipments</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>-->
         
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
            <li class="treeview">
              <a href="<?php echo base_url();?>admin/index">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="pull-right"></i>
              </a>
              
            </li>
           
            <li class="active">
              <a href="<?php echo base_url();?>admin/categories">
                <i class="fa fa-th"></i> <span>Categories</span>
              </a>
            </li>
            
            
            <li class="treeview">
              <a href="<?php echo base_url();?>admin/users">
                <i class="fa fa-edit"></i> <span>Users</span>
                
              </a>
              
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>admin/advertisements">
                <i class="fa fa-table"></i> <span>Advertisements</span>
               
              </a>
              
            </li>
             <li>
              <a href="<?php echo base_url();?>admin/news">
                <i class="fa fa-envelope"></i> <span>News</span>
               
              </a>
            </li>
            <li>
              <a href="<?php echo base_url();?>admin/slider">
                <i class="fa fa-picture-o"></i> <span>Slider</span>
               
              </a>
            </li>
            <li>
              <a href="<?php echo base_url();?>admin/social_icons">
                <i class="fa fa-picture-o"></i> <span>Social Icons</span>
               
              </a>
            </li>
            <li>
              <a href="<?php echo base_url();?>admin/reported_ads">
                <i class="fa fa-picture-o"></i> <span>Reported Ads</span>
               
              </a>
            </li>
           
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

