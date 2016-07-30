<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Social icons 
            <small><a href="<?php echo base_url();?>admin/add_social_icons">Add New</a></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Admin</a></li>
           <li>Social icons</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          
            
           <!-- Small boxes (Stat box) -->
          <div class="row">
		  <?php foreach($social_icons as $img){ ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/delete_social_icons/<?php echo $img['id'];?>"><i class="fa fa-close"></i></a>
                <div class="inner">
                  <img src="<?php echo str_replace("/index.php","",base_url());?>assets/uploads/social_icons/<?php echo $img['icon_image'];?>" height="100px" width="100px">
                </div>
                <a href="<?php echo base_url();?>admin/advertisements" class="small-box-footer">
                 Url : <?php echo $img['icon_url'];?>
                </a>
              </div>
            </div><!-- ./col -->
           <?php } ?>
          </div><!-- /.row -->

          
          
         

         

            
            

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
