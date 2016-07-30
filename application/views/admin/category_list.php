<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Categories
            <small><a href="<?php echo base_url();?>admin/add_categories">Add new</a></small>
          </h1>
          <ol class="breadcrumb">
           <li><a href="<?php echo base_url();?>admin/index">Admin</a></li>
            <li class="active">Categories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
                
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Categories</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action(s)</th>
                      </tr>
                    </thead>
                    <tbody>
			<?php foreach($categories as $category){ ?>
                      <tr>
                        <td><?php echo $category['c_title'];?></td>
                        <td><?php echo $category['c_description'];?></td>
                        <td><a href="<?php echo base_url();?>admin/edit_categories/<?php echo $category['c_id'];?>" class="btn btn-primary">Edit</a>  <a href="<?php echo base_url();?>admin/delete_categories/<?php echo $category['c_id'];?>" class="btn btn-primary">Delete</a></td>
                        
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
