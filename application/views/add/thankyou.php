<div class="search-page space page1">
  <div class="container">
    <div class="row">
        <div class="col-md-8 thank you">
            <p> Thank you for posting with us ! We really appreciate it!</p>
            <ul>
                <li>
                    View your post at<a href="<?php echo base_url()."add/view/".$this->uri->segment(3); ?>"> <?php echo base_url()."add/view/".$this->uri->segment(3); ?></a>
                </li>
                 <li class="blue">
                     <a href="<?php echo base_url();?>members/dashboard">Manage your post</a>
                </li>
                 <li>
                     <a href="<?php echo base_url();?>members/dashboard">Return to your account page</a>
                </li>
            </ul>
        </div>
    </div>
  </div>
</div>
<style>.thank li a {
    color: #0093FF;
}
.thank li{    list-style: outside;
    margin-left: 4%;
}
footer{position:absolute; bottom:0; left:0; right:0}</style>