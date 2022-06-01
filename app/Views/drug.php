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
        <style>
            /* Style The Dropdown Button */
            /* The container <div> - needed to position the dropdown content */
            .dropdown {
                position: relative;
                display: inline-block;
                border-radius: 1rem;
            }

            /* Dropdown Content (Hidden by Default) */
            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
                border-radius: 1rem;
            }

            /* Links inside the dropdown */
            .dropdown-content p {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                border-radius: 1rem;
            }

            /* Change color of dropdown links on hover */
            .dropdown-content p:hover {background-color: #f1f1f1}

            /* Show the dropdown menu on hover */
            .dropdown:hover .dropdown-content {
                display: block;
                border-radius: 1rem;
            }
        </style>
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
                <?php if ($data_list['description'] != ''): ?>
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
                <?php if ($data_list['date_to'] != '0000-00-00'): ?>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 1rem;">
                            <div class="form-group">
                                <label for="schedule_to">End date</label>
                                <h5><?= date_format(date_create($data_list['date_to']), 'M d, Y') ?></h5>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-sm-12 form-select dropdown" style=" margin-bottom: 1rem; margin-top: 1rem; border-radius: 0.5rem;">
                        <div class="row" style="border-radius: 1rem;">
                            <?php if (empty($took_data)): ?>
                                <p class="dropbtn">You haven't taken this drug yet</p>
                            <?php else: ?>
                                <p class="dropbtn muted">Days you took this drug at (hover to see)</p>
                            <?php endif; ?>
                            <div class="dropdown-content">
                                <?php foreach ($took_data as $took): ?>
                                    <p><?= date_format(date_create($took['date']), 'M d, Y') ?></p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex row px-2 mt-3 mb-3 align-items-center">
                    <?php if ($show_took_today): ?>
                        <span class="col btn btn-success btn-block m-1"
                              onclick="location.href='<?= base_url('/took-drug/') . '/' . $data_list['drug_id'] ?>'">I took it today!</span>
                    <?php else: ?>
                        <span class="col btn btn-warning btn-block m-1"
                              onclick="location.href='<?= base_url('/untook-drug/') . '/' . $data_list['drug_id'] ?>'">Untook today!</span>
                    <?php endif; ?>
                    <span class="col btn btn-primary btn-block m-1"
                          onclick="location.href='<?= base_url('/edit-schedule') . '/' . $data_list['drug_id'] ?>'">Edit schedule</span>
                </div>
            </div>
        </div>
    </div>
</html>