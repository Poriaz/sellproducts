<div class="dash space">
	<div class="container">
		<div class="col-md-8">
		<div class="dash-product">
		<div class="my-ad">
		
		<h2>My Profile</h2>
		
		
		</div>
		
		<div class="dash-table table-profile">
<form action="<?php echo base_url();?>members/profile" method="post" enctype="multipart/form-data">
<table>
<tr>
   
    <td>&nbsp;</td>

 </tr>
  <tr>
    <th class="table-title">First Name</th>
    <td><input type="text" name="firstname" value="<?php echo $user_details[0]['firstname'];?>" /></td>

 </tr>
 <tr>
    <th class="table-title">Last Name</th>
    <td><input type="text" name="lastname" value="<?php echo $user_details[0]['lastname'];?>" /></td>

 </tr>
 <tr>
    <th class="table-title">Postal Code</th>
    <td><input type="text" name="postalcode" value="<?php echo $user_details[0]['postal_code'];?>" /></td>

 </tr>
 <tr>
    <th class="table-title">Telephone</th>
    <td><input type="text" name="telephone" value="<?php echo $user_details[0]['telephone'];?>" /></td>

 </tr>
<?php if (strpos($user_details[0]['email'], '|') == FALSE){?>
 <tr>
    <th class="table-title">Email</th>
    <td><input type="text" name="email" value="<?php echo $user_details[0]['email'];?>" /></td>

 </tr>
<?php } ?>
 <tr>
    <th class="table-title">Profile Picture</th>
    <td><input type="file" name="profile_picture" />
	<?php if(!empty($user_details[0]['image']) && file_exists('assets/uploads/user_images/'.$user_details[0]['image'])){ ?>
	<img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/<?php echo $user_details[0]['image'];?>" height="100px" width="100px"/>
	<?php } else { ?>
	<?php if($user_details[0]['user_type'] == 'private'){ ?>
	<img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/private-seller.jpg" height="100px" width="100px"/>
	<?php } else if($user_details[0]['user_type'] == 'dealer'){ ?>
	<img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/dealer.jpg" height="100px" width="100px"/>
	<?php } else { ?>
	<img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/user.jpeg" height="100px" width="100px"/>
	<?php } } ?>
</td>

 </tr>
 <tr>
    <th class="table-title"></th>
    <td><input type="submit" name="update_profile" value="Update" class="srch"/></td>

 </tr>
</table>
</form>

		</div></div>
		
		</div>
        
		<div class="col-md-4">
		
		<div class="dash-list">
		<h4>Dashboard</h4>
		<ul>
			<li><a href="<?php echo base_url();?>members/dashboard"><i class="fa fa-angle-left"></i> My Ads</a></li>
			<li><a href="<?php echo base_url();?>members/saved_items"><i class="fa fa-angle-left"></i> My Saved Items</a></li>
			<li><a href="<?php echo base_url();?>members/saved_searches"><i class="fa fa-angle-left"></i> My Saved Searches</a></li>
			<li><a href="<?php echo base_url();?>members/compare_items"><i class="fa fa-angle-left"></i> My Compare Items</a></li>
			<li><a href="<?php echo base_url();?>members/orders"><i class="fa fa-angle-left"></i> My Orders</a></li>
			<li><a href="<?php echo base_url();?>members/profile"><i class="fa fa-angle-left"></i> My Edit Profile</a></li>
			<li><a href="<?php echo base_url();?>members/changepassword"><i class="fa fa-angle-left"></i> My Change Password</a></li>
			<li><a href="<?php echo base_url();?>auth/logout"><i class="fa fa-angle-left"></i> Log Out</a></li>
		</ul>
		</div>
		
		<div class="dash-list">
		<h4>Account Information</h4>
		<div class="col-md-4"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/<?php echo $user_details[0]['image'];?>" /></div>
		<div class="col-md-8">

    <p><b><?php echo $user_details[0]['firstname']." ".$user_details[0]['lastname'];?></b></p>
    <p>Member Since: <?php echo date("d, M Y",strtotime($user_details[0]['created']));?></p>
    <p> <span>Last Login: April 25, 2015 8:25 am</span></p>
	</div>
	<div class="col-md-12">
	<h5>Purchase a Membership Pack</h5>
	<p><i class="fa fa-envelope-o"></i> demo@appthemes.com</div>
</div>
<div class="dash-list">
		<h4>Account Statistics</h4>
		<ul>
			<li><a href="#">
    Live Listings: 9
  
    
   
</a></li>
			<li><a href="#">  Pending Listings: 0</a></li>
			<li><a href="#">Offline Listings: 0</a></li>
			<li><a href="#"> Total Listings: 9</a></li>
			
		</ul>
		</div>
		</div>
		
		</div>
	</div>
  </div>
