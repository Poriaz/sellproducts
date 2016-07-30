<style>
.settings-profile input[type="password"] {
    border: 1px solid rgba(186, 186, 186, 0.25);
    margin-bottom: 3px;
    padding: 7px;
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
            <li style="<?php if($page_name == 'messages'){echo "color:black;background:white;position:relative;bottom: -2px;";}?>"><a href="<?php echo base_url();?>members/messages"> Messages</a></li>
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
        <div class="settings-profile change_password">
<form action="<?php echo base_url();?>auth/change_password" method="post">
<table>
<tbody>
  <tr>
    <th class="table-title">Old Password</th>
    <td><input type="password" name="old_password" value="" /></td>

 </tr>
 <tr>
    <th class="table-title">New Password</th>
    <td><input type="password" name="new_password" value="" /></td>

 </tr>
 <tr>
    <th class="table-title">Confirm New Password</th>
    <td><input type="password" name="confirm_new_password" value="" /></td>

 </tr>
  
 <tr>
    <th class="table-title"></th>
    <td><input type="submit" name="update_profile" value="Update" class="srch btn1"></td>

 </tr>
</tbody></table>
</form>

		</div>
      </div>
      
    </div>
  </div>
</div>