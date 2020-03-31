<img class="wave" src="<?= base_url();?>/assets/img/wave1.png">
<div class="container">
    <div class="img">
        <img src="<?= base_url();?>assets/img/dua.png">
    </div>
    <div class="login-content">
    <?= form_open('', ['class' => 'user']); ?>
        <img src="<?= base_url();?>assets/img/satu.png">
        <h2 class="title">Welcome</h2>
        <div class="input-div one">
            <div class="i">
                <i class="fas fa-user"></i>
            </div>
            <div class="div">
                <h5>Username</h5>
                <input type="text" name="username" value="<?= set_value('username'); ?>" class="input">
                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="input-div pass">
            <div class="i">
                <i class="fas fa-lock"></i>
            </div>
            <div class="div">
                <h5>Password</h5>
                <input type="password" name="password" class="input">
                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                

            </div>
        </div>
        <a href="<?= base_url('register') ?>">Buat Akun</a>
        <input type="submit" class="btn" style="background: orange" value="Login">
        <?= $this->session->flashdata('pesan'); ?>
        <?= form_close(); ?>

    </div>
</div>
</body>