<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<div class="span5" id="container">
	<?php
			$login='';
        	if(isset($_GET['login'])&& !empty($_GET['login']))
			{
				if($_GET['login']=='error')
					$login='';
				else
					$login='active';		
			}
			else
				$login='active';
		?>
         <?php
		 	$login1='';
        	if(isset($_GET['login'])&& !empty($_GET['login']))
			{
				if($_GET['login']=='error')
					$login1='active';	
			}	
		?>
	<div id="header">
		<p id="logo"><img src="<?= $theme_path; ?>/img/logo.png"  alt="Logo"></p>
	</div>
    
    <nav>
	<ul class="tabs">
		<li><a class="<?=$login?>" href="#section-1"><i class="icon-user icon-2x pull-left"></i><span>Stud Registration </span></a></li>
		<li><a class="<?=$login1?>" href="#section-2"><i class=" icon-book icon-2x pull-left"></i><span>Stud Login</span></a></li>
		<li><a href="#section-3"><i class=" icon-envelope-alt icon-2x pull-left"></i><span>Contact Us</span></a></li>
	</ul>
   </nav> 
   
	<ul class="tabs-content clearfix">
    	
		<li class="<?=$login?>" id="section-1">
        <div class="login">
        <div class="login_bg">
        <div class="login_tit_bg">Registration Form</div>
        <form method="post">
         <?php
        	if(isset($_GET['login'])&& !empty($_GET['login']))
			{
				if($_GET['login']=='fail')
				{
					?>
                    <span style="color:red;">Sorry Incorrect Login Credentials !</span>
                    <?php
				}
			}	
		?>
        <div class="login_input">
        <label class="login_label">
    		<i class="icon-user login_icon"></i>
    		<input type="text" name="student[name]" placeholder="Name" />
		</label>
        <label class="login_label">
    		<i class="icon-user login_icon"></i>
    		<input type="text" name="student[std_id]" placeholder="Roll no" />
		</label>
        <label class="login_label">
    		<i class="icon-envelope login_icon"></i>
    		<input type="text" name="student[email_id]" placeholder="Email Id" />
		</label>
        <label class="login_label">
    		<i class="icon-lock login_icon"></i>
    		<input type="password" name="student[pwd]" placeholder="Password" />
		</label>
        <div class="login_forgot"><!--<a href="#">Forgot your password?</a>--></div>
        <input type="submit" name="staff" value="Login" class="btn btn-info login_button">
        </div>
        </div>
        </form>
        </div>
		</li>
       
		<li id="section-2" class="<?=$login1?>">
		<div class="login">
        <div class="login_bg">
        <div class="login_tit_bg">Login</div>
        <div class="login_input">
        <form method="post">
         <?php
        	if(isset($_GET['login'])&& !empty($_GET['login']))
			{
				if($_GET['login']=='error')
				{
					?>
                    <span style="color:red;">Sorry Incorrect Login Credentials !</span>
                    <?php
				}
			}	
		?>
        
        <label class="login_label">
    		<i class="icon-user login_icon"></i>
    		<input type="text" name='user_email_id' placeholder="Email Id" />
		</label>
        <label class="login_label">
    		<i class="icon-lock login_icon"></i>
    		<input type="password" name='user_pwd' placeholder="Password" />
		</label>
        <div class="login_forgot"><!--<a href="#">Forgot your password?</a>--></div>
        <input type="submit" name ='user' value="Login" class="btn btn-info login_button">
        </div>
        </form>
        </div>
        </div>
		</li>
        
		<li id="section-3">
		<div class="login">
        <div class="login_bg">
        <div class="login_tit_bg">Address</div>
        <div class="login_input">
        <table width="100%" border="0">
          <tr>
            <td valign="top"><i class="icon-home"></i></td>
            <td>&nbsp;</td>
            <td>: Kaamadhenu Nagar, Sathy-Athani Main Road, D.G. Pudur Post, Sathyamangalam, Erode District - 638 503 Tamilnadu, India</td>
          </tr>
          <tr>
            <td valign="top"><i class="icon-phone"></i></td>
            <td>&nbsp;</td>
            <td>098 42 960943</td>
          </tr>
          <tr>
            <td valign="top"><i class="icon-print"></i></td>
            <td>&nbsp;</td>
            <td>+91 4295 223843</td>
          </tr>
          <tr>
            <td valign="top"><i class="icon-envelope-alt"></i></td>
            <td>&nbsp;</td>
            <td>info@kascsathy.ac.in</td>
          </tr>
          <tr>
            <td valign="top"><i class="icon-tag"></i></td>
            <td>&nbsp;</td>
            <td><a href="http://www.kascsathy.ac.in/" target="_blank">www.kascsathy.ac.in</a></td>
          </tr>
        </table>
        <div class="login_social_icon"><a href="#" class="facebook"><i class="icon-facebook icon_link">&nbsp;</i></a></div>
        <div class="login_social_icon"><a href="#"><i class="icon-twitter icon_link">&nbsp;</i></a></div>
        <div class="login_social_icon"><a href="#"><i class="icon-linkedin icon_link">&nbsp;</i></a></div>
        <div class="login_social_icon"><a href="#"><i class="icon-google-plus icon_link">&nbsp;</i></a></div>
        </div>
        </div>
        </div>
		</li>
	</ul>
    
    <footer>
        <p id="copy">Copyright &copy; 2014 iBoard. All Rights Reserved.</p>
	</footer>

 </div>
 <script type="text/javascript">
$(document).ready(function(){
	$('input').attr('autocomplete','off');	
});
</script>