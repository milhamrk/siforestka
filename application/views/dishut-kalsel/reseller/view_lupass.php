<div class="ps-breadcrumb">
<div class="container">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li>Reset Password</li>
    </ul>
</div>
</div>
<div class="ps-my-account">
    <div class="container">
        <div class="ps-form--account ps-tab-root">
            <div class="ps-tabs">
                <div style='margin:0px 10px'>
                <?php 
                    echo $this->session->flashdata('message'); 
                    $this->session->unset_userdata('message');
                ?>
                </div>
                <div class="ps-tab active" id="sign-in">
                <form action="<?php echo base_url(); ?>auth/resetpassword?token=<?php echo cetak($this->input->get('token')); ?>" method="POST">
                    <div class="ps-form__content">
                        <h5>Silahkan input password baru.</h5>
                        <div class="form-group">
                            <input class="form-control" name='pass' type="password" placeholder="Password Baru,.." required>
                        </div>
                        <div class="form-group form-forgot">
                            <input class="form-control" name='repass' type="password" placeholder="Ulangi Password,.." required>
                        </div><br>
                        <div class="form-group submit">
                            <button type='submit' name='submit' class="ps-btn ps-btn--fullwidth">Proses Perubahan</button>
                        </div><br>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

