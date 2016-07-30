 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Advertisement
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="<?php echo base_url();?>admin/advertisements">Advertisements</a></li>
            <li class="active">Edit Advertisement</li>
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
                <form role="form" action="<?php echo base_url();?>admin/edit_advertisement" method="post">
		<input type="hidden" name="add_id" value="<?php echo $add[0]['add_id'];?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" class="form-control" id="" name="add_title" value="<?php echo $add[0]['add_title'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Description</label>
                      <input type="text" class="form-control" id="" name="add_description" value="<?php echo $add[0]['add_description'];?>">
                    </div>
			<div class="form-group">
                      <label for="exampleInputPassword1">Category</label>
                      <input type="text" class="form-control" id="" name="add_category" value="<?php echo $add[0]['add_category'];?>">
                    </div>
			<div class="form-group">
                      <label for="exampleInputPassword1">Price</label>
                      <input type="text" class="form-control" id="" name="add_price" value="<?php echo $add[0]['add_price'];?>">
                    </div>
			<div class="form-group">
                      <label for="exampleInputPassword1">Postal Code</label>
                      <input type="text" class="form-control" id="" name="add_postal_code" value="<?php echo $add[0]['add_postal_code'];?>">
                    </div>
			<div class="form-group">
                      <label for="exampleInputPassword1">Phone Number</label>
                      <input type="text" class="form-control" id="" name="add_phone_number" value="<?php echo $add[0]['add_phone_number'];?>">
                    </div>
			<div class="form-group">
                      <label for="exampleInputPassword1">Email</label>
                      <input type="text" class="form-control" id="" name="add_email" value="<?php echo $add[0]['add_email'];?>">
                    </div>
			<div class="form-group">
			<label>Contact By</label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="add_contact_by" id="" value="phone" <?php if($add[0]['add_contact_by']=="phone"){echo "checked";}?>>
                          Phone
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="add_contact_by" id="" value="text" <?php if($add[0]['add_contact_by']=="text"){echo "checked";}?>>
                          Text
                        </label>
                      </div>
                      
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Images</label>
                     
                     
			<ul>
			<?php foreach($images as $img){?>
				<li><img src="<?php echo str_replace('index.php/','',base_url());?>assets/uploads/add_portfolio/<?php echo $add[0]['add_id'];?>/<?php echo $img['image'];?>" height="200px" width="200px"/>&nbsp;&nbsp;&nbsp;<a class="btn btn-primary" href="<?php echo base_url();?>admin/delete_image/<?php echo $img['id'];?>/<?php echo $add[0]['add_id'];?>">Delete</a></li>
			<?php }?>
			</ul>
		       <span>Deleted images wont appear in the advertisements</span>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="update_add" value="update">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

             

             
              
              

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
