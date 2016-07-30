<style>

.dashboard_pagi{
	text-align:left;
}
.change_color{
    cursor:pointer;
}
#example_length{
    display:none;
}
#example_filter{
    display:none;
}
#example_info{
    display:none;
}
#example_paginate{
    display:none;
}
</style>

<script src="//code.jquery.com/jquery-1.12.0.min.js" ></script>   
<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js" ></script>
<?php $page_name = $this->uri->segment('2');
$cat_selected = ($this->input->get('category')) ? $this->input->get('category') : 'all';
$post_type_selected = ($this->input->get('post_type')) ? $this->input->get('post_type') : 'all';
?>
<link href="<?php echo str_replace('/index.php','',base_url());?>assets/css/style-dashboard.css" rel="stylesheet">

<div class="dash2">
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
        <div class="posting">
            <p>
                Your postings: 
                <a style="<?php if($post_type_selected == "all"){echo "color:blue !important";} else {echo "color:#222222 !important;";}?>" onclick="setGetParameter('post_type','all');" class="change_color">All</a> 
                | <a onclick="setGetParameter('post_type','active');" style="<?php if($post_type_selected == "active"){echo "color:blue !important";} else {echo "color:#222222 !important;";}?>" class="change_color">Active</a>
                | <a onclick="setGetParameter('post_type','inactive');" style="<?php if($post_type_selected == "inactive"){echo "color:blue !important";} else {echo "color:#222222 !important;";}?>" class="change_color"> Inactive</a>
                <input type="hidden" id="posting_type_id" value="all"/>
            </p>
          <div class="col-md-3 posting-field">
            <p>in category
              <select id="catAbbc" name="filter_cat" onchange="setGetParameter('category',$(this).val());">
               

                <option value="0"> All</option>
				<?php foreach($categories as $category){ ?>
                <option value="<?php echo $category['c_id'];?>" <?php if($cat_selected == $category['c_id']){echo "selected=selected";}?>> <?php echo $category['c_title'];?> </option>
				<?php } ?>
              </select>
            </p>
          </div>
          
        </div>
      </div>
      <div class="col-md-12 pagination">
      	<div class="pging-top">
            <h5>Showing all postings</h5>
             <?php 
         $param = $this->pagination->cur_page * $this->pagination->per_page;
        if($param > $total_results || $param == 0){
            $param = $total_results;
			$pagee = "<strong>1</strong>";
        } else {
			$pagee = "";
		}
         ?>
          <div class="pagination_div1"><p>(<span> <b>Page: </b> <?php echo $pagee.$links; ?> </span>Postings <?php echo  $param." of ".$total_results." total results"; ?> )</p>
          </div>
		 </div>
      <div class="table-responsive">
          <table id="example"  class="table">
              <thead><tr class="table-headings"><th class="status">Status</th><th class="manage">Manage</th><th class="posting-title">Posting Title</th><th class="area">Area</th><th class="catagory">Category</th><th class="pdate">Posted Date</th><th class="exp">Expiry</th><th class="ide">id</th></tr>
             </thead>
             <tbody>
                  <?php 
                    $i = 1;
                    foreach($advertisements as $add){ 
                    $images = $this->db->get_where('add_images',array('add_id' => $add['add_id']))->result_array();
                    $category = $this->db->get_where('categories',array('c_id' => $add['add_category']))->result_array();
                    if(trim($add['status']) == 'active'){
                            $style = 'background:#dfd;color:black;';
                            $style_title = 'color:blue;background:none;';
                            $style_column = 'background-color:lightgreen;';
                    }
                    else if(trim($add['status']) == 'expired'){
                            $style = 'background:pink;color:black;';
                            $style_title = 'color:black;background:none;';
                            $style_column = 'background-color:lightgrey;color:black;';
                    } else {
                            $style = 'background:#eef;color:black;';
                            $style_title = 'color:black;background:none;';
                            $style_column = 'background-color:lightblue;color:black;';
                    }
                  ?>
                  <tr id="cat_<?php echo $category[0]['c_id'];?>">
                      <td style="<?php echo $style_column; ?>"><?php echo $add['status'];?></td>
                      <td style="<?php echo $style;?>">
                          <?php if($add['status'] == 'expired' || $add['status'] == 'deleted'){?>
                          <a class="no_background" href="<?php echo base_url();?>add/repost/<?php echo $add['add_id'];?>">Repost</a>
                          <?php } else { ?>
                          <a href="" class="no_background" onclick="delete_add(<?php echo $add['add_id'];?>);return false;">Delete</a> / 
                          <a class="no_background" href="<?php echo base_url();?>add/edit/<?php echo $add['add_id'];?>">edit</a>  
                          <?php if (strtotime($add['status_change_date']) <= strtotime('-24 hours') && $add['status'] == 'renewed' || $add['status'] != 'renewed') { ?>
                          / <a class="no_background" href="<?php echo base_url();?>add/renew/<?php echo $add['add_id'];?>">Renew</a>
                          <?php } } ?>
                      </td>
                      <td style="<?php echo $style;?>"><a style="<?php echo $style_title;?>" href="<?php echo base_url();?>add/view/<?php echo $add['add_id'];?>"><?php echo $add['add_title'];?> - $<?php echo $add['add_price'];?></a></td>
                      <td style="<?php echo $style;?>"><?php echo $add['add_city'];?></td>
                      <td style="<?php echo $style;?>"><?php echo $category[0]['c_title'];?> - <?php echo $add['add_dealer_type'];?></td>
                      <td style="<?php echo $style;?>">
                          <?php echo date("d, M Y H:i",strtotime($add['created']));?>
                          <?php if($add['status'] =='renewed'){ echo "Renewed - ". date("d, M Y H:i",strtotime($add['status_change_date'])); } ?>
                      </td>
                      <td style="<?php echo $style;?>">Active until sold</td>
                      <td style="<?php echo $style;?>"><?php echo $add['add_id'];?></td>
                  </tr>
                  <?php } ?>  
                  </tbody>           
          </table>
      
      </div>
	  <p class="pagination_links dashboard_pagi"><b>Page :</b><?php echo $pagee.$links; ?></p>
      </div>
 
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 3, "desc" ]],
        "iDisplayLength": 20
    } );
	$(".pagination_div1 > p > span > a").each(function() {
		$(this).attr("href", $(this).attr('href') + "?post_type=<?php echo $post_type_selected; ?>&category=<?php echo $cat_selected; ?>");
	});
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

function delete_add(id){
	$.ajax({
		url : '<?php echo base_url();?>add/delete_add',
		data :{'add_id':id},
		type : 'post',
		success : function(){
			window.location.reload();
		}
	     });

}
function get_related(){
        $(".catclass").hide(0);
        var cat = $('#catAbbc').val();
        var visible = $("#posting_type_id").val();
        $('#example tbody').html("");
        $.ajax({
		url : '<?php echo base_url();?>add/get_related_adds',
		data :{'cat_id':cat,'visibility':visible},
		type : 'post',
		success : function(data){
                        var jso = $.parseJSON(data);
                        for(i=0;i< jso.length;i++){
                            if(jso[i].status == 'active'){
                                    style = 'background:#dfd;color:black;';
                                    style_title = 'color:blue;background:none;';
                                    style_column = 'background-color:lightgreen;';
                            }
                            else if(jso[i].status == 'expired'){
                                    style = 'background:pink;color:black;';
                                    style_title = 'color:black;background:none;';
                                    style_column = 'background-color:lightgrey;color:black;';
                            } else {
                                    style = 'background:#eef;color:black;';
                                    style_title = 'color:black;background:none;';
                                    style_column = 'background-color:lightblue;color:black;';
                            }
                          if(jso[i].status == 'expired' || jso[i].status == 'deleted'){
                          links = '<a class="no_background" href="'+base_url+'index.php/add/renew/'+jso[i].add_id+'">Repost</a>';
                          } else {
                          links = '<a href="" class="no_background" onclick="delete_add('+jso[i].add_id+');return false;">Delete</a> / <a class="no_background" href="'+base_url+'index.php/add/edit/'+jso[i].add_id+'">edit</a> / <a class="no_background" href="'+base_url+'index.php/add/renew/'+jso[i].add_id+'">Renew</a>';
                           } 
                            data = '<tr id="cat_'+jso[i].add_id+'"><td style="'+style_column+'">'+jso[i].status+'</td><td style="'+style+'">'+links+'</td><td style="'+style+'"><a style="'+style+'" href="'+base_url+'index.php/add/view/'+jso[i].add_id+'">'+jso[i].add_title+' - $'+jso[i].add_price+'</a></td> <td style="'+style+'">'+jso[i].add_city+'</td><td style="'+style+'">'+jso[i].c_title+' - '+jso[i].add_dealer_type+'</td><td style="'+style+'">'+jso[i].created+'</td><td style="'+style+'">Active until sold</td><td style="'+style+'">'+jso[i].add_id+'</td></tr>';
                            $('#example tbody').append(data);
                            }
                        }
	     });
        
}

</script>