<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<div class="span1-log" id="container1">
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
	<!--<div id="header">
		<p id="logo"><img src="<?= $theme_path; ?>/img/logo.png"  alt="Logo"></p>
	</div>-->
    
    <nav class="nav-ml">
	<ul class="tabs">
		<li><a class="<?=$login?>" href="#section-1"><i class="icon-user icon-2x pull-left"></i><span>Faculty Login </span></a></li>
		<li><a class="<?=$login1?>" href="#section-2"><i class=" icon-book icon-2x pull-left"></i><span>Student Login</span></a></li>
		<!--<li><a href="#section-3"><i class=" icon-envelope-alt icon-2x pull-left"></i><span>Contact Us</span></a></li>-->
	</ul>
   </nav> 
   
	<ul class="tabs-content clearfix">
    	
		<li class="<?=$login?>" id="section-1">
        <div class="login">
        <div class="login_bg">
        <div class="login_tit_bg">Sign In</div>
        <form method="post">
        <div class="login_input">
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
        
        <label class="login_label">
    		<i class="icon-user login_icon log-col"></i>
    		<input type="text" name="staff_email_id" placeholder="Email Id" />
		</label>
        <label class="login_label">
    		<i class="icon-lock login_icon log-col"></i>
    		<input type="password" name='staff_pwd' placeholder="Password" />
		</label>
        <div class="login_forgot"><!--<a href="#">Forgot your password?</a>--></div>
        <input type="submit" name='staff' value="Login" class="btn-info2 login_button">
        </div>
        </div>
        </form>
        </div>
		</li>
       
		<li id="section-2" class="<?=$login1?>">
		<div class="login">
        <div class="login_bg">
        <div class="login_tit_bg">Sign In</div>
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
    		<i class="icon-user login_icon log-col"></i>
    		<input type="text" name='user_email_id' placeholder="Email Id" />
		</label>
        <label class="login_label">
    		<i class="icon-lock login_icon log-col"></i>
    		<input type="password" name='user_pwd' placeholder="Password" />
		</label>
        <div class="login_forgot"><!--<a href="#">Forgot your password?</a>--></div>
        <input type="submit" name ='user' value="Login" class="btn-info2 login_button">
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
            <td>College Address</td>
          </tr>
          <tr>
            <td valign="top"><i class="icon-phone"></i></td>
            <td>&nbsp;</td>
            <td>123 45 67890</td>
          </tr>
          <tr>
            <td valign="top"><i class="icon-print"></i></td>
            <td>&nbsp;</td>
            <td>+91 123 456789</td>
          </tr>
          <tr>
            <td valign="top"><i class="icon-envelope-alt"></i></td>
            <td>&nbsp;</td>
            <td>info@college.ac.in</td>
          </tr>
          <tr>
            <td valign="top"><i class="icon-tag"></i></td>
            <td>&nbsp;</td>
            <td><a href="#" target="_blank">www.college.ac.in</a></td>
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
    
<div class="create-account-stu">
                    <p>
                        Copyright © 2017 e-soft.Powered By <a href="http://f2fsolutions.co.in/" target="_blank" style="color:#000;">F2F Solutions</a>
                    </p>
                </div>

 </div>
 <script type="text/javascript">
$(document).ready(function(){
	$('input').attr('autocomplete','off');	
});
</script>