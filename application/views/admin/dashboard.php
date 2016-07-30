<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Admin</a></li>
           
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          
            
           <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $advertisements;?></h3>
                  <p>Advertisements</p>
                </div>
                <div class="icon">
                  <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="<?php echo base_url();?>admin/advertisements" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $users;?></h3>
                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url();?>admin/users" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $categories;?></h3>
                  <p>Categories</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url();?>admin/categories" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $news;?></h3>
                  <p>News</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?php echo base_url();?>admin/news" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box">&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/delete_logo/<?php echo $logo[0]['id'];?>"><i class="fa fa-close"></i></a>
                <div class="inner">
                  <img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/logo/<?php echo $logo[0]['logo'];?>" style="max-width:100%;max-height:100%;height:auto;width:auto;"/>
                </div>
                
                <a href="<?php echo base_url();?>admin/change_logo" class="small-box-footer">
                  Change Logo<i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

          
          
         

         

            
            

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
