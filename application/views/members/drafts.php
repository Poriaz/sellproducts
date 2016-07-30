<style>
.pagination_div > p {
    float: left;
    width: 50%;
}
.dashboard_pagi{
	text-align:right;
}
.row.posting-list span {
  width: 19.8% !important;
  background:#FFEEDD;
  border:1px solid pink;
}
</style>
<?php $page_name = $this->uri->segment('2');?>
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/style-dashboard.css" rel="stylesheet">
<div class="dash2 space">
  <div class="container-fluid">
    <div class="row light-back">
      <div class="col-md-12 border-btm">
        <div class="dash21">
          <ul>
           <li style="<?php if($page_name == 'dashboard'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/dashboard"> Postings</a></li>
            <li style="<?php if($page_name == 'drafts'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/drafts">Drafts</a></li>
            <li style="<?php if($page_name == 'saved_searches'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/saved_searches">Saved Searches</a></li>
            <li style="<?php if($page_name == 'saved_items'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/saved_items"> Saved Items</a></li>
            <li style="<?php if($page_name == 'messages'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/messages"> Messages</a></li>
            <li style="<?php if($page_name == 'compare_items'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/compare_items"> Compare Items</a></li>
            <li style="<?php if($page_name == 'profile'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/profile">Settings</a></li>
            <li style="<?php if($page_name == 'changepassword'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/changepassword"> Change Password</a></li>
            <li style="<?php if($page_name == 'logout'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>auth/logout"> Log Out</a></li>
          
          </ul>
        </div>
      </div>
    </div>
    
      <div class="col-md-12 pagination drft">
      <h4>Showing Drafts</h4>
     
      <div class="row posting-list">
      <ul>
      <li>
      <h5>
	  <span class="ide">id</span>
      <span class="posting-title">Title</span>
      <span class="area">Category</span>
       <span class="pdate">Date</span>
      <span class="exp">Manage</span>
	  
     </h5>
 
<?php 
$i = 1;
foreach($drafts as $add){ 
$images = $this->db->get_where('add_images',array('add_id' => $add['add_id']))->result_array();
$category = $this->db->get_where('categories',array('c_id' => $add['add_category']))->result_array();
?>
<p class="active" id="saved_row_<?php echo $add['add_id'];?>">
     <span class="ide"><?php echo $add['add_id'];?></span>
      <span class="posting-title"><a class="no_background" href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>"><?php echo $add['add_title'];?></a></span>
      <span class="area"><?php echo $category[0]['c_title'];?></span>
    
      
      <span class="pdate"><?php echo date("d, M Y H:i",strtotime($add['created']));?></span>
      <span class="exp">
		
		<a class="no_background" href="" onclick="delete_draft(<?php echo $add['add_id'];?>);return false;">Delete</a>
		<a class="no_background" href="" onclick="publish_draft(<?php echo $add['add_id'];?>);return false;" id="compare_<?php echo $add['add_id'];?>">Publish</a>
	</span>
      
      </p>

<?php $i++; } ?>




      

      
      </li>
      </ul>
      </div>
      </div>
    </div>
  </div>
</div>
<script>

function publish_draft(id){
	$.ajax({
		url : '<?php echo base_url();?>add/publish_draft',
		data :{'add_id':id},
		type : 'post',
		success : function(){
			alert("Published !");
			$('#saved_row_'+id).hide(0);
		}
	     });

}
function delete_draft(id){
	$.ajax({
		url : '<?php echo base_url();?>add/delete_draft',
		data :{'add_id':id},
		type : 'post',
		success : function(){
			$('#saved_row_'+id).hide(0);
		}
	     });

}

</script>