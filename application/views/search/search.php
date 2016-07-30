<style>
    .fa-angle-right,.fa-angle-left {
    cursor: pointer;
    font-size: 24px;
    margin-left: 14px;
    margin-right: 12px;
    margin-top: -3px;
    color: white !important;
}
</style>
<div class="search-page space single-search">
<?php 				  
	$page_num = (int)$this->input->get('page');
	$order_seg = ($this->input->get('order')) ? $this->input->get('order') : 'price-asc'; 
	if($order_seg == "price-asc") {$order = "price-desc";} else { $order = "price-asc"; }
	$price_range_in_url = ($this->input->get('min_price')) ? $this->input->get('min_price') : '';
	$category_in_url = ($this->input->get('category')) ? $this->input->get('category') : '';
	$per_page_in_url = ($this->input->get('per_page')) ? $this->input->get('per_page') : '25';
	$order_in_url = ($this->input->get('order')) ? $this->input->get('order') : 'price-asc';
	$miles_in_url = ($this->input->get('radius')) ? $this->input->get('radius') : '25';
        $postal_code = ($this->input->get('postal_code')) ? $this->input->get('postal_code') : 'v6a 1r3';
        $term = ($this->input->get('term')) ? $this->input->get('term') : '';
        if(!empty($category_in_url)){
            $category_data = $this->db->get_where('categories',array('c_id'=>$category_in_url))->result_array();
            $category_name_in_header = $category_data[0]['c_title'];
        } else {
            $category_name_in_header = "Equipments";
        }
?>
  <?php 
	 $param = $this->pagination->cur_page * $this->pagination->per_page;
	if($param > $total_results || $param == 0){
		$param = $total_results;
	}
	 ?>
    <?php $active_page_number = floor( $page_num/$per_page_in_url + 1); ?>
    <div class="type" style="background:none; padding:0px;">
        <div class="container">
        <div class="change_location" style="float:left;width:70%;"><h3><?php echo $category_name_in_header;?> in <?php echo $place_details;?> </h3> <a href="#" class="btn1 btn-info1 btn-lg1" data-toggle="modal" data-target="#mylocationModal">Change location</a></div>
        <div class="no_of_results" style="float:right;width:30%;text-align:right;"><h3><b><?php echo $total_results;?> </b></h3><span>Matching Listings</span></div>
        </div>
	  <div class="container"><div class="pagi">
      <div class="col-md-12 sorting-group">
        <div class="sorting" style="font-size:16px; color:#000;"> <label>Within:</label> <span>         
          <select class="sortby" onchange="change_miles($(this).val());">
		  <option value="">Choose One</option>
			<option value="25" <?php if($miles_in_url == '25'){echo "selected = selected";}?>>25 Km</option>
           <option value="50" <?php if($miles_in_url == '50'){echo "selected = selected";}?>>50 Km</option>
            <option value="100" <?php if($miles_in_url == '100'){echo "selected = selected";}?>>100 Km</option>
            <option value="200" <?php if($miles_in_url == '200'){echo "selected = selected";}?>>200 Km</option>
            <option value="5000" <?php if($miles_in_url == '5000'){echo "selected = selected";}?>>Any Distance</option>
          </select>
          </span>
        </div>
        <div class="sorting" style="font-size:16px; color:#000;"><label> Sort By: </label>
          <span>          
              <select class="sortby" onchange="change_order($(this).val());">
                <option value="">Choose One</option>
                <option value="add_price-desc" <?php if($order_in_url == 'add_price-desc'){echo "selected = selected";}?>>Price-Highest</option>
                <option value="add_price-asc" <?php if($order_in_url == 'add_price-asc'){echo "selected = selected";}?>>Price-Lowest</option>
                <option value="distance-asc" <?php if($order_in_url == 'distance-asc'){echo "selected = selected";}?>>Distance-Closest</option>
                <option value="distance-desc" <?php if($order_in_url == 'distance-desc'){echo "selected = selected";}?>>Distance-Farthest</option>
                <option value="created-desc" <?php if($order_in_url == 'created-desc'){echo "selected = selected";}?>>Post date- Newest</option>
                <option value="created-asc" <?php if($order_in_url == 'created-asc'){echo "selected = selected";}?>>Post date- Oldest</option>               
              </select>
          </span>
        </div>
        <div class="sorting" style="font-size:16px; color:#000;"><label>Per Page:</label> <span>        
          <select class="sortby" onchange="change_per_page($(this).val());">
		  <option value="">Choose One</option>
		  <option value="10" <?php if($per_page_in_url == '10'){echo "selected = selected";}?>>10</option>
            <option value="25" <?php if($per_page_in_url == '25'){echo "selected = selected";}?>>25</option>
            <option value="50" <?php if($per_page_in_url == '50'){echo "selected = selected";}?>>50</option>
            <option value="100" <?php if($per_page_in_url == '100'){echo "selected = selected";}?>>100</option>
          </select>
          </span>
        </div>
         <div class="buttons"> 
          <button class="list"><i class="fa fa-list"></i> List View</button>   
        <button class="grid"><i class="fa fa-th"></i> Grid View</button>
    	</div>
      </div>
	  <div class="pages-showing">
              
	   <div class="sorting">
               <?php if($active_page_number != 1) { ?>
                   <a style="cursor:pointer;" onclick="setGetParameter('page','<?php echo $page_num - $per_page_in_url;?>');"> <i class="fa fa-angle-left"></i> </a>
               <?php } ?>
               <?php 
               $check = ceil($total_results/$per_page_in_url);
               if($check == 0){
                   $counting = 1;
               } else {
                   $counting = $check;
               }
               echo "<span class='search_page_no_of_page'>Page ".$active_page_number." of ".$counting."</span>"; ?>
                <?php if( $active_page_number < ceil($total_results/$per_page_in_url)) { ?>
                   <a style="cursor:pointer;" onclick="setGetParameter('page',<?php echo $page_num + $per_page_in_url;?>);"> <i class="fa fa-angle-right"></i> </a>
               <?php } ?>
           </div>
      </div>
	  </div>
      
    </div>
    <div class="container">
      
   <div class="sort-search">
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
		  <option value="">All Categories</option>
		 <?php foreach($categories as $category){ ?>
                  <option value="<?php echo $category['c_id'];?>" <?php if((isset($post_data['category']) && $post_data['category'] == $category['c_id']) || ($category_in_url ==$category['c_id'])){echo 'selected=selected';}?>><?php echo $category['c_title'];?></option>
                 <?php } ?>
        </select>  
        </div>
        
        <?php /*?><div class="sortBy">
        <h4>Sort By</h4>
         <select onchange="change_order($(this).val());" class="sortby">
		<option>Select one</option>
		  <option value="asc" <?php if($order_in_url == 'asc'){echo "selected = selected";}?>>Price-Lowest</option>
          <option value="desc" <?php if($order_in_url == 'desc'){echo "selected = selected";}?>>Price-Highest</option>
         </select>  
		
		
        </div><?php 
		<div class="prc-filter">
        	<h4>Price Filter</h4>
        	<input type="range" id="sliderBar" min="0" max="10000" step="1" value="<?php echo $price_range_in_url;?>" onChange="showValue(this.value);change_price($(this).val());"/>
			<div class="filterd-val">
            	<span>Upto $</span><div id="result"></div><span><?php echo $price_range_in_url;?></span>
            </div>
        </div>*/?>
        <div class="prc-filter">
        	<h4>Price</h4>
			<div class="filterd-val">
            	<input type="text" id="search_min_price" name="min_price"  autocomplete='off' placeholder="Min. Price" value="<?php echo $price_range_in_url;?>"/>
                <input type="text" id="search_max_price" name="max_price" placeholder="Max. Price" value="<?php if(isset($post_data['max_price']) && !empty($post_data['max_price'])){echo $post_data['max_price'];}?>"/>
            </div>
        </div>
        <div class="prc-filter">
        	<h4>Seller Type</h4>
			<div class="filterd-val">
            	<ul>
                	<li>
                  <input type="checkbox" name="dealer_type" class="check-box" value="dealer" id="search_item_condition_new" <?php if(isset($post_data['dealer_type']) && $post_data['dealer_type'] == "dealer"){echo 'checked=checked';}?>>
                  Dealer</li>
                <li>
                  <input type="checkbox" name="dealer_type1" value="private" class="check-box" id="search_item_condition_used" <?php if(isset($post_data['dealer_type1']) && $post_data['dealer_type1'] == "private"){echo 'checked=checked';}?>>
                  Private</li>
                </ul>
            </div>
        </div>
        <div class="prc-filter">
        	<h4>Condition</h4>
			<div class="filterd-val">
            	<ul>
                	<li>
                  <input type="checkbox" name="used_type" class="check-box" value="new" id="search_item_condition_new" <?php if(isset($post_data['used_type']) && $post_data['used_type'] == "new"){echo 'checked=checked';}?>>
                  New</li>
                <li>
                  <input type="checkbox" name="used_type1" value="used" class="check-box" id="search_item_condition_used" <?php if(isset($post_data['used_type1']) && $post_data['used_type1'] == "used"){echo 'checked=checked';}?>>
                  Used</li>
                </ul>
            </div>
        </div>
        <p class="sv-srch"><a href="#" id="save_search">Save Search</a></p>
        <p><input type="submit" name="find" id="search_submit_btn" value="Search(<?php echo $total_results;?>)" class="search1"/></p>
        <p class="svd-srch">
			  <?php $num_searches = $this->db->get_where('save_search',array('user_id' =>@$_SESSION['user_id']))->num_rows(); ?>
			  <a href="<?php echo base_url();?>members/saved_searches" class="saved_search_link">Saved Searches (<?php echo $num_searches;?>)</a>
			  </p>
            </form>
    </div>    
    
    <!------------------------------>
   </div> 
   <?php
   if($matching_results == 'no_results'){
	$advertisements = $this->db->query('select * from advertisement limit 20')->result_array();
   ?>
   <div class="search_empty_msg"> <p><i class="fa fa-frown-o"></i> <br/>Sorry ! we couldn't find the matching results .. though you can try other equipments.</p></div>
   <?php } ?>
       <div class="search-wrap">     
<?php 
		$flag = 0;
                
		foreach($advertisements as $add){ 
		$images = $this->db->get_where('add_images',array('add_id' => $add['add_id']))->result_array();
		$category = $this->db->get_where('categories',array('c_id' => $add['add_category']))->result_array();
		$dealer = $this->db->get_where('users',array('id' => $add['add_added_by_member']))->result_array();
		$latlng = $this->db->get_where('zipcodes',array('zip_code' => $add['add_postal_code']))->result_array();
		/*$earthRadius = 3976;
		$latFrom = deg2rad($dealer[0]['latitude']);
		$lonFrom = deg2rad($dealer[0]['longitude']);
		$latTo = deg2rad(@$latlng[0]['latitude']);
		$lonTo = deg2rad(@$latlng[0]['longitude']);
		$latDelta = $latTo - $latFrom;
		$lonDelta = $lonTo - $lonFrom;
		$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
                if(isset($_SESSION['user_id'])){
                    $current_usr = $this->db->get_where('users',array('id' => $_SESSION['user_id']))->result_array(); 
                    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$current_usr[0]['postal_code'];
                 } else {
                     $postal_from_latlng = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$_SESSION['client_lat'].",".$_SESSION['client_lon']."&sensor=true";
                     $postal_get = file_get_contents($postal_from_latlng);
                     $postal_get = json_decode($postal_get);
                     //echo "<pre>";print_r($postal_get);echo "</pre>";
                     $postal_get->results[0]->formatted_address;
                     $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$postal_get->results[0]->formatted_address;
                 }
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
                $distance_driv = $response_a['rows'][0]['elements'][0]['distance']['value']/1000;*/
		
   ?>
 
  
  <div class="row list" style="margin:0"><div class="container">
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
            <span class="snc-div">
                                <?php if(!isset($_SESSION['user_id'])){ ?>
                                <a class="save_compare_links" href="<?php echo base_url().'auth/login/';?>" id="save_<?php echo $add['add_id'];?>">Save</a>
                                <a class="save_compare_links" href="<?php echo base_url().'auth/login/';?>" id="compare_<?php echo $add['add_id'];?>">Compare</a>
                                
                                <?php } else { 
                                 $check_saved  = $this->db->get_where('saved_adds',array('user_id'=> $_SESSION['user_id'],'add_id'=>$add['add_id']))->result_array();
                                 $check_compared = $this->db->get_where('compare_adds',array('user_id'=> $_SESSION['user_id'],'add_id'=>$add['add_id']))->result_array();
                        
                                ?>
                                        <?php if(count($check_saved) > 0){ ?>
                                        <a class="save_compare_links" href="#" >Saved</a>
                                        <?php } else { ?>
                                        <a class="save_compare_links" style="cursor:pointer;" onclick="save_add(<?php echo $add['add_id'];?>);return false;" id="save_<?php echo $add['add_id'];?>">Save</a>
                                        <?php } ?>
                                         <?php if(count($check_compared) > 0){ ?>
                                        <a class="save_compare_links" href="#">Compared</a>
                                        <?php } else { ?>
                                        <a class="save_compare_links" style="cursor:pointer;" onclick="compare_add(<?php echo $add['add_id'];?>);return false;" id="compare_<?php echo $add['add_id'];?>">Compare</a>
                                        <?php } ?>  
                                <?php } ?>
            </span>
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
                    <p class="date_posted"><span><?php echo date('M d',strtotime($add['created']));?></span></p>
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
                                    <?php if(!file_exists('assets/uploads/user_images/'.$dealer[0]['image'])  && !empty($dealer[0]['image']) && !is_numeric($dealer[0]['image'])){
                                        $new_images = 'assets/uploads/user_images/'.$dealer[0]['image'];
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
				<img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/<?php echo $dealer[0]['image'];?>" />
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
			echo $add['distance']; ?></h3>
               <?php /*?> <h2><?php echo $category[0]['c_title'];?></h2><?php */?>
                </div>
            </div></div></div>
                

    
 </div>   </div>
  
 </div> 


 <?php $flag = 1; ?>
                <?php } ?> 
           <?php if($total_results > $per_page_in_url){?>
           <div> <ul class="dealer_pagination">
               <?php if($active_page_number != 1) { ?>
                   <li> <a style="cursor:pointer;" class="dealer_prev" onclick="setGetParameter('page',<?php echo $page_num - $per_page_in_url;?>);"> « Previous </a></li>
               <?php } ?>
               <?php $count = 1;
               for($x = 0;  $x < $total_results; $x = $x + $per_page_in_url){ ?>
                   <li><a style="cursor:pointer;" class="dealer_pagination_links" onclick="setGetParameter('page', <?php $res = $per_page_in_url*($count - 1); if($res == 0){echo "1";} else {echo $res;}?>)"><?php echo $count;?></a></li>
                            
               <?php    $count++;}  ?>
               <?php if($active_page_number < ceil($total_results/$per_page_in_url)) { ?>
               <li><a style="cursor:pointer;" class="dealer_next" onclick="setGetParameter('page',<?php echo ($page_num-1) + $per_page_in_url;?>);"> Next » </a></li>
               <?php } ?>
               </ul></div>
           <?php } ?>
				 </div></div><!--------search wrap ends----------->
				
                
 
</div>
</div>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Success ! </h4>
				<p class="text-warning">Your search has been saved</p>
            </div>
            <div class="modal-body">
				<form id="search_name_save_form">
				<input type="hidden" name="saved_search_id" value="" id="saved_search_id">
                                <p><input style="width:10px;height:13px;" type="checkbox" name="set_alert" value="1" id="email_alert"> Alert me via email when a new equipment matches the search criteria.</p>
                                <input type="button" onclick="update_search_name();return false;" class="btn btn-primary" style="background:#2e6da4 !important;" name="save_user_type" value="Save"/>
                                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
    <div id="myModal1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Failed ! </h4>
				
            </div>
            <div class="modal-body">
			<p class="text-warning">The search could not be saved, please login if you are not logged in !</p>	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
    <div id="myModal3" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Failed ! </h4>
				
            </div>
            <div class="modal-body">
			<p class="text-warning">The search could not be saved, please fill in product name !</p>	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
    <div id="myModal2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
		<p class="text-warning">Your saved search has been updated !</p>
               
            </div>
            <div class="modal-body">
		 <p>You can manage <a href="<?php echo base_url();?>members/saved_searches"> saved searches</a> now !</p>		
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
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

<div id="alreadysaved" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
		<h3> Not saved </h3>
               
            </div>
            <div class="modal-body">
		<p>You have already saved this item to <a href="<?php echo base_url();?>members/saved_items">saved items list </a> </p>		
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>

<div id="mylocationModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search area</h4>
      </div>
      <div class="modal-body">
          <div class=""><input type="text" placeholder="Zipcode" name="zipcode_change" id="zipcode_new" autocomplete="off" class="small input-text"/></div>
          <button type="button" onclick="change_location($('#zipcode_new').val());" class="btn btn-primary" >Update Location</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <script>
        
function change_location(zipcode){
    if(zipcode.length >= 4){
        $("#zip_code_hidden_field").val(zipcode);
        $.ajax({
                                    url : "http://maps.googleapis.com/maps/api/geocode/json?address=santa+cruz&components=postal_code:"+zipcode+"&sensor=false",
                                    method: "POST",
                                    success:function(data){
                                        $("#postal_code_updated").val(zipcode);
                                        setGetParameter("postal_code", zipcode);
                                        
                                     } 
                               });
    }
}


</script>
  </div>
</div>

<style>
/* CSS used here will be applied after bootstrap.css */
.carousel {
    margin-top: 20px;
}
input#save_search{margin-top:0;}


</style>
<script>
var QueryString = function () {
  // This function is anonymous, is executed immediately and 
  // the return value is assigned to QueryString!
  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
        // If first entry with this name
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = decodeURIComponent(pair[1]);
        // If second entry with this name
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
      query_string[pair[0]] = arr;
        // If third or later entry with this name
    } else {
      query_string[pair[0]].push(decodeURIComponent(pair[1]));
    }
  } 
    return query_string;
}();

function setGetParameter(paramName, paramValue)
{
    var url = window.location.href;
    var hash = location.hash;
    url = url.replace(hash, '');
    if (url.indexOf(paramName + "=") >= 0)
    {
        var prefix = url.substring(0, url.indexOf(paramName));
        var suffix = url.substring(url.indexOf(paramName));
        suffix = suffix.substring(suffix.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + paramName + "=" + paramValue + suffix;
    }
    else
    {
    if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
    else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
}

function save_add(id){
	$.ajax({
		url : '<?php echo base_url();?>add/save',
		data :{'id':id},
		type : 'post',
		success : function(data){
                        if(data != 0){
			$('#save_'+id).html('Saved');
                        } else {
                        $("#alreadysaved").modal('show');
                        }
		}
	     });

}
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
function update_search_name(){
        $("#myModal").modal('hide');
        var search_id = $("#saved_search_id").val();
        var search_name = $("#search_name_id").val();
        var search_alert = $("#email_alert").val();
        $.ajax({
		url : '<?php echo base_url();?>members/update_search_name',
		data :{'id':search_id,'alert' : search_alert},
		type : 'post',
		success : function(){
			 $("#myModal2").modal('show');
		}
	     });
       
}

function change_category(cat){
	var urlfull = window.location.href;
	var parameters = urlfull.split('index.php/');
	var params_array = parameters[1].split('/');
	var newurl =  parameters[0]+'index.php/'+params_array[0]+'/'+params_array[1]+'/'+params_array[2]+'/'+params_array[3]+'/'+params_array[4]+'/'+params_array[5]+'/'+cat+'/'+params_array[7];
	console.log(newurl);
	window.location = newurl;
}

function change_price(price){
	var urlfull = window.location.href;
	var parameters = urlfull.split('index.php/');
	var params_array = parameters[1].split('/');
	var newurl =  parameters[0]+'index.php/'+params_array[0]+'/'+params_array[1]+'/'+params_array[2]+'/'+params_array[3]+'/'+params_array[4]+'/'+params_array[5]+'/'+params_array[6]+'/'+price;
	console.log(newurl);
	window.location = newurl;
}

function change_miles(miles){
	/*var urlfull = window.location.href;
	var parameters = urlfull.split('index.php/');
	var params_array = parameters[1].split('/');
	var newurl =  parameters[0]+'index.php/'+params_array[0]+'/'+params_array[1]+'/'+params_array[2]+'/'+params_array[3]+'/'+params_array[4]+'/'+miles+'/'+params_array[6]+'/'+params_array[7];
	*/
	setGetParameter("radius", miles);
	
}

function change_per_page(per_page){
	/*var urlfull = window.location.href;
	var parameters = urlfull.split('index.php/');
	var params_array = parameters[1].split('/');
	var newurl =  parameters[0]+'index.php/'+params_array[0]+'/'+params_array[1]+'/'+params_array[2]+'/'+params_array[3]+'/'+per_page+'/'+params_array[5]+'/'+params_array[6]+'/'+params_array[7];
	console.log(newurl);
	window.location = newurl;*/
	setGetParameter("per_page", per_page);
        
}
function change_order(order){
	/*var urlfull = window.location.href;
	var parameters = urlfull.split('index.php/');
	var params_array = parameters[1].split('/');
	var newurl =  parameters[0]+'index.php/'+params_array[0]+'/'+params_array[1]+'/'+params_array[2]+'/'+order+'/'+params_array[4]+'/'+params_array[5]+'/'+params_array[6]+'/'+params_array[7];
	console.log(newurl);
	window.location = newurl;*/
	setGetParameter("order", order);
}


 $(document).ready(function($) {
	$("#search_term").keyup(function(){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
		});
		$("#search_item_category").change(function(){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
		});
		$("#search_postal_code").keyup(function(){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
		});
		$("#search_item_radius").change(function(){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
		});
		$("#search_min_price").keyup(function(){
                        var min_price = $("#search_min_price").val();
                        if(parseInt(min_price) == 0){
                            $("#search_min_price").val("1");
                        }
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
		});
		$("#search_max_price").keyup(function(){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
		});
		$("input[type='checkbox'][name='used_type']").click(function(){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
		});
		$("input[type='checkbox'][name='used_type1']").click(function(){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
		});
		$("input[type='checkbox'][name='dealer_type']").click(function(){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
		});
		$("input[type='checkbox'][name='dealer_type1']").click(function(){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
		});
		$("#save_search").click(function(){
			
			$.ajax({
				   url : '<?php echo base_url();?>members/save_search',
				   data : $("#home_search_form").serialize() ,
				   type: 'post',
				   success : function(data){
					   if(data == 0){
						   $("#myModal1").modal('show');
					   } else if(data == 2){
						   $("#myModal3").modal('show');
					   } else {
                                                   $("#saved_search_id").val(data);
                                                   $("#myModal").modal('show');
                                           }
				   }
			});
		});
	});
	
		$('button').on('click',function(e) {
    if ($(this).hasClass('grid')) {
        $('.search-wrap div').removeClass('list').addClass('grid');
    }
    else if($(this).hasClass('list')) {
        $('.search-wrap div').removeClass('grid').addClass('list');
    }
	});
</script>
<script>

 $(document).ready(function($){
$(window).bind("load resize",function(){
    console.log($(this).width())
    if($(this).width() <768){
    $('.search-wrap div').removeClass('list').addClass('grid')
    }
    else{
    $('.search-wrap div').removeClass('grid').addClass('list')
    }
})
})
</script>
<script type="text/javascript">
function showValue(num){
	var result = document.getElementById('result');	
	result.innerHTML = num;
}
</script>

