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
      <?php include "menu-members.php"; ?>
        <?php 
          echo $this->session->flashdata('message'); 
          $this->session->unset_userdata('message');
        ?>

        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 ">
              <?php
                echo "<a href='".base_url()."members/tambah_opini' class='ps-btn btn-block'><i class='icon-pen'></i> Buat Opini Publik</a>";
              ?><div style='clear:both'><br></div>
          </div>

          <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 ">
        <div class='table-responsive'>
        <table id="example1" class="table table-striped table-sm iconset">
          <thead>
            <tr>
              <th style='width:20px'>No</th>
              <th colspan='3'>Judul</th>
              <th>Status</th>
              <th>Tanggal Submit</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
        <?php 
          $no = 1;
          foreach ($record->result_array() as $row){
          if ($row['transaksi']=='debit'){ $color =  'red'; }else{ $color = 'green'; }
          if ($row['status']=='Sukses'){ $color_status =  'green'; }else{ $color_status = '#cecece'; }
          $ex = explode(';',$row['keterangan']);
          echo "<tr><td>$no</td>";
                      echo "<td>$row[judul]</td>
                            <td></td>
                            <td></td>";
                    echo "<td><i>".($row['status'] == 'Y' ? 'Diterima' : 'Proses Review')."</i></td>
                    <td style='color:$color'>".jam_tgl_indo($row['tanggal'])."$row[jam]</td>
                    <td><a class='ps-btn detail-keuangan' data-id='$row[id_withdraw]' href='#'><i class='icon-magnifier'></i></a></td>
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

<div class="modal fade bd-example-modal-lg detail-modal" style='z-index:99999' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header" style='border-bottom:0px solid #e9ecef'>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
      <div class='content-body' style='padding:0px 20px'></div>
    </div>
</div>
</div>
</div>

<script>
    $(function(){
        $(document).on('click','.detail-keuangan',function(e){
            e.preventDefault();
            $(".detail-modal").modal('show');
            $.post("<?php echo site_url()?>members/detail_keuangan",
                {id:$(this).attr('data-id')},
                function(html){
                    $(".content-body").html(html);
                }   
            );
        });
    });
</script>