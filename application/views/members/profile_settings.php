<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/style-dashboard.css" rel="stylesheet">
<?php $page_name = $this->uri->segment('2');?>
<style>
.error{
		color:red;
	}
</style>
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
    <div class="row">
      <div class="col-md-12">
        <div class="settings-profile">
            
<form action="<?php echo base_url();?>members/profile" method="post" enctype="multipart/form-data">
<table>
<tbody>
  <tr>
    <th class="table-title">First Name</th>
    <td><input type="text" name="firstname" placeholder="Mark" value="<?php echo $user_details[0]['firstname'];?>"></td>

 </tr>
 <tr>
    <th class="table-title">Last Name</th>
    <td><input type="text" name="lastname" placeholder="Name" value="<?php echo $user_details[0]['lastname'];?>"></td>

 </tr>
 <tr>
    <th class="table-title">City</th>
    <td><input type="text" name="city" placeholder="" value="<?php echo $user_details[0]['city'];?>"></td>

 </tr>
 <tr>
    <th class="table-title">State</th>
    <td><input type="text" name="state" placeholder="" value="<?php echo $user_details[0]['state'];?>"></td>

 </tr>
 <tr>
    <th class="table-title">Postal Code</th>
    <td><input type="text" name="postalcode" placeholder="i.e.234565" id="postal_code_check" value="<?php echo $user_details[0]['postal_code'];?>">
	<span id="error_postal" class="error"></span>
	</td>

 </tr>
  <tr>
    <th class="table-title">Telephone</th>
    <td><input type="text" name="telephone" placeholder="i.e.9898989898" value="<?php echo $user_details[0]['telephone'];?>"></td>

 </tr>
 <tr>
    <th class="table-title">Website</th>
    <td><input type="text" name="website_url" placeholder="i.e.www.xyz.com" value="<?php echo $user_details[0]['website_url'];?>" class="webs" onblur="checkURL(this)"></td>

 </tr>
<?php if (strpos($user_details[0]['email'], '|') == FALSE){?>
 <tr>
    <th class="table-title">Email</th>
    <td><input type="text" name="email" placeholder="i.e. xyz@abc.com" value="<?php echo $user_details[0]['email'];?>"></td>

 </tr>
 <?php } ?>
 <tr>
    <th class="table-title">Profile Picture</th>
    <td><input type="file" name="profile_picture" />
</tr>
<tr>
	<th>&nbsp;</th>
	<td>
	<?php if(!empty($user_details[0]['image']) && file_exists('assets/uploads/user_images/'.$user_details[0]['image'])){ ?>
          <?php if(!file_exists('assets/uploads/user_images/88*31'.$user_details[0]['image'])  && !empty($user_details[0]['image']) && !is_numeric($user_details[0]['image'])){
			$new_images = 'assets/uploads/user_images/88*31'.$user_details[0]['image'];
                        $width=88;
                        $size = GetimageSize('assets/uploads/user_images/'.$user_details[0]['image']);
                        $height=31;
                        $images_orig = ImageCreateFromJPEG('assets/uploads/user_images/'.$user_details[0]['image']);
                        $photoX = ImagesX($images_orig);
                        $photoY = ImagesY($images_orig);
                        $images_fin = ImageCreateTrueColor($width, $height);
                        ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
                        ImageJPEG($images_fin,$new_images);
                        ImageDestroy($images_orig);
                        ImageDestroy($images_fin);
		}
										?>
	<img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/88*31<?php echo $user_details[0]['image'];?>" height="31px" width="88px"/>
	<?php } else { ?>
              <?php if($user_details[0]['user_type'] == 'private'){ ?>
                <img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/private-seller.jpg" alt="categories"/>
             <?php } else if($user_details[0]['user_type'] == 'dealer'){ ?>
                <img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/dealer.jpg" alt="categories"/>
             <?php } else { ?>
                <img  src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/user.jpeg" alt="categories"/>
             <?php } } ?>
	</td>
</tr>
 
 
 <tr>
    <th class="table-title"></th>
    <td><input type="submit" name="update_profile" value="Update" class="btn1"></td>

 </tr>
</tbody></table>
</form>
			<div class="deactivate_account">
                    <p>Deactivate Account</p>
                    <span><input type="button" name="remove_account" value="Deactivate" class="btn1" data-toggle="modal" data-target="#myModal"></span>
            </div>
		</div>
      </div>
      
    </div>
  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <form action="<?php echo base_url();?>members/delete_account" method="post" >
  <div class="modal-dialog">
      
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Deactivate Account</h4>
      </div>
      <div class="modal-body">
        <p>If you continue all your posts will be deleted and you won't be able to use this account, continue ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-default" >Yes</button>
      </div>

    </div>
    
  </div>
   </form>

</div>
<script>
    function checkURL (abc) {
    var string = abc.value;
    if (!~string.indexOf("http")){
        string = "http://" + string;
    }
    abc.value = string;
    return abc
    }
    

	function check_postal(postal){
			$.ajax({
										url : "http://maps.googleapis.com/maps/api/geocode/json?address="+postal+"&sensor=false",
										method: "POST",
										success:function(data){
											if(data.status == 'OK'){
													$("#error_postal").html("");
													$("input[name=postalcode]").css('border','1px solid #d4d1d1');
											} else {
													$("#error_postal").html("Postal code is not correct !");
													$("input[name=postalcode]").css('border','1px solid #990000');
											}
										}
			});
	}
	
	$(document).ready(function(){
		$("#postal_code_check").change(function(){
			postal = $("#postal_code_check").val();
			check_postal(postal);
		});
		$("#postal_code_check").keyup(function(){
			postal = $("#postal_code_check").val();
			check_postal(postal);
		});
		$("#postal_code_check").blur(function(){
			postal = $("#postal_code_check").val();
			check_postal(postal);
		});
		$("#postal_code_check").keypress(function(){
			postal = $("#postal_code_check").val();
			check_postal(postal);
		});
	});
        
        
        
    </script>