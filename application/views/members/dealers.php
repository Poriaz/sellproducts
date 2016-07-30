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
  if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
  $user = $this->db->get_where('users',array('id'=>$this->session->userdata('user_id')))->result_array();
  $user_postal_code = $user[0]['postal_code'];
  } else {
  $user_postal_code = "V6A 1R3";
  }
  $coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($user_postal_code) . '&sensor=false');
  $coordinates = json_decode($coordinates);
  $address_formatted = @$coordinates->results[0]->formatted_address;
?>
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.theme.css" rel="stylesheet">

    <link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl/custom.css" rel="stylesheet">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	  <style>
	  .dealer_url {
  text-decoration: underline !important;
}
	  </style>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxsS5OxA5Zv_t9tdYKAU9ba6R5EdevkDs"></script>
<div class="boby-back">
	<div class="find-dealer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
                <div class="find-local">
					<form id="find-dealer" action="" method="post">
						 <h1> Find Local Dealers</h1> 
						<p><span>within </span><select class="distance" name="radius" id="search_form_radius" onchange="initMap()">
							<option value="25">25 Km</option>
							<option value="50" selected="selected">50 Km</option>
							<option value="100">100 Km</option>
							<option value="200">200 Km</option>
							<option value="50000">Any Distance</option>
						</select></p>
						<input type="hidden" name="zip_code" value="<?php echo $user_postal_code;?>" id="zip_code_hidden_field" />
					</form>
                    <p style="width:100%; float:left"><span class="all_dealers_in">All Dealers in </span><span id="address_span" ><?php echo $address_formatted;?> </span> <a href="#" class="btn1 btn-info1 btn-lg1" data-toggle="modal" data-target="#myModal">Change location</a></p>
                     
				</div><!-----col-12-ends------->
                
			</div><!------row-ends------>
			</div>
		</div><!------container-ends------->
	</div><!-----"find-dealer ends------->
	<div class="dealer-results-section">
		<div class="container">
				
				 
			<div class="row">
				<div class="col-md-121">
                
					<div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="pagi">
				 <div class="col-md-12 col-sm-12 col-xs-12">
      
	  
	 
	  <div class="sorting">
      	<div class="sort-bi"><span>Sort by</span>
        	<select class="distance1" name="sort_by" id="sort_by_select" onchange="initMap()">
				<option value="distance-asc" selected="selected">Distance - Closest</option>	
                                <option value="distance-desc">Distance - Farthest</option>
                                <option value="users.firstname-asc">Dealership Name - A-Z</option>
                                <option value="users.firstname-desc">Dealership Name - Z-A</option>
		</select>
         </div>
      <div id="pagin"></div></div>
	  </div>
	 
      
    </div>
                    <div class="map-space">
							<div id="map" style="height:202px"></div>
						</div>
						
						<div id="append_here">
					
						</div>
						<div id="pagin1"></div>
					</div>
					<?php 
					$images = $this->db->get_where('add_images',array('add_id' => $advertisements_slider[0]['add_id']))->result_array();
					$category = $this->db->get_where('categories',array('c_id' => $advertisements_slider[0]['add_category']))->result_array();
					$dealer = $this->db->get_where('users',array('id' => $advertisements_slider[0]['add_added_by_member']))->result_array();
					$latlng = $this->db->get_where('zipcodes',array('zip_code' => $advertisements_slider[0]['add_postal_code']))->result_array();
					$address = $advertisements_slider[0]['add_postal_code'];
					$coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
					$coordinates = json_decode($coordinates);
					$latitudeFrom = deg2rad($_SESSION['client_lat']);;
					$longitudeFrom = deg2rad($_SESSION['client_lon']);
					$latitudeTo = deg2rad(@$coordinates->results[0]->geometry->location->lat);
					$longitudeTo = deg2rad(@$coordinates->results[0]->geometry->location->lng);
					$mmm = get_distance_between_points($latitudeFrom,$latitudeTo,$longitudeFrom,$longitudeTo);
					?>
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                    <div class="news-banr">
                                                      <a href="<?php echo base_url();?>add/post"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/side-bg.jpg" alt="advertisement"/></a>
                                                    </div>
                                                    <div class="news-banr">
                                                    <div class="feature-ad">
                                                            <div class="f-img">
														<a href="<?php echo base_url();?>add/view/<?php echo $advertisements_slider[0]['add_id'];?>">
															<?php if(!empty($images[0]['image']) && file_exists('assets/uploads/add_portfolio/'.$advertisements_slider[0]['add_id']."/".$images[0]['image'])){ ?>
																 <img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $advertisements_slider[0]['add_id']."/".$images[0]['image'];?>" alt="products"/>
															<?php } else { ?>
															<img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="products"/>
															<?php } ?>
															</a>															
                                                        </div>
                                                        <p class="p-title"><a href="<?php echo base_url();?>add/view/<?php echo $advertisements_slider[0]['add_id'];?>"><?php echo $advertisements_slider[0]['add_title'];?></a></p>
                                                        <p class="p-price"><?php echo "$".$advertisements_slider[0]['add_price'];?></p>
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
                                                       <p><?php 
														if($mmm < 100000){
															echo $mmm;
														} else {
															echo "Postal Code :".$add['add_postal_code'];
														} ?></p>

                                                    </div>



                                                    </div>
                                                  </div>					
				</div><!-------column-12 ends----->
			</div><!--------row ends------->
		</div><!-------container ends----->
	</div><!-----dealer-results-section ends-------->
        
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search area</h4>
      </div>
      <div class="modal-body">
          <input type="text" placeholder="Zipcode" name="zipcode_change" id="zipcode_new" autocomplete="off"/>
          <button type="button" onclick="change_location($('#zipcode_new').val());" class="btn btn-primary" >Update Location</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <script>
        var rows_per_page = 10;
var total_rows;
var page_num = 1;
function change_location(zipcode){
    if(zipcode.length >= 4){
        $("#zip_code_hidden_field").val(zipcode);
        $.ajax({
                                    url : "http://maps.googleapis.com/maps/api/geocode/json?address=santa+cruz&components=postal_code:"+zipcode+"&sensor=false",
                                    method: "POST",
                                    success:function(data){
                                        address = data.results[0].formatted_address;
                                        $("#address_span").html(address);
                                        $('#myModal').modal('hide');
                                        initMap();
                                     } 
                               });
    }
}
function initPageNumbers(page_number)
{
    var zipcode = $("#zip_code_hidden_field").val();
    var radius = $("#search_form_radius").val(); 
    $.ajax({
                url : "<?php echo base_url();?>welcome/get_dealers_num_pages",
                method: "POST",
                data : {'zipcode':zipcode,'radius':radius},
                success:function(resdata){
                            $('#page-numbers').html("");
                            total_rows = parseInt(resdata);
                            next = parseInt(page_number) + parseInt("1");
                            if(page_number == 1){
                                prev = parseInt(page_number);
                                var pagination_prev = "<p>";
                                var pagin_prev1 = "";
                            } else {
                               prev = parseInt(page_number) - parseInt("1"); 
                               var pagination_prev = "<p><a onclick='initMap("+prev+");'> <i class='fa fa-angle-left'></i> </a>";
                               var pagin_prev1 = "<li class='dealer_prev'><a onclick='initMap("+prev+");'> « Previous </a></li>";
                            }
                            if(page_number < Math.ceil(total_rows/rows_per_page)){
                            var pagination_next = "<a onclick='initMap("+next+");'> <i class='fa fa-angle-right'></i> </a></p>";
                            var pagin_next1 = "<li  class='dealer_next'><a onclick='initMap("+next+");'> Next » </a></li>";
                            } else {
                            var pagination_next = "";   
                            var pagin_next1 = "";
                            }
                            var pagination = pagination_prev+"  <span >Page "+page_number+" of "+Math.ceil(total_rows/rows_per_page)+" </span>"+pagination_next;
                            $("#pagin").html(pagination);
                           
                            var bottom_pagin = "";
                            for(p=1;p<=Math.ceil(total_rows/rows_per_page);p++){
                                bottom_pagin += "<li><a id='mylia"+p+"' class='dealer_pagination_links' onclick='initMap("+p+")'>"+p+"</a></li>"; 
                            }
                            
                            full_pagin = "<ul class='dealer_pagination'>" +pagin_prev1+bottom_pagin+pagin_next1+"</ul>"; 
                            if(Math.ceil(total_rows/rows_per_page) > 1){
                             $("#pagin1").html(full_pagin);
                            }
                            var count = 1;
                            for(var x = 0;  x < total_rows; x += rows_per_page)
                            {
                                $('#page-numbers').append('<li id="li'+count+'"><a href="#'+count+'" onclick="initMap('+count+');">'+count+'</a></li>');
                                count++;
                            }
               }
    });
}
</script>
  </div>
</div>

</div>
        
<script>
function initMap(page_num) {

    if (typeof page_num === 'undefined') {
        page_num = 1;
    }
    page_number = page_num;
    initPageNumbers(page_number);

    var zipcode = $("#zip_code_hidden_field").val();
    var radius = $("#search_form_radius").val();
    var sort_by_select = $("#sort_by_select").val();
    $.ajax({
        url: "<?php echo base_url();?>welcome/get_dealers",
        method: "POST",
        data: {
            'zipcode': zipcode,
            'radius': radius,
            'page_num': page_number,
            'rows_per_page': rows_per_page,
            'sort': sort_by_select
        },
        success: function(resdata) {

            $("#append_here").html("");
            var json = $.parseJSON(resdata);
            var mapOptions = {
                center: new google.maps.LatLng(json.main_marker.latitude, json.main_marker.longitude),
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.TERRAIN
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

            var infoWin = new google.maps.InfoWindow;
            $(".pagination_links").hide(0);
            if (json.dealers.length < 1) {
                htmll = '<div class="row rowstyle"><div class="col-md-2 col-sm-2 col-xs-2 dealer-address"><p>No results were found !</p></div></div>'
                $("#append_here").append(htmll);
            }
            for (i = 0; i < json.dealers.length; i++) {
                var icon_here = {
                    url: '<?php echo str_replace('/index.php/','/',base_url());?>assets/uploads/dealer_markers/' + i + '.png',
                    size: new google.maps.Size(20, 32),
                };
                var m = new google.maps.Marker({
                    position: new google.maps.LatLng(parseFloat(json.dealers[i].latitude), parseFloat(json.dealers[i].longitude)),
                    map: map,
                    icon: icon_here,
                    title: json.dealers[i].firstname + ' ' + json.dealers[i].lastname
                });
				
				var list_image = '<?php echo str_replace('/index.php/','/',base_url());?>assets/uploads/user_images/' +json.dealers[i].image;
				var list_weburl = json.dealers[i].website_url;
				var list_fname = json.dealers[i].firstname;
				var list_lname = json.dealers[i].lastname;
				var list_radius = json.dealers[i].radius;
				var list_telephone = json.dealers[i].telephone;
				var list_city = json.dealers[i].city;
				if(!list_city){
					list_city = "city not given";
				}
				var list_state = json.dealers[i].state;
				if(!list_state){
					list_state = "city not given";
				}
				var list_postal = json.dealers[i].postal_code;
				if(!list_postal){
					list_postal = "city not given";
				}
				var icon = '<?php echo str_replace('/index.php/','/',base_url());?>assets/uploads/dealer_markers/' + i + '.png';
				
                var html = '<div class="marker_data"><div class="dealer-logo-space"><img src="'+list_image+'" alt="new add" height="200px" width="200px"/></div><div class="other-details"><p><a target="_blank" href="' + list_weburl + '">' + list_fname + ' ' + list_lname + '</a></p><p>' + list_telephone + ' </p><p> ' + list_city +', '+ list_state +', '+list_postal+'</p><p><a target="_blank" href="' + list_weburl + '" class="dealer_url"> ' + list_weburl + ' </a></p></div>';
				bindInfoWindow(m, map, infoWin, html);
				
				var listt = createSidebarEntry(m,list_image, list_weburl, list_fname, list_lname,list_radius,list_telephone,list_city,list_state,list_postal,icon,i);
				document.getElementById("append_here").appendChild(listt);
                
			}
            $(".dealer_pagination_links").removeClass('active');
            $("#mylia" + page_number).addClass('active');
        }
    });
}




function bindInfoWindow(marker, map, infoWindow, html) {
    google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
    });
    
}

function createSidebarEntry(marker,list_image, list_weburl, list_fname, list_lname,list_radius,list_telephone,list_city,list_state,list_postal,icon_here,i){
	var html1 = '<div class="row rowstyle"><div class="col-md-2 col-sm-2 col-xs-2 dealer-address"><div class="dealer-logo-space"><img src="' + list_image + '" alt="new add" height="200px" width="200px"/></div></div><div class="col-md-10 col-sm-10 col-xs-10 dealer-address"><h4><a target="_blank" href="' + list_weburl + '">' + list_fname + ' ' + list_lname + '</a></h4><p><span class="address-distance">';
	var html2 = '<img class="marker_icon_html" id="marker'+i+'" src="'+ icon_here +'"/>';
	var html3 = list_radius + '<p>' + list_telephone + ' </p><p> ' + list_city +', '+ list_state +', '+list_postal+'</p><p><a target="_blank" href="' + list_weburl + '" class="dealer_url"> ' + list_weburl + ' </a></p></div></div>';
	
	var div = document.createElement('div');
    div.innerHTML = html1 + html2 + html3;
    div.className = "main-list";
	div.style.cursor = 'pointer';
    div.style.float = 'left';
	div.style.width = '100%';
    div.style.marginBottom = '5px';
	
	google.maps.event.addDomListener(div, 'click', function() {
            google.maps.event.trigger(marker, 'click');
			console.log('working');
			var window_height = window.height;
			$("html, body").animate({ scrollTop: 200 }, "slow");
    });
	return div;
}

$(document).ready(function() {
    initMap(1);
});

$(document)
    .ajaxStart(function() {
        $('#spinner_image').show();
        $('body').css('opacity', '0.4');
    })
    .ajaxStop(function() {
        $('#spinner_image').hide();
        $('body').css('opacity', '1');
    })
	.ajaxError(function() {
        $('#spinner_image').hide();
        $('body').css('opacity', '1');
    });
</script>
