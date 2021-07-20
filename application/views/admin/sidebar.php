<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" hidden>
        <div class="pull-left image">
          <img src="assets/dist/img/<?php echo $profile_image;?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $firstname." ".$lastname;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
        </div>
      </div>
  
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><?php echo $text_navigation;?></li>
        <li class="active">
          <a href="<?php echo $dashboard;?>">
            <i class="fa fa-dashboard"></i> <span><?php echo $text_dashboard;?></span>
          </a>
        </li>
		
		  <li>
          <a href="<?php echo $category;?>">
            <i class="fa fa-list"></i>
            <span><?php echo 'Brands';?></span>
          </a>
        </li>
			
		<li class="treeview">
			 <a href="javascript:void(0);">
            <i class="fa fa-bar-chart"></i> <span><?php echo 'Rent a Car';?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		   <li>
			  <a href="<?php echo base_url();?>/admin/rent_a_car">
				<i class="fa fa fa-laptop"></i>
				<span>Rent a Car</span>
			  </a>
			</li>
			<li class="active">
			  <a href="<?php echo base_url();?>admin/rent_a_car_booking">
				<i class="fa   fa-history"></i>
				<?php echo 'Booking';?>
			  </a>
			</li> 
			</ul>
		</li>
		
		
		<li class="treeview">
			 <a href="javascript:void(0);">
            <i class="fa fa-bar-chart"></i> <span><?php echo 'Sell a Car';?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		   <li>
			  <a href="<?php echo base_url();?>/admin/sell_a_car">
				<i class="fa fa fa-laptop"></i>
				<span>Sell a car</span>
			  </a>
			</li>
			<li class="active">
			  <a href="<?php echo base_url();?>admin/sell_a_car_booking">
				<i class="fa   fa-history"></i>
				<?php echo 'Booking';?>
			  </a>
			</li> 
			</ul>
		</li>
		
		<li class="treeview">
			 <a href="javascript:void(0);">
            <i class="fa fa-bar-chart"></i> <span><?php echo 'Buy to Car';?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		   <li>
			  <a href="<?php echo base_url();?>/admin/rent_to_buy">
				<i class="fa fa fa-laptop"></i>
				<span>Rent to buy</span>
			  </a>
			</li>
			<li class="active">
			  <a href="<?php echo base_url();?>admin/rent_to_buy_booking">
				<i class="fa   fa-history"></i>
				<?php echo 'Booking';?>
			  </a>
			</li> 
			</ul>
		</li>
		
	
		<li>
          <a href="<?php echo base_url();?>/admin/contact_us">
            <i class="fa fa fa-laptop"></i>
            <span>Contact us</span>
          </a>
        </li>
		
		<li>
          <a href="<?php echo base_url();?>admin/settings">
            <i class="fa  fa-cogs"></i>
            <span><?php echo 'Setting';?></span>
          </a>
        </li> 
		
	  </ul>
    </section>
    <!-- /.sidebar -->
</aside>