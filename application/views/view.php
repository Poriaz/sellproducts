<style>
.magnify {
	width: 200px;
	margin: 50px auto;
	position: relative;
}
.large {
	width: 175px;
	height: 175px;
	position: absolute;
	border-radius: 100%;
	box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85),  0 0 7px 7px rgba(0, 0, 0, 0.25),  inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
	display: none;
}
.small {
	display: block;
}
.food_btn{
    background-color: #ffa200 !important;
    border: medium none;
    color: #ffffff !important;
    font-family: "Source Sans Regular";
    text-align: center;
    transition: all 300ms linear 0s;
}
</style>

<script type="text/javascript">
	$(document).ready(function(){
                $("#report_abuse").click(function(){
                    $("#myModal12").modal('show');
                });
                $("#send_message").click(function(){
                    $("#messagemodal").modal('show');
                });
	});
</script>
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.carousel.css" rel="stylesheet">
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.theme.css" rel="stylesheet">
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl/custom.css" rel="stylesheet">
<?php $images  = $this->db->get_where('add_images',array('add_id'=> $advertisement[0]['add_id']))->result_array(); 
$add_owner  = $this->db->get_where('users',array('id'=> $advertisement[0]['add_added_by_member']))->result_array();
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($advertisement[0]['add_postal_code'])."&sensor=true";
$address_info = file_get_contents($url);
$json_decode = json_decode($address_info);


function localize_us_number($phone) {
  $numbers_only = preg_replace("/[^\d]/", "", $phone);
  return preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
}
?>
<div id="myModal12" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Report Abuse </h4>
				<p class="text-warning"><small>Send us a report if you find any ads with bad content, profanity, wrong or misleading pictures.</small></p>
            </div>
            <div class="modal-body">
				<form id="form_message_report" onsubmit="report_spam();return false;">
                                    <input type="hidden" name="add_id" value="<?php echo @$advertisement[0]['add_id'];?>" />
                                 <div class="form-group"><input type="text" name="email" class="form-control" placeholder="Email"/></div>
                                <div class="form-group"><textarea name="comments" class="form-control" placeholder="Your message here"></textarea></div>
                                <button class="btn btn-default food_btn"><img style="display:none;" id="loading_img2" height="30px" width="30px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/loading-icon.gif" alt="Loading"/> Report Spam </button>
				</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
<div id="messagemodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Email Ad to a Friend </h4>
				
            </div>
            <div class="modal-body">
				<form id="form_message1" onsubmit="send_message();return false;" >
                                <input type="hidden" name="add_id" value="<?php echo @$advertisement[0]['add_id'];?>" />
                                <input type="hidden" name="message_to" value="<?php echo $add_owner[0]['id'];?>" />
                              <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name">
                              </div>
                              <div class="form-group">                               
                                <input type="email" class="form-control" name="email" placeholder="Email">
                              </div>
                                <div class="form-group">                               
                                <input type="email" class="form-control" name="friend_email" placeholder="Friends' email">
                              </div>
                              <div class="form-group">
                                <textarea class="form-control" id="message" name="message" placeholder="Type a message"></textarea>
                              </div>
                              <div class="checkbox">
                                  <label>
                                    <input type="checkbox" value="1" name="send_copy">
                                    Send me a copy of this message
                                  </label>
                                </div>
                              <button class="btn btn-default food_btn"><img style="display:none;" id="loading_img1" height="30px" width="30px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/loading-icon.gif" alt="Loading"/> Send Message </button>
                            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
<div class="search-page space page1">
  <div class="container">
    <div class="row">
    	<div class="col-md-8 col-sm-8 col-xs-12">
        	<h2 class="prdct-title"><?php echo ucfirst($advertisement[0]['add_title']);?> - <?php echo $json_decode->results[0]->address_components[1]->long_name;?> $<?php echo @$advertisement[0]['add_price'];?></h2>
        	<div class="product-detail">            	
            	<div class="main-iamge">
                        <?php if(!empty($images[0]['image']) && file_exists('assets/uploads/add_portfolio/'.$advertisement[0]['add_id']."/".$images[0]['image'])){ ?>
                	<img id="small_img_here" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $advertisement[0]['add_id'].'/'.$images[0]['image'];?>" alt="product-Image" />
                        <?php } else { ?>
                        <img id="small_img_here" class="small" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="products"/>
                        <?php } ?>
                </div>
                <div class="product-thumbs">
                  <?php foreach($images as $image){ ?>
                  <?php if(!empty($image['image']) && file_exists('assets/uploads/add_portfolio/'.$advertisement[0]['add_id']."/".$image['image'])){ ?>
                   <div class="thumbnails">
                    	<img style="cursor:pointer;" onclick="change_main_image('<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $advertisement[0]['add_id'].'/'.$image['image'];?>');" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $advertisement[0]['add_id']."/".$image['image'];?>" alt="thumbnails" />
                    </div>
                  <?php } }?>
                   
                </div>
            </div>
            <div class="related-actions">
            	<div class="action-buttons">
                	<button class="btn btn-default btn-1" onclick="save_add(<?php echo $advertisement[0]['add_id'];?>);return false;" id="save_<?php echo $advertisement[0]['add_id'];?>">Save</button>
                    <button class="btn btn-default" onclick="compare_add(<?php echo $advertisement[0]['add_id'];?>);return false;" id="compare_<?php echo $advertisement[0]['add_id'];?>">Compare</button>
                </div>
                <div class="social-shares">
                    <a href="https://www.facebook.com/sharer.php?u=<?php echo str_replace('index.php/index.php','index.php',current_url()); ?>&t=<?php echo $advertisement[0]['add_title'];?>" target="_blank"></a>
			<a href="http://twitter.com/intent/tweet?source=<?php echo str_replace('index.php/index.php','index.php',current_url()); ?>&text=%5BTEXT%5D&url=<?php echo str_replace('index.php/index.php','index.php',current_url()); ?>" target="_blank"></a>
                 
                    <a href="https://plus.google.com/share?url=<?php echo str_replace('index.php/index.php','index.php',current_url()); ?>" target="_blank"></a>
                </div>
                <div class="activities">
                	<ul>
                    	<li><a href="#" id="send_message">E-mail</a></li>
                        <li><a target="_blank" href="<?php echo base_url();?>welcome/print_ad/<?php echo $advertisement[0]['add_id'];?>">Print</a></li>
                        <li><a href="#" id="report_abuse">Report Ad</a></li>
                    </ul>
                </div>
            </div>
            <div class="product-description">
            	
                
                <div class="description-text">
                    <p><?php echo @$advertisement[0]['add_description'];?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 eq">
        	<div class="product-enquiry">
            	<h3>Inquire About this Product</h3>
                <?php if($advertisement[0]['show_phone_number'] != 0 || $advertisement[0]['show_phone_number'] != '0'){ ?>
                <h1><i class="fa fa-phone"></i> 
                    <?php echo "(+1) ".localize_us_number($advertisement[0]['add_phone_number']);?>
                </h1>
                <?php } ?>
                                            
                    <div class="tab-content1">
                      <div class="tab-pane1 active1" id="enquiry">
                      		<form id="form_message" onsubmit="save_message();return false;" >
                                <input type="hidden" name="add_id" value="<?php echo @$advertisement[0]['add_id'];?>" />
                                <input type="hidden" name="message_to" value="<?php echo $add_owner[0]['id'];?>" />
                              <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name">
                              </div>
                              <div class="form-group">                               
                                <input type="email" class="form-control" name="email" placeholder="Email">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="Phone">
                              </div>
                              <div class="form-group">
                                <textarea class="form-control" id="message" name="message" placeholder="Type a message"></textarea>
                              </div>
                              <div class="checkbox">
                                  <label>
                                    <input type="checkbox" value="1" name="send_copy">
                                    Send me a copy of this message
                                  </label>
                                </div>
                              <button class="btn btn-default food_btn"><img style="display:none;" id="loading_img" height="30px" width="30px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/loading-icon.gif" alt="Loading"/> Send Message </button>
                            </form>
                      </div>
                      
                    </div>                         
                                  
            </div><!---------------product enquiry ends here-------------->
            <div class="seller-info">
            	<div class="seller-image">
                	<?php if(!empty($add_owner[0]['image']) && file_exists('assets/uploads/user_images/'.$add_owner[0]['image'])){ ?>
				<img height="80px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/<?php echo $add_owner[0]['image'];?>" />
				<?php } else { ?>
				<img height="80px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/user.jpeg" alt="categories"/>
				<?php } ?>
                </div>
                <p class="seller"><?php echo $json_decode->results[0]->formatted_address;?></p>
                <p class="view-web"><a href="#">View our Website</a></p>
            </div>
            <?php if($advertisement[0]['add_show_on_map'] != 0 || $advertisement[0]['add_show_on_map'] != '0'){ ?>
            <div class="seller-location" id="map" style="height:250px;border:1px solid #dedede;">
            	
            </div>
            <?php } ?>
        </div>
     </div>
  </div>
</div>


<script>
function change_main_image(img){
	console.log(img);
	
	$("#small_img_here").attr('src',img);
}
    function initialize() {
      var myLatlng = new google.maps.LatLng(<?php if(isset($main_marker['latitude'])){echo $main_marker['latitude'];}else {echo "-25.363";}?>, <?php if(isset($main_marker['longitude'])){echo $main_marker['longitude'];}else {echo "131.044";}?>);
      var myOptions = {
        zoom: 8,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.TERRAIN,
       
      }
      var map = new google.maps.Map(document.getElementById("map"), myOptions);
	  var icon_here = {
						    url: 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|FE7569',
						    size: new google.maps.Size(20, 32),
						 };
	var marker = new google.maps.Marker( { 
			position: myLatlng,     
			map: map,      
			title: '<?php echo $advertisement[0]["add_address"];?>',
			icon : icon_here,					// image to display as the marker
			
		});
    }

    function loadScript() {
      var script = document.createElement("script");
      script.type = "text/javascript";
      script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initialize";
      document.body.appendChild(script);
    }

    window.onload = loadScript;


</script> 
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/owl.carousel.min.js"></script> 
<script>

    $(document).ready(function($) {
      $("#owl-example1").owlCarousel({items : 1,autoPlay : true,
    stopOnHover : true,pagination:false});
	
    });
    
    function save_add(id){
	$.ajax({
		url : '<?php echo base_url();?>add/save',
		data :{'id':id},
		type : 'post',
		success : function(){
			$('#save_'+id).html('Saved');
		}
	     });

}
function compare_add(id){
	$.ajax({
		url : '<?php echo base_url();?>add/compare',
		data :{'id':id},
		type : 'post',
		success : function(){
			$('#compare_'+id).html('Added');
		}
	     });

}
function save_message(){
        $("#loading_img").show(0);
        var form_data = $("#form_message").serialize();
        $.ajax({
		url : '<?php echo base_url();?>welcome/save_message',
		data : form_data,
		type : 'post',
                onerror : function(){
                        $("#loading_img").hide(0);
                },
		success : function(){
			$("#loading_img").hide(0);
		}
	     });
}
function send_message(){
        $("#loading_img1").show(0);
        var form_data = $("#form_message1").serialize();
        $.ajax({
		url : '<?php echo base_url();?>welcome/send_message',
		data : form_data,
		type : 'post',
                onerror : function(){
                        $("#loading_img1").hide(0);
                },
		success : function(){
			$("#loading_img1").hide(0);
		}
	     });
}
function report_spam(){
        $("#loading_img2").show(0);
        var form_data = $("#form_message_report").serialize();
        $.ajax({
		url : '<?php echo base_url();?>welcome/report_spam',
		data : form_data,
		type : 'post',
                onerror : function(){
                        $("#loading_img2").hide(0);
                },
		success : function(){
			$("#loading_img2").hide(0);
		}
	     });
}
</script>


