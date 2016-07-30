<style>
.pagination_div > p {
    float: left;
    width: 50%;
}
.dashboard_pagi{
	text-align:right;
}
.row.posting-list span{
	width:20% !important;
}
</style>
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/style-dashboard.css" rel="stylesheet">
<div class="dash2 space">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="dash21">
          <ul>
            <li><a href="<?php echo base_url();?>members/dashboard"> Postings</a></li>
            <li><a href="<?php echo base_url();?>members/drafts">Draft</a></li>
            <li><a href="<?php echo base_url();?>members/saved_searches">Searches</a></li>
            <li><a href="<?php echo base_url();?>members/profile">settings</a></li>
            <li><a href="<?php echo base_url();?>members/saved_items"> Saved Items</a></li>
			<li><a href="<?php echo base_url();?>members/compare_items"> Compare Items</a></li>
			<li><a href="<?php echo base_url();?>members/changepassword"> Change Password</a></li>
			<li><a href="<?php echo base_url();?>auth/logout"> Log Out</a></li>
          </ul>
        </div>
      </div>
    </div>
    
      <div class="col-md-12 pagination">
      <h4>Showing Billing Accounts</h4>
     
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
 
<p class="active">
     <span class="ide">12</span>
      <span class="posting-title">Induction</span>
      <span class="area">Cooking</span>
    
      
      <span class="pdate">09, Oct 2015 02:28</span>
      <span class="exp">
		
		Delete
	</span>
      
      </p>




      

      
      </li>
      </ul>
      </div>
      </div>
    </div>
  </div>
</div>
<script>

function compare_add(id){
	$.ajax({
		url : '<?php echo base_url();?>add/compare',
		data :{'id':id},
		type : 'post',
		success : function(){
			alert("Added to compare list !");
		}
	     });

}
function delete_saved(id){
	$.ajax({
		url : '<?php echo base_url();?>add/delete_saved',
		data :{'add_id':id},
		type : 'post',
		success : function(){
			$('#saved_row_'+id).hide(0);
		}
	     });

}

</script>