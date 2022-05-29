<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
         <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/styles/profile.css">
        <link rel="stylesheet" type="text/css" href="<?=base_url('/styles/help_popup.css')?>">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            function helpPopup() {
                var popup = document.getElementById("helpPopup");
                popup.classList.toggle("show");
            }
        </script>
         <title>Profile</title>
     </head>
     <div class="container d-flex justify-content-center align-items-center">

         <div class="card">

             <div class="upper">

                 <img src="https://i.imgur.com/Qtrsrk5.jpg" class="img-fluid">

             </div>

             <div class="user text-center">

                 <div class="profile">

                     <img src="<?php echo base_url('/images/pills.png')?>" class="rounded-circle" width="80">

                 </div>

             </div>


             <div class="mt-5 text-center">

                 <h4 class="mb-0" style="margin-bottom: 0.5rem; padding-bottom: 0.5rem;"><?=session()->get('name')?></h4>

                 <?php if($show_set_password):?>
                 <div class="text-center px-5 mt-1 row">
                     <div class="m-1 btn btn-primary confirm-button col"  onclick="location.href='<?=base_url('/set-password')?>'">Set password</div>
                     <div class="m-1 btn btn-primary confirm-button col popup" onclick="helpPopup()">Why should i?
                         <span class="popuptext" id="helpPopup">If you want to login not only using facebook login,
                                but with your password, you can set it now, so you can use it to login later</span></div>
                 </div>

                 <?php else:?>
                     <div class="text-center px-5 mt-1 row">
                         <div class="m-1 btn btn-primary confirm-button col"  onclick="location.href='<?=base_url('/set-password')?>'">Change password</div>
                     </div>
                 <?php endif;?>
                 <div class="d-flex justify-content-between align-items-center mt-3 px-4">
                     <div class="stats">
                         <span>You have  <?=$drugs_count[0]['drug_id']?> pill<?php if($drugs_count[0]['drug_id'] != 1) echo 's'?> to take</span>
                     </div>

                     </div>

                 </div>

             </div>

         </div>

     </div>
 </html>