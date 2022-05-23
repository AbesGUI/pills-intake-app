<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url('/styles/signin.css'); ?>" rel="stylesheet" type="text/css">
        <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title>Sign-in</title>
    </head>
    <div class="wrapper bg-white">
        <div class="h2 text-center">Pills-Intake</div>
        <div class="h4 text-muted text-center pt-2">Enter your login details</div>
        <?php use App\Libraries\FacebookCall;

        if (session()->getFlashdata('msg')):?>
            <div class="alert alert-warning">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        <form class="pt-3" action="<?php echo base_url(); ?>/signin/" method="post">
            <div class="form-group py-2">
                <div class="input-field"><span class="far fa-user p-2"></span> <input type="email" name="email"
                                                                                      placeholder="Email Address"
                                                                                      value="<?= set_value('email') ?>"
                                                                                      required class=""></div>
            </div>
            <div class="form-group py-1 pb-2">
                <div class="input-field"><span class="fas fa-lock p-2"></span> <input type="password" name="password"
                                                                                      placeholder="Enter your Password"
                                                                                      required class="">
                    <button class="btn bg-white text-muted"><span class="far fa-eye-slash"></span></button>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <div class="ml-auto"><a href="#" id="forgot">Forgot Password?</a></div>
            </div>
            <button class="btn btn-block text-center my-3">Log in</button>
            <div class="text-center pt-3 text-muted">Not a member? <a href="<?php echo base_url(); ?>/signup">Sign
                    up</a> or
                <?php
                $fb_c = new FacebookCall();
                $fbLoginUrl = $fb_c->loginURL();
                echo ' <a href="' . $fbLoginUrl . '">Login with Facebook</a> </div>';
                ?>
        </form>
    </div>
</html>