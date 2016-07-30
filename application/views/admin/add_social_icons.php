 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add icons
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="<?php echo base_url();?>admin/slider">Social icon</a></li>
            <li class="active">Add Social Icon</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               <form role="form" action="<?php echo base_url();?>admin/add_social_icons" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label for="exampleInputFile">Image</label>
                      <input type="file" id="" name="social_image">
                      <p class="help-block">(Add slider image here)</p>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Url</label>
                      <input type="text" class="form-control"  id="" name="url">
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="submit" value="save">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

             

             
              
              

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
