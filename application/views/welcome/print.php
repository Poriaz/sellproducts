<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" />

 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />

<style>
.print-inner {
    width: 650px;    padding-top: 10px;
    margin: 0 auto;
}
.print-inner h2 {  padding-bottom: 10px;  border-bottom: 1px solid #333333;
    font-size: 19.5px;
}
span.item-title {
    float: left;
    width: 40%;
}
span.item-title-details {
    float: right;
    width: 60%;
}
.st p{    margin-bottom: 10px;
    float: left;
    width: 100%;}
	.col-md-12.print-logo {
       padding: 0px 15px; border-bottom: 0px solid #333333;
}.col-md-12.print-logo img {
    width: 165px!important;
}
.print-details img{ width:100%;}
.company-detail {
    float: left;
    margin-top: 10px;
}
.print-logo {    padding-bottom: 10px;
   
    float: left;
    width: 100%;    padding: 10px 0px
   
}
.print-details p {
    font-size: 14px;
}
.company-detail textarea {
    min-height: 127px;
}
</style>

<title>Foodequipments-Print</title>
</head>
<?php
$images  = $this->db->get_where('add_images',array('add_id'=> $advertisement[0]['add_id']))->result_array();
$add_owner  = $this->db->get_where('users',array('id'=> $advertisement[0]['add_added_by_member']))->result_array();
 if(!empty($images[0]['image']) && file_exists('assets/uploads/add_portfolio/'.$advertisement[0]['add_id']."/".$images[0]['image'])){ 
     $item_image =  str_replace('/index.php','',base_url())."assets/uploads/add_portfolio/". $advertisement[0]['add_id']."/".$images[0]['image'];
   } else { 
      $item_image =   str_replace('/index.php','',base_url())."assets/images/product_dummy.jpeg";
   }
$dealer = $this->db->get_where('users',array('id' => $advertisement[0]['add_added_by_member']))->result_array();
$url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($advertisement[0]['add_postal_code'])."&sensor=true";
$address_info = file_get_contents($url);
$json_decode = json_decode($address_info);

?>
<div class="print-details">
	<div class="print-inner">
    	<div class="col-md-12 print-logo">
        	<img src="<?php echo str_replace('index.php/','',base_url()).'assets/images/logo.png';?>" alt="" />
            
        </div>
        <div class="col-md-12"><h2><?php echo ucfirst($advertisement[0]['add_title']);?> - $<?php echo @$advertisement[0]['add_price'];?></h2></div>
    	<div class="col-md-4 col-sm-4 col-xs-12">
        	<div class="print-image">
            	
                <div class="print-logo">
                <img src="<?php echo $item_image;?>" alt="" />
                </div>
                <div class="company-detail">
                         <?php if(!empty($dealer[0]['image']) && file_exists('assets/uploads/user_images/'.$dealer[0]['image'])){ ?>
                            <img style="width: 80px;margin-left: 27%;" height="80px" width="80px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/<?php echo $dealer[0]['image'];?>" />
                           <?php } else { ?>
                             <img style="width: 80px;margin-left: 27%;" height="80px" width="80px" src="<?php echo str_replace('/index.php','',base_url());?>assets/uploads/user_images/user.jpeg" alt="Dealer"/>
                            <?php } ?>
                	<p style=" margin-top:5px;border-top: 1px solid #333333;">  Address - <?php echo $json_decode->results[0]->formatted_address;?><br>
                    </p>
                    <p>
                    	<h4>Notes</h4>
                        <textarea name="comment" form="usrform" placeholer="You can write notes here">You can write notes here</textarea>
                    </p>
                    <p>
                        <button onclick="window.print();" >Print</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12 st">
                    
                    <p class="item-title"><b>Condition : </b><?php echo ucfirst($advertisement[0]['add_used_type']);?>
                    <p class="item-title"><b>Model : </b><?php echo @$advertisement[0]['add_model'];?></p>
                    <p class="item-title"><b>Postal Code : </b><?php echo @$add_owner[0]['postal_code'];?></p>
                    <p class="item-title"><b>Email : </b><?php echo @$add_owner[0]['email'];?></p>
        	
            <p><?php echo @$advertisement[0]['add_description'];?></p>
        </div>
    </div>
</div>


</body>
</html>