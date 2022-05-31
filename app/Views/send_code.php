<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css"
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/styles/create_edit_schedule.css">
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title>Send Code</title>
    </head>
    <form class="pt-3" action="<?= base_url('/send-code/'); ?>" method="post">
        <div class="container mt-5 mb-5 d-flex justify-content-center">
            <div class="card px-1 py-4">
                <div class="card-body">
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-warning">
                            <?= $validation ?>
                        </div>
                    <?php endif; ?>
                    <h4 class="information mt-1" style="margin-bottom: 0.5rem;">Please fill following fields</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="email">E-mail</label><span class="fas fa-user-circle p-1"></span><input
                                        name="email" class="form-control"
                                        type="email"
                                        placeholder="ex. john@mail.com"></div>
                        </div>
                    </div>
                    <div class=" d-flex flex-column text-center px-5 mt-3 mb-3">
                        <button class="btn btn-primary btn-block confirm-button">Send Code</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</html>