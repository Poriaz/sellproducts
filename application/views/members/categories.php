
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Custom styles for this template -->
<link href="style.css" rel="stylesheet">
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/product/genric.css" rel="stylesheet" type="text/css" />
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/product/slider.css" rel="stylesheet" type="text/css" />
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/product/thumbnail-slider.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo str_replace('/index.php','',base_url());?>assets/css/compare/jQueryTab.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo str_replace('/index.php','',base_url());?>assets/css/compare/animation.css" type="text/css" media="screen" />
 <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
 
</head>
<!-- NAVBAR
================================================== -->
<body>



<div class="recent space">
  <div class="container">
    <h2>Categories</h2>
  
    <div class="row categories-icon">
	
    <?php foreach($categories as $category){ 
$count  = $this->db->get_where('advertisement',array('add_category'=>$category['c_id']))->num_rows();
	?>
	
      <div class="col-md-3 col-sm-4 col-xs-12">
        <div class="cat-icon">
		<a href="<?php echo base_url();?>search/results?page=1&order=add_price-asc&per_page=10&term=&postal_code=v6a+1r3&radius=50&category=<?php echo $category['c_id'];?>&min_price=&max_price=&find=Search" > 
		<?php if(!empty($category['c_image']) && file_exists('assets/uploads/category_images/'.$category['c_image'])){ ?>
			<img src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/category_images/<?php echo $category['c_image'];?>" alt="categories">
				<?php } else { ?>
	<img height="100px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="categories"/>
				<?php } ?>
		</a> 
		</div>
        <div class="cat-text">
          <h4><a href="<?php echo base_url();?>search/results?page=1&order=add_price-asc&per_page=10&term=&postal_code=v6a+1r3&radius=50&category=<?php echo $category['c_id'];?>&min_price=&max_price=&find=Search" > <?php echo $category['c_title'];?>(<?php echo $count;?>)</a></h4>
        </div>
      </div>
	
    <?php } ?>
	
    </div>
   
  </div>
</div>


<!-- Placed at the end of the document so the pages load faster --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/bootstrap.min.js"></script> 

<!-- compare --> 
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/compare/jquery-1.9.0.min.js"></script> 
<!-- jQueryTab.js --> 
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/compare/jQueryTab.js"></script> 
<script type="text/javascript">
// initializing jQueryTab plugin 
$('.tabs-1').jQueryTab({
    initialTab:2,				// tab to open initially; start count at 1 not 0
    tabInTransition: 'fadeIn',
    tabOutTransition: 'scaleUpOut',
    cookieName: 'active-tab-1',
    tabPosition : 'bottom'
});
$('.tabs-2').jQueryTab({
    initialTab: 3,
    openOnhover: true,
    tabInTransition: 'flipIn',
    tabOutTransition: 'flipOut',
    cookieName: 'active-tab-2'
    
});
$('.tabs-3').jQueryTab({
    responsive:false,
    useCookie: false,
    initialTab: 1,
    tabInTransition: 'rotateIn',
    tabOutTransition: 'rotateOut',
    before: function(){ console.log('Hello from before!'); },			// function to call before tab is opened
    after: function(){ console.log('Hello from after!') }				// function to call after tab is opened
    
});
$('.tabs-4').jQueryTab({
    openOnhover: true,
    collapsible:false,
    initialTab: 4,
    tabInTransition: 'slideUpIn',
    tabOutTransition: 'slideUpOut',
    cookieName: 'active-tab-4'
    
});
$('.tabs-5').jQueryTab({
    initialTab: 3,
    tabInTransition: 'slideRightIn',
	tabOutTransition: 'slideRightOut',
    cookieName: 'active-tab-5'
    
});
$('.tabs-6').jQueryTab({
    initialTab: 4,
    tabInTransition: 'scaleDownIn',
    tabOutTransition: 'scaleDownOut',
    cookieName: 'active-tab-6'
    
});
$('.tabs-7').jQueryTab({
    initialTab: 2,
    tabInTransition: 'fadeIn',
    tabOutTransition: 'fadeOut',
    cookieName: 'active-tab-7'
    
});


</script> 
<script>
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
function delete_saved(id){
	$.ajax({
		url : '<?php echo base_url();?>add/delete_saved',
		data :{'add_id':id},
		type : 'post',
		success : function(){
			$('#compare_'+id).html('Added');
		}
	     });

}
function delete_compared(id){
	$.ajax({
		url : '<?php echo base_url();?>add/delete_compared',
		data :{'add_id':id},
		type : 'post',
		success : function(){
			$('#compare_'+id).html('Added');
		}
	     });

}
</script>

