<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Slider Images
            <small><a href="<?php echo base_url();?>admin/add_slider_image">Add New</a></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Admin</a></li>
           <li>Slider</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          
            
           <!-- Small boxes (Stat box) -->
          <div class="row">
		  <?php foreach($slider_images as $img){ ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>admin/delete_slider_image/<?php echo $img['s_id'];?>"><i class="fa fa-close"></i></a>
                <div class="inner">
                  <img src="<?php echo str_replace("/index.php","",base_url());?>assets/uploads/slider_images/<?php echo $img['slider_image'];?>" height="100px" width="100px">
                </div>
                
              </div>
            </div><!-- ./col -->
           <?php } ?>
          </div><!-- /.row -->

          
          
         

         

            
            

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
