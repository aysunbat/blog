
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title><?php if($uyeSayisi>0){?>Giriş Yap<?php }else{?>Üye Ol<?php }?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo url;?>/admin/tasarim/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="<?php echo url;?>/admin/tasarim/css/style.css" rel='stylesheet' type='text/css' />
<link href="<?php echo url;?>/admin/tasarim/css/font-awesome.css" rel="stylesheet"> 
<script src="<?php echo url;?>/admin/tasarim/js/jquery.min.js"> </script>
<script src="<?php echo url;?>/admin/tasarim/js/bootstrap.min.js"> </script>
</head>
<body>
	<div class="login">
		<h1><a href="index.html">Blogumuz </a></h1>
		<div class="login-bottom">
			<h2><?php if($uyeSayisi>0){?>Giriş Yap<?php }else{?>Üye Ol<?php }?></h2>
			<form method="POST" action="">
			<div class="col-md-6">
				<div class="login-mail">
					<input type="text" placeholder="Kullanıcı Adı" name="nick">
					<i class="fa fa-envelope"></i>
				</div>
				<div class="login-mail">
					<input type="password" placeholder="Şifre" name="sifre">
					<i class="fa fa-lock"></i>
				</div>
				 
				<?php if(isset($sonuc)){echo implode($sonuc[1],'<br/>');}?>	
			
			</div>
			<div class="col-md-6 login-do">
				<label class="hvr-shutter-in-horizontal login-sub">
					<input type="submit" value="Giriş">
					</label>
					
			</div>
			
			<div class="clearfix"> </div>
			</form>
		</div>
	</div>
		<!---->
<div class="copy-right">
            <p> &copy; 2016 Minimal. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>	    </div>  
<!---->
<!--scrolling js-->
	<script src="<?php echo url;?>/admin/tasarim/js/jquery.nicescroll.js"></script>
	<script src="<?php echo url;?>/admin/tasarim/js/scripts.js"></script>
	<!--//scrolling js-->
</body>
</html>

