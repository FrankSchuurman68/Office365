<?PHP //
require_once(__DIR__ .'/incl/config.php'); 

$emailsent = false;
if(isset($_POST['submitted']))
{
   if($mimksite->EmailResetPasswordLink())
   {
        $mimksite->RedirectToURL("reset-pwd-link-sent.html");
        exit;
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
        <title>Portall</title>
        <meta charset='UTF-8' />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="img/favicon.png">
        <link rel='stylesheet' id='fontello-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/fontello.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='stylesheet-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/style.css?ver=1.0' type='text/css' media='all' />
        <link rel='stylesheet' id='skeleton-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/skeleton.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='responsive-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/responsive.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='contact-form-7-css'  href='<?php echo $mimksite->sitename; ?>/style/contact-form.css?ver=4.3.1' type='text/css' media='all' />
        <link rel='stylesheet' id='js_composer_front-css'  href='<?php echo $mimksite->sitename; ?>/style/js_composer.css?ver=4.7.4' type='text/css' media='all' />
        <link rel='stylesheet' id='mink-style-css'  href='<?php echo $mimksite->sitename; ?>/style/stylesheet.css' type='text/css' media='all' />
        <script type='text/javascript' src='<?php echo $mimksite->sitename; ?>/scripts/gen_validatorv31.js'></script>
</head>
<body>
            <div id='main' class='rounded'><center></br>
                <div class ='container'>
                    <div class='logo aligncenter'>
                        <img src="img/logo5.png" alt="Portall" />
                    </div>
                    </br><div id="no-title"></div>
                    </br>
<!-- Form Code Start -->
<form id='resetreq' action='<?php echo $mimksite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Reset Wachtwoord</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* verplichte velden</div><br />

<div><span class='error'><?php echo $mimksite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='username' >Uw e-mail adres*:</label>
    <input type='text' name='email' id='email' value='<?php echo $mimksite->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='resetreq_email_errorloc' class='error'></span>
</div>
<div class='short_explanation'>Wij sturen een link om uw wachtwoord te resetten naar uw e-mail adres</div><br />
<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>     </div></center>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("resetreq");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("email","req","Vul het e-mail adres in waarmee u bent geregistreerd.");
    frmvalidator.addValidation("email","email","Vul het e-mail adres in waarmee u bent geregistreerd.");

// ]]>
</script>

</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</html>