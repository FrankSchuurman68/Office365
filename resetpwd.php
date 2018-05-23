<?PHP
require_once(__DIR__ .'/incl/config.php'); 

$success = false;
if($mimksite->ResetPassword())
{
    $success=true;
}

?>
<!DOCTYPE html>
 
<html>
    <head>
        <title>Portall</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.png">
        <link rel='stylesheet' id='fontello-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/fontello.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='stylesheet-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/style.css?ver=1.0' type='text/css' media='all' />
        <link rel='stylesheet' id='skeleton-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/skeleton.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='responsive-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/responsive.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='contact-form-7-css'  href='<?php echo $mimksite->sitename; ?>/style/contact-form.css?ver=4.3.1' type='text/css' media='all' />
        <link rel='stylesheet' id='js_composer_front-css'  href='<?php echo $mimksite->sitename; ?>/style/js_composer.css?ver=4.7.4' type='text/css' media='all' />
        <link rel='stylesheet' id='mink-style-css'  href='<?php echo $mimksite->sitename; ?>/style/stylesheet.css' type='text/css' media='all' />
    </head>
    <body>
        <!-- Form Code Start -->
        <div id='main' class='rounded'><center></br>
                <div class ='container'>
                    <div class='logo aligncenter'>
                        <img src="img/logo5.png" alt="Portall" />
                    </div>
                    </br><div id="no-title"></div>
                    </br>
<?php
if($success){
?>
<h2>Uw wachtwoord is succesvol hersteld.</h2>
Uw nieuwe wachtwoord is verzonden naar uw e-mail adres.
<?php
}else{
?>
<h2>Fout</h2>
<span class='error'><?php echo $mimksite->GetErrorMessage(); ?></span>
<?php
}
?>
                </div></div>

</body>
</html>