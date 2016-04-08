<?php
session_start();
?>
<!DOCTYPE html>

<html>


<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Saltwell Harriers</title>
	<meta name="description" content="Saltwell Harriers">
	<meta name="author" content="Rob Brooks">
	
    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- CSS
    <!-- CSS
  ================================================== -->

	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
    <script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/app.js"></script>
    <script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/controllers.js"></script>
    
     
    
    
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44631646-1', 'auto');
  ga('send', 'pageview');

</script>

<script>

 // JavaScript Document
var FbAll = {
    facebookLogin: function () {
		var height = 300;
	    var width = 550;
	    var left = Number((screen.width/2)-(width/2));
	    var top = Number((screen.height/2)-(height/2));
	    var clientid = document.getElementById("client_id");
        var redirecturi = document.getElementById("redirect_uri");
 
        if (clientid.value == '') {
            alert("You have not configure facebook api settings.")
        } else {
            var openedwin = window.open('https://graph.facebook.com/oauth/authorize?client_id=' + clientid.value + '&redirect_uri=' + redirecturi.value + '&scope=email,user_birthday,user_hometown,user_location,user_work_history,user_website,publish_actions&display=popup', '', 'scrollbars=no, menubar=no, height='+height+', width='+width+', top='+top+', left='+left+', resizable=yes, toolbar=no, status=no');
			if (window.focus) {openedwin.focus()}
        }
    },
 
    parentRedirect: function (config) {
        var redirectto = document.getElementById("fball_login_form_uri");
        var form = document.createElement('form');
        form.id = 'fball-loginform';
        form.method = 'post';
        form.action = redirectto.value;
        form.innerHTML = '<input type="hidden" id="fball_redirect" name="fball_redirect" value="' + redirectto.value + '">';
 
        var key;
        for (key in config) {
			form.innerHTML += '<input type="hidden" id="' + key + '" name="' + key + '" value="' + config[key] + '">';
        }
 
        document.body.appendChild(form);
        form.submit();
    }
 }
 </script>

    
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/zerogrid.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/responsive.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/responsiveslides.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/carousel.css" media="screen" />
	

	
    
	
	<!-- <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/saltwell.css" media="screen" /> -->

	
	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/js/html5.js"></script>
		<script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/js/css3-mediaqueries.js"></script>
	<![endif]-->
	
	
	
	<link href='<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/favicon.ico' rel='icon' type='image/x-icon'/>
	
	
	
	<script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/js/jquery.min.js"></script>
	<script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/js/responsiveslides.js"></script>
	<script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/js/saltwell.js"></script>
	<!-- <script src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/js/jquery.validate.js"></script> -->
	
	<script charset="utf-8" type="text/javascript">var switchTo5x=true;</script>
	<script charset="utf-8" type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
	<script charset="utf-8" type="text/javascript">stLight.options({"publisher":"71063c6e-d0d7-47bb-98bc-7835cd159f44"});var st_type="wordpress3.8.1";</script>

	
	<script>
    $(function () {
      $("#slider").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "centered-btns"
      });
    });
  </script>
  
    
</head>


<body>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '887419204666910',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
   
window.fbAsyncInit = function() {
   FB.login(function(response) {
   if (response.authResponse) {
     console.log('Welcome!  Fetching your information.... ');
     FB.api('/me', function(response) {
       console.log('Good to see you, ' + response.name + '.');
     });
   } else {
     console.log('User cancelled login or did not fully authorize.');
   }
 });
   };
 
 
</script>
    
    

<!--------------Header--------------->

<!--
<header>

	<div class="zerogrid">
		<div class="row">
			 <div class="col05">
				<div id="logo"><a href=""><img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/logo.gif"/></a>
				
				
					
				</div>
			</div>
			
			
</header>
-->

<nav2>
	
		<img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/logo.gif" style="margin:10px"/>
<nav>
	<ul>
	    
		<li><a href="<?php bloginfo('wpurl'); ?>">Home</a></li>
		<li><a href="<?php bloginfo('wpurl'); ?>/10k">10k Race</a></li>
		<li><a href="<?php bloginfo('wpurl'); ?>/membership">Membership</a></li>
		<li><a href="<?php bloginfo('wpurl'); ?>/diary">Training Diary</a></li>
		<li><a href="<?php bloginfo('wpurl'); ?>/contacts">Contact</a></li>
		<li><a href="<?php bloginfo('wpurl'); ?>/gallery">Gallery</a></li>
		<li><a href="<?php bloginfo('wpurl'); ?>/merchandise">Merchandise</a></li>
		<li><a href="<?php bloginfo('wpurl'); ?>/suggested-races">Club Races</a></li>
		<li><a href="<?php bloginfo('wpurl'); ?>/members">Members Area</a></li>
		
	</ul>
		
		<!--
		<div id="social-icons">
			<a href="http://www.facebook.com/codepal"><img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/fb.png"/></a>
			<a href="http://twitter.com/sumeetchawla/"><img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/twitter.png"/></a>
			<a href="http://feeds.feedburner.com/code-pal/"><img src="<?php bloginfo('wpurl'); ?>/wp-content/themes/saltwell/images/rss.png"/></a>	
		</div> 
		-->		<!-- social icons -->
</nav>
	
</nav2>



			
			
			<!--
			<div class="col06 offset05">
			   <div id='search-box'>
				  <form action='' id='search-form' method='get' target='_top'>
					<input id='search-text' name='q' placeholder='type here' type='text'/>
					<button id='search-button' type='submit'><span>Search</span></button>
				  </form>
				</div>
			</div>
			-->
		</div> <!-- row -->
	</div> <!-- zerogrid -->


	<!-- </header> -->
	
	
	
	
	