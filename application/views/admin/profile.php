 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            My Profile
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="<?php echo base_url();?>admin/categories">Profile</a></li>
            <li class="active">My Profile</li>
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
                <form role="form" action="<?php echo base_url();?>admin/profile" method="post" enctype="multipart/form-data">
				<div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">First Name</label>
                      <input type="text" class="form-control" name="fname" value="<?php echo $admin[0]['firstname'];?>">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Last Name</label>
                      <input type="text" class="form-control" name="lname" value="<?php echo $admin[0]['lastname'];?>">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" class="form-control" name="email" value="<?php echo $admin[0]['email'];?>">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">City</label>
                      <input type="text" class="form-control" name="city" value="<?php echo $admin[0]['city'];?>">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">State</label>
                      <input type="text" class="form-control" name="state" value="<?php echo $admin[0]['state'];?>">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Postal Code</label>
                      <input type="text" class="form-control" name="postal_code" value="<?php echo $admin[0]['postal_code'];?>">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Telephone</label>
                      <input type="text" class="form-control" name="telephone" value="<?php echo $admin[0]['telephone'];?>">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Website Url</label>
                      <input type="text" class="form-control" name="website_url" value="<?php echo $admin[0]['website_url'];?>">
                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputFile">Image</label>
                      <input type="file" id="exampleInputFile" name="profile_picture">
                      <p class="help-block"><img src="<?php echo str_replace('index.php/','',base_url());?>assets/uploads/user_images/<?php echo $admin[0]['image'];?>" style="max-height:100%;max-width:100%;height:auto;width:auto;"></p>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="update_profile" value="update">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

             

             
              
              

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
