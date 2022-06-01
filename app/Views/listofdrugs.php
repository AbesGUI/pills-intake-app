<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css"
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/styles/listofdrugs.css">
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title>Drug List</title>
    </head>
    <div class="container bg-light">
        <div class="d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 my-lg-0 my-3 ml-3 mr-3">
                <div class="box bg-white">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <b><a href="<?= base_url('/schedule') ?>" class="nav-link mx-2 btn-outline-primary">Create
                                    schedule</a></b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-lg-0 my-3 ml-3 mr-3">
                <div class="box bg-white">
                    <div class="d-flex align-items-center">
                        <div class="row">
                            <div class="col-sm-12" style="margin-top: 0.5rem;">
                                <div class="form-group">
                                    <form method="get" id="categoryFilterForm">
                                    <label for="drug_category">Drug Category</label>
                                    <select id="drug_category" name="drug_category" class="form-select"
                                            style="margin-top: 10px; height: 48px; border: 2px solid #eee; border-radius: 10px;" onchange="document.getElementById('categoryFilterForm').submit();">
                                        <option value="">Not set</option>
                                        <?php foreach ($category_list as $category): ?>
                                            <option value="<?= $category['category_id'] ?>" <?php if (isset($_GET['drug_category'])) if (esc($_GET['drug_category']) == $category['category_id']) echo 'selected'; ?>><?= $category['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-light">
        <div class="h4 font-weight-bold text-center py-3">Scheduled intakes</div>
        <div class="row">
            <?php foreach ($drug_list as $drug): ?>
                <div class="col-lg-4 col-md-6 my-lg-2 my-3"
                     onclick="location.href='<?= base_url('/drug/' . $drug['drug_id']) ?>'">
                    <div class="box bg-white">
                        <div class="d-flex align-items-center">
                            <div
                                    class="rounded-circle mx-3 text-center d-flex align-items-center justify-content-center blue">
                                <img src="<?= base_url('images/pill_list.png') ?>" alt="">
                            </div>
                            <div class="d-flex flex-column">
                                <b><?= $drug['drug_name'] ?></b>
                                <?php if (!is_null($drug['took_id'])): ?>
                                    <span class="badge rounded-pill bg-success">Took today</span>
                                <?php endif; ?>
                                <?php if (!empty($drug['description'])): ?>
                                    <small><?= $drug['description'] ?></small>
                                <?php endif; ?>
                                <p class="text-muted"><?= $drug['category'] ?></p>
                                <p class="text-muted"><?= date_format(date_create($drug['periodicity']), 'G:i') ?></p>
                                <a class="btn-sm btn-danger text-center ml-5 mt-1"
                                   style="border-radius: 4rem; outline: none; text-decoration: none; padding: 0.3rem 1rem 0.3rem 1rem;"
                                   href="<?= base_url('/delete-drug') . '/' . $drug['drug_id'] ?>">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</html>


