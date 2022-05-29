<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css"
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/styles/create_edit_schedule.css">
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title><?= $data_list['drug_name'] ?></title>
    </head>
        <div class="container mt-5 mb-5 d-flex justify-content-center">
            <div class="card px-1 py-4">
                <div class="card-body">
                    <?php if (isset($validation)): ?>
                        <div class="alert alert-warning">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>
                    <h4 class="information mt-1" style="margin-bottom: 0.5rem;">Schedule information</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="drug_name">Drug name</label>
                                <h5><?= $data_list['drug_name'] ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 1rem;">
                            <div class="form-group">
                                <label for="drug_category">Drug Category</label>
                                <h5><?= $data_list['category'] ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php if($data_list['description'] != ''): ?>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 1rem;">
                            <div class="form-group">
                                <label for="drug_description">Description</label>
                                <h5><?= $data_list['description'] ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 1rem;">
                            <div class="form-group">
                                <label for="schedule_time">When</label>
                                <h5><?= date_format(date_create($data_list['periodicity']), 'G:i') ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php if($data_list['date_to'] != '0000-00-00 00:00:00'): ?>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 1rem;">
                            <div class="form-group">
                                <label for="schedule_to">End date</label>
                                <h5><?= date_format(date_create($data_list['date_to']), 'M d, Y') ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="d-flex row px-2 mt-3 mb-3 align-items-center">
                        <span class="col btn btn-success btn-block m-1">I took it today!</span>
                        <span class="col btn btn-primary btn-block m-1">Edit schedule</span>
                    </div>
                </div>
            </div>
        </div>
</html>