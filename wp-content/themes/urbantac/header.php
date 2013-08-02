<!doctype html>  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
  
  <head>
    <meta charset="utf-8">
    <title><?php wp_title('') ?></title>
    
    <!-- Google Chrome Frame for IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    
    <!-- wordpress head functions -->
    <?php wp_head(); ?>
    <!-- end of wordpress head -->
      
    <!-- drop Google Analytics Here -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-42918691-1', 'urbantacticalsupplies.com');
      ga('send', 'pageview');

    </script>
    <!-- end analytics -->
    
  </head>
  
  <body <?php body_class(); ?>>
  	<div id="container" class="wrapper">
      
      <header class="header default clearfix" role="banner">
        <div id="inner-header" class="clearfix">
          
          <!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
          <a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/urbantac-logo.png" alt="Urban Tactical Supplies" /></a>
          
          <div class="header-right clearfix">
            <a href="http://www.facebook.com/pages/Urban-Tactical-Supplies-LLC/149152391833258" target="_blank"><p class="header-facebook">Like Us on Facebook! <i class="icon-facebook-sign"></i></p></a>
            <div class="header-info">
              <p>260 Main Street</p>
              <p>Buzzards Bay, MA 02532</p>
            </div>
            <nav role="navigation">
              <?php bones_main_nav(); ?>
            </nav>
          </div>
        
        </div> <!-- end #inner-header -->

      </header> <!-- end header -->

