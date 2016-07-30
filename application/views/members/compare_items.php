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
</style>
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
<?php $page_name = $this->uri->segment('2');
$current_user  = $this->db->get_where('users',array('id'=> $_SESSION['user_id']))->result_array();
?>
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/style-dashboard.css" rel="stylesheet">
<div class="dash2 space compared_page">
  <div class="container-fluid row">
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
    <div class="col-md-12 comparision-area">
        <div class="compare-content-wrap">
        	<div class="container1">
            <div class="row">
              <div  class="col-sm-12">
                <h3>Compared Items</h3>
                
              
        
                <div class="col-xs-12 comp-itm">
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div class="tab-pane active" id="c_item">
                    	  <table style="width: 100%;">
                            <tr>
                             
                              <td class="col_2" colspan="4">
                                <table class="compareItemsCol">
                                   
                                  <tr class="emptyRow">
                                      <?php if(isset($compare_items[0]) && !empty($compare_items[0])){ 
                                      $images_0 = $this->db->get_where('add_images',array('add_id' => $compare_items[0]['add_id']))->result_array();  
                                       /* $address = $compare_items[0]['add_postal_code'];
                                        $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
                                        $coordinates = json_decode($coordinates);
                                        $latitudeFrom = deg2rad($_SESSION['client_lat']);;
                                        $longitudeFrom = deg2rad($_SESSION['client_lon']);
                                        $latitudeTo = deg2rad(@$coordinates->results[0]->geometry->location->lat);
                                        $longitudeTo = deg2rad(@$coordinates->results[0]->geometry->location->lng);
                                        $mmm0 = get_distance_between_points($latitudeFrom,$latitudeTo,$longitudeFrom,$longitudeTo);*/
                                      ?>
                                    <td>
                                    	
                                      <div class="item-to-compare">
                                      	<div class="primery-info">
                                        	<a class="item-title" href="<?php echo base_url();?>add/view/<?php echo $compare_items[0]['add_id']; ?>"><?php echo $compare_items[0]['add_title']; ?></a>
                                            <p class="item-price">$<?php echo $compare_items[0]['add_price']; ?></p>
                                            <span class="distence"><?php echo $compare_items[0]['distance']; ?></span>
                                        </div>
                                        <div class="contact-seller">
                                        	<a class="item-title" onclick="show_popup('<?php echo $compare_items[0]['add_id']; ?>','<?php echo $compare_items[0]['add_phone_number']?>');">Contact Seller</a>
                                        </div>
                                        <div class="item-images">
                                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                                <!-- Indicators -->
                                                 <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">
                                                  <?php if(count($images_0) > 0){ $i0 =0;?>
                                                  <?php foreach($images_0 as $image0){ ?>
                                                    <?php if(!empty($image0['image']) && file_exists('assets/uploads/add_portfolio/'.$compare_items[0]['add_id']."/".$image0['image'])){ ?>
                                                     <div class="item <?php if($i0 == 0){echo "active";}?>">
                                                          <img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $compare_items[0]['add_id']."/".$image0['image'];?>" alt="thumbnails" />
                                                      </div>
                                                  <?php } $i0++;} } else {?>
                                                    <div class="item active">
                                                        <img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="categories"/>
                                                    </div>
                                                  <?php } ?>
                                                </div>

                                                <!-- Left and right controls -->
                                                <div id="cont">
                                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                 <i class="fa fa-angle-left"></i>

                                                </a>
                                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                 <i class="fa fa-angle-right"></i>
                                                </a>
                                                </div>
                                     </div>
                                            
                                            
                                            
                                            
                                            
                                        </div>
                                        <div class="action-btns">
                                        	<a class="item-title" onclick="delete_compared(<?php echo $compare_items[0]['add_id']?>);">Remove from compare</a>
                                        </div>
                                        <div class="action-btns">
                                                <?php $check_saved  = $this->db->get_where('saved_adds',array('user_id'=> $_SESSION['user_id'],'add_id'=>$compare_items[0]['add_id']))->result_array();
                                                 if(count($check_saved) > 0){ ?>
                                                <a class="item-title"  onclick="#" >Saved</a>
                                                <?php } else { ?>
                                                <a class="item-title" id="a_<?php echo $compare_items[0]['add_id']?>" onclick="save_add(<?php echo $compare_items[0]['add_id']?>);return false;">Move to saved items</a>
                                                <?php } ?>
                                        	
                                        </div>
                                      </div>
                                    </td>
                                      <?php } else { ?>
                                        <td>
                                            <div class="selectAnother">
                                                <div class="compare-wrap">
                                                	<p>Select another</br>
                                                	item from</p>
                                                	<span class="plus">+</span>
                                                    <div>
                                                        <a id="" href="<?php echo base_url();?>">Start new search</a>
                                                    </div>
                                                </div>
                                          </div> 
                                        </td>
                                      <?php } ?>
                                   <?php if(isset($compare_items[1]) && !empty($compare_items[1])){
                                        $images_1 = $this->db->get_where('add_images',array('add_id' => $compare_items[1]['add_id']))->result_array();
                                         /*$address = $compare_items[1]['add_postal_code'];
                                        $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
                                        $coordinates = json_decode($coordinates);
                                        $latitudeFrom = deg2rad($_SESSION['client_lat']);;
                                        $longitudeFrom = deg2rad($_SESSION['client_lon']);
                                        $latitudeTo = deg2rad(@$coordinates->results[0]->geometry->location->lat);
                                        $longitudeTo = deg2rad(@$coordinates->results[0]->geometry->location->lng);
                                        $mmm1 = get_distance_between_points($latitudeFrom,$latitudeTo,$longitudeFrom,$longitudeTo);*/
                                       ?>
                                    <td>
                                    	
                                      <div class="item-to-compare">
                                      	<div class="primery-info">
                                        	<a class="item-title" href="<?php echo base_url();?>add/view/<?php echo $compare_items[1]['add_id']; ?>"><?php echo $compare_items[1]['add_title']; ?></a>
                                            <p class="item-price">$<?php echo $compare_items[1]['add_price']; ?></p>
                                            <span class="distence"><?php echo $compare_items[1]['distance']; ?></span>
                                        </div>
                                        <div class="contact-seller">
                                        	<a class="item-title" onclick="show_popup('<?php echo $compare_items[1]['add_id']; ?>','<?php echo $compare_items[1]['add_phone_number']?>');">Contact Seller</a>
                                        </div>
                                        <div class="item-images">
                                        <div id="myCarousel1" class="carousel slide" data-ride="carousel">
                                                <!-- Indicators -->
                                                 <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">
                                                  <?php if(count($images_1) > 0){ $i1=0;?>  
                                                  <?php foreach($images_1 as $image1){ ?>
                                                    <?php if(!empty($image1['image']) && file_exists('assets/uploads/add_portfolio/'.$compare_items[1]['add_id']."/".$image1['image'])){ ?>
                                                     <div class="item <?php if($i1 == 0){echo "active";}?>">
                                                          <img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $compare_items[1]['add_id']."/".$image1['image'];?>" alt="thumbnails" />
                                                      </div>
                                                    <?php } $i1++;} }  else {?>
                                                   <div class="item active">
                                                        <img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="categories"/>
                                                    </div>
                                                  <?php } ?>

                                                </div>

                                                <!-- Left and right controls -->
                                                <div id="cont">
                                                <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">
                                                 <i class="fa fa-angle-left"></i>

                                                </a>
                                                <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next">
                                                 <i class="fa fa-angle-right"></i>
                                                </a>
                                                </div>
                                     </div>
                                            
                                            
                                            
                                            
                                            
                                        </div>
                                        <div class="action-btns">
                                        	<a class="item-title"  onclick="delete_compared(<?php echo $compare_items[1]['add_id']?>);">Remove from compare</a>
                                        </div>
                                        <div class="action-btns">
                                                <?php $check_saved  = $this->db->get_where('saved_adds',array('user_id'=> $_SESSION['user_id'],'add_id'=>$compare_items[1]['add_id']))->result_array();
                                                 if(count($check_saved) > 0){ ?>
                                                <a class="item-title"  onclick="#" >Saved</a>
                                                <?php } else { ?>
                                                <a class="item-title" id="a_<?php echo $compare_items[1]['add_id']?>" onclick="save_add(<?php echo $compare_items[1]['add_id']?>);return false;">Move to saved items</a>
                                                <?php } ?>
                                        </div>
                                      </div>
                                    </td>
                                      <?php } else { ?>
                                        <td>
                                            <div class="selectAnother">
                                            <p>Select another</br>
                                            item from</p>
                                            <span class="plus">+</span>
                                            <div></div>
                                            <div></div>
                                            <div><a id="" href="<?php echo base_url();?>">Start new search</a></div>
                                          </div> 
                                        </td>
                                      <?php } ?>
                                        
                                        <?php if(isset($compare_items[2]) && !empty($compare_items[2])){
                                             $images_2 = $this->db->get_where('add_images',array('add_id' => $compare_items[2]['add_id']))->result_array();
                                              /*$address = $compare_items[2]['add_postal_code'];
                                        $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
                                        $coordinates = json_decode($coordinates);
                                        $latitudeFrom = deg2rad($_SESSION['client_lat']);;
                                        $longitudeFrom = deg2rad($_SESSION['client_lon']);
                                        $latitudeTo = deg2rad(@$coordinates->results[0]->geometry->location->lat);
                                        $longitudeTo = deg2rad(@$coordinates->results[0]->geometry->location->lng);
                                        $mmm2 = get_distance_between_points($latitudeFrom,$latitudeTo,$longitudeFrom,$longitudeTo);*/
                                        ?>
                                    <td>
                                    	
                                      <div class="item-to-compare">
                                      	<div class="primery-info">
                                        	<a class="item-title"  href="<?php echo base_url();?>add/view/<?php echo $compare_items[2]['add_id']; ?>"><?php echo $compare_items[2]['add_title']; ?></a>
                                            <p class="item-price">$<?php echo $compare_items[2]['add_price']; ?></p>
                                            <span class="distence"><?php echo $compare_items[2]['distance']; ?></span>
                                        </div>
                                        <div class="contact-seller">
                                        	<a class="item-title" onclick="show_popup('<?php echo $compare_items[2]['add_id']; ?>','<?php echo $compare_items[2]['add_phone_number']?>');">Contact Seller</a>
                                        </div>
                                        <div class="item-images">
                                        <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                                                <!-- Indicators -->
                                                 <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">
                                                  <?php if(count($images_2) > 0){ $i2 = 0;?> 
                                                  <?php foreach($images_2 as $image2){ ?>
                                                    <?php if(!empty($image2['image']) && file_exists('assets/uploads/add_portfolio/'.$compare_items[2]['add_id']."/".$image2['image'])){ ?>
                                                     <div class="item <?php if($i2 == 0){echo "active";}?>">
                                                          <img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $compare_items[2]['add_id']."/".$image2['image'];?>" alt="thumbnails" />
                                                      </div>
                                                     <?php } $i2++;} }  else {?>
                                                   <div class="item active">
                                                        <img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="categories"/>
                                                    </div>
                                                  <?php } ?>


                                                </div>

                                                <!-- Left and right controls -->
                                                <div id="cont">
                                                <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
                                                 <i class="fa fa-angle-left"></i>

                                                </a>
                                                <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
                                                 <i class="fa fa-angle-right"></i>
                                                </a>
                                                </div>
                                     </div>
                                            
                                            
                                            
                                            
                                            
                                        </div>
                                        <div class="action-btns">
                                        	<a class="item-title"  onclick="delete_compared(<?php echo $compare_items[2]['add_id']?>);">Remove from compare</a>
                                        </div>
                                        <div class="action-btns">
                                                 <?php $check_saved  = $this->db->get_where('saved_adds',array('user_id'=> $_SESSION['user_id'],'add_id'=>$compare_items[2]['add_id']))->result_array();
                                                 if(count($check_saved) > 0){ ?>
                                                <a class="item-title"  onclick="#" >Saved</a>
                                                <?php } else { ?>
                                                <a class="item-title" id="a_<?php echo $compare_items[2]['add_id']?>" onclick="save_add(<?php echo $compare_items[2]['add_id']?>);return false;">Move to saved items</a>
                                                <?php } ?>
                                        </div>
                                      </div>
                                    </td>
                                      <?php } else { ?>
                                        <td>
                                            <div class="selectAnother">
                                            <p>Select another</br>
                                            item from</p>
                                            <span class="plus">+</span>
                                            <div></div>
                                            <div></div>
                                            <div><a id="" href="<?php echo base_url();?>">Start new search</a></div>
                                          </div> 
                                        </td>
                                      <?php } ?>
                                        
                                        <?php if(isset($compare_items[3]) && !empty($compare_items[3])){
                                         $images_3 = $this->db->get_where('add_images',array('add_id' => $compare_items[3]['add_id']))->result_array();
                                          /*$address = $compare_items[3]['add_postal_code'];
                                        $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
                                        $coordinates = json_decode($coordinates);
                                        $latitudeFrom = deg2rad($_SESSION['client_lat']);;
                                        $longitudeFrom = deg2rad($_SESSION['client_lon']);
                                        $latitudeTo = deg2rad(@$coordinates->results[0]->geometry->location->lat);
                                        $longitudeTo = deg2rad(@$coordinates->results[0]->geometry->location->lng);
                                        $mmm3 = get_distance_between_points($latitudeFrom,$latitudeTo,$longitudeFrom,$longitudeTo);*/
                                        ?>
                                    <td>
                                    	
                                      <div class="item-to-compare">
                                      	<div class="primery-info">
                                        	<a class="item-title" href="<?php echo base_url();?>add/view/<?php echo $compare_items[3]['add_id']; ?>"><?php echo $compare_items[3]['add_title']; ?></a>
                                            <p class="item-price">$<?php echo $compare_items[3]['add_price']; ?></p>
                                            <span class="distence"><?php echo $compare_items[3]['distance'];?></span>
                                        </div>
                                        <div class="contact-seller">
                                        	<a class="item-title" onclick="show_popup('<?php echo $compare_items[3]['add_id']; ?>','<?php echo $compare_items[1]['add_phone_number']?>');">Contact Seller</a>
                                        </div>
                                        <div class="item-images">
                                        <div id="myCarousel3" class="carousel slide" data-ride="carousel">
                                                <!-- Indicators -->
                                                 <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">
                                                    <?php if(count($images_3) > 0){ $i= 0;?> 
                                                    <?php foreach($images_3 as $image3){ ?>
                                                    <?php if(!empty($image3['image']) && file_exists('assets/uploads/add_portfolio/'.$compare_items[3]['add_id']."/".$image3['image'])){ ?>
                                                     <div class="item <?php if($i == 0){echo "active";}?>">
                                                          <img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $compare_items[3]['add_id']."/".$image3['image'];?>" alt="thumbnails" />
                                                      </div>
                                                     <?php } $i++;} }  else {?>
                                                   <div class="item active">
                                                        <img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="categories"/>
                                                    </div>
                                                  <?php } ?>
                                                  </div>

                                                <!-- Left and right controls -->
                                                <div id="cont">
                                                <a class="left carousel-control" href="#myCarousel3" role="button" data-slide="prev">
                                                 <i class="fa fa-angle-left"></i>

                                                </a>
                                                <a class="right carousel-control" href="#myCarousel3" role="button" data-slide="next">
                                                 <i class="fa fa-angle-right"></i>
                                                </a>
                                                </div>
                                     </div>
                                            
                                            
                                            
                                            
                                            
                                        </div>
                                        <div class="action-btns">
                                        	<a class="item-title" onclick="delete_compared(<?php echo $compare_items[3]['add_id']?>);">Remove from compare</a>
                                        </div>
                                        <div class="action-btns">
                                             <?php $check_saved  = $this->db->get_where('saved_adds',array('user_id'=> $_SESSION['user_id'],'add_id'=>$compare_items[3]['add_id']))->result_array();
                                                 if(count($check_saved) > 0){ ?>
                                                <a class="item-title"  onclick="#" >Saved</a>
                                                <?php } else { ?>
                                                <a class="item-title" id="a_<?php echo $compare_items[3]['add_id']?>" onclick="save_add(<?php echo $compare_items[3]['add_id']?>);return false;">Move to saved items</a>
                                                <?php } ?>
                                        </div>
                                      </div>
                                    </td>
                                      <?php } else { ?>
                                        <td>
                                            <div class="selectAnother">
                                            <p>Select another</br>
                                            item from</p>
                                            <span class="plus">+</span>
                                            <div></div>
                                            <div></div>
                                            <div><a id="" href="<?php echo base_url();?>">Start new search</a></div>
                                          </div> 
                                        </td>
                                      <?php } ?>
                                  </tr>   
                                </table>
                              </td>
                            </tr>
                            <tr class="specSpacerBtm">
                              <td colspan="6"></td>
                            </tr>
                         </table> 
                         <!-------------------------other  properties------------------------->
                       
                    
                    
                    
                    
                    </div><!--------compare-item-------------->
                    
                  </div>
                </div>
              </div>      
            </div>  
          </div>
    	</div>  
    </div>
  </div>
</div>

<div id="messagemodal" class="modal fade msg-model">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Inquire About this Product </h3>
				<div class="call-wrap">
                <h1 id="phone_number"><i class="fa fa-phone"></i> 
                    <?php echo "(+1) 999-999-8888";?>
                </h1>
                </div>
                <p id="message_noti" style="display:none;color:white;background:green;"> Message was sent successfully ! </p>		
            </div>
            <div class="modal-body">
				<form id="form_message1" onsubmit="send_message();return false;" >
                                <input type="hidden" name="add_id" id="add_id_message" value="" />
								<div class="form-group">
								 <input type="text" class="form-control" name="name" value="<?php echo $current_user[0]['firstname']." ".$current_user[0]['lastname'];?>" placeholder="Name" />
								<span id="error_name" class="error required-fields"></span>
								</div>
                              <div class="form-group"> 
                                 <input type="email" class="form-control" name="email" value="<?php echo $current_user[0]['email'];?>" placeholder="Email"/>
                                <span id="error_email" class="error required-fields"></span>
                              </div>
                                <div class="form-group">       
                                 <input type="text" class="form-control" name="phone" value="<?php echo $current_user[0]['telephone'];?>" placeholder="Phone" />
                              </div>
                              <div class="form-group">
                                  <textarea class="form-control" id="emessage" name="message" placeholder="Type a message"></textarea>
                                <span id="error_message" class="error required-fields"></span>
                              </div>
                              
                              <button class="btn btn-default food_btn snd-msg"><img style="display:none;" id="loading_img1" height="30px" width="30px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/loading-icon.gif" alt="Loading"/> Send Message </button>
                            </form>
                            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
<script>
function delete_compared(id){
	$.ajax({
		url : '<?php echo base_url();?>add/delete_compared',
		data :{'add_id':id},
		type : 'post',
		success : function(){
			
                        window.location.reload();
		}
	     });

}
function save_add(id){
	$.ajax({
		url : '<?php echo base_url();?>add/save',
		data :{'id':id},
		type : 'post',
		success : function(){
			$('#a_'+id).html('Saved');
		}
	     });

}
function show_popup(add_id,phone_number){
    /*$("input[name=name]").val("");
    $("input[name=email]").val("");
    $("#emessage").text("");
    $("#emessage").val("");
    $("input[name=phone]").val("");*/
    $("#add_id_message").val(add_id);
     $("#message_noti").hide(0);
    $("#messagemodal").modal('show');
    $("#input[name=name]").css('border','1px solid #D4D1D1');
    $("#input[name=email]").css('border','1px solid #D4D1D1');
    $("#emessage").css('border','1px solid #D4D1D1');
	var phone_number = phone_number.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
	$("#phone_number").html("<i class='fa fa-phone'></i> "+phone_number);
	
}
function send_message(){
        var name = $("input[name=name]").val();
        var email = $("input[name=email]").val();
        var message = $("#emessage").val();
        var errors = new Array();
		if(name.length === 0){
			errors[1] = "error";
			$("#error_name").html("* Name is required ");
			$("#input[name=name]").css('border','2px solid #990000');
		} else {
			errors[1] = 1;
			$("#error_name").html("");
			$("#input[name=name]").css('border','1px solid #D4D1D1');
		}

		if(email.length === 0){
			errors[2] = "error";
			$("#error_email").html("* Email is required ");
			$("#input[name=email]").css('border','2px solid #990000');
		} else {
			errors[2] = 1;
			$("#error_email").html("");
			$("#input[name=email]").css('border','1px solid #D4D1D1');
		}
                if(message.length === 0){
			errors[3] = "error";
			$("#error_message").html("* Message is required ");
			$("#emessage").css('border','2px solid #990000');
		} else {
			errors[3] = 1;
			$("#error_message").html("");
			$("#emessage").css('border','1px solid #D4D1D1');
		}
                if(errors[1] == 1 && errors[2] == 1 && errors[3] == 1){
                            $("#loading_img1").show(0);
                            var form_data = $("#form_message1").serialize();
                            $.ajax({
                                 url : '<?php echo base_url();?>welcome/send_message_from_compare',
                                 data : form_data,
                                 type : 'post',
                                 onerror : function(){
                                         $("#loading_img1").hide(0);
                                         $("#message_noti").show(0);

                                 },
                                 success : function(){
                                         $("#loading_img1").hide(0);
                                         $("#message_noti").show(0);


                                 }
                              });
                                $("input[name=name]").val("");
                                $("input[name=email]").val("");
                                $("#emessage").text("");
                                $("#emessage").val("");
                                $("input[name=phone]").val("");
                } else {
                    $("input[name=name]").val("");
                    $("input[name=email]").val("");
                    $("#emessage").text("");
                    $("#emessage").val("");
                    $("input[name=phone]").val("");
                    return false;
		}
}
</script>
<style>
.dash2 .col-md-12.pagination {
  padding-top: 0;
}
</style>