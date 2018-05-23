<?PHP
require_once(__DIR__ .'/incl/config.php'); 

if(!$mimksite->CheckLogin())
{
    $mimksite->RedirectToURL("index.php");
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
        <title>Portall - Administratie</title>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.png">
        <link rel='stylesheet' id='fontello-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/fontello.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='FontAwesome-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/font-awesome.min.css?ver=4.1' type='text/css' media='all' />
        <link rel='stylesheet' id='stylesheet-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/style.css?ver=1.0' type='text/css' media='all' />
        <link rel='stylesheet' id='skeleton-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/skeleton.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='responsive-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/responsive.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='contact-form-7-css'  href='<?php echo $mimksite->sitename; ?>/style/contact-form.css?ver=4.3.1' type='text/css' media='all' />
        <link rel='stylesheet' id='js_composer_front-css'  href='<?php echo $mimksite->sitename; ?>/style/js_composer.css?ver=4.7.4' type='text/css' media='all' />
        <link rel='stylesheet' id='mink-style-css'  href='<?php echo $mimksite->sitename; ?>/style/stylesheet.css' type='text/css' media='all' />
</head>
<body>
<div id='main' class='rounded'>
    <center></br>
    <div class='container'>
                    <div class='logo aligncenter'>
                        <img src="img/logo5.png" alt="Portall" />
                    </div></br>
<?php echo isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:''; ?> !
<div id="no-title"></div>
    <p>
        <div id="" class="wpb_row row-fluid  " style="margin-bottom: 0px;">
            <div class="container">
               <!-- verkleind de ruimte tussen de grijze kaders --><div class="wpb_column vc_column_container vc_col-sm-12">
                    <div class="wpb_wrapper">
                            <h2 class="wpb_call_text"> </h2>
                            <a class="wpb_button_a" href="medewerkers.php">
                                <span class="wpb_button  wpb_btn-danger wpb_regularsize wpb_arrow">WR Medewerkers 
                                    <i class="icon"> </i>
                                </span>
                            </a>
                                                        <h2 class="wpb_call_text"> </h2>
                            <a class="wpb_button_a" href="praktijken.php">
                                <span class="wpb_button  wpb_btn-danger wpb_regularsize wpb_arrow">Relaties 
                                    <i class="icon"> </i>
                                </span>
                            </a>
                                                        <h2 class="wpb_call_text"> </h2>
                            <a class="wpb_button_a" href="login-home.php">
                                <span class="wpb_button  wpb_btn-danger wpb_regularsize wpb_arrow">Terug 
                                    <i class="icon"> </i>
                                </span>                                                        
                                                        
                    </div>
                </div>
            </div>
        </div>
    </p>    
    <div id="no-title"></div>
    <p>
        <div id="" class="wpb_row row-fluid  " style="margin-bottom: 0px;">
            <div class="container">
                <div class="wpb_column vc_column_container vc_col-sm-12">
                    <div class="wpb_wrapper">
                            <h2 class="wpb_call_text"> </h2>
                            <a class="wpb_button_a" href="logout.php">
                                <span class="wpb_button  wpb_btn-danger wpb_regularsize wpb_arrow">Uitloggen 
                                    <i class="icon"> </i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>    </p>
	<div id="copyright" class="clearfix">
		<div class="container wrap-table">
			
			<div class="copyright-text cell nine columns">
													 © WilroffReitsma <br>
Vragen of opmerkingen?<br>
Mail ons via <a href="mailto:servicedesk@WilroffReitsma.nl">Servicedesk@WilroffReitsma.nl</a>							</div>
			
						
		</div>
	</div><!-- end copyright -->
</div>
</center>
</div>
</body>
</html>