<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $user_det = $this->session->userdata('logged_in');
        if (!empty($user_det['application']))
            redirect($this->config->item("base_url") . 'admin/dashboard');
        ?>
        <meta charset="utf-8">
        <title>Pupil Soft - School Management</title>
        <meta name="description" content=" ">
        <meta name=" " content=" ">
        <title>
            <?= $this->config->item('site_title'); ?> | <?= $this->config->item('site_powered'); ?>
        </title>
        <?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
        <link rel="stylesheet" type="text/css" media="all" href="<?= $theme_path; ?>/css/bootstrap.css" />
        <script type="text/javascript" src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="<?= $theme_path; ?>/js/bootstrap.js"></script>
        <!-- Favicons-->
        <link rel="shortcut icon" href="<?= $theme_path; ?>/images/fav.png" type="image/x-icon"/>
        <!-- CSS -->
        <link href="<?= $theme_path; ?>/css/login_bootstrap.css" rel="stylesheet">
        <link href="<?= $theme_path; ?>/css/login_bootstrap-responsive.css" rel="stylesheet">
        <link href="<?= $theme_path; ?>/css/login_bootstrap-select.min" rel="stylesheet">
        <link href="<?= $theme_path; ?>/css/style.css" rel="stylesheet">
        <link href="<?= $theme_path; ?>/css/font-awesome.css" rel="stylesheet" >
          <style>
            .login-copyright { display:none; }
        </style>
    </head>
    <body class="login-bg">

        <div id="container">   
            <div class="row-fluid">    
                <div class="">

                    <?php echo $content; ?>

                </div>
            </div>  
            <footer>
                <p id="copy"><?= $this->config->item('site_footer'); ?></p>
            </footer>
        </div> 

    </body>
</html>
