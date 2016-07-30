<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           News
            <small><a href="<?php echo base_url();?>admin/add_news">Add new</a></small>
          </h1>
          <ol class="breadcrumb">
            
            <li><a href="<?php echo base_url();?>admin/index">Admin</a></li>
            <li class="active">News</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
                
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">News</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>News</th>
                        <th>Action(s)</th>
                       
                      </tr>
                    </thead>
                    <tbody>
			<?php foreach($news as $news_item){?>
                      <tr>
                        <td><?php echo $news_item['nw_title'];?></td>
                        <td><?php echo $news_item['nw_description'];?></td>
                        <td><a href="<?php echo base_url();?>admin/edit_news/<?php echo $news_item['nw_id'];?>" class="btn btn-primary">Edit</a>  <a href="<?php echo base_url();?>admin/delete_news/<?php echo $news_item['nw_id'];?>" class="btn btn-primary">Delete</a></td>
                        
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
