 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit News Item
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="<?php echo base_url();?>admin/news">News</a></li>
            <li class="active">Edit news</li>
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
                <form role="form" action="<?php echo base_url();?>admin/edit_news" method="post" enctype="multipart/form-data">
		<input type="hidden" name="nw_id" value="<?php echo $news_item[0]['nw_id'];?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" class="form-control"  name="nw_title" value="<?php echo $news_item[0]['nw_title']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <textarea class="form-control" name="nw_description" ><?php echo $news_item[0]['nw_description']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Image</label>
                      <input type="file" id="exampleInputFile" name="nw_image">
                      <p class="help-block"><img src="<?php echo str_replace('index.php/','',base_url());?>assets/uploads/news_images/<?php echo $news_item[0]['nw_image'];?>" height="200px" width="200px"></p>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="update_news" value="update">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

             

             
              
              

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
