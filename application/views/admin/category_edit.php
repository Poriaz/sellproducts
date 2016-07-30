 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Category
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="<?php echo base_url();?>admin/categories">Category</a></li>
            <li class="active">Edit Category</li>
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
                <form role="form" action="<?php echo base_url();?>admin/edit_categories/<?php echo $category[0]['c_id'];?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="c_id" value="<?php echo $category[0]['c_id'];?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" class="form-control" name="c_title" value="<?php echo $category[0]['c_title'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea class="form-control" name="c_description" ><?php echo $category[0]['c_description'];?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Image</label>
                      <input type="file" id="exampleInputFile" name="c_image">
                      <p class="help-block"><img src="<?php echo str_replace('index.php/','',base_url());?>assets/uploads/category_images/<?php echo $category[0]['c_image'];?>" height="200px" width="200px"></p>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="update_category" value="update">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

             

             
              
              

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
