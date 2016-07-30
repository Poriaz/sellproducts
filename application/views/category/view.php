<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl.theme.css" rel="stylesheet">
    <link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/owl/custom.css" rel="stylesheet">
    <link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/animations.css" rel="stylesheet">


<!-- Carousel
    ================================================== -->

  <div class="col-md-12" style="text-align:center;"><h3>Advertisements under <?php echo $category[0]['c_title'];?></h3></div>
 <?php if(count($total_advertisements) > 0 ){?>
  <div class="products viewss">
    <div id="container" class="container">
    
    <!-------side-bar ----------------------->
    <div class="sort-search">
     <h3>Modify Results </h3>
    <div class="sd-bar">
    <div class="sd-catgry">
    	<h3>Category</h3>
    	<select onchange="window.location = $(this).val();" class="sortby">
		<option>Select Category</option>
		<?php  $cat = $this->db->get('categories')->result_array(); 
		foreach($cat as $ca){
		?>
		<option value="<?php echo base_url();?>category/view/<?php echo $ca['c_id'];?>/asc"><?php echo $ca['c_title'];?></option>
		<?php } ?>
		</select>   
        </div>
        
        <div class="sortBy">
        <h3>Short By</h3>
         <select onchange="window.location = $(this).val();" class="sortby">
		<option>Select one</option>
		  <option value="<?php echo base_url();?>category/view/<?php echo $this->uri->segment(3);?>/asc">Price-Lowest</option>
           <option value="<?php echo base_url();?>category/view/<?php echo $this->uri->segment(3);?>/desc">Price-Highest</option>
		   </select>  
		
		
        </div>
		<div class="prc-filter">
        	<h3>Price Filter</h3>
        	<input type="range" id="sliderBar" min="0" max="100" step="1" value="0" onChange="showValue(this.value);"/>
			<div class="filterd-val">
            	<span>Upto $</span><div id="result"></div><span>00</span>
            </div>
        </div>
    </div></div>
    <!------------------------------>
    <div class="search-wrap">
    <div class="prdct-area1">
    <div class="buttons">    
        <button class="grid" data-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></button>
        <button class="list" data-toggle="tooltip" title="List View"><i class="fa fa-list"></i></button>
    </div>
    <ul class="row list" style="margin:0">
	<?php 
	$flag = 0;
	foreach($total_advertisements as $add){ 
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
    

    <div class="col-sm12">
       
		 <div class="lorem">
         	<div class="row11">
		    <div class="col-md-10 col-sm-7 col-xs-12">
		    <h4><a href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>"><?php echo $add['add_title'];?></a> </h4>
            <span class="snc-div">
                                    <?php /*?><a class="save_compare_links tooltips" href="" onclick="save_add(<?php echo $add['add_id'];?>);return false;" id="save_<?php echo $add['add_id'];?>"><i class="fa fa-floppy-o"></i><span>Save</span></a>
                                <a class="save_compare_links tooltips" href="" onclick="compare_add(<?php echo $add['add_id'];?>);return false;" id="compare_<?php echo $add['add_id'];?>"><i class="fa fa-balance-scale"><span>Compare</span></i>
                    </a><?php */?>
                    <a class="save_compare_links" href="" onclick="save_add(<?php echo $add['add_id'];?>);return false;" id="save_<?php echo $add['add_id'];?>">Save</a>
                                <a class="save_compare_links" href="" onclick="compare_add(<?php echo $add['add_id'];?>);return false;" id="compare_<?php echo $add['add_id'];?>">Compare</a>
               </span>
		    </div>
		    <div class="col-md-2 col-sm-5 col-xs-12">
		    <h4>
            
			<a class="save_compare_links" href="https://www.facebook.com/sharer.php?u=<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>&t=<?php echo $add['add_title'];?>"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/facebook.png" height="20px" width="20px"/></a>
			<a class="save_compare_links" href="http://twitter.com/intent/tweet?source=<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>&text=<?php echo $add['add_title'];?>"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/twitter.png" height="20px" width="20px"/></a>
			<a class="save_compare_links" href="https://plus.google.com/share?url=<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>"><img src="<?php echo str_replace('/index.php','',base_url());?>assets/images/google.png" height="20px" width="20px"/></a>		
		    </h4>
		    </div>
		    </div>
            <div class="row11">
                <div class="col-sm-2 item-img">
				<a href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>">
				<?php if(!empty($images[0]['image']) && file_exists('assets/uploads/add_portfolio/'.$images[0]['add_id'].'/'.$images[0]['image'])){ ?>
                   <img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/add_portfolio/<?php echo $images[0]['add_id']."/".$images[0]['image'];?>" alt="products"/>
                <?php } else { ?>
					<img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/images/product_dummy.jpeg" alt="categories"/>
				<?php } ?>  
				</a>
                <!----------------------------------------------------------------------------->
                	 
                <!----------------------------------------------------------------------------->
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
        	<div class="lorem-text">
            	<h4 class="add_price">Price : <?php echo "$".$add['add_price'];?></h4>
				<p><a href="<?php echo base_url();?>category/view/<?php echo $category[0]['c_id'];?>"><?php echo $category[0]['c_title'];?></a><a href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>" > <i class="fa fa-angle-double-right"></i> <?php echo $add['add_title'];?></a></p>
                <p><?php echo $add['add_description'];?> </p>
                </div>
            </div>
           
                <div class="col-md-2 col-sm-2 col-xs-12 lg">
                <div class="lorem-side">
                    
                    <p>
                    <?php if(!empty($dealer[0]['image']) && file_exists('assets/uploads/user_images/'.$dealer[0]['image'])){ ?>
                    <img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/<?php echo $dealer[0]['image'];?>" />
                    <?php } else { ?>
                    <img height="200px" width="200px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/user.jpeg" alt="categories"/>
                    <?php } ?>
                    </p>
                <h3><?php $miles =  round($angle * $earthRadius); 
			if($miles < 50){
				echo $miles." miles away";
			} else {
				echo $add['add_specific_location'];
			}
			?></h3>
                    <h2><?php echo $category[0]['c_title'];?></h2>
                    </div>
                </div>
                 </div>
             </div>
            </div>  

  
  <?php $flag = 1; ?>
    
    <?php } ?>  
  <p class="pagination_links"><?php echo $links; ?></p>
<?php } else { ?>
</ul>
	</div>
	<div class="col-md-12" style="text-align:center;"><h4>No products were found under category <b><?php echo $category[0]['c_title'];?></b></h4></div>
	<?php } ?>
</div>
</div>
</div></div>
<script src="<?php echo str_replace('/index.php','',base_url());?>assets/js/owl.carousel.min.js"></script>

    <!-- Frontpage Demo -->
    <script type="text/javascript">
function showValue(num){
	var result = document.getElementById('result');	
	result.innerHTML = num;
}
</script>
<script>

    $(document).ready(function($) {
      $("#owl-example").owlCarousel({items : 1,autoPlay : true,
    stopOnHover : true});
	$("#owl-example1").owlCarousel({items : 4,autoPlay : true,
    stopOnHover : true});
	$("#owl-example3").owlCarousel({items : 3,autoPlay : true,
    stopOnHover : true});
    });
	
	$('button').on('click',function(e) {
    if ($(this).hasClass('grid')) {
        $('.prdct-area ul').removeClass('list').addClass('grid');
    }
    else if($(this).hasClass('list')) {
        $('.prdct-area ul').removeClass('grid').addClass('list');
    }
});
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});


</script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>

/*
Tendina jQuery plugin v0.11.1

Copyright (c) 2015 Ivan Prignano
Released under the MIT License
 */

(function() {
  var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __slice = [].slice;

  (function($, window) {
    var Tendina;
    Tendina = (function() {
      Tendina.prototype.defaults = {
        animate: true,
        speed: 500,
        onHover: false,
        hoverDelay: 200,
        activeMenu: null
      };

      function Tendina(el, options) {
        this._eventHandler = __bind(this._eventHandler, this);
        this.options = $.extend({}, this.defaults, options);
        this.$el = $(el);
        this.elSelector = this._getSelector(this.$el);
        this.$el.addClass('tendina');
        this.linkSelector = "" + this.elSelector + " a";
        this.$listElements = $(this.linkSelector).parent('li');
        this._hideSubmenus();
        this.mouseEvent = this.options.onHover === true ? 'mouseenter.tendina' : 'click.tendina';
        this._bindEvents();
        if (this.options.activeMenu !== null) {
          this._openActiveMenu(this.options.activeMenu);
        }
      }

      Tendina.prototype._bindEvents = function() {
        return $(document).on(this.mouseEvent, this.linkSelector, this._eventHandler);
      };

      Tendina.prototype._unbindEvents = function() {
        return $(document).off(this.mouseEvent);
      };

      Tendina.prototype._getSelector = function(el) {
        var elId, firstClass, _ref;
        firstClass = (_ref = $(el).attr('class')) != null ? _ref.split(' ')[0] : void 0;
        elId = $(el).attr('id');
        if (elId !== void 0) {
          return "#" + elId;
        } else {
          return "." + firstClass;
        }
      };

      Tendina.prototype._isFirstLevel = function(targetEl) {
        if ($(targetEl).parent().parent().hasClass('tendina')) {
          return true;
        }
      };

      Tendina.prototype._eventHandler = function(event) {
        var targetEl;
        targetEl = event.currentTarget;
        if (this._hasChildren(targetEl) && this._IsChildrenHidden(targetEl)) {
          event.preventDefault();
          if (this.options.onHover) {
            return setTimeout((function(_this) {
              return function() {
                if ($(targetEl).is(':hover')) {
                  return _this._openSubmenu(targetEl);
                }
              };
            })(this), this.options.hoverDelay);
          } else {
            return this._openSubmenu(targetEl);
          }
        } else if (this._isCurrentlyOpen(targetEl) && this._hasChildren(targetEl)) {
          event.preventDefault();
          if (!this.options.onHover) {
            return this._closeSubmenu(targetEl);
          }
        }
      };

      Tendina.prototype._openSubmenu = function(el) {
        var $openMenus, $targetMenu;
        $targetMenu = $(el).next('ul');
        $openMenus = this.$el.find('> .selected ul').not($targetMenu).not($targetMenu.parents('ul'));
        $(el).parent('li').addClass('selected');
        this._close($openMenus);
        this.$el.find('.selected').not($targetMenu.parents('li')).removeClass('selected');
        this._open($targetMenu);
        if (this.options.openCallback) {
          return this.options.openCallback($(el).parent());
        }
      };

      Tendina.prototype._closeSubmenu = function(el) {
        var $nestedMenus, $targetMenu;
        $targetMenu = $(el).next('ul');
        $nestedMenus = $targetMenu.find('li.selected');
        $(el).parent().removeClass('selected');
        this._close($targetMenu);
        $nestedMenus.removeClass('selected');
        this._close($nestedMenus.find('ul'));
        if (this.options.closeCallback) {
          return this.options.closeCallback($(el).parent());
        }
      };

      Tendina.prototype._open = function($el) {
        if (this.options.animate) {
          return $el.stop(true, true).slideDown(this.options.speed);

        } else {
          return $el.show();
        }
      };

      Tendina.prototype._close = function($el) {
        if (this.options.animate) {
          return $el.stop(true, true).slideUp(this.options.speed);
        } else {
          return $el.hide();
        }
      };

      Tendina.prototype._hasChildren = function(el) {
        return $(el).next('ul').length > 0;
      };

      Tendina.prototype._IsChildrenHidden = function(el) {
        return $(el).next('ul').is(':hidden');
      };

      Tendina.prototype._isCurrentlyOpen = function(el) {
        return $(el).parent().hasClass('selected');
      };

      Tendina.prototype._hideSubmenus = function() {
        return this.$el.find('ul').hide();
      };

      Tendina.prototype._showSubmenus = function() {
        this.$el.find('ul').show();
        return this.$el.find('li').addClass('selected');
      };

      Tendina.prototype._openActiveMenu = function(element) {
        var $activeMenu, $activeParents;
        $activeMenu = element instanceof jQuery ? element : this.$el.find(element);
        $activeParents = $activeMenu.closest('ul').parents('li').find('> a');
        if (this._hasChildren($activeParents) && this._IsChildrenHidden($activeParents)) {
          $activeParents.next('ul').show();
        } else {
          $activeMenu.next('ul').show();
        }
        $activeMenu.parent().addClass('selected');
        return $activeParents.parent().addClass('selected');
      };

      Tendina.prototype.destroy = function() {
        this.$el.removeData('tendina');
        this._unbindEvents();
        this._showSubmenus();
        this.$el.removeClass('tendina');
        return this.$el.find('.selected').removeClass('selected');
      };

      Tendina.prototype.hideAll = function() {
        return this._hideSubmenus();
      };

      Tendina.prototype.showAll = function() {
        return this._showSubmenus();
      };

      return Tendina;

    })();
    return $.fn.extend({
      tendina: function() {
        var args, option;
        option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
        return this.each(function() {
          var $this, data;
          $this = $(this);
          data = $this.data('tendina');
          if (!data) {
            $this.data('tendina', (data = new Tendina(this, option)));
          }
          if (typeof option === 'string') {
            return data[option].apply(data, args);
          }
        });
      }
    });
  })(window.jQuery, window);

}).call(this);





$('.dropdown').tendina({
	// enable slide down/up animations
	animate: true,
	// animation speed
	speed: 500,
	// open menus on mouse hover
	onHover: false,
	// the delay after which Tendina will open menus on hover.
	hoverDelay: 200,
	// The active menu that will be open when a new Tendina menu is created.
	// activeMenu: '.my-active-category'
	// or activeMenu: $('.my-active-category')
	activeMenu: null,
	// Callback that will be executed once any menu/submenu has been opened.
	openCallback: function($clickedEl) {
	  console.log($clickedEl);
	},
	// Callback that will be executed once any menu/submenu has been closed.
	closeCallback: function($clickedEl) {
	  console.log($clickedEl);
	}
	})

// destroy the plugin
	$('#menu').tendina('destroy')
	// hide all open submenus
	$('#menu').tendina('hideAll')
	// show all submenus
	$('#menu').tendina('showAll')





</script>
