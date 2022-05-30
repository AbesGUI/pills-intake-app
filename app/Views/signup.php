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
        <title>Sign-up</title>
    </head>
    <div class="wrapper bg-white">
        <div class="h2 text-center">Pills-Intake</div>
        <div class="h4 text-muted text-center pt-2">Register an account</div>
        <?php if (isset($validation)): ?>
            <div class="alert alert-warning">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form class="pt-3" action="<?php echo base_url(); ?>/signup/" method="post">
            <div class="form-group py-2">
                <div class="input-field"><span class="fas fa-user-circle p-2"></span> <input type="text" name="name"
                                                                                             placeholder="Full Name"
                                                                                             value="<?= set_value('name') ?>"
                                                                                             class="form-control"></div>
            </div>
            <div class="form-group py-1 pb-2">
                <div class="input-field"><span class="fas fa-hashtag p-2"></span> <input type="email" name="email"
                                                                                         placeholder="Email"
                                                                                         value="<?= set_value('email') ?>"
                                                                                         class="form-control">
                </div>
            </div>
            <div class="form-group py-1 pb-2">
                <div class="input-field"><span class="fas fa-lock p-2"></span> <input type="password" name="password"
                                                                                      placeholder="Password"
                                                                                      class="form-control">
                </div>
            </div>
            <div class="form-group py-1 pb-2">
                <div class="input-field"><span class="fas fa-lock p-2"></span> <input type="password"
                                                                                      name="password_confirm"
                                                                                      placeholder="Confirm Password"
                                                                                      class="form-control">
                </div>
            </div>
            <div class="d-flex align-items-start">
                <div class="ml-auto"><a href="<?= base_url('/send-code') ?>" id="forgot">Forgot Password?</a></div>
            </div>
            <button class="btn btn-block text-center my-3">Log in</button>
            <div class="text-center pt-3 text-muted">Already a member? <a href="<?php echo base_url(); ?>/signin">Sign
                    in</a>
        </form>
    </div>
</html>