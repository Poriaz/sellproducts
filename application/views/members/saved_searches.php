<style>
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
    
      <div class="col-md-12 pagination">
           <?php 
       $param = $this->pagination->cur_page * $this->pagination->per_page;
        if($param > $total_results || $param == 0){
            $param = $total_results;
        }
         ?>
      <h4>Saved Searches</h4>
       <p> (<?php echo $total_results;?> Saved Searches)</p>
      <div class="row posting-list">
          <div class="table-responsive">
          <table id="example"  class="table">
              <thead><tr><th>Created</th><th>Search</th><th>Category</th><th>Condition</th><th>Seller Type</th><th>Min Price</th><th>Max Price</th><th>Alerts</th><th>Manage</th></tr></thead>
              <tbody>
                  <?php 
                    $i = 1;
                    foreach($search_saved as $search){ 
                    $category = $this->db->get_where('categories',array('c_id' => $search['category']))->result_array();
                    if(empty($category)){
                        $cat = 'All Categories';
                    } else {
                        $cat = $category[0]['c_title'];
                    }
                    ?>
                  <tr id="saved_row_<?php echo $search['id'];?>">
                      <td style="width:130px"><?php echo $search['date_created'];?></td>
                      <td style="width:245px"><?php if(!empty($search['term'])){echo $search['term'];} else { echo "";}?></td>
                      <td><?php echo $cat;?></td>
                      <td><?php echo $search['item_condition'];?></td>
                      <td><?php echo $search['dealer_type'];?> <?php echo $search['dealer_type1'];?></td>
                      <td><?php echo $search['min_price'];?></td>
                      <td><?php echo $search['max_price'];?></td>
                      <td><input type="checkbox" <?php if($search['set_alert'] == "1"){echo "checked=checked";}?> id="alert_checkbox_<?php echo $search['id'];?>" name="alert_checkbox_<?php echo $search['id'];?>" value="1" onclick="change_alert(<?php echo $search['id'];?>);"></td>
                      <td>
                            <a class="no_background"  href="" onclick="delete_saved(<?php echo $search['id'];?>);return false;">Delete</a>
                            <a  class="no_background" href="<?php echo base_url();?>welcome/index/<?php echo $search['id'];?>">Edit</a>
                      </td>
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
<script>

$(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 3, "desc" ]],
        "iDisplayLength": 20
    } );
} );
function delete_saved(id){
	$.ajax({
		url : '<?php echo base_url();?>members/delete_search',
		data :{'search_id':id},
		type : 'post',
		success : function(){
			$('#saved_row_'+id).hide(0);
		}
	     });

}
function change_alert(search_id){
        if($("#alert_checkbox_"+search_id).is(":checked")){
                var search_alert = 1;
        } else {
                 var search_alert = 0;
        }
        $.ajax({
		url : '<?php echo base_url();?>members/update_search_name',
		data :{'id':search_id,'alert' : search_alert},
		type : 'post',
		success : function(){
			
		}
	     });
}
</script>
<style>
.dash2 .col-md-12.pagination {
  padding-top: 0;
}
</style>