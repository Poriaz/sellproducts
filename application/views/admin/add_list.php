<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Advertisements
            <small></small>
          </h1>
          <ol class="breadcrumb">
             <li><a href="<?php echo base_url();?>admin/index">Admin</a></li>
            <li class="active">Advertisements</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
                
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Advertisements</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Action(s)</th>
                      </tr>
                    </thead>
                    <tbody>
			<?php foreach($adds as $add){ ?>
                      <tr>
                        <td><?php echo $add['add_title'];?></td>
                        <td><?php echo $add['add_description'];?></td>
                        <td><?php echo $add['add_category'];?></td>
                        <td><?php echo "$".$add['add_price'];?></td>
                        <td><a href="<?php echo base_url();?>admin/edit_advertisement/<?php echo $add['add_id'];?>" class="btn btn-primary">Edit</a>  <a href="<?php echo base_url();?>admin/delete_advertisement/<?php echo $add['add_id'];?>" class="btn btn-primary">Delete</a></td>
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
