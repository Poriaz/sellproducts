<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Users
            <small></small>
          </h1>
          <ol class="breadcrumb">
            
            <li><a href="<?php echo base_url();?>admin/index">Admin</a></li>
            <li class="active">Users</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
                
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Users</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action(s)</th>
                      </tr>
                    </thead>
                    <tbody>
			<?php foreach($users as $user){ ?>
                      <tr>
                        <td><?php echo $user['firstname']." ".$user['lastname'];?></td>
                        <td><?php echo $user['email'];?></td>
                        <td><a href="<?php echo base_url();?>admin/edit_user/<?php echo $user['id'];?>" class="btn btn-primary">Edit</a>  <a href="<?php echo base_url();?>admin/delete_user/<?php echo $user['id'];?>" class="btn btn-primary">Delete</a></td>
                       
                      </tr>
                      <?php } ?>
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
