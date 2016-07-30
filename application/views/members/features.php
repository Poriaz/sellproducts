<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.carousel.css" rel="stylesheet">
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.theme.css" rel="stylesheet">
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl/custom.css" rel="stylesheet">
<style>
    .archives_underline{
        text-decoration: underline;
    }
</style>
<div class="news space">
  <div class="container">
    <h2>News and Features</h2>
    <span class="span"></span>
    <div class="row">
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php 
		if(count($news) > 0){
		foreach($news as $news_item){ ?>
        <div class="row1">
          <div class="news-image"> <a href="<?php echo base_url();?>members/news_item/<?php echo $news_item['nw_id'];?>">
            <?php if(!empty($news_item['nw_image']) && file_exists('assets/uploads/news_images/'.$news_item['nw_image'])){?>
            <img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/news_images/<?php echo $news_item['nw_image'];?>" alt="img">
            <?php } else { ?>
            <img height="100px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="categories"/>
            <?php } ?>
            </a>
            <div class="publish_date"><?php echo date('F d, Y',strtotime($news_item['created_on']));?></div>
          </div>
          <div class="new-detail">
            <h4 class="news_title"><a href="<?php echo base_url();?>members/news_item/<?php echo $news_item['nw_id'];?>"><?php echo $news_item['nw_title'];?></a></h4>
            <?php echo implode(' ', array_slice(explode(' ', $news_item['nw_description']), 0, 50))."..";?>
            <p>
            <div class="learn-more">
              </p>
            </div>
          </div>
        </div>
        <?php } } else { ?>
		<div class="row1">
          <p>No results were found in selected month! Please select different month and year</p>
        </div>
		<?php } ?>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12">
	  
        <div class="news-banr news-add1">
          <a href="<?php echo base_url();?>add/post"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/side-bg.jpg" alt="advertisement"/></a>
        </div>
        <div class="news-banr">
         <?php 
         $advertisements =  $this->db->query('select * from advertisement where status = "active" and post_status = "published" order by rand() limit 1')->result_array();
		
         foreach($advertisements as $add){ 
		$images = $this->db->get_where('add_images',array('add_id' => $add['add_id']))->result_array();
		$category = $this->db->get_where('categories',array('c_id' => $add['add_category']))->result_array();
		$dealer = $this->db->get_where('users',array('id' => $add['add_added_by_member']))->result_array();
		$latlng = $this->db->get_where('zipcodes',array('zip_code' => $add['add_postal_code']))->result_array();
		$earthRadius = 3976;
		$latFrom = deg2rad($_SESSION['client_lat']);
		$lonFrom = deg2rad($_SESSION['client_lon']);
		$latTo = deg2rad(@$latlng[0]['latitude']);
		$lonTo = deg2rad(@$latlng[0]['longitude']);
		$latDelta = $latTo - $latFrom;
		$lonDelta = $lonTo - $lonFrom;
		$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
	?>
        <div class="feature-ad">
        	<div class="f-img">
                    <a href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>">
	<?php if(!empty($images[0]['image']) && file_exists('assets/uploads/add_portfolio/'.$add['add_id']."/".$images[0]['image'])){ ?>
         <img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $add['add_id']."/".$images[0]['image'];?>" alt="products"/>
	<?php } else { ?>
	<img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="products"/>
	<?php } ?>
	</a>
            </div>
            <p class="p-title"><a href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>"><?php echo $add['add_title'];?></a></p>
            <p class="p-price">Price : <?php echo "$".$add['add_price'];?></p>
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
           <p>
               <?php $miles =  round($angle * $earthRadius); 
			if($miles < 10000){
				echo "within ".$miles." Km";
			} else {
				echo $add['add_specific_location'];
			}
			?>
           </p>
            
        </div>
        
         <?php } ?>
          
        </div>
          <div class="news-banr">
	  <?php $news_date_query = $this->db->query("SELECT Distinct(DATE_FORMAT(created_on, '%m-%Y')) AS archive from news ORDER BY created_on asc")->result_array();
	  ?>
		  <h3 class="archives_underline">Archives</h3>
		  <ul>
		  <?php foreach($news_date_query as $arc){ 
                      $month_year = explode("-",$arc['archive']);
                      $monthNum = $month_year[0];
                      $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                      $monthName = $dateObj->format('F');
                      ?>
          <li><a style="cursor:pointer;" onclick="setGetParameter('filter','<?php echo $arc['archive'];?>');"><?php  echo $monthName." ".$month_year[1];?></a></li>
		  <?php } ?>
		  </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/owl.carousel.min.js"></script> 
<script>

    $(document).ready(function($) {
      $("#owl-example1").owlCarousel({items : 1,autoPlay : true,
    stopOnHover : true,pagination:false});
	$("#owl-example2").owlCarousel({items : 1,autoPlay : true,
    stopOnHover : true,pagination:false});
    });
	
	var QueryString = function () {
  // This function is anonymous, is executed immediately and 
  // the return value is assigned to QueryString!
  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
        // If first entry with this name
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = decodeURIComponent(pair[1]);
        // If second entry with this name
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
      query_string[pair[0]] = arr;
        // If third or later entry with this name
    } else {
      query_string[pair[0]].push(decodeURIComponent(pair[1]));
    }
  } 
    return query_string;
}();

function setGetParameter(paramName, paramValue)
{
    var url = window.location.href;
    var hash = location.hash;
    url = url.replace(hash, '');
    if (url.indexOf(paramName + "=") >= 0)
    {
        var prefix = url.substring(0, url.indexOf(paramName));
        var suffix = url.substring(url.indexOf(paramName));
        suffix = suffix.substring(suffix.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + paramName + "=" + paramValue + suffix;
    }
    else
    {
    if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
    else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
}
</script> 
