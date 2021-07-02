<?php $theme_path = $this->config->item('theme_locations').$this->config->item('active_template'); ?>
<div class="container new-login admin-login">
    	<div class="login-page1">
            <div class="">
            	<div class="main">
                    <div class="login-form">
                        		<h1>Sign In</h1>
                                <div class="head">
                                    <img src="<?= $theme_path; ?>/img/admin-icons.png">
                                </div>
                                
                                <form action="<?php echo $this->config->item('base_url'); ?>admin/verify" method="post" onsubmit="return validate();">
                                    <div class="">
                                        <div class="">
                                            <div class="login_input" style="position:relative;">
                                                <div style="text-align:center; color:red; font-weight:bold; position:absolute; top:4px"><?php 
                                                if(isset($_GET['check']) && !empty($_GET['check']))
                                                echo "Email or Password Incorrect !!!";
                                                ?>
                                                </div>
                                            <label class="login_label">
                                                <i class="icon-user login_icon log-col-ad"></i>
                                                <input type="text" name="email" placeholder="Email Id" id="emailid" class="soft-form input-wid bor-0" />
                                            </label>
                                            <label class="login_label">
                                                <i class="icon-lock login_icon log-col-ad"></i>
                                                <input type="password" name="upass" placeholder="Password" id="upass" class="soft-form input-wid bor-0"/>
                                            </label>
                                            <div class="login_forgot"><!--<a href="#">Forgot your password?</a>--></div>
                                        <span id="v1" style="color:#F00; font-style:oblique;"></span> 
                                        <input type="submit" value="Login" class="btn-info2 login_button" id="submit">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    </form>
                                
                            
                        </div>
                </div>
            	
            
            
            </div>
        </div>
        



<!--<section id="slidecaption" class="hidden-phone slide-text"><h3>imagine and believe</h3><br><span>...achieve with all your might</span></section>-->
<!--<h3 style="font-size: 46px;
    background-color: #ffffff;
    display: inline;
    padding: 0 10px;
    border-radius: 10px 10px 0 0px;">xgdf</h3>-->
<script type="text/javascript">
$(document).ready(function(){
	$('input').attr('autocomplete','off');	
});

$(document).ready(function(){
	$('#submit').click(function(){
		//alert("hi");
	var emailid=$("#emailid").val();
	var filter=/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	var upass=$("#upass").val();
	if(emailid=="")
	{
		$("#v1").html("Enter your email address.");
		return false;
	}
	else if(!filter.test(emailid))
	{
		$("#v1").html("Enter valid email.");
		return false;
	}
	else if(upass=="")
	{
		$("#v1").html("Enter your password.");
		return false;
	}
	else
	{
		$("#v1").html("");
		return true;
	}
	/*else
	{
		$("#v2").html("");
		return true;
	}*/
	});
});


</script>

