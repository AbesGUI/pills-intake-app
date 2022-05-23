<?php
//
//
//foreach ($drug_list as $drug ) {
//    foreach($drug as $drug_key => $drug_name) {
//        echo '<h1>' . $drug_key . '    ' . $drug_name . '</h1><br>';
//    }
//}
//
//
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/styles/listofdrugs.css">
        <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title>Drug List</title>
    </head>
    <div class="container bg-light">
        <div class="h4 font-weight-bold text-center py-3">Controls</div>
        <div class="d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 my-lg-0 my-3">
                <div class="box bg-white">
                    <div class="d-flex align-items-center">
                        <div class="d-flex flex-column">
                            <b><a href="<?=base_url('/schedule')?>" class="nav-link mx-2 btn-outline-primary">Create schedule</a></b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bg-light">
        <div class="h4 font-weight-bold text-center py-3">Explore more</div>
        <div class="row">
            <?php foreach ($drug_list as $drug ): ?>
            <div class="col-lg-4 col-md-6 my-lg-2 my-3">
                <div class="box bg-white">
                    <div class="d-flex align-items-center">
                        <div
                                class="rounded-circle mx-3 text-center d-flex align-items-center justify-content-center blue">
                            <img src="https://freepngimg.com/thumb/microphone/11-microphone-png-image-thumb.png" alt="">
                        </div>
                        <div class="d-flex flex-column">
                            <b><?=$drug['name']?></b>
                            <a href="#">
                                <p class="text-muted">23 classes</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
    </div>
</html>


