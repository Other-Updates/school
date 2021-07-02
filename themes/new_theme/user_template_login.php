<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<html lang="en">
    <!--<![endif]-->
    <head>

        <meta charset="utf-8">
        <title>Pupil Soft - School Management</title>
        <meta name="description" content=" ">
        <meta name=" " content=" ">
        <?php
        $user_det = $this->session->userdata('logged_in');
        if ($user_det['staff_type'] == 'staff')
            redirect($this->config->item("base_url") . 'admin/index');
        ?>
        <!-- CSS -->
        <?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
        <!-- Favicons-->
        <link rel="shortcut icon" href="<?= $theme_path; ?>/images/fav.png" />
        <link href="<?= $theme_path; ?>/css/login_bootstrap.css" rel="stylesheet">
        <link href="<?= $theme_path; ?>/css/login_bootstrap-responsive.css" rel="stylesheet">
        <link href="<?= $theme_path; ?>/css/login_bootstrap-select.min.css" rel="stylesheet">
        <link href="<?= $theme_path; ?>/css/style.css" rel="stylesheet">
        <!--<link href="<?= $theme_path; ?>/css/supersized.css" rel="stylesheet" >-->
        <link href="<?= $theme_path; ?>/css/supersized.shutter.css" rel="stylesheet" >
        <link href="<?= $theme_path; ?>/css/font-awesome.css" rel="stylesheet" >
        <title><?= $this->config->item('site_title'); ?> | <?= $this->config->item('site_powered'); ?></title>    	

        <script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
        <!-- Support media queries for IE8 -->
        <script src="<?= $theme_path; ?>/js/respond.min.js"></script>
        <!-- HTML5 and CSS3-in older browsers-->
        <script src="<?= $theme_path; ?>/js/modernizr.custom.17475.js"></script>
        <!--[if IE 7]>
          <link rel="stylesheet" href="font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
        <script type="text/javascript">
            var BASE_URL = '<?php echo $theme_path; ?>';
        </script>
        <style>
            .login-copyright { display:none; }
        </style>
     </head>
   <body class="login-bg1">
        <!--<div id="pageloaddiv"></div>-->
        <section id="slidecaption" class="hidden-phone"></section> <!--Slide caption. Open bg_images.js to edit the copy-->
        
        <!--Arrow Navigation-->
        <!--<a id="prevslide" class="load-item hidden-phone"></a>
        <a id="nextslide" class="load-item hidden-phone"></a>-->

        <?= $content; ?>

        <!-- DATEPICKER -->        
        <script type="text/javascript" src="<?= $theme_path; ?>/js/bootstrap-datetimepicker.min.js"></script>

        <!-- FULLSCREEN -->      
        <script src="<?= $theme_path; ?>/js/jquery.easing.min.js"></script>
        <script src="<?= $theme_path; ?>/js/supersized.3.2.7.min.js"></script>
        <script src="<?= $theme_path; ?>/js/supersized.shutter.min.js"></script>
        <!--<script src="<?= $theme_path; ?>/js/bg_images.js"></script>-->

        <!-- OTHER JS -->    	
        <script src="<?= $theme_path; ?>/js/bootstrap.js"></script>
        <script src="<?= $theme_path; ?>/js/bootstrap-select.min.js"></script>
        <script src="<?= $theme_path; ?>/js/functions.js"></script>
        <script type="text/javascript">
            $(window).load(function () {
                $("#pageloaddiv").fadeOut(800);
            });
        </script>
    </body>
</html>