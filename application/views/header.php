<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<title>Sell your products</title>

<!-- Bootstrap core CSS -->
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/responsive.css" rel="stylesheet">
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Custom styles for this template -->

<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/product/genric.css" rel="stylesheet" type="text/css" />
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/product/slider.css" rel="stylesheet" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo str_replace('/index.php','',base_url());?>assets/css/compare/animation.css" type="text/css" media="screen" />

<script type="text/javascript" src="<?php echo str_replace('/index.php','',base_url());?>assets/js/jquery-1.11.0.min.js"></script>
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/jquery-ui.js"></script>
<script type="text/javascript">
var  base_url = "http://geniusprogrammers.com/testserver/selling/";
$(document).ready(function(){
	$('.reorder_link').on('click',function(){
		$("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
		$('.reorder_link').html('save reordering');
		$('.reorder_link').attr("id","save_reorder");
		$('#reorder-helper').slideDown('slow');
		$('.image_link').attr("href","javascript:void(0);");
		$('.image_link').css("cursor","move");
		$("#save_reorder").click(function( e ){
			if( !$("#save_reorder i").length )
			{
				$(this).html('').prepend('<img src="images/refresh-animated.gif"/>');
				$("ul.reorder-photos-list").sortable('destroy');
				$("#reorder-helper").html( "Reordering Photos - This could take a moment. Please don't navigate away from this page." ).removeClass('light_box').addClass('notice notice_error');
	
				var h = [];
				$("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
				$.ajax({
					type: "POST",
					url: "order_update.php",
					data: {ids: " " + h + ""},
					success: function(html) 
					{
						window.location.reload();
						/*$("#reorder-helper").html( "Reorder Completed - Image reorder have been successfully completed. Please reload the page for testing the reorder." ).removeClass('light_box').addClass('notice notice_success');
						$('.reorder_link').html('reorder photos');
						$('.reorder_link').attr("id","");*/
					}
					
				});	
				return false;
			}	
			e.preventDefault();		
		});
	});
	
});
</script>
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/product/thumbnail-slider.js" type="text/javascript"></script>
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/bootstrap.min.js"></script> 

</head>
<!-- NAVBAR
================================================== -->
<body>
<header>
<?php 
$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$jsonData = file_get_contents("http://freegeoip.net/json/".$ip);	
$data = json_decode($jsonData,true);
if ($data) {
        $_SESSION['client_lat'] = $data['latitude']; // Latitude  
        $_SESSION['client_lon'] = $data['longitude']; // Latitude  
}

?>
  <div class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-4">
          <div class="logo"><a href="<?php echo base_url();?>" ><img class="img-responsive" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/logo.png" alt="logo"></a></div>
        </div>
        <div class="col-md-9 col-sm-8">
        
        
         <a href="<?php echo base_url();?>add/post"><img class="img-responsive" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/h-bg.png" alt="banner" /></a>


        </div>
      </div>
    </div>
  </div>
  <div class="menu-bar"> 
    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
             <?php $current_action = $this->uri->segment(2);?>
            <li class="<?php if($current_action != 'dealers' && $current_action !='categories' && $current_action !='newandfeatures'){echo 'active';}?>"><a href="<?php echo base_url();?>">Home</a></li>
            <li class="<?php if($current_action == 'dealers'){echo 'active';}?>"><a href="<?php echo base_url();?>members/dealers"> Find Local Dealers </a></li>
            <li class="<?php if($current_action == 'categories'){echo 'active';}?>"><a href="<?php echo base_url();?>members/categories">Categories</a></li>
            <li class="<?php if($current_action == 'newandfeatures'){echo 'active';}?>"><a href="<?php echo base_url();?>members/newandfeatures"> News And Features </a></li>
		</ul>
          
          <div class="post">
                 <?php if(!isset($_SESSION['user_id'])){ 
		    if($this->uri->segment(2) != "register" && $this->uri->segment(2) != "login"){ ?>
				<a class="rightmost_btn" href="<?php echo base_url();?>auth/login/">Sign in</a>
			<?php } } else {
					$user = $this->db->get_where('users',array('id'=>$_SESSION['user_id']))->result_array();
			?>
				<a class="rightmost_btn" href="<?php echo base_url();?>members/dashboard/">
				<?php if(!empty($user[0]['firstname'])){ ?>
				<?php echo "My Account";?>
				<?php } else { ?>
				Add an email account
				<?php } ?>
				</a>
			<?php } ?>
		  <a href="<?php echo base_url();?>add/post/" class="post_free_add_link">Post Ad</a>
		  
		
		  </div>
		  
        </div>
        <!--/.nav-collapse --> 
      </div>
    </nav>
  </div>
</header>
