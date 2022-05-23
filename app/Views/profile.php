<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
         <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/styles/profile.css">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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

                 <h4 class="mb-0" style="margin-bottom: 2rem; padding-bottom: 2rem;"><?php echo session()->get('name'); ?></h4>

                 <div class="d-flex justify-content-between align-items-center mt-4 px-4">
                     <div class="stats">
                         <span style="font-size: px;">You have X pills to take</span>
                     </div>

                     </div>

                 </div>

             </div>

         </div>

     </div>
 </html>