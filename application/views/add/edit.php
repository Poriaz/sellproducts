<link type="text/css" rel="stylesheet" href="<?php echo str_replace('/index.php','',base_url());?>assets/css/jquery.stepy.css" />
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo str_replace('/index.php','',base_url());?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo str_replace('/index.php','',base_url());?>assets/js/jquery.stepy.min.js"></script>
<script type="text/javascript" src="<?php echo str_replace('/index.php','',base_url());?>assets/js/jquery.filer.min.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
<script>
$(document).ready(function() {
       
        
        $('.file_input').filer({
            showThumbs: true,
            maxSize : 2,
            templates: {
                box: '<ul class="jFiler-item-list" id="sortable"></ul>',
                item: '<li class="jFiler-item ui-state-default">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item ui-state-default">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: true,
				removeConfirmation: false,
                _selectors: {
                    list: '.jFiler-item-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action',
                }
            },
            addMore: true,
            files: [
	 <?php foreach($images as $img){ 
	if(file_exists('assets/uploads/add_portfolio/'.$this->uri->segment(3).'/'.$img['image']) && !empty($img['image'])){
	$exploded = explode(".",$img['image']);
	?>
		{
                name: "<?php echo $img['image'];?>",
                size: 5453,
                type: "image/<?php echo $exploded[1];?>",
                file: "<?php echo str_replace('/index.php','',base_url()).'assets/uploads/add_portfolio/'.$this->uri->segment(3).'/'.$img['image'];?>",
            },
	 <?php } } ?>
	    ]
        });
        $("#file_input_id").change(function () {
        $('#add_thumbnails').html("");
        imageFiles = document.getElementById('file_input_id').files;
	numFiles = imageFiles.length;
	readFile();           

        });
       
	});
        var reader = new FileReader(),
        i=0,numFiles = 0,imageFiles;
        function readFile() {
            reader.readAsDataURL(imageFiles[i])
        }
        reader.onloadend = function(e) {

            // make an image and append it to the div
            var single_img = '<div class="thumbnails"><img src="'+e.target.result+'"/></div>';
            $(single_img).appendTo('#add_thumbnails');
            // if there are more files run the file reader again
            if (i < numFiles) {
                if(i == 0){
                    var big_img = '<img src="'+e.target.result+'"/>';
                    $('#add_main_image').html(big_img);   
                }
                i++;
                readFile();
            }
        };  
  
</script>
<script type="text/javascript">
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });
$(function(){
$('#custom').stepy({backLabel: 'Back',
block: true,
errorImage: true,
nextLabel: 'Next',
titleClick: true,
legend : false,
validate: true,
next: function(index) {
	if(index == 2 || index == 3 || index == 4){
                var numItems = $('.jFiler-item-thumb-image').length;
                if(numItems >= 1){
                    $('#add_thumbnails').html("");
                    var big_img = '<img src="'+$(".jFiler-item-thumb-image:first").children('img').attr('src')+'"/>';
                    $('#add_main_image').html(big_img);   
                    $(".jFiler-item-thumb-image").each(function() { 

                                    imgsrc = $(this).children('img').attr('src');
                                    var single_img = '<div class="thumbnails"><img src="'+imgsrc+'" /></div>';
                                    $(single_img).appendTo('#add_thumbnails');
                    });
                } else {
                    $('#add_thumbnails').html("");
                    var big_img = '<img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/side-bg.jpg"/>';
                    $('#add_main_image').html(big_img);
                    var single_img = '<div class="thumbnails"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/side-bg.jpg" /></div>';
                    $('#add_thumbnails').html(single_img);
                }
		var add_title = $("input[name=add_title]").val();
		var add_price = $("input[name=price]").val();
		var add_postal = $("input[name=postal_code]").val();
		var add_category = $("select[name=category]").val();
		
		var add_model = $("input[name=model]").val();
		var add_used_type = $("select[name=equip_used_type]").val();
		/*var add_country = $("input[name=map_country]").val();
		var add_state = $("input[name=map_state]").val();
		var add_city = $("input[name=map_city]").val();
		var add_street = $("input[name=map_street]").val();*/
		
		var description = $('textarea#text_description').val();
		var phone = $("input[name=phone_no]").val();
		phone  = phone.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
		if(add_title.length === 0){
			add_title = "Not Added";
		}
                if(add_price.length === 0){
			add_price = "0";
		}
		$('#product_title_and_price').html(add_title+" - $"+add_price);
		
		if(add_used_type.length === 0){
			add_used_type = "Not Added";
		}
		$('#add_address_here').html(add_postal);
		if(add_used_type.length === 0){
			add_used_type = "Not Added";
		}
		$('#add_condition_here').html(add_used_type);
		
		if(add_model.length === 0){
			add_model = "Not Added";
		}
		$('#add_model_here').html(add_model);
		
		
		/*if(add_street.length === 0){
			add_street = "Not Added";
		}
		$('#add_address_here').html(add_street);
		if(add_state.length === 0){
			add_state = "State not Added";
		}
		$('#add_state_here').html(add_state);
		if(add_city.length === 0){
			add_city = "City not Added";
		}
		$('#add_city_here').html(add_city);*/
		if(add_postal.length === 0){
			add_postal = "Postal not Added";
		}
		$('#add_zip_here').html(add_postal);
		if(phone.length === 0){
			phone = "Not Added";
		}
		$('#add_phone_here').html(phone);
		if(description.length === 0){
			description = "Description not Added";
		}
		$('#add_description').html(description);
		


		var errors = new Array();

		var title = $("input[name=add_title]").val();
		if(title.length === 0){
			errors[1] = "error";
			$("#error_title").html("Title is required !");
			$("input[name=add_title]").css('border','1px solid #990000');
		} else {
			errors[1] = 1;
			$("#error_title").html("");
			$("input[name=add_title]").css('border','1px solid #D4D1D1');
			
		}

		var price = $("input[name=price]").val();
		if(price.length === 0){
			errors[2] = "error";
			$("#error_price").html("Price is required !");
			$("input[name=price]").css('border','1px solid #990000');
		} else {
			errors[2] = 1;
			$("#error_price").html("");
			$("input[name=price]").css('border','1px solid #D4D1D1');
		}

		var city = $("input[name=city]").val();
		if(city.length === 0){
			errors[4] = "error";
			$("#error_city").html("City is required !");
			$("input[name=city]").css('border','1px solid #990000');
		} else {
			errors[4] = 1;
			$("#error_city").html("");
			$("input[name=city]").css('border','1px solid #D4D1D1');
		}

		var postal = $("input[name=postal_code]").val();
		if(postal.length === 0){
			errors[3] = "error";
			$("#error_postal").html("Postal code is required !");
			$("input[name=postal_code]").css('border','1px solid #990000');
		} else {
			errors[3] = 1;
			$("#error_postal").html("");
			$("input[name=postal_code]").css('border','1px solid #D4D1D1');
		}


		/*var year_make = $("input[name=year_make]").val();
		if(year_make.length === 0){
			errors[4] = "error";
			$("#error_year_make").html("Year make is required !");
		} else {
			errors[4] = 1;
			$("#error_year_make").html("");
		}*/


		var description = $("textarea#text_description").val();
		if(description.length === 0){
			errors[5] = "error";
			$("#error_description").html("Description is required !");
			$("textarea#text_description").css('border','1px solid #990000');
		} else {
			errors[5] = 1;
			$("#error_description").html("");
			$("textarea#text_description").css('border','1px solid #D4D1D1');
		}


		var phone = $("input[name=phone_no]").val();
                 var pattern = /^\d{10}$/;
		if(phone.length === 0){
			errors[6] = "error";
			$("#error_phone").html("Phone number is required !");
			$("input[name=phone_no]").css('border','1px solid #990000');
		} else if(pattern.test(phone)){ console.log(phone.length);
			errors[6] = "error";
			$("#error_phone").html("Phone number is not correct !");
			$("input[name=phone_no]").css('border','1px solid #990000');
		} else {
			errors[6] = 1;
			$("#error_phone").html("");
			$("input[name=phone_no]").css('border','1px solid #D4D1D1');
		}

		var equip_used_type = $("select[name=equip_used_type]").val();
		if(equip_used_type.length === 0){
			errors[7] = "error";
			$("#error_equip_used_type").html("Equipment condition required !");
			$("select[name=equip_used_type]").css('border','1px solid #990000');
		} else {
			errors[7] = 1;
			$("#error_equip_used_type").html("");
			$("select[name=equip_used_type]").css('border','1px solid #D4D1D1');
		}
		/*var city = $("input[name=map_city]").val();
		if(city.length === 0){
			errors[7] = "error";
			$("#error_city").html("City is required !");
		} else {
			errors[7] = 1;
			$("#error_city").html("");
		}


		var state = $("input[name=map_state]").val();
		if(state.length === 0){
			errors[8] = "error";
			$("#error_state").html("State is required !");
		} else {
			errors[8] = 1;
			$("#error_state").html("");
		}
		*/
	
		var category = $("#add_category_id option:selected").val();
		if(category.length === 0){
			errors[9] = "error";
			$("#error_category").html("Category is required !");
			$("select[name=category]").css('border','1px solid #990000');
		} else {
			errors[9] = 1;
			$("#error_category").html("");
			$("select[name=category]").css('border','1px solid #d4d1d1');
		}
		if($('input[name="show_phone_number"]:checked').val() == 1){
			$("#phone_number_h1").show(0);
		} else {
			$("#phone_number_h1").hide(0);
		}

                 /**************adding map******************/
                                 zipcode = add_postal;
                                property_title = add_title;
                                $.ajax({
                                    url : "http://maps.googleapis.com/maps/api/geocode/json?address="+zipcode+"&sensor=false",
                                    method: "POST",
                                    success:function(data){
										if(data.status == 'OK'){
                                                                                                latitude = data.results[0].geometry.location.lat;
												longitude= data.results[0].geometry.location.lng;
												address = data.results[0].formatted_address;
												$("#advertisement_address").html(address);
												var geocoder; //To use later
												var map; //Your map
												geocoder = new google.maps.Geocoder();
											  //Default setup
												var latlng = new google.maps.LatLng(latitude, longitude);
												var myOptions = {
												zoom: 8,
												center: latlng,
												mapTypeId: google.maps.MapTypeId.ROADMAP
												}
                                                                                                errors[8] = "1";
                                                                                                console.log(errors[8]);
												$("#error_postal").html("");
												$("input[name=postal_code]").css('border','1px solid #d4d1d1');
												
												if($('input[name="show_on_maps"]:checked').length > 0){ console.log("checked");
												map = new google.maps.Map(document.getElementById("advertisment_map"), myOptions);
												var marker = new google.maps.Marker({
													position: latlng,
													map: map,
													title: property_title
												  });
												} else { console.log("not checked");
													$("#advertisment_map").html('');
													$("#advertisment_map").removeAttr('style');
													$("#advertisment_map").css('height','200px');
													$("#advertisment_map").css('border','none');
												}
												
										} else {
													console.log("ziperror");
													if(zipcode.length < 1){
													$("#error_postal").html("Postal code is required !");
													$("input[name=add_title]").css('border','1px solid #990000');													
													} else {
													$("#error_postal").html("Postal code is not correct !");
													$("input[name=add_title]").css('border','1px solid #990000');
													}
                                                                                                        errors[8] = "error";
										}
                if(errors[1] == 1 && errors[2] == 1 && errors[3] == 1 && errors[4] == 1 && errors[5] == 1 && errors[6] == 1 && errors[7] == 1 && errors[8] == 1 &&  errors[9] == 1){
		console.log("trtrtrtrt");return true;
		} else {
		console.log("1."+errors[1]+"2."+errors[2]+"3."+errors[3]+"4."+errors[4]+"5."+errors[5]+"6."+errors[6]+"7."+errors[7]+"8."+errors[8]+"9."+errors[9]);return false;
		}
                                   } 
                               });
                /********************************/
                
		

               
		
	}

	
    	
  }
});
});
$('#custom').validate({
errorPlacement: function(error, element) {
$('#custom div.stepy-error').append(error);
}, rules: {
'add_title': 'required',
'category': 'required',
'price': 'required',
'postal_code': 'required',
'description': 'required',
'name': 'required',
'phone_no': 'required',
'email':'email',
}, messages: {
'add_title': { required: 'Title is required' },
'category': { required: 'Category is required!' },
'price': { required: 'Price is required!' },
'postal_code': { required: 'Postal code is required!' },
'description': { required: 'Description is required!' },
'name': { required: 'Name is required!' },
'phone_no': { required: 'Phone number is required!' },
'email': { email: 'Invalid e-mail!' },
}
});
</script>
<style>
        .file_input{
            display: inline-block;
            padding: 10px 16px;
            outline: none;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            white-space: nowrap;
            font-family: sans-serif;
            font-size: 11px;
            font-weight: bold;
            border-radius: 3px;
            color: #008BFF;
            border: 1px solid #008BFF;
            vertical-align: middle;
            background-color: #fff;
            margin-bottom: 10px;
            box-shadow: 0px 1px 5px rgba(0,0,0,0.05);
            -webkit-transition: all 0.2s;
            -moz-transition: all 0.2s;
            transition: all 0.2s;
        }
        .file_input:hover,
        .file_input:active {
            background: #008BFF;
            color: #fff;
        }
    </style>
     <?php $user = $this->db->get_where('users',array('id'=>$_SESSION['user_id']))->result_array();
     $images = $this->db->get_where('add_images',array('add_id' => $add_data[0]['add_id']))->result_array();
     ?>
    
	<!-----"find-dealer ends------->
<div class="post-1 space">    
    <div class="tabs-7">
    <div class="container">
	
	<section class="tab_content_wrapper" >
	<form method="post" action="<?php echo base_url();?>add/edit" enctype="multipart/form-data" id="custom" class="p2">
	<input type="hidden" name="add_id" value="<?php echo $this->uri->segment(3);?>"/>
        <fieldset class="tab_content" id="tab25" title="1. Details">
	<legend>1. Details</legend>
       <div class="container1">
            <div class="details">
			   <div class="form1">
				<h4>Contact Information :</h4>
            	<p>
                  <label>
                  Email : <?php echo $user[0]['email'];?> ( <?php if(!empty($user[0]['user_type'])){echo ucfirst($user[0]['user_type']);}else {echo "Private";}?> )
                  </label>
				
                </p>
                <input type="hidden" name="dealer_type" value="<?php if(!empty($user[0]['user_type'])){echo ucfirst($user[0]['user_type']);}else {echo "Private";}?>"/>
                
                  <p class="fifty">
             
               <span><label>Phone Number :</label><input type="number"  style="width:77% !important;" placeholder="" name="phone_no" value="<?php echo trim($add_data[0]['add_phone_number']);?>"/><span id="error_phone" class="error"></span></span>
               
                 </p>
                 <p class="fifty">
                     <label>Show phone number :</label>
                        <span><input class="cl" type="radio" value="1" name="show_phone_number" checked/>Yes</span>
                        <span> <input class="cl" type="radio" value="0" name="show_phone_number"/>No</span>
                 </p>
				</div>
				<div class="form1">
				<p class="cat cat1 cat2"> <label>Posting Title :</label> <input type="text" class="category detail" name="add_title" value="<?php echo $add_data[0]['add_title'];?>"/><span id="error_title" class="error"></span></p>
					<p class="cat cat1"> <label>City </label><input type="text" class="category detail" name="city" value="<?php echo $add_data[0]['add_city'];?>"/><span id="error_city" class="error"></span></p>
                  
				 <p class="cat cat1"> <label>Price($) :  </label><input type="number" min="1" class="category detail" name="price" value="<?php echo $add_data[0]['add_price'];?>"/><span id="error_price" class="error"></span></p>
                  
                  <p class="cat cat1" style="margin-right: 0px !important;"> <label>Postal Code :</label> <input type="text" class="category detail" name="postal_code" value="<?php echo $add_data[0]['add_postal_code'];?>"/><span id="error_postal" class="error"></span></p>
                  
                    <p> <label>Posting Body :</label><span style="text-align:right">Please enter phone numbers as contact info above, not in posting body below.</span>
                     <textarea name="description"  id="text_description"><?php echo $add_data[0]['add_description'];?></textarea><span id="error_description" class="error"></span></p>
                     </div>
                     <div class="form1">
                      <h4>Posting Detail :</h4>
		<p class="cat cat1">
                  <label>
                 Category
                  </label>
                  
                  <select class="category detail" name="category"  id="add_category_id">
		 <option val="">Choose Category</option>
		<?php foreach($categories as $category){ ?>
		<option <?php if($category['c_id'] == trim($add_data[0]['add_category'])){ ?>selected="selected"<?php }?> value="<?php echo $category['c_id'];?>" ><?php echo $category['c_title'];?></option>
		<?php } ?>
		</select>
                    <span id="error_category" class="error"></span>
                </p>
                
                 <p class="cat cat1">
                  <label>
                 Model Number
                  </label>
                  
                  <input type="text" placeholder="Enter model" name="model" value="<?php echo $add_data[0]['add_model'];?>"/>
                </p>
                 <p class="cat cat1">
                  <label>
                 Size / Dimensions
                  </label>
                  
                  <input type="text" placeholder="Enter Size" name="size" value="<?php echo $add_data[0]['add_dimensions'];?>"/>
                </p>
                 <p class="cat cat1">
                  <label>
                 Condition
                  </label>
                  
                   <select class="category detail" name="equip_used_type"  id="euip_used_id">
                        <option value="" <?php if(trim($add_data[0]['add_used_type']) == ""){ ?>selected="selected"<?php }?>>Select Condition</option>
			<option value="new" <?php if(trim($add_data[0]['add_used_type']) == "new"){ ?>selected="selected"<?php }?>>New</option>
			<option value="used" <?php if(trim($add_data[0]['add_used_type']) == "used"){ ?>selected="selected"<?php }?>>Used</option>
			
		  

		</select>
                     <span id="error_equip_used_type" class="error"></span>
                </p>
                
             
		</div>
		<div class="form1">
		<p class="cat cat1">
                  <input type="checkbox" class="c2" name="show_on_maps" value="1" <?php if($add_data[0]['add_show_on_map'] == "1"){ ?>checked<?php }?>/> Show on maps
                </p>
		</div>
            </div>
			</div>
        </fieldset>
        <fieldset class="tab_content" id="tab26" title="2. Upload Images">
	<legend>2. Upload Images</legend>
        <div class="container1">
            <div class="details2">
            	<div class="row">
		<div class="col-md-12">
		<div class="col-md-12 postad-photo-section">
			
			    <div id="reorder-helper" class="light_box" style="display:none;">Drag photos to reorder</div>
			    </div>
			</div>
		</div>
			
				
				<a class="file_input" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><i class="icon-jfi-paperclip"></i> Attach a file</a>
                <div class="col-md-6 postad-text">
			<p>Drag and drop your photos to change the order. The photo in the first position will be your main photo.
			</p>
		</div>
            
		</div>
		
		
		
	</div>
            
        </fieldset>
         <fieldset class="tab_content" id="tab27" title="3. Publish">
	 <legend>3. Publish</legend>
         
         <div class="container1">
        
           <div class="row publish">
    	<div class="col-md-8 col-sm-8 col-xs-12">
        	<h2 class="prdct-title" id="product_title_and_price">Lorem Ipsum</h2>
        	<div class="product-detail">            	
            	<div class="main-iamge" id="add_main_image">
                	<?php if(!empty($images[0]['image']) && file_exists('assets/uploads/add_portfolio/'.$add_data[0]['add_id']."/".$images[0]['image'])){ ?>
                        <img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $add_data[0]['add_id']."/".$images[0]['image'];?>" alt="products"/>
                       <?php } else { ?>
                       <img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="products"/>
                       <?php } ?>
                </div>
                <div class="product-thumbs" id="add_thumbnails">
                    <?php foreach($images as $image){ ?>
                  <?php if(!empty($image['image']) && file_exists('assets/uploads/add_portfolio/'.$add_data[0]['add_id']."/".$image['image'])){ ?>
                   <div class="thumbnails">
                    	<img style="cursor:pointer;" onclick="change_main_image('<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $add_data[0]['add_id'].'/'.$image['image'];?>');" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $add_data[0]['add_id']."/".$image['image'];?>" alt="thumbnails" />
                    </div>
                  <?php } }?>
                    
                </div>
            </div>
           
            <div class="product-description">
            	
                
                <div class="description-text">
                	<p id="add_description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 eq">
			<div class="product-enquiry">
            	<h3>Inquire About this Product</h3>
                <div class="call-wrap">
                    <h1 id="phone_number_h1"><i class="fa fa-phone"></i> 
                        (+1) <span id="phone_number_here">999-999-9999</span>
                    </h1>
                </div>
              
                                            
                    <div class="tab-content1">
                      <div class="tab-pane1 active1" id="enquiry">
                      		<form id="form_message" onsubmit="return false;" >
                                <input type="hidden" name="add_id" value="" disabled="disabled"/>
                                <input type="hidden" name="message_to" value="" disabled="disabled"/>
                              <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name" disabled="disabled">
                              </div>
                              <div class="form-group">                               
                                <input type="email" class="form-control" name="email" placeholder="Email" disabled="disabled">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="Phone" disabled="disabled">
                              </div>
                              <div class="form-group">
                                <textarea class="form-control" id="message" name="message" placeholder="Type a message" disabled="disabled"></textarea>
                              </div>
                              <div class="checkbox">
                                  <label>
                                    <input type="checkbox" value="1" name="send_copy" disabled="disabled">
                                    Send me a copy of this message
                                  </label>
                                </div>
                              <button class="btn btn-default food_btn" disabled="disabled"><img style="display:none;" id="loading_img" height="30px" width="30px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/loading-icon.gif" alt="Loading"/> Send Message </button>
                            </form>
                      </div>
                      
                    </div>                         
                                  
            </div>
        	<!---------------product enquiry ends here-------------->
            <?php $user = $this->db->get_where('users',array('id'=>$_SESSION['user_id']))->result_array();?>
            <div class="seller-info">
            	<div class="seller-image">
                	<?php if(!empty($user[0]['image']) && file_exists('assets/uploads/user_images/'.$user[0]['image'])){ ?>
			<img height="80px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/<?php echo $user[0]['image'];?>" />
			<?php } else { ?>
			<img height="80px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/user.jpeg" alt="categories"/>
			<?php } ?>
                </div>
                <p class="seller"><?php echo $user[0]['firstname']." ".$user[0]['lastname']; ?><br><span id="advertisement_address" style="border:none;"></span></p>
				<p class="view-web"><a target="_blank" href="#">Visit our Website</a></p>
			</div>
			<div class="seller-location" id="advertisment_map" style="height:200px;">
            	
            </div>
        </div>
       </div>
      </div>
         
         
	<input type="submit" class="finish" name="update_add" value="Publish" />
        </fieldset>
        
	
	</form>
    </section>
</div> 
</div>
</div>

