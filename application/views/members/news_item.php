<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.carousel.css" rel="stylesheet">
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.theme.css" rel="stylesheet">
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl/custom.css" rel="stylesheet">
<div class="news space news-item">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-8 col-xs-12">
        <?php foreach($news_item as $news_item){ ?>
        <div class="row1">
          <div class="news-image"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/news_images/<?php echo $news_item['nw_image'];?>" alt="img">
            <div class="publish_date"><b> </b> <?php echo date('d, M Y',strtotime($news_item['created_on']));?></div>
          </div>
         
          <div class="new-detail">
		   <h4 class="news_title"><?php echo $news_item['nw_title'];?></h4>
		  <?php echo $news_item['nw_description'];?>
           
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">

        <div class="news-banr">
          <a href="<?php echo base_url();?>add/post"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/side-bg.jpg" alt="advertisement"/></a>
        </div>
        <div class="news-banr">
        <div class="feature-ad">
        	<div class="f-img"><a href=""><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/f-bg.jpg" alt="advertisement"/></a>            
            </div>
            <p class="p-title"><a href="#">Microwave</a></p>
            <p class="p-price">212</p>
            <p class="profile-img"><img height="80px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/profile.jpg" alt="products"/></p>
           <p>within 5469 Km</p>
            
        </div>
        
        
          
        </div>
    
        <div class="news-banr">
          <h3>Archives</h3>
          <ul>
            <?php foreach($news as $n){ ?>
            <li><a href="<?php echo base_url();?>members/news_item/<?php echo $n['nw_id'];?>"><?php echo $n['nw_title'];?></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
        <?php } ?>
      </div>
      
    </div>
  </div>
</div>
</div>
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/owl.carousel.min.js"></script> 
<script>

    $(document).ready(function($) {
      $("#owl-example").owlCarousel({items : 1,autoPlay : true,
    stopOnHover : true,pagination:false});
	$("#owl-example2").owlCarousel({items : 1,autoPlay : true,
    stopOnHover : true,pagination:false});
    });
</script> 
