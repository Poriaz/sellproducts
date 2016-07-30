<style>
            .spinner{
            position: absolute;
            height: 100px;
            width: 100px;
            top: 50%;
            left: 50%;
            margin-left: -50px;
            margin-top: -50px;
            }
        </style>
<script>
function add_to_cart(id){
$.ajax({
	 url : '<?php echo base_url();?>cart/add',
	 type : 'post',
	 data : {'id':id},
	 success : function(count){
			$("#cart_itmes_count").html(count);
	}
	
});

}



</script>
<footer>
  <div class="container">
    <div class="col-md-3 col-sm-3"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/logo.png" alt="footer-logo"/></div>
    <div class="col-md-6 col-sm-6">
      <div class="copyright">&copy;  2015 All Right Reserved. Developed By Deeps</div>
    </div>
    <div class="col-md-3 col-sm-3">
      <div class="social-icon"> <a href="//www.facebook.com"><i class="fa fa-facebook"></i></a><a href="//plus.google.com"><i class="fa fa-google-plus"></i></a><a href="//www.pinterest.com"><i class="fa fa-pinterest"></i></a><a href="//www.twitter.com"><i class="fa fa-twitter"></i></a></div>
    </div>
  </div>
</footer>


</body>

        <div class="spinner" id="spinner_image" style="display:none;"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/spinner.gif"/></div>
</html>
