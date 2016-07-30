<style>
.pagination_div > p {
    float: left;
    width: 50%;
}
.dashboard_pagi{
	text-align:right;
}
.row.posting-list span{
	width:19.8%;
}
.date_posted > span {
  border-right: 1px solid #ffffff;
  height: auto !important;
  padding: 0 !important;
}
.add_price {
  margin: 8px 0 !important;
  padding: 0 !important;
}
.svd-items .snc-div {
  text-align: center;
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
		<div class="container svd-items"> 
        <?php /*?><div class="sort-search">
   		<!-------side-bar ----------------------->
        <h3>Modify Results </h3>
    <div class="sd-bar">
    	
            <form action="<?php echo base_url();?>search/results" method="get" id="home_search_form">
		   <input type="hidden" name="page" value="<?php echo $page_num;?>"  />
		  <input type="hidden" name="order" value="<?php echo $order_in_url;?>"  />
		  <input type="hidden" name="per_page" value="<?php echo $per_page_in_url;?>"  />
                  <input type="hidden" name="postal_code" id="postal_code_updated" value="<?php echo $postal_code;?>"/> 
                  <input type="hidden" name="radius" value="<?php echo $miles_in_url;?>"  />
          <div class="prc-filter">
        	<h4>Search</h4>
			<div class="filterd-val">
            	<input type="text" name="term" id="search_term" placeholder="Search Product" value="<?php echo $term;?>"/>
            </div>
          </div>   
        
    	<div class="sd-catgry">    	
    	<h4>Category</h4>
    	<select name="category" id="search_item_category">
		  <option value="">All Category</option>
		 <?php foreach($categories as $category){ ?>
                  <option value="<?php echo $category['c_id'];?>" <?php if((isset($post_data['category']) && $post_data['category'] == $category['c_id']) || ($category_in_url ==$category['c_id'])){echo 'selected=selected';}?>><?php echo $category['c_title'];?></option>
                 <?php } ?>
        </select>  
        </div>
        
    
        <div class="prc-filter">
        	<h4>Price</h4>
			<div class="filterd-val">
            	<input type="text" id="search_min_price" name="min_price"  autocomplete='off' placeholder="Min. Price" value=""/>
                <input type="text" id="search_max_price" name="max_price" placeholder="Max. Price" value=""/>
            </div>
        </div>
        <div class="prc-filter">
        	<h4>Seller Type</h4>
			<div class="filterd-val">
            	<ul>
                	<li>
                  <input type="checkbox" name="dealer_type" class="check-box" value="dealer" id="search_item_condition_new" >
                  Dealer</li>
                <li>
                  <input type="checkbox" name="dealer_type1" value="private" class="check-box" id="search_item_condition_used">
                  Private</li>
                </ul>
            </div>
        </div>
        <div class="prc-filter">
        	<h4>Condition</h4>
			<div class="filterd-val">
            	<ul>
                	<li>
                  <input type="checkbox" name="used_type" class="check-box" value="new" id="search_item_condition_new">
                  New</li>
                <li>
                  <input type="checkbox" name="used_type1" value="used" class="check-box" id="search_item_condition_used" >
                  Used</li>
                </ul>
            </div>
        </div>
        <p class="sv-srch"><a href="#" id="save_search">Save Search</a></p>
        <p><input type="text" name="find" id="search_submit_btn" value="Search(<?php echo $total_results;?>)" class="search1"  disabled="disabled"/></p>
        <p class="svd-srch">
			
			  <a href="#" class="saved_search_link">Saved Searches (<?php echo $num_searches;?>)</a>
			  </p>
            </form>
    </div>    
    
    <!------------------------------>
   </div><?php */?>
        
        
           
      <div class="col-md-12 pagination">
      <h4>Saved Items</h4>
       <?php 
       $param = $this->pagination->cur_page * $this->pagination->per_page;
        if($param > $total_results || $param == 0){
            $param = $total_results;
        }
         ?>
      <div class="pagination_div"><p> (<?php echo $total_results;?> Saved Items)</p></div>
      <div class="row posting-list">
      
          <div class="search-wrap">     
 <?php 
		$flag = 0;
                $current_usr = $this->db->get_where('users',array('id' => $_SESSION['user_id']))->result_array(); 
                
		foreach($saved_items as $add){ 
		$images = $this->db->get_where('add_images',array('add_id' => $add['add_id']))->result_array();
		$category = $this->db->get_where('categories',array('c_id' => $add['add_category']))->result_array();
		$dealer = $this->db->get_where('users',array('id' => $add['add_added_by_member']))->result_array();
		$latlng = $this->db->get_where('zipcodes',array('zip_code' => $add['add_postal_code']))->result_array();
		/*$earthRadius = 3976;
		$latFrom = deg2rad($_SESSION['client_lat']);
		$lonFrom = deg2rad($_SESSION['client_lon']);
		$latTo = deg2rad(@$latlng[0]['latitude']);
		$lonTo = deg2rad(@$latlng[0]['longitude']);
		$latDelta = $latTo - $latFrom;
		$lonDelta = $lonTo - $lonFrom;
		$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));*/
                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$current_usr[0]['postal_code'];
                $url .="&destinations=".$add['add_postal_code']."&mode=driving";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $response = curl_exec($ch);
                curl_close($ch);
                $response_a = json_decode($response, true);
                //echo "<pre>";print_r($response_a);echo "</pre>";
                $distance_driv = $response_a['rows'][0]['elements'][0]['distance']['value'] / 1000;
		
   ?>
<div class="row list" id="saved_add_<?php echo $add['add_id'];?>" style="margin:0"><div class="container">
    <div class="col-sm-121">
		 <div class="lorem">
         	<div class="row11">
		    <div class="col-md-10 col-sm-7 col-xs-12">
		    <h4><a href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>"><?php echo $add['add_title'];?></a> </h4>
            
		    </div>
		    <div class="col-md-2 col-sm-5 col-xs-12">
		    <?php /*?><h4>
			
			<a class="save_compare_links" href="https://www.facebook.com/sharer.php?u=<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>&t=<?php echo $add['add_title'];?>"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/facebook.png" height="20px" width="20px"/></a>
			<a class="save_compare_links" href="http://twitter.com/intent/tweet?source=<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>&text=<?php echo $add['add_title'];?>"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/twitter.png" height="20px" width="20px"/></a>
			<a class="save_compare_links" href="https://plus.google.com/share?url=<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/google.png" height="20px" width="20px"/></a>
			</h4><?php */?>
            <div class="snc-div">
                                <?php if(!isset($_SESSION['user_id'])){ ?>
                                <a class="save_compare_links" href="<?php echo base_url().'auth/login/';?>" id="save_<?php echo $add['add_id'];?>">Save</a>
                                <a class="save_compare_links" href="<?php echo base_url().'auth/login/';?>" id="compare_<?php echo $add['add_id'];?>">Compare</a>
                                
                                <?php } else { 
                                 $check_compared = $this->db->get_where('compare_adds',array('user_id'=> $_SESSION['user_id'],'add_id'=>$add['add_id']))->result_array();
                                ?>
                                    <a class="save_compare_links" href="#" onclick="delete_saved(<?php echo $add['add_id'];?>);return false;" style="cursor:pointer;">Remove</a>
                                    <?php if(count($check_compared) > 0){ ?>
                                    <a  class="save_compare_links" onclick="#" style="cursor:pointer;">Compared</a>
                                    <?php } else { ?>
                                    <a  class="save_compare_links"  style="cursor:pointer;" onclick="compare_add(<?php echo $add['add_id'];?>);return false;" id="compare_<?php echo $add['add_id'];?>">Compare</a>
                                    <?php } ?>  
                                <?php } ?>
            </div>
		    </div>
            </div>
            
            
            
		    <div class="row11">
                <div class="col-sm-2 item-img list">
				<a href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>">
				<?php if(!empty($images[0]['image']) && file_exists('assets/uploads/add_portfolio/'.$images[0]['add_id'].'/'.$images[0]['image'])){ ?>
                   <img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $images[0]['add_id']."/".$images[0]['image'];?>" alt="products"/>
                <?php } else { ?>
					<img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="categories"/>
				<?php } ?>  
				</a>
                    <p class="date_posted"> <span><?php echo date('M d',strtotime($add['created']));?></span></p>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12 list">
        	<div class="lorem-text">
            	<h4 class="add_price"><?php echo "$".$add['add_price'];?></h4>
				<?php /*?><p><a href=""><?php echo $category[0]['c_title'];?></a><a href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>" > <i class="fa fa-angle-double-right"></i> <?php echo $add['add_title'];?></a></p><?php */?>
                <p><?php echo $add['add_description'];?> </p>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12 lg">
        	<div class="lorem-side">
                <p>
				<?php if(!empty($dealer[0]['image']) && file_exists('assets/uploads/user_images/'.$dealer[0]['image'])){ ?>
                                    <?php if(!file_exists('assets/uploads/user_images/88*31'.$dealer[0]['image'])  && !empty($dealer[0]['image']) && !is_numeric($dealer[0]['image'])){
                                        $new_images = 'assets/uploads/user_images/88*31'.$dealer[0]['image'];
                                        $width=88;
                                        $size = GetimageSize('assets/uploads/user_images/'.$dealer[0]['image']);
                                        $height=31;
                                        $images_orig = ImageCreateFromJPEG('assets/uploads/user_images/'.$dealer[0]['image']);
                                        $photoX = ImagesX($images_orig);
                                        $photoY = ImagesY($images_orig);
                                        $images_fin = ImageCreateTrueColor($width, $height);
                                        ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                                        ImageJPEG($images_fin,$new_images);
                                        ImageDestroy($images_orig);
                                        ImageDestroy($images_fin);
                                        }   
                                    ?>
				<img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/88*31<?php echo $dealer[0]['image'];?>" />
				<?php } else { ?>
                                <?php if($dealer[0]['user_type'] == 'private'){ ?>
                                <img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/private-seller.jpg" alt="categories"/>
                                
                                <?php } else if($dealer[0]['user_type'] == 'dealer'){ ?>
                                <img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/dealer.jpg" alt="categories"/>
                                
                                <?php } else { ?>
				<img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/user.jpeg" alt="categories"/>
                                <?php } } ?>
				</p>
			<h3><?php 
			if(!$distance_driv){
				echo round($add['distance']*1.6)." km away";
			} else {
				echo round($distance_driv)." km away";
			} ?></h3>
               <?php /*?> <h2><?php echo $category[0]['c_title'];?></h2><?php */?>
                </div>
            </div></div></div>
                

    
 </div>   </div>
  
 </div>
<?php $i++; } ?>
      <p class="pagination_links dashboard_pagi"><?php echo $links; ?></p>


      

      
          </div>
      </div>
      </div><!------------------pagination div ends------------------>
      </div>
    </div>
  </div>
</div>

<div id="alreadycompared" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3> Item not compared </h3>
		
               
            </div>
            <div class="modal-body">
		 <p>You have already added this item to compare list or you are trying to add more than 4 items to <a href="<?php echo base_url();?>members/compare_items">compare list </a> </p>		
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
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
		success : function(data){
			 if(data != 0){
			$('#compare_'+id).html('Compared');
                        } else {
                        $("#alreadycompared").modal('show');
                        }
		}
	     });

}
function delete_saved(id){
	$.ajax({
		url : '<?php echo base_url();?>add/delete_saved',
		data :{'add_id':id},
		type : 'post',
		success : function(){
			$('#saved_add_'+id).hide(0);
		}
	     });

}

</script>
<style>
.dash2 .col-md-12.pagination {
  padding-top: 0;
}
</style>