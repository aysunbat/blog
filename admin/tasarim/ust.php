<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Admin Title</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo url;?>/admin/tasarim/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="<?php echo url;?>/admin/tasarim/css/style.css" rel='stylesheet' type='text/css' />
<link href="<?php echo url;?>/admin/tasarim/css/font-awesome.css" rel="stylesheet"> 
<script src="<?php echo url;?>/admin/tasarim/js/jquery.min.js"> </script>
<script src="<?php echo url;?>/admin/tasarim/js/bootstrap.min.js"> </script>
  
<!-- Mainly scripts -->
<script src="<?php echo url;?>/admin/tasarim/js/jquery.metisMenu.js"></script>
<script src="<?php echo url;?>/admin/tasarim/js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="<?php echo url;?>/admin/tasarim/css/custom.css" rel="stylesheet">
<script src="<?php echo url;?>/admin/tasarim/js/custom.js"></script>
<script src="<?php echo url;?>/admin/tasarim/js/screenfull.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
			

			
		});
		</script>



</head>
<body>
<div id="wrapper">
       <!----->
        <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="index.html">Minimal</a></h1>         
			   </div>
			 <div class=" border-bottom">
        	<div class="full-left">
        	  <section class="full-top">
				<button id="toggle"><i class="fa fa-arrows-alt"></i></button>	
			</section>
			<form class=" navbar-left-right">
              <input type="text"  value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">
              <input type="submit" value="" class="fa fa-search">
            </form>
            <div class="clearfix"> </div>
           </div>
     
       
            <!-- Brand and toggle get grouped for better mobile display -->
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="drop-men" >
		        <ul class=" nav_1">
		           
		    		<li class="dropdown at-drop">
		              <a href="index.php?y=yorum" class="dropdown-toggle dropdown-at " ><i class="fa fa-globe"></i> <span class="number"><?php echo onayBekleyenYorumSay();?></span></a>
		              
		            </li>
					<li class="dropdown">
		             <span class=" name-caret"><?php echo $_SESSION['nick'];?></span><img src="<?php echo url;?>/admin/tasarim/images/wo.png">
		              
		            </li>
		           
		        </ul>
		     </div><!-- /.navbar-collapse -->
			<div class="clearfix">
       
     </div>