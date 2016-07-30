 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit User
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin/index"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="<?php echo base_url();?>admin/users">Users</a></li>
            <li class="active">Edit User</li>
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
                <form role="form" action="<?php echo base_url();?>admin/edit_user" method="post">
		<input type="hidden" name="id" value="<?php echo $user[0]['id'];?>">
                  <div class="box-body">
 			<div class="form-group">
                      <label for="exampleInputPassword1">First Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="fname" value="<?php echo $user[0]['firstname']; ?>">
                    </div>
			 <div class="form-group">
                      <label for="exampleInputPassword1">Last Name</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="lname" value="<?php echo $user[0]['lastname']; ?>" >
                    </div>
 			<div class="form-group">
			<?php $full_email =  $user[0]['email']; 
			      if (strpos($full_email,'|') !== false) {
    				   $exploded = explode('|',$full_email);
				   $reg_type = $exploded[0];
				   $email = $exploded[1];
				} else {
				   $reg_type = "Normal";
				   $email = $full_email;
				}
			?>
                      <label for="exampleInputPassword1">Registration Type</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="reg_type" value="<?php echo $reg_type; ?>" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $email; ?>">
                    </div>
                   
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="update_user" value="update">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->

             

             
              
              

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
