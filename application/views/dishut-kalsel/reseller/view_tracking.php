<div class="ps-order-tracking">
    <div class="container">
        <div class="ps-section__header">
            <h3><?php echo $title; ?></h3>
            <p>Untuk melacak pesanan Anda, masukkan No Pesanan Anda di kotak di bawah ini dan tekan tombol "Lacak Pesanan". Kode Ini diberikan kepada Anda pada saat tanda menerima detail pesanan dalam email konfirmasi.</p>
        </div>
        <div class="ps-section__content">
            <?php 
              $attributes = array('class'=>'ps-form--order-tracking');
              echo form_open_multipart('konfirmasi/tracking',$attributes); 
            ?>
                <div class="form-group">
                    <label>No Pesanan</label>
                    <input class="form-control" type="text" name='a' placeholder="Input No Pesanan, Contoh : TRX- - - - - - " required>
                </div>
                <div class="form-group">
                    <label>Alamat E-mail</label>
                    <input class="form-control" type="text" placeholder="Alamat Email Terkait Pesanan,..">
                </div>
                <div class="form-group">
                    <button type='submit' name='submit1' class="ps-btn ps-btn--fullwidth">Lacak Pesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>
