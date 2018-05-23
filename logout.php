<?PHP
require_once(__DIR__ .'/incl/config.php'); 

$mimksite->LogOut();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
        <title>Portall</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/favicon.png">
        <link rel='stylesheet' id='fontello-css'  href='h<?php echo $mimksite->sitename; ?>/style/energy/fontello.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='stylesheet-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/style.css?ver=1.0' type='text/css' media='all' />
        <link rel='stylesheet' id='skeleton-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/skeleton.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='responsive-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/responsive.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='contact-form-7-css'  href='<?php echo $mimksite->sitename; ?>/style/contact-form.css?ver=4.3.1' type='text/css' media='all' />
        <link rel='stylesheet' id='js_composer_front-css'  href='<?php echo $mimksite->sitename; ?>/style/js_composer.css?ver=4.7.4' type='text/css' media='all' />
        <link rel='stylesheet' id='mink-style-css'  href='<?php echo $mimksite->sitename; ?>/style/stylesheet.css' type='text/css' media='all' />
</head>
<body>
<div id='main' class='rounded'><center></br>
        <div class='container'>
<h2>U bent uitgelogd</h2>
<p>
<a href='index.php'>Opnieuw inloggen</a>
</p>
</div>
    </center></div>
</body>
</html>