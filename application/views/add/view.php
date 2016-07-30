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
	.form-group > label[for="phone"] {
  margin-left: 10px;
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.css" rel="stylesheet">
<?php $images  = $this->db->get_where('add_images',array('add_id'=> $advertisement[0]['add_id']))->result_array(); 
$add_owner  = $this->db->get_where('users',array('id'=> $advertisement[0]['add_added_by_member']))->result_array();
$current_user  = $this->db->get_where('users',array('id'=> $_SESSION['user_id']))->result_array();
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($advertisement[0]['add_postal_code'])."&sensor=true";
$address_info = file_get_contents($url);
$json_decode = json_decode($address_info);
$latitude = $json_decode->results[0]->geometry->location->lat;
$longitude = $json_decode->results[0]->geometry->location->lng;

function localize_us_number($phone) {
  $numbers_only = preg_replace("/[^\d]/", "", $phone);
  return preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
}
?>
<div id="emailmessagesent" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Email Sent </h4>
            </div>
            <div class="modal-body">
                <p>The email was sent successfully !</p>		
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
<div id="loginerror" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">  </h4>
            </div>
            <div class="modal-body">
                <p>Please <a style="color:blue;text-decoration:underline;" href="<?php echo base_url();?>auth/login" >login</a> to complete the action !</p>		
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
<div id="spamreport" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> Add Report </h4>
            </div>
            <div class="modal-body">
                <p> We have received you report about the add, we will check it as soon as possible.</p>		
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>
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
                                <input type="text" class="form-control" name="name" placeholder="Name" >
                              </div>
                              <div class="form-group">                               
                                <input type="email" class="form-control" name="email" placeholder="Email" >
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
                    <?php if(isset($_SESSION['user_id'])){
                        $check_saved  = $this->db->get_where('saved_adds',array('user_id'=> $_SESSION['user_id'],'add_id'=>$advertisement[0]['add_id']))->result_array();
                        $check_compared = $this->db->get_where('compare_adds',array('user_id'=> $_SESSION['user_id'],'add_id'=>$advertisement[0]['add_id']))->result_array();
                    ?>
                            <?php if(count($check_saved) > 0){ ?>
                            <button class="btn btn-default btn-1" onclick="#" >Saved</button>
                            <?php } else { ?>
                            <button class="btn btn-default btn-1" onclick="save_add(<?php echo $advertisement[0]['add_id'];?>);return false;" id="save_<?php echo $advertisement[0]['add_id'];?>">Save</button>
                            <?php } ?>
                             <?php if(count($check_compared) > 0){ ?>
                            <button class="btn btn-default" onclick="#">Compared</button>
                            <?php } else { ?>
                            <button class="btn btn-default" onclick="compare_add(<?php echo $advertisement[0]['add_id'];?>);return false;" id="compare_<?php echo $advertisement[0]['add_id'];?>">Compare</button>
                            <?php } ?>                   
                    <?php } else { ?>
                    <button class="btn btn-default btn-1" data-toggle="modal" data-target="#loginerror">Save</button>
                    <button class="btn btn-default" data-toggle="modal" data-target="#loginerror">Compare</button>
                    
                    <?php } ?>
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
                <div class="call-wrap">
                <h1><i class="fa fa-phone"></i> 
                    <?php echo "(+1) ".localize_us_number($advertisement[0]['add_phone_number']);?>
                </h1>
                </div>
                <?php } ?>
                                            
                    <div class="tab-content1" id="tab-content1">
                      <div class="tab-pane1 active1" id="enquiry">
                      		<form id="form_message" onsubmit="save_message();return false;" >
                                <input type="hidden" name="add_id" value="<?php echo @$advertisement[0]['add_id'];?>" />
                                <input type="hidden" name="message_to" value="<?php echo $add_owner[0]['id'];?>" />
                              <div class="form-group">
                              
                                <input type="text" class="form-control" name="name" placeholder="Name" id="enquiry_name" value="<?php echo $current_user[0]['firstname'];?>">    
                               <span id="error_name" class="error required-fields"></span>
                              </div>
                              <div class="form-group"> 
                                                          
                                <input type="email" class="form-control" name="email" placeholder="Email" id="enquiry_email" value="<?php echo $current_user[0]['email'];?>">
                            <span id="error_email" class="error required-fields"></span>
                              </div>
                              <div class="form-group">
                              
                                <input type="text" class="form-control" name="phone" placeholder="Phone">
                              </div>
                              <div class="form-group">
                              
                                <textarea class="form-control" id="enquiry_message" name="message" placeholder="Type a message"></textarea>
                               <span id="error_message" class="error required-fields"></span>
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
                      
                    </div>   <!---------------tab-content1 ends here-------------->                      
                      <div class="tab-content2"  id="tab-content2" style="display:none;">
                      	  <h2>Thank you for your inquiry!</h2>   
                          <p>An email has been sent to <span id="name_to">John Doe</span></p>
                           
                           <button class="btn btn-default thnks_btn2" onclick="close_thankyou();"> close </button>               		
                      </div><!---------------tab-content-2 ends here-------------->    
            </div><!---------------product enquiry ends here-------------->
            <div class="seller-info">
            	<div class="seller-image">
                	<?php if(!empty($add_owner[0]['image']) && file_exists('assets/uploads/user_images/'.$add_owner[0]['image'])){ ?>
                                    <?php if(!file_exists('assets/uploads/user_images/88*31'.$add_owner[0]['image'])  && !empty($add_owner[0]['image']) && !is_numeric($add_owner[0]['image'])){
                                        $new_images = 'assets/uploads/user_images/88*31'.$add_owner[0]['image'];
                                        $width=88;
                                        $size = GetimageSize('assets/uploads/user_images/'.$add_owner[0]['image']);
                                        $height=31;
                                        $images_orig = ImageCreateFromJPEG('assets/uploads/user_images/'.$add_owner[0]['image']);
                                        $photoX = ImagesX($images_orig);
                                        $photoY = ImagesY($images_orig);
                                        $images_fin = ImageCreateTrueColor($width, $height);
                                        ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                                        ImageJPEG($images_fin,$new_images);
                                        ImageDestroy($images_orig);
                                        ImageDestroy($images_fin);
                                        }   
                                    ?>
				<img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/<?php echo $add_owner[0]['image'];?>" />
				<?php } else { ?>
                                <?php if($add_owner[0]['user_type'] == 'private'){ ?>
                                <img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/private-seller.jpg" alt="categories"/>
                                
                                <?php } else if($add_owner[0]['user_type'] == 'dealer'){ ?>
                                <img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/dealer.jpg" alt="categories"/>
                                
                                <?php } else { ?>
				<img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/user.jpeg" alt="categories"/>
                                <?php } } ?>
                </div>
                <p class="seller"><?php echo $json_decode->results[0]->formatted_address;?></p>
                <p class="view-web"><a target="_blank" href="<?php echo $add_owner[0]['website_url'];?>">Visit our Website</a></p>
            </div>
            <?php if($advertisement[0]['add_show_on_map'] != 0 || $advertisement[0]['add_show_on_map'] != '0'){ ?>
            <div class="seller-location" id="map" style="height:250px;border:1px solid #dedede;">
            	
            </div>
            <?php } ?>
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


<script>
function change_main_image(img){
	console.log(img);
	
	$("#small_img_here").attr('src',img);
}
    function initialize() {
      var myLatlng = new google.maps.LatLng(<?php if(isset($latitude)){echo $latitude;}else {echo "-25.363";}?>, <?php if(isset($longitude)){echo $longitude;}else {echo "131.044";}?>);
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
function save_message(){
        
        var form_data = $("#form_message").serialize();
        var name = $("#enquiry_name").val();
        var errors = new Array();
		if(name.length === 0){
			errors[1] = "error";
			$("#error_name").html("* Name is required ");
			$("#enquiry_name").css('border','2px solid #990000');
		} else {
			errors[1] = 1;
			$("#error_name").html("");
			$("#enquiry_name").css('border','1px solid #D4D1D1');
		}

		var email = $("#enquiry_email").val();
		if(email.length === 0){
			errors[2] = "error";
			$("#error_email").html("* Email is required ");
			$("#enquiry_email").css('border','2px solid #990000');
		} else {
			errors[2] = 1;
			$("#error_email").html("");
			$("#enquiry_email").css('border','1px solid #D4D1D1');
		}
                var message = $("#enquiry_message").val();
		if(message.length === 0){
			errors[3] = "error";
			$("#error_message").html("* Message is required ");
			$("#enquiry_message").css('border','2px solid #990000');
		} else {
			errors[3] = 1;
			$("#error_message").html("");
			$("#enquiry_message").css('border','1px solid #D4D1D1');
		}
                
                
                if(errors[1] == 1 && errors[2] == 1 && errors[3] == 1){
                            $("#loading_img").show(0);
                            
                            $.ajax({
                                    url : '<?php echo base_url();?>welcome/save_message',
                                    data : form_data,
                                    type : 'post',
                                    onerror : function(){
                                            $("#loading_img").hide(0);
                                            $("#name_to").html('<?php echo $add_owner[0]['firstname'].' '. $add_owner[0]['lastname'];?>');
                                            $("#tab-content1").hide(0);
                                             $("#tab-content2").show(0);
                                    },
                                    success : function(){
                                            $("#loading_img").hide(0);
                                            $("#name_to").html('<?php echo $add_owner[0]['firstname'].' '. $add_owner[0]['lastname'];?>');
                                            $("#tab-content1").hide(0);
                                            $("#tab-content2").show(0);
                                    }
                                });
		} else {
                    return false;
		}
        
}
function close_thankyou(){
                $("#enquiry_name").val("");
                $("#enquiry_email").val("");
                $("#enquiry_message").text("");
                $("#enquiry_message").val("");
                $("input[name=phone]").val("");
                $("#tab-content1").show(0);
                $("#tab-content2").hide(0);
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
                        $("#messagemodal").modal('hide');
                        $("#emailmessagesent").modal('show');
                },
		success : function(){
			$("#loading_img1").hide(0);
                        $("#messagemodal").modal('hide');
                        $("#emailmessagesent").modal('show');
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
                        $("#myModal12").modal('hide');
                        $("#spamreport").modal('show');
                },
		success : function(){
			$("#loading_img2").hide(0);
                        $("#myModal12").modal('hide');
                        $("#spamreport").modal('show');
		}
	     });
}
</script>


