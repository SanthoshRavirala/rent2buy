<?php echo $header;?>
<?php echo $sidebar;?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $text_dashboard;?>
    </h1>    
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
       <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?php echo $rent_car=$this->db->get('rent_a_car')->num_rows();?></h3>

            <p><?php echo 'Total Rent a car';?></p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo base_url('admin/rent_a_car');?>" class="small-box-footer"><?php echo $text_more;?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $rent_car=$this->db->get('rent_to_buy')->num_rows();?></h3>

            <p><?php echo 'Total Rent to Buy';?></p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?php echo base_url('admin/rent_to_buy');?>" class="small-box-footer"><?php echo $text_more;?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $rent_car=$this->db->get('sell_a_car')->num_rows();?></h3>

            <p><?php echo 'Sell a car';?></p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="<?php echo base_url('admin/sell_a_car');?>" class="small-box-footer"><?php echo $text_more;?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo $rent_car=$this->db->get('contact_us')->num_rows();?></h3>

            <p><?php echo 'Total Contact us';?></p>
          </div>
          <div class="icon">
            <i class="ion ion-grid"></i>
          </div>
          <a href="<?php echo base_url('admin/contact_us');?>" class="small-box-footer"><?php echo $text_more;?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo $footer;?>