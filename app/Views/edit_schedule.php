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
        <title>Edit Schedule</title>
    </head>
    <form class="pt-3" action="<?php echo base_url('/edit-schedule').'/'; if(isset($data_list)) echo $data_list['drug_id']; else echo $drug_id;?>" method="post">
        <div class="container mt-5 mb-5 d-flex justify-content-center">
            <div class="card px-1 py-4">
                <div class="card-body">
                    <?php if(isset($validation)):?>
                        <div class="alert alert-warning">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif;?>
                    <h4 class="information mt-1" style="margin-bottom: 0.5rem;">Please fill following fields</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="drug_name">Drug name</label> <input name="drug_name" class="form-control"
                                                                                type="text"
                                                                                placeholder="ex. Ibalgin"
                                                                                value="<?php if(isset($_POST['drug_name'])) echo $_POST['drug_name']; elseif(isset($data_list)) echo $data_list['drug_name']?>"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 0.5rem;">
                            <div class="form-group">
                                <label for="drug_category">Drug Category</label>
                                <select id="drug_category" name="drug_category" class="form-select"
                                        style="margin-top: 10px; height: 48px; border: 2px solid #eee; border-radius: 10px;">
                                    <option value="none" selected disabled hidden>Select Category</option>
                                    <?php foreach ($category_list as $category): ?>
                                        <option value="<?= $category['category_id'] ?>" <?php if(isset($data_list)) { if($category['category_id'] == $data_list['category_id']) echo 'selected'; } else if($category['category_id'] == $category_id) echo 'selected';  ?> ><?= $category['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 1rem;">
                            <div class="form-group">
                                <label for="drug_description">Description</label> <input name="drug_description"
                                                                                         class="form-control" type="text"
                                                                                         placeholder="ex. to cure headache"
                                                                                         value="<?php if(isset($_POST['drug_description'])) echo $_POST['drug_description']; elseif(isset($data_list)) echo $data_list['description']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 1rem;">
                            <div class="form-group">
                                <label for="schedule_time">When</label> <input name="schedule_time" class="form-control"
                                                                               type="time"
                                                                               value="<?php if(isset($_POST['schedule_time'])) echo $_POST['schedule_time']; elseif(isset($data_list)) echo $data_list['periodicity']?>"></div>
                        </div>
                    </div>
                    <?php if(isset($data_list) && $data_list['date_to'] != '0000-00-00 00:00:00'):?>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 1rem;">
                            <div class="form-group">
                                <label for="schedule_to">End date</label> <input name="schedule_to" class="form-control"
                                                                                 type="date"
                                                                                 value="<?php if(isset($_POST['schedule_to'])) echo $_POST['schedule_to']; elseif(isset($data_list)) echo date("Y-m-d", strtotime($data_list['date_to']))?>"></div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class=" d-flex flex-column text-center px-5 mt-3 mb-3">
                        <button class="btn btn-primary btn-block confirm-button">Save schedule</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</html>