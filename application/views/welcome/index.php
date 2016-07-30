<?php
function get_distance_between_points($latitude1, $longitude1, $latitude2, $longitude2) {
 	$theta = $longitude1 - $longitude2;
  	$miles = (sin($latitude1) * sin($latitude2)) + (cos($latitude1) * cos($latitude2) * cos($theta));
  	$miles = acos($miles);
  	$miles = rad2deg($miles);
  	$miles = $miles * 60 * 1.1515;
  	$feet = $miles * 5280;
  	$yards = $feet / 3;
  	$kilometers = $miles * 1.609344;
 	$meters = $kilometers * 1000;
 	return round($kilometers * 1.609344)." Km away";
  }
?>
<style>
input[disabled] {
    background: #fff;
}
</style>
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.theme.css" rel="stylesheet">

    <link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl/custom.css" rel="stylesheet">
    <?php 
    if(isset($search_data) && !empty($search_data[0]['postal_code']) && !array_key_exists("user_id",$_SESSION))
      {
        $postal_code =  $search_data[0]['postal_code'];
       
      } else {
        $user = $this->db->get_where('users',array('id'=>@$_SESSION['user_id']))->result_array();
        $postal_code = @$user[0]['postal_code'];  
      }
    ?>

 
  <div class="type home-page-design" style="background-image:none" id="type1">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="type-box hom11" id="home_form_container">
            <div class="col-md-8 col-sm-8 col-xs-8">
			<?php $old_url_for_bkup = "search/results/1/asc/25/25/cat/price"; ?>
	      <form action="<?php echo base_url();?>search/results" method="get" id="home_search_form">
		  <input type="hidden" name="page" value="1"  />
		  <input type="hidden" name="order" value="add_price-asc"  />
		  <input type="hidden" name="per_page" value="10"  />
		  
              <span class="diss" style="position:relative;"> <input type="text" disabled="disabled" name="term" autocomplete='off' placeholder="Type search in here..." class="type-search" id="search_term" value="<?php if(isset($search_data) && !empty($search_data[0]['term'])){echo $search_data[0]['term'];}?>"/><div style="position:absolute; left:0; right:0; top:0; bottom:0; cursor: pointer;" ></div></span>
             <span class="disss" style="position:relative;"> <input type="text" name="postal_code" autocomplete='off' placeholder="" class="type-search" id="search_postal_code" value="<?php echo $postal_code;?>" required/>
             <span class="star-field" id="star_field_on_postal" ><span class="star-txt"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/star-feild.png" alt="star" /></span><b> Postal Code</b></span>
             </span>
             <span class="diss home-in" style="position:relative;
        margin-right: 1%;">  <input type="text" disabled="disabled" name="min_price" autocomplete='off' placeholder="Min Price" class="min-price" id="search_min_price" value="<?php if(isset($search_data) && !empty($search_data[0]['min_price'])){echo $search_data[0]['min_price'];}?>"/><div style="position:absolute; left:0; right:0; top:0; bottom:0; cursor: pointer; width: 100%;height: 100%;" ></div></span>
             <span class="diss home-in" style="position:relative;">  <input type="text" disabled="disabled" name="max_price" autocomplete='off' placeholder="Max Price" class="max-price" id="search_max_price" value="<?php if(isset($search_data) && !empty($search_data[0]['max_price'])){echo $search_data[0]['max_price'];}?>"/><div style="position:absolute; left:0; right:0; top:0; bottom:0; cursor: pointer; width: 100%;height: 100%;" ></div></span>
              <div class="check-main">
                <li><span class="diss" style="position:relative;">
                  <input type="checkbox" disabled="disabled" name="used_type" class="check-box" value="new" id="search_item_condition_new" <?php if(isset($search_data) && $search_data[0]['item_condition'] == "new"){echo 'checked=checked';}?>>
                  <div style="position:absolute; left:0; right:0; top:0; bottom:0; cursor: pointer;" ></div>New</span></li>
                <li><span class="diss" style="position:relative;">
                  <input type="checkbox" disabled="disabled" name="used_type1" value="used" class="check-box" id="search_item_condition_used" <?php if(isset($search_data) && $search_data[0]['item_condition'] == "used"){echo 'checked=checked';}?>>
                  <div style="position:absolute; left:0; right:0; top:0; bottom:0; cursor: pointer;" ></div>Used</span></li>
                <li><span class="diss" style="position:relative;">
                  <input type="checkbox" disabled="disabled" name="dealer_type" class="check-box" value="dealer" id="search_item_dealer" <?php if(isset($search_data) && $search_data[0]['item_condition'] == "dealer"){echo 'checked=checked';}?>>
                  <div style="position:absolute; left:0; right:0; top:0; bottom:0; cursor: pointer;" ></div>Dealer</span></li>
                <li><span class="diss" style="position:relative;">
                  <input type="checkbox" disabled="disabled" name="dealer_type1" value="private" class="check-box" id="search_item_private" <?php if(isset($search_data) && $search_data[0]['item_condition'] == "private"){echo 'checked=checked';}?>>
                  <div style="position:absolute; left:0; right:0; top:0; bottom:0; cursor: pointer;" ></div>Private</span></li>
                  <li class="req"><span>*</span> Required</li>
              </div>
              
		
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
              
                <div class="diss home-ss"> <select name="category" id="search_item_category" disabled="disabled">
		  <option value="">All Categories</option>
		 <?php foreach($categories as $category){ ?>
                  <option value="<?php echo $category['c_id'];?>" <?php if(isset($search_data) && $search_data[0]['category'] == $category['c_id']){echo 'selected=selected';}?> <?php if(!isset($search_data) && $this->uri->segment(4) == $category['c_id']){echo 'selected=selected';}?>><?php echo $category['c_title'];?></option>
                 <?php } ?>
                </select>
                <div style="position:absolute; left:0; right:0; top:0; bottom:0; cursor: pointer; width: 100%;height: 100%;" ></div>
                </div>
              
              
                <div class="diss home-ss"> <select name="radius" id="search_item_radius" disabled="disabled" style="">
                    
                  <option value="25" <?php if(isset($search_data) && $search_data[0]['radius'] == "25"){echo 'selected=selected';}?>>+25km</option>
                  <option value="50" <?php if(!isset($search_data) || $search_data[0]['radius'] == "" || $search_data[0]['radius'] == "50"){ echo "selected = selected";}?>>+50km</option>
				<option value="100" <?php if(isset($search_data) && $search_data[0]['radius'] == "100"){echo 'selected=selected';}?>>+100km</option>
                    <option value="200" <?php if(isset($search_data) && $search_data[0]['radius'] == "200"){echo 'selected=selected';}?>>+200km</option>
                    <option value="5000" <?php if(isset($search_data) && $search_data[0]['radius'] == "5000"){echo 'selected=selected';}?>>Any Distance</option>
                </select>
                <div style="position:absolute; left:0; right:0; top:0; bottom:0; cursor: pointer; width: 100%;height: 100%;" ></div>
                </div>
              
              <p class="gif"> 
			  <input type="submit" name="find" disabled="disabled"  id="search_submit_btn" value="Search(<?php echo $total_advertisements;?>)" class="search1"/>
			  <?php $num_searches = $this->db->get_where('save_search',array('user_id' =>@$_SESSION['user_id']))->num_rows(); ?>
			  <a href="<?php echo base_url();?>members/saved_searches" class="saved_search_link">Saved Searches (<?php echo $num_searches;?>)</a>
			  </p>
            </div>
          </div>
	  </form>
        </div>
        <div class="col-md-4">
          	
			<div class="sidebar_image side_home-page">
                            <a href="<?php echo base_url();?>add/post"><img style="width:358px;" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/side-bg.jpg" alt="advertisement"/></a>
			</div>
		
        </div>
      </div>
    </div>
  </div>
  <div class="products space">
    <div class="container">
	<div class="homes" style="width:100%;">
	<?php 
        
        foreach($advertisements as $add){ 
          
		$images = $this->db->get_where('add_images',array('add_id' => $add['add_id']))->result_array();
		$category = $this->db->get_where('categories',array('c_id' => $add['add_category']))->result_array();
		$dealer = $this->db->get_where('users',array('id' => $add['add_added_by_member']))->result_array();
		$latlng = $this->db->get_where('zipcodes',array('zip_code' => $add['add_postal_code']))->result_array();
                /*if(isset($_SESSION['user_id'])){
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
                $distance_driv = $response_a['rows'][0]['elements'][0]['distance']['value'] / 1000;*/
		
	?>
	<div class="prduct-box" style="float:left;">
	 <p class="p-image"><a href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>">
	<?php if(!empty($images[0]['image']) && file_exists('assets/uploads/add_portfolio/'.$add['add_id']."/".$images[0]['image'])){ ?>
         <img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $add['add_id']."/".$images[0]['image'];?>" alt="products"/>
	<?php } else { ?>
	<img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="products"/>
	<?php } ?>
	</a></p>
		  <p class="p-title"><a href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>"><?php echo $add['add_title'];?></a></p>
		  <p class="p-price">Price : <?php echo "$".$add['add_price'];?></p>
		 
          <p class="profile-img">
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
				<img height="80px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/88*31<?php echo $dealer[0]['image'];?>" />
				<?php } else { ?>
				<?php if($dealer[0]['user_type'] == 'private'){ ?>
                                <img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/private-seller.jpg" alt="categories"/>
                                
                                <?php } else if($dealer[0]['user_type'] == 'dealer'){ ?>
                                <img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/dealer.jpg" alt="categories"/>
                                
                                <?php } else { ?>
				<img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/user.jpeg" alt="categories"/>
                                
                                <?php } } ?>
         <p><?php echo round($add['distance'] * 1.6)." km away"; ?></p>
          
          </p>
        
      </div>
    
    <?php } ?>  
	</div>
    </div>
  </div>

<!--div class="sep space"> <img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/sep.png"  alt="seperator"/></div-->
<div class="recent space">
  <div class="container">
    <h2>Categories </h2>
    
    <div class="row categories-icon">
	
    <?php foreach($categories as $category){ 
	$count  = $this->db->query('select * from advertisement where add_category = '.$category['c_id'].' and (status = "active" or status = "renewed") and post_status = "published"')->num_rows();
	/* $count  = $this->db->get_where('advertisement',array('add_category'=>$category['c_id'],'status'=>'active','status'=>'renewed','post_status'=>'published'))->num_rows(); */
	?>
	
      <div class="col-md-3 col-sm-3 col-xs-4">
        <div class="cat-icon"><a href="<?php echo base_url();?>search/results?page=1&order=add_price-asc&per_page=10&term=&postal_code=v6a+1r3&radius=50&category=<?php echo $category['c_id'];?>&min_price=&max_price=&find=Search" > <?php if(!empty($category['c_image']) && file_exists('assets/uploads/category_images/'.$category['c_image'])){ ?>
			<img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/category_images/<?php echo $category['c_image'];?>" alt="categories">
				<?php } else { ?>
	<img height="100px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="categories"/>
				<?php } ?>
				</a> </div>
        <div class="cat-text">
          <h4><a href="<?php echo base_url();?>search/results?page=1&order=add_price-asc&per_page=10&term=&postal_code=v6a+1r3&radius=50&category=<?php echo $category['c_id'];?>&min_price=&max_price=&find=Search" ><?php echo $category['c_title'];?>(<?php echo $count;?>)</a></h4>
        </div>
      </div>
	
    <?php } ?>
	
    </div>
   
  </div>
</div>
<?php if(isset($_SESSION['user_id'])){ 
$user = $this->db->get_where('users',array('id'=>$_SESSION['user_id']))->result_array();
if($user[0]['user_type'] == null){
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>

<div id="myModal" class="modal fade select-typ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select User Type </h4>
				<p class="text-warning"><small>If you don't choose, your won't be able to post any advertisements.</small></p>
            </div>
            <div class="modal-body">
				<form action="" method="post">
				<input type="hidden" name="user_type_form" value="1">
                <p><input type="radio" name="user_type" value="private"> Private Seller</p>
				<p><input type="radio" name="user_type" value="dealer"> Dealer</p>
                <input type="submit" class="btn btn-primary btn-default select-save" style="background:#2e6da4 !important;" name="save_user_type" value="Save"/>
				</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
<?php
}
}

?>
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/owl.carousel.min.js"></script>

    <!-- Frontpage Demo -->
<script>

    $(document).ready(function($) {
      $("#owl-example").owlCarousel({items : 1,autoPlay : true,
    stopOnHover : true,pagination : false});
	$("#owl-example3").owlCarousel({items : 3,autoPlay : true,
    stopOnHover : true});

    	$("#search_term").change(function(){
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
		var postal = $("#search_postal_code").val();
            if(postal.length > 4){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
			}
		});
		
                $("#search_postal_code").change(function(){
				var postal = $("#search_postal_code").val();
                if(postal.length > 4){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
			}
		});
		$("#search_item_radius").change(function(){
		var postal = $("#search_postal_code").val();
            if(postal.length > 4){
			$.ajax({
					url : '<?php echo base_url();?>search/count_results',
					type : 'post',
					data : $("#home_search_form").serialize(),
					success : function(count){
							$("#search_submit_btn").val(count);
					}
			});
			}
		});
		$("#search_min_price").change(function(){
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
		$("#search_max_price").change(function(){
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
                        var postal = $("#search_postal_code").val();
                        if(postal.length > 4){
                            $.ajax({
                                            url : '<?php echo base_url();?>search/count_results',
                                            type : 'post',
                                            data : $("#home_search_form").serialize(),
                                            success : function(count){
                                                            $("#search_submit_btn").val(count);
                                            }
                            });
                        }
		});
                $("input[type='checkbox'][name='used_type1']").click(function(){
                        var postal = $("#search_postal_code").val();
                        if(postal.length > 4){
                            $.ajax({
                                            url : '<?php echo base_url();?>search/count_results',
                                            type : 'post',
                                            data : $("#home_search_form").serialize(),
                                            success : function(count){
                                                            $("#search_submit_btn").val(count);
                                            }
                            });
                        }
		});
		$("input[type='checkbox'][name='dealer_type']").click(function(){
                        var postal = $("#search_postal_code").val();
                        if(postal.length > 4){
                            $.ajax({
                                            url : '<?php echo base_url();?>search/count_results',
                                            type : 'post',
                                            data : $("#home_search_form").serialize(),
                                            success : function(count){
                                                            $("#search_submit_btn").val(count);
                                            }
                            });
                        }
		});
                $("input[type='checkbox'][name='dealer_type1']").click(function(){
                        var postal = $("#search_postal_code").val();
                        if(postal.length > 4){
                            $.ajax({
                                            url : '<?php echo base_url();?>search/count_results',
                                            type : 'post',
                                            data : $("#home_search_form").serialize(),
                                            success : function(count){
                                                            $("#search_submit_btn").val(count);
                                            }
                            });
                        }
		});
		$("#save_search").click(function(){
			
			$.ajax({
				   url : '<?php echo base_url();?>members/save_search',
				   data : $("#home_search_form").serialize() ,
				   type: 'post',
				   success : function(data){
					   if(data == 0){
						   console.log("not saved");
					   } else {
						   console.log("saved");
					   }
				   }
			});
		});
                   
                $(".diss > div").click(function(){
                    console.log('dis');
                    var postal = $("#search_postal_code").val();
                    if(postal.length < 5){ console.log('dissif');
                                            $(".diss > div").css('display','block'); 
                                            $("input[type='text'],input[type='number'],input[type='submit'],input[type='checkbox'],select").attr('disabled','disabled');
                                            $("select,[type='text']").css('background','#E3E3E3');
                                            $("#search_postal_code").removeAttr('disabled');
                                            $("select[name='radius']").css('background','#ffffff');
                                            $("#search_postal_code").css('background','#ffffff');
                                            //$("#search_postal_code").attr('placeholder','* Please enter a postal code');
                                            $("#search_postal_code").css({'color':'red','border':'2px solid red'});
                                            $("#search_item_radius").css({'border':'2px solid red','border-left':'0px'});
                                            $("#star_field_on_postal > b").html(' Please enter postal code');
                                            $("#star_field_on_postal > b").css({'color':'red'});
											if(postal.length < 1){
                                             $("#star_field_on_postal").show(0);
											 }
                        
                    } else {
                                       console.log('disselse'); 
									   $("input[type='text'],input[type='number'],input[type='submit'],input[type='checkbox'],select").removeAttr('disabled');
                                        $(".diss > div").css('display','none'); 
                                         $("select,[type='text']").css('background','#ffffff');
                                        $("#search_postal_code").css({'color':'#5a5a5a','border':'1px solid #fff'});
										$("#search_item_radius").css({'border':'2px solid #fff','border-left':'0px'});
                                        $("#star_field_on_postal").hide(0);
                                        //$("#search_postal_code").attr('placeholder','* Postal code');
                    }
                
                });
                $(".disss > span,#star_field_on_postal").click(function(){
                    $("#star_field_on_postal").css('display','none'); 
					 $("#search_postal_code").focus();
					 var postal = $("#search_postal_code").val();
					 if(postal.length < 1){
															 $("#search_submit_btn").val('Search(<?php echo $total_advertisements;?>)');
														}
					console.log('clickck');
                });
                  var postal = $("#search_postal_code").val();
                  if(postal.length > 4){
                    $("#search_postal_code").blur();
						$.ajax({
								url : '<?php echo base_url();?>search/count_results',
								type : 'post',
								data : $("#home_search_form").serialize(),
								success : function(count){
										$("#search_submit_btn").val(count);
								}
						});
                   }
					
    });
                        $(document).mouseup(function(e){
					var container = $("select,input");
					var postal = $("#search_postal_code").val();
                                        var disss = $(".disss");
                                        var postal_input = $("#search_postal_code");
                                        var star_field = $("#star_field_on_postal");
                                        var star_field_b = $("#star_field_on_postal > b");
					if (!container.is(e.target) && !disss.is(e.target) && !postal_input.is(e.target) && !star_field.is(e.target) && !star_field_b.is(e.target) && postal.length < 1){
                                                        console.log("idf");
                                                        $("#search_postal_code").css({'color':'#5a5a5a','border':'1px solid #fff'});
							$("#search_item_radius").css({'border':'2px solid #fff','border-left':'0px'});
							$("select,[type='text']").css('background-color','#fff');
                                                        $("#star_field_on_postal > b").css({'color':'#5a5a5a'});
                                                        //$("#star_field_on_postal > b").html(' Postal code');
                                                        $("#star_field_on_postal").show(0);
														
					} else if($("#search_postal_code").is(e.target) || $("#star_field_on_postal").is(e.target) || $(".disss").is(e.target)) {
                                                         console.log("elseidf");
                                                        $("#star_field_on_postal").css('display','none');
                                                        $("#search_postal_code").focus(0);
                                        } else { console.log('elseifelse');
                                                        $("#star_field_on_postal").css('display','none');
                                                        
                                        }                                 
                     });
                    $("#search_postal_code").keyup(function(){
                            postal = $("#search_postal_code").val();
                            
                            if(postal.length > 0){  
                                            $("#star_field_on_postal").css('display','none');
                                            $("#search_postal_code").css({'color':'#5a5a5a','border':'1px solid #fff'});
                                            $("#search_item_radius").css({'border':'2px solid #fff','border-left':'0px'});
                                            
                                            var postal = $("#search_postal_code").val();
                                            if(postal.length > 4){ console.log('keup pnga');
												$("input[type='text'],input[type='number'],input[type='submit'],input[type='checkbox'],select").removeAttr('disabled');
												$(".diss > div").css('display','none'); 
												$("select,[type='text']").css('background','#ffffff');
                                                $.ajax({
                                                                url : '<?php echo base_url();?>search/count_results',
                                                                type : 'post',
                                                                data : $("#home_search_form").serialize(),
                                                                success : function(count){
                                                                                $("#search_submit_btn").val(count);
																				abc = $("#search_postal_code").val();
																				if(abc.length < 1){
																					$("#search_submit_btn").val('Search(<?php echo $total_advertisements;?>)');
																				}
                                                                }
                                                });
                                            } else {
								$(".diss > div").css('display','block'); 
								$("input[type='text'],input[type='number'],input[type='submit'],input[type='checkbox'],select").attr('disabled','disabled');
								$("#search_postal_code").removeAttr('disabled');
								$("select[name='radius']").css('background','#ffffff');
								$("#search_postal_code").css('background','#ffffff');
								$("#search_submit_btn").val('Search(<?php echo $total_advertisements;?>)');
					}
                                            
                            } else { console.log('postal blur'); 
                                $(".diss > div").css('display','block');
				$("#star_field_on_postal > b").html(' Postal code');
                                $("#star_field_on_postal").css('display','block');
                                $("#search_postal_code").blur();
                                $("#search_submit_btn").val('Search(<?php echo $total_advertisements;?>)');
                            }
                            
                    });
                    var postal = $("#search_postal_code").val();
                    if(postal.length > 4){
                        $("input[type='text'],input[type='number'],input[type='submit'],input[type='checkbox'],select").removeAttr('disabled');
                        $(".diss > div").css('display','none');   
                        $("#search_postal_code").css({'color':'#5a5a5a','border':'1px solid #fff'});
			$("#search_item_radius").css({'border':'2px solid #fff','border-left':'0px'});
                        $("#star_field_on_postal").css('display','none');
                        $("#search_postal_code").focus(0);
                        $("select,[type='text']").css('background','#fff');
                    }
</script>


<style>
.navbar-default {
    background-color: #444645;
    margin-bottom: 0;}
    .select-typ .modal-body input[type="radio"] {
  float: left;
  margin: -7px 8px 0 0;
  width: 10px;
}
.select-typ .modal-body p {
  font-size: 18px;
}
.select-typ .modal-dialog {
  width: 35%;
}
.btn.btn-primary.btn-default.select-save {
  display: inline-block;
  width: 30%;
}
.modal-body > form {
  display: inline-block;
  width: 100%;
}
.text-warning .small, small {
  color: #f47777;
}

    
    </style>