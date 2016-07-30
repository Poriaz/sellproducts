
<script src="//code.jquery.com/jquery-1.12.0.min.js" ></script>   
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js" ></script>
<?php $page_name = $this->uri->segment('2');?>
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/style-dashboard.css" rel="stylesheet">
<div class="dash2 space">
  <div class="container-fluid">
    <div class="row light-back">
      <div class="col-md-12 border-btm">
        <div class="dash21">
         <ul>
           <li style="<?php if($page_name == 'dashboard'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/dashboard"> Postings</a></li>
            <li style="<?php if($page_name == 'saved_searches'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/saved_searches">Saved Searches</a></li>
            <li style="<?php if($page_name == 'saved_items'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/saved_items"> Saved Items</a></li>
            <li style="<?php if($page_name == 'messages' || $page_name == 'sent_messages'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/messages"> Messages</a></li>
            <li style="<?php if($page_name == 'compare_items'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/compare_items"> Compared Items</a></li>
            <li style="<?php if($page_name == 'profile'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/profile">Settings</a></li>
            <li style="<?php if($page_name == 'changepassword'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/changepassword"> Change Password</a></li>
            <li style="<?php if($page_name == 'logout'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>auth/logout"> Log Out</a></li>
          
          </ul>
        </div>
      </div>
    </div>   
      <div class="col-md-12 pagination messgs">
           <?php 
       $param = $this->pagination->cur_page * $this->pagination->per_page;
        if($param > $total_results || $param == 0){
            $param = $total_results;
        }
         ?>
		<div class="m_tabs">
			<ul class="messages_tab">
				<li><a href="<?php echo base_url();?>members/messages">Inbox</a></li>
				<li class="active"><a href="<?php echo base_url();?>members/sent_messages">Sent</a></li>
			</ul>
		</div>
      <h4>Sent Messages</h4>
      <p> ( Messages <?php echo  $param." of ".$total_results." total results"; ?> )</p>
      
       <div class="table-responsive">
      <div class="row posting-list">
          <table id="example"  class="table">
              <thead><tr><th>Id</th><th>Post Title</th><th>Message</th><th>Sent Date</th><th>Phone Number</th></tr></thead>
              <tbody>
                  <?php 
                    $i = 1;
                    foreach($messages as $message){ 
                    $add = $this->db->get_where('advertisement',array('add_id'=>$message['add_id']))->result_array();

                    ?>
                  <tr>
                      <td><?php echo $message['id'];?></td>
					  <td><a style="background:none;color:black;text-decoration:underline;" target="_blank" href="<?php echo base_url();?>add/view/<?php echo $add[0]['add_id'];?>"><?php echo $add[0]['add_title'];?></a></td>
                      <td class="mess12"><?php echo $message['message'];?></td>
                      <td><?php echo $message['date_created'];?></td>
                      <td><?php echo $message['phone'];?></td>
                  </tr>
                  <?php $i++; } ?>
              </tbody>
          </table>
     <p class="pagination_links dashboard_pagi"><?php echo $links; ?></p>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>
<style>

 .mess12{   width: 50%!important;
}	
.pagination_div > p {
    float: left;
    width: 50%;
}
.dashboard_pagi{
	text-align:right;
}
.row.posting-list span{
	width:19.8% !important;
}
#example_length{
    display:none;
}
#example_filter{
    display:none;
}
#example_info{
    display:none;
}
#example_paginate{
    display:none;
}
</style>
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 3, "desc" ]],
        "iDisplayLength": 20,
		
    } );
} );
    </script>
    