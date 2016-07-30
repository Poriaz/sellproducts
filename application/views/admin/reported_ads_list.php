<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Reported Ads
            
          </h1>
          <ol class="breadcrumb">
           <li><a href="<?php echo base_url();?>admin/index">Admin</a></li>
            <li class="active">Reported ads</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
                
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> Reported Ads </h3>
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
			<?php 
			if(count($spam_reports) > 0){
			foreach($spam_reports as $report){ ?>
                      <tr>
                        <td><?php echo $report['email'];?></td>
                        <td><?php echo $report['message'];?></td>
                        <td><a target="_blank" href="<?php echo base_url();?>add/view/<?php echo $report['add_id'];?>" class="btn btn-primary">View</a>  <a href="<?php echo base_url();?>admin/delete_report/<?php echo $report['id'];?>" class="btn btn-primary">Delete</a></td>
                        
                      </tr>
			<?php } } else { ?>
					<tr>
                        <td colspan="3">No spam reports till now !</td>
                        
                        
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
