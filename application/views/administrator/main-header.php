<!-- Logo -->
<a href="#" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b><?= config('title'); ?></b></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account: style can be found in dropdown.less -->
      <?php 
        if ($this->session->level=='admin'){
          $reseller = $this->model_app->view('rb_reseller')->num_rows();
          $orders = $this->model_app->view_where('rb_penjualan',array('status_pembeli'=>'konsumen'))->num_rows();
          echo "<li><a href='".base_url()."administrator/penjualan_konsumen'><i class='fa fa-shopping-cart'></i><span class='label label-danger'>$orders</span></a></li>
                <li><a href='".base_url()."administrator/reseller'><i class='fa fa fa-users'></i><span class='label label-success'>$reseller</span></a></li>";
        } 
      ?>
      <li>
        <a target='_BLANK' href="<?php echo base_url(); ?>"><i class="glyphicon glyphicon-new-window"></i></a>
      </li>

    </ul>
  </div>
</nav>