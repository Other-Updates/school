<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); 
$user_det = $this->session->userdata('logged_in');
if(empty($user_det['application']))
	redirect($this->config->item("base_url").'admin/index');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
    <title>Excel College</title>
	<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/css/style_front.css" />
</head>
<body>
<div class="wrapper">	
	<div class="background-change col-lg-block-themeshark-dark">
		<div class="animated fadeInDown">
			<header class="header_block">
				<figure>
					<a >
						<img src="<?= $theme_path; ?>/images/front_logo.png" alt="" />
					</a>
				</figure>
			</header>
			<p>We Don't care what people know...</p>
			<p>...we care what thay do. It's all about performance!</p>
		</div>
	</div>
	<div class="background-light col-lg-block-themeshark-light">
		<div class="animated fadeInUp clg_logo">
			<a href="http://localhost/software-i2/trunk/codes/i2_software/admin/dashboard" class="transition" target="_blank">
            	<img src="<?= $theme_path; ?>/images/excel_engg.png"><span>Excel College of Engineering and Technology</span>
            </a>
			<a href="http://localhost/online_test/trunk/codes/i2_software/admin/dashboard" class="transition"  target="_blank">
            	<img src="<?= $theme_path; ?>/images/excel_arch.png"><span>Excel College of Architecture and Planning</span>
            </a>
			<a href="http://localhost/i2soft-online-test/trunk/codes/i2_software/admin/dashboard" class="transition"  target="_blank">
            	<img src="<?= $theme_path; ?>/images/excel_tech.png"><span>Excel College of Technology</span>
            </a>                    
			
			
		</div>
	</div>	
</div>
</body>
</html>