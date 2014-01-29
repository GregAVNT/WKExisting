<!doctype html> <!--[if lt IE 7]><html <?php language_attributes();?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--> <!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes();
     ?> class="no-js lt-ie9 lt-ie8"><![endif]--> <!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes();
     ?> class="no-js lt-ie9"><![endif]--> <!--[if gt IE 8]><!--> <html <?php language_attributes();
     ?> class="no-js"><!--<![endif]--> <head> <meta charset="utf-8"> <!-- Google Chrome Frame for IE --> <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"> <title><?php wp_title('');
     ?></title> <!-- mobile meta (hooray!) --> <meta name="HandheldFriendly" content="True" /> <meta name="MobileOptimized" content="320" /> <meta name="viewport" content="width=device-width,  initial-scale=1.0,  maximum-scale=1.0,  user-scalable=no"/> <meta name="format-detection" content="telephone=no" /> <!-- icons & favicons (for more:  http://www.jonathantneal.com/blog/understand-the-favicon/) --> <link rel="icon" href="<?php echo get_template_directory_uri();
     ?>/favicon.png"> <!--[if IE]> <link rel="shortcut icon" href="<?php echo get_template_directory_uri();
     ?>/favicon.ico"> <![endif]--> <!-- or,  set /favicon.ico for IE10 win --> <link rel="pingback" href="<?php bloginfo('pingback_url');
     ?>"> <!-- wordpress head functions --> 
     
     <?php wp_head();?> <!-- end of wordpress head --> 
     
     <?php if(metabox_enabled('custom_css')) :  ?><style type="text/css"><?php get_meta('custom_code_css');?></style>
     
     <?php endif;
     ?> </head> <body <?php body_class();?>> 
     	<div class="subscribe-top">
     		<div class='subscribe-inner center'>
     			<p>Here's a sample of what can go in here  </p>
     		</div>
     	</div>
     	<div class="container"> 
     		<header class="header row clearfix" role="banner"> 
     			<div class='col-sm-6 col-md-3'>
     			<p id="logo" class="h1 center-block"><a href="<?php echo ot_get_option( 'logo_link',  'http: //www.lww.com/' );?>" rel="nofollow">Wolters Kluwer Health | Lippincott,  Williams & Wilkins</a>
     			</p>
     			</div>
     			<div class='col-sm-6 col-md-3 col-md-push-6'>
     				<div class='social-container center-block'>
     					<a href='http://www.youtube.com/user/WoltersKluwerHealth' target="_blank"><div class='social wk-youtube'></div></a>
     					<a href='https://www.facebook.com/LippincottWilliamsWilkins' target="_blank"><div class='social wk-facebook'></div></a>
     					<a href='https://twitter.com/lippincott' target="_blank"><div class='social wk-twitter'></div></a>
     				</div>
     			</div> 
     		</header> 
     		<!-- end header -->