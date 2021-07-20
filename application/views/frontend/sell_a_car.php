<style>

input[type='range'] {
  width: 280px;
  height: 30px;
  overflow: hidden;
  cursor: pointer;
    outline: none;
	
}
input[type='range'],
input[type='range']::-webkit-slider-runnable-track,
input[type='range']::-webkit-slider-thumb {
  -webkit-appearance: none;
    background: none;
}
input[type='range']::-webkit-slider-runnable-track {
  width: 200px;
  height: 3px;
  background:#003D7C;
   border-radius: 150px;
  
 
}

input[type='range']:nth-child(2)::-webkit-slider-runnable-track{
  background: none;
}

input[type='range']::-webkit-slider-thumb {
  position: relative;
  height: 16px;
  width: 15px;
  margin-top: -7px;
  background: #fff;
  border: 1px solid #003D7C;
 
  z-index: 1;
}


input[type='range']:nth-child(1)::-webkit-slider-thumb{
  z-index: 2;
}

.wrapper1 {
  
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
.rangeslider{
    position: relative;
    height: 60px;
    width: 210px;
    display: inline-block;
    margin-top: -5px;
    margin-left: 20px;
	 
	
}
.rangeslider input{
    position: absolute;
}
.rangeslider{
    position: absolute;
}

.rangeslider span{
    position: absolute;
    margin-top: 30px;
    left: 0;
}

.rangeslider .right{
   position: absolute;
   float: right;
   margin-left: 260px;
  
   
}	
.rangeslider input[type='submit']{
	margin-top:40px;
	margin-left:100px;
}


	</style>
	

<div id="page_caption" class="hasbg parallax  withtopbar  " style="background-image:url(<?php echo base_url('template/')?>upload/driver-2.jpg);">

            <div class="page_title_wrapper">
                <div class="page_title_inner">
                    <div class="page_title_content">
                        <h1 class="withtopbar">Sell a car</h1>
                        <!--div class="page_tagline">
                            This is sample of page tagline and you can set it up using page option </div-->
                    </div>
                </div>
            </div>

        </div>

        <!-- Begin content -->
        <div id="page_content_wrapper" class="hasbg withtopbar ">
		<form class="form-horizontal" action="<?php echo base_url();?>sell-a-car" method="GET">
	        <div class="wrapper1">
         
                       <div class="rangeslider">
					            
                                <input class="min" name="lower" type="range" min="1" max="500"  value="<?php echo $lower=isset($_GET['lower']) ? $_GET['lower'] : '1';?>" id="lower"   />
                                <input class="max" name="upper" type="range" min="1" max="500" value="<?php echo $upper=isset($_GET['upper']) ? $_GET['upper'] : '100';	 ?>" id="upper" />
                                <span class="range_min light left">10</span>
                                <span class="range_max light right">100</span>
								
							 <input type="submit"  style="background-color:#5babe1 !important;color:#ffffff !important;border:1px solid #5babe1 !important;"class="Button"  value="FILTER" />	
                           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			 
			</form>
						   </div>	
		</div>

	  <?php   
		$lower=isset($_GET['lower']) ? $_GET['lower'] : '';
		$upper=isset($_GET['upper']) ? $_GET['upper'] : '';	
			if(!empty($lower)){ 
				$this->db->where('price >=',$lower);
			}
			if(!empty($upper)){ 
			   $this->db->where('price <=',$upper);
			}
			
		  if($lower || $upper){
			$rent_a_car = $this->db->get('sell_a_car')->result_array();
		  }
  
  
  ?>
	  

            <!-- Begin content -->

            <div class="inner" style="margin-top:75px;">

                <div class="inner_wrapper nopadding">

                    <div id="page_main_content" class="sidebar_content full_width fixed_column">

                        <div class="standard_wrapper">

                            <div id="portfolio_filter_wrapper" class="gallery classic three_cols portfolio-content section content clearfix" data-columns="3">
                              <?php if(!empty($rent_a_car)){
							         foreach($rent_a_car as $rent_a_cars){ 
							   ?>
                                <div class="element grid classic3_cols animated2">

                                    <div class="one_third gallery3 classic static filterable portfolio_type themeborder" data-id="post-2">
                                        <a class="car_image" href="#">
                                            <img src="<?php echo base_url().$rent_a_cars['image']?>" alt="BMW 3 Series" />
                                        </a>

                                        <div class="portfolio_info_wrapper">
                                            <div class="car_attribute_wrapper">
                                                <a class="car_link" href="<?php  echo base_url('sell-a-car/').$rent_a_cars['link'];?>"><h4><?php echo  $rent_a_cars['title']?></h4></a>
                                                <!--div class="car_attribute_rating" hidden>
                                                    <div class="br-theme-fontawesome-stars-o">
                                                        <div class="br-widget">
                                                            <a href="javascript:;" class="br-selected"></a>
                                                            <a href="javascript:;" class="br-selected"></a>
                                                            <a href="javascript:;" class="br-selected"></a>
                                                            <a href="javascript:;" class="br-selected"></a>
                                                            <a href="javascript:;"></a>
                                                        </div>
                                                    </div>
                                                    <div class="car_attribute_rating_count">
                                                        4&nbsp; reviews </div>
                                                </div-->

                                                <!--div class="car_attribute_wrapper_icon" hidden>
                                                    <div class="one_fourth">
                                                        <div class="car_attribute_icon ti-user"></div>
                                                        <div class="car_attribute_content">
                                                            4 </div>
                                                    </div>

                                                    <div class="one_fourth">
                                                        <div class="car_attribute_icon ti-briefcase"></div>
                                                        <div class="car_attribute_content">
                                                            2 </div>
                                                    </div>

                                                    <div class="one_fourth">
                                                        <div class="car_attribute_icon ti-panel"></div>
                                                        <div class="car_attribute_content">
                                                            Auto </div>
                                                    </div>

                                                </div-->
                                                <br class="clear" />
                                            </div>
                                            <div class="car_attribute_price">
                                                <div class="car_attribute_price_day three_cols">
                                                    <span class="single_car_currency">£</span><span class="single_car_price"><?php echo $rent_a_cars['price'];?></span>
                                                </div>
                                            </div>
                                            <br class="clear" />
                                        </div>
                                    </div>
                                </div>
							  <?php } } else { ?>
							 
							  <h2 class="text-danger" style="background-color:#cb5f54 !important;text-align:center; color:#ffffff !important;border:1px solid #cb5f54 !important;margin-right:10px; margin-top: 40px; margin-bottom:100px; max-width:250px;">Nothing found.</h2>
							 
							  <?php }?>
                            </div>
                            <br class="clear" />
                            <!--div class="pagination"><span class="current">1</span><a href='#' class="inactive">2</a></div>
                            <div class="pagination_detail">
                                Page 1 of 2 </div-->

                        </div>
                    </div>

                </div>
            </div>
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script>
 (function() {
	 
        function addSeparator(nStr) {
            nStr += '';
            var x = nStr.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }

        function rangeInputChangeEventHandler(e){
            var rangeGroup = $(this).attr('name'),
                minBtn = $(this).parent().children('.min'),
                maxBtn = $(this).parent().children('.max'),
                range_min = $(this).parent().children('.range_min'),
                range_max = $(this).parent().children('.range_max'),
                minVal = parseInt($(minBtn).val()),
                maxVal = parseInt($(maxBtn).val()),
                origin = $(this).context.className;

            if(origin === 'min' && minVal > maxVal-5){
                $(minBtn).val(maxVal-5);
            }
            var minVal = parseInt($(minBtn).val());
            $(range_min).html(addSeparator(minVal*1) );


            if(origin === 'max' && maxVal-5 < minVal){
                $(maxBtn).val(5+ minVal);
            }
            var maxVal = parseInt($(maxBtn).val());
            $(range_max).html(addSeparator(maxVal*1));
        }

     $('input[type="range"]').on( 'input', rangeInputChangeEventHandler);
})();
</script>