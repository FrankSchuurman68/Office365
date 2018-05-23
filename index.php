<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(__DIR__ .'/incl/config.php'); 

if(isset($_POST['submitted']))
{
    if($mimksite->Login())
   {
       
        $mimksite->RedirectToURL("login-home.php");
   }
}
?>

<!DOCTYPE html>
 
<html>
    <head>
        <title>Portall Calculator</title>
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
                    <form id='login' action='<?php echo $mimksite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
                    <input type='hidden' name='submitted' id='submitted' value='1'/>
                    <div><span class='error'><?php echo $mimksite->GetErrorMessage(); ?></span></div>
                    <table>
                        <tr>
                        <td valign="top"><strong>Loginnaam:</strong></td>
                        <td ><input type="text" name="username"  size="40"/></span></td>
                        </tr>
                        <tr>
                        <td valign="top"><strong>Wachtwoord:</strong></td>
                        <td ><input type="password" name="password" size="40"/></span></td>
                        </tr>
                        <tr><td align="center"><input type="submit" name="submit" value="Inloggen"></td></tr>
                    </table>
                    <div class='short_explanation'><a href='reset-pwd-req.php'>Wachtwoord vergeten?</a></div>
                    </br></br>
                    </form>
                </div></center>
            
<!-- client-side Form Validations:
    Uses the excellent form validation script from JavaScript-coder.com
-->

<script type='text/javascript'>
// <![CDATA[
    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("username","req","Please provide your username");
    
    frmvalidator.addValidation("password","req","Please provide the password");
// ]]>
</script>
        </div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->
    </body>
</html>