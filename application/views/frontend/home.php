


        <div class="ppb_wrapper  ">
	
		
            <div class="one withsmallpadding ppb_car_search_background parallax withbg " style="padding-top: 150px !important;text-align:center;height:800px;background-image:url(<?php echo base_url('template');?>/upload/IMG_3496bfree.jpg);background-position: center center;color:#ffffff;">
                <div class="overlay_background" style="background:#000000;background:rgb(0,0,0,0.2);background:rgba(0,0,0,0.2);"></div>
                <div class="center_wrapper">
                    <div class="inner_content">
					
					
                        <div class="standard_wrapper">
                            <h2 class="ppb_title" style="color:#ffffff;">Find Best Car</h2>
                            <!--div class="page_tagline" style="color:#ffffff;">From as low as $10 per day with limited time offer discounts</div-->
                            <form class="car_search_form text-center" method="get" action="#">
							
                                <div class="car_search_wrapper">
								
                                  <div class="one_fourth themeborder"  style="background:#28a745;  border:none;"  >
                                        <a href="<?php echo base_url('rent-a-car');?>"   style="background:#28a745; border:none;"  id="car_search_btn" class="button"  >Rent a car</a>
								    </div>
									<div class="one_fourth themeborder" style="background:#ffc107; border:none;">
                                          <a href="<?php echo base_url('rent-to-buy');?>"   style="background-color: #ffc107; border:none;"  id="car_search_btn" class="button"  >Rent to Buy</a>
								    </div>
									<div class="one_fourth themeborder" style="background:#17a2b8; border:none;">
                                        <a href="<?php echo base_url('sell-a-car');?>"   style="background:#17a2b8; border:none;"  id="car_search_btn" class="button"  >Sell a car</a>
								    </div>
									
								</div>
						 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="one withsmallpadding ppb_header " style="text-align:center;padding:60px 0 60px 0;">
                <div class="standard_wrapper">
                    <div class="page_content_wrapper">
                        <div class="inner">
                            <div style="margin:auto;width:100%">
                                <h2 class="ppb_title" style="">Our Top Brands</h2>
                                <div class="page_tagline" style="">We offer professional car rental &amp; limousine services in our range of high-end vehicles</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ppb_car_brand_grid one nopadding ">
			
				
			
                <div class="page_content_wrapper page_main_content sidebar_content full_width fixed_column">
                    <div class="standard_wrapper">
					<div class="marquee">
						<ul class="marquee-content">
						 <?php $brands=$this->db->order_by('category_id','desc')->get('category')->result_array();
							     if(!empty($brands))
								 {
								  foreach($brands as $brand){
							   ?>
						  <li>
							<a href="<?php echo base_url('brand/').$brand['category_id'];?>">
							  <img src="<?php echo base_url().$brand['image'];?>" style="height:130px;"/>
						  </a></li>
								 <?php } }?>
						  
						</ul>
                     </div>
				    </div>
                </div>
            </div>
            <div class="one withsmallpadding ppb_header " style="padding-top: 40px !important;text-align:center;padding:60px 0 60px 0;">
                <div class="standard_wrapper">
                    <div class="page_content_wrapper">
                        <div class="inner">
                            <div style="margin:auto;width:100%">
                                <h2 class="ppb_title" style="">Rent a car</h2>
                                <!--div class="page_tagline" style="">We offer professional car rental &amp; limousine services in our range of high-end vehicles</div-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ppb_car_type_grid one nopadding " style="margin-bottom:60px;">
                <div class="page_content_wrapper page_main_content sidebar_content full_width fixed_column">
                    <div class="standard_wrapper">
                        <div id="1572257266780950625" class="portfolio_filter_wrapper gallery grid portrait three_cols" data-columns="3">
                           <?php $rent_a_car=$this->db->order_by('id','desc')->get('rent_a_car',3)->result_array();
							      // $rent_to_buy=$this->db->order_by('id','desc')->get('rent_to_buy',1)->result_array();
									 // $sell_a_car=$this->db->order_by('id','desc')->get('sell_a_car',1)->result_array();
									 // $sub_datas=array_merge($rent_a_car,$rent_to_buy,$sell_a_car);
									  
									  
								if(!empty($rent_a_car))
								 {
								  foreach($rent_a_car as $sub_data){
							   ?>
						   <div class="element grid classic3_cols animated1">
                                
							   
							   <div class="one_third gallery3 grid static filterable portfolio_type themeborder" style="background-image:url(<?php echo base_url().$sub_data['image'];?>);">
                                   <?php if($sub_data['car_type']=='rent_a_car'){?>
								          <a class="car_image" href="<?php echo base_url('rent-a-car/').$sub_data['link'];?>"></a>
								   <?php } ?>
								   
								  
								   <?php if($sub_data['car_type']=='rent_to_buy'){?>
								          <a class="car_image" href="<?php echo base_url('rent-to-buy/').$sub_data['link'];?>"></a>
								   <?php } ?>
								   
                                    <div class="portfolio_info_wrapper">
                                        <h3><?=$sub_data['title']?></h3></div>
                                </div>
								
                            </div>
							   	<?php } }?> 
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
			 <div class="one withsmallpadding ppb_header " style="padding-top: 40px !important;text-align:center;padding:60px 0 60px 0;">
                <div class="standard_wrapper">
                    <div class="page_content_wrapper">
                        <div class="inner">
                            <div style="margin:auto;width:100%">
                                <h2 class="ppb_title" style="">Rent to Buy </h2>
                                <!--div class="page_tagline" style="">We offer professional car rental &amp; limousine services in our range of high-end vehicles</div-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ppb_car_type_grid one nopadding " style="margin-bottom:60px;">
                <div class="page_content_wrapper page_main_content sidebar_content full_width fixed_column">
                    <div class="standard_wrapper">
                        <div id="1572257266780950625" class="portfolio_filter_wrapper gallery grid portrait three_cols" data-columns="3">
                           <?php //$rent_a_car=$this->db->order_by('id','desc')->get('rent_a_car',3)->result_array();
							      $rent_to_buy=$this->db->order_by('id','desc')->get('rent_to_buy',3)->result_array();
									 // $sell_a_car=$this->db->order_by('id','desc')->get('sell_a_car',1)->result_array();
									 // $sub_datas=array_merge($rent_a_car,$rent_to_buy,$sell_a_car);
									  
									  
								if(!empty($rent_to_buy))
								 {
								  foreach($rent_to_buy as $sub_data){
							   ?>
						   <div class="element grid classic3_cols animated1">
                                
							   
							   <div class="one_third gallery3 grid static filterable portfolio_type themeborder" style="background-image:url(<?php echo base_url().$sub_data['image'];?>);">
                                   
								  
								   <?php if($sub_data['car_type']=='rent_to_buy'){?>
								          <a class="car_image" href="<?php echo base_url('rent-to-buy/').$sub_data['link'];?>"></a>
								   <?php } ?>
								   
                                    <div class="portfolio_info_wrapper">
                                        <h3><?=$sub_data['title']?></h3></div>
                                </div>
								
                            </div>
							   	<?php } }?> 
                        </div>
                    </div>
                </div>
            </div>
			
			
			
			
            <div class="one withsmallpadding ppb_header_youtube withbg parallax" data-jarallax-video="https://www.youtube.com/watch?v=D3tv6J7tk0k" style="text-align:center;padding:215px 0 215px 0;color:#ffffff;">
                <div class="overlay_background" style="background:#000000;background:rgb(0,0,0,0.5);background:rgba(0,0,0,0.5);"></div>
                <div class="standard_wrapper">
                    <div class="page_content_wrapper">
                        <div class="inner">
                            <div style="margin:auto;width:100%">
                                <h2 class="ppb_title" style="color:#ffffff;">Our Fleet, Your Fleet</h2>
                                <div class="page_tagline" style="color:#ffffff;">We know the difference is in the details and that’s why our car rental services, in the tourism
                                    <br /> and business industry, stand out for their quality and good taste, to offer you an unique experience</div>
                                <div class="ppb_header_content">
                                    <p><span style="font-size: 32px;">Call Now <?php echo $settings[2]['value']; ?></span></p>
                                    <p><a class="button" href="<?=base_url()?>/contact-us">Request a Quote</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="one withsmallpadding ppb_header " style="text-align:center;padding:60px 0 60px 0;background-color:#5856d6;color:#ffffff;">
                <div class="standard_wrapper">
                    <div class="page_content_wrapper">
                        <div class="inner">
                            <div style="margin:auto;width:100%">
                                <h2 class="ppb_title" style="color:#ffffff;">Why Choose Us</h2>
                                <div class="page_tagline" style="color:#ffffff;">Explore our first class limousine &amp; car rental services</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="one withsmallpadding ppb_text" style="padding-top:0 !important;text-align:center;padding:10px 0 10px 0;background-color:#5856d6;color:#ffffff !important;">
                <div class="standard_wrapper">
                    <div class="page_content_wrapper">
                        <div class="inner">
                            <div style="margin:auto;width:100%">

                                <div class="one_third " style=""><span class="ti-car" style="display: block; font-size: 50px; margin-bottom: 20px;"> </span>
                                    <h4 style="color: #fff;">Variety of Car Brands</h4>
                                    <p>Lorem ipsum dolor sit amet, consectadipiscing elit. Aenean commodo ligula eget dolor.</p>
                                </div>
                                <div class="one_third " style="">
                                    <span class="ti-face-smile" style="display: block; font-size: 50px; margin-bottom: 20px;"> </span>
                                    <h4 style="color: #fff;">Best Rate Guarantee</h4>
                                    <p>Lorem ipsum dolor sit amet, consectadipiscing elit. Aenean commodo ligula eget dolor.</p>
                                </div>
                                <div class="one_third last " style=""><span class="ti-heart" style="display: block; font-size: 50px; margin-bottom: 20px;"> </span>
                                    <h4 style="color: #fff;">Awesome Customer Support</h4>
                                    <p>Lorem ipsum dolor sit amet, consectadipiscing elit. Aenean commodo ligula eget dolor.</p>
                                </div>
                                <p>
                                    <br class="clear" />
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--div class="one withsmallpadding ppb_header " style="text-align:center;padding:60px 0 60px 0;">
                <div class="standard_wrapper">
                    <div class="page_content_wrapper">
                        <div class="inner">
                            <div style="margin:auto;width:100%">
                                <h2 class="ppb_title" style="">Articles &amp; Tips</h2>
                                <div class="page_tagline" style="">Explore some of the best tips from around the world</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="standard_wrapper">
                <div class="ppb_blog_grid one nopadding" style="padding:0px 0 0px 0;margin-bottom:40px;">
                    <div class="page_content_wrapper">
                        <div class="inner">
                            <div class="inner_wrapper">
                                <div class="blog_grid_wrapper sidebar_content full_width ppb_blog_posts">
                                    <div id="post-18" class="post type-post hentry status-publish ">
                                        <div class="post_wrapper grid_layout">
                                            <div class="post_img small static">
                                                <a href="#">
                                                    <img src="<?php echo base_url('template');?>/upload/nw6xremkxkg-nicolai-berntsen-960x636.jpg" alt="What To Do if Your Rental Car Has Met With An Accident" class="" />
                                                </a>
                                            </div>
                                            <div class="post_header_wrapper">
                                                <div class="post_header grid">
                                                    <div class="post_detail single_post">
                                                        <span class="post_info_date">
													    	<a href="#" title="What To Do if Your Rental Car Has Met With An Accident">January 12, 2017</a>
													    </span>
									                                                    </div>
                                                    <h6><a href="#" title="What To Do if Your Rental Car Has Met With An Accident">What To Do if Your Rental Car Has Met With An Accident</a></h6>
                                                </div>
                                                <p>Meh synth Schlitz, tempor duis single-origin coffee ea next level ethnic fingerstache...
                                                    <div class="post_button_wrapper">
                                                        <a class="readmore" href="#">Read More<span class="ti-angle-right"></span></a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="post-29" class="post type-post hentry status-publish ">
                                        <div class="post_wrapper grid_layout">
                                            <div class="post_img small static">
                                                <a href="#">
                                                    <img src="<?php echo base_url('template');?>/upload/IMG_3496bfree-960x636.jpg" alt="On The Trail of 6 Best Foods in North America" class="" />
                                                </a>
                                            </div>
                                            <div class="post_header_wrapper">
                                                <div class="post_header grid">
                                                    <div class="post_detail single_post">
                                                        <span class="post_info_date">
													    	<a href="#" title="On The Trail of 6 Best Foods in North America">January 10, 2017</a>
													    </span>
                                                    </div>
                                                    <h6><a href="#" title="On The Trail of 6 Best Foods in North America">On The Trail of 6 Best Foods in North America</a></h6>
                                                </div>
                                                <p>Meh synth Schlitz, tempor duis single-origin coffee ea next level ethnic fingerstache...
                                                    <div class="post_button_wrapper">
                                                        <a class="readmore" href="#">Read More<span class="ti-angle-right"></span></a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="post-36" class="post type-post hentry status-publish last">
                                        <div class="post_wrapper grid_layout">
                                            <div class="post_img small static">
                                                <a href="#">
                                                    <img src="<?php echo base_url('template');?>/upload/pexels-photo-2-960x636.jpg" alt="Car Rental Mistakes That Can Cost You Big" class="" />
                                                </a>
                                            </div>
                                            <div class="post_header_wrapper">
                                                <div class="post_header grid">
                                                    <div class="post_detail single_post">
                                                        <span class="post_info_date">
													    	<a href="#" title="Car Rental Mistakes That Can Cost You Big">January 9, 2017</a>
													    </span>
                                                    </div>
                                                    <h6><a href="#" title="Car Rental Mistakes That Can Cost You Big">Car Rental Mistakes That Can Cost You Big</a></h6>
                                                </div>
                                                <p>Meh synth Schlitz, tempor duis single-origin coffee ea next level ethnic fingerstache...
                                                    <div class="post_button_wrapper">
                                                        <a class="readmore" href="#">Read More<span class="ti-angle-right"></span></a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br class="clear" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div-->

<style>
 @import url('https://fonts.googleapis.com/css?family=Montserrat');



:root {
  --marquee-width: 100%;
  --marquee-height: 130px;
  /* --marquee-elements: 12; */ /* defined with JavaScript */
  --marquee-elements-displayed: 5;
  --marquee-element-width: calc(var(--marquee-width) / var(--marquee-elements-displayed));
  --marquee-animation-duration: calc(var(--marquee-elements) * 3s);
}

.marquee {
  width: var(--marquee-width);
  height: var(--marquee-height);
  background-color: #fff;
  color: #eee;
  overflow: hidden;
  position: relative;
}
.marquee:before, .marquee:after {
  position: absolute;
  top: 0;
  width: 10rem;
  height: 100%;
  content: "";
  z-index: 1;
}
.marquee:before {
  left: 0;
  background: linear-gradient(to right, #fff 0%, transparent 100%);
}
.marquee:after {
  right: 0;
  background: linear-gradient(to left, #fff 0%, transparent 100%);
}
.marquee-content {
  list-style: none;
  height: 100%;
  display: flex;
  animation: scrolling var(--marquee-animation-duration) linear infinite;
}
/* .marquee-content:hover {
  animation-play-state: paused;
} */
@keyframes scrolling {
  0% { transform: translateX(0); }
  100% { transform: translateX(calc(-1 * var(--marquee-element-width) * var(--marquee-elements))); }
}
.marquee-content li {
  display: flex;
  justify-content: center;
  align-items: center;
  /* text-align: center; */
  flex-shrink: 0;
  width: var(--marquee-element-width);
  max-height: 100%;
/*   font-size: calc(var(--marquee-height)*3/4); /* 5rem; */ */
  white-space: nowrap;
}

.marquee-content li img {
/*   width: 100%; */
  height: 100%;
/*   border: 2px solid #eee; */
}

@media (max-width: 600px) {
  html { font-size: 12px; }
  :root {
    --marquee-width: 100vw;
    --marquee-height: 16vh;
    --marquee-elements-displayed: 3;
  }
  .marquee:before, .marquee:after { width: 5rem; }
}
 </style>
<script>
const root = document.documentElement;
const marqueeElementsDisplayed = getComputedStyle(root).getPropertyValue("--marquee-elements-displayed");
const marqueeContent = document.querySelector("ul.marquee-content");

root.style.setProperty("--marquee-elements", marqueeContent.children.length);

for(let i=0; i<marqueeElementsDisplayed; i++) {
  marqueeContent.appendChild(marqueeContent.children[i].cloneNode(true));
}
</script>
	
