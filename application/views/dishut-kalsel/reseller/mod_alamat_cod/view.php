<div class="ps-page--single">
<div class="ps-breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="#">Members</a></li>
            <li><?php echo $title; ?></li>
        </ul>
    </div>
</div>
</div>
<div class="ps-vendor-dashboard pro" style='margin-top:10px'>
    <div class="container">
      <div class="ps-section__content">
        <?php 
          echo $this->session->flashdata('message'); 
          $this->session->unset_userdata('message');
        ?>
        <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "><br>
        <div class='table-responsive'>
        <a class='ps-btn margin-btn' href='<?php echo base_url(); ?>members/tambah_cod'>Tambahkan Data</a>
        <table id="example1" class="table table-striped table-sm iconset">
          <thead>
            <tr>
              <th style='width:30px'>No</th>
              <th>Nama Alamat</th>
              <th>Tarif</th>
              <th style='width:70px'>Action</th>
            </tr>
          </thead>
          <tbody>
        <?php 
          $no = 1;
          foreach ($record->result_array() as $row){
          echo "<tr><td>$no</td>
                    <td>$row[nama_alamat]</td>
                    <td>Rp ".rupiah($row['biaya_cod'])."</td>
                    <td><center>
                      <a class='btn btn-success btn-xs' title='Edit Data' href='".base_url().$this->uri->segment(1)."/edit_cod/$row[id_cod]'><span class='fa fa-edit'></span></a>
                      <a class='btn btn-danger btn-xs' title='Delete Data' href='".base_url().$this->uri->segment(1)."/delete_cod/$row[id_cod]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='fa fa-remove'></span></a>
                    </center></td>
                </tr>";
            $no++;
          }
        ?>
        </tbody>
        </table>
      </div>
      </div>
        </div>
    </div>
</div>