<?PHP
require_once(__DIR__ .'/incl/config.php'); 

if(!$mimksite->CheckLogin())
{
    $mimksite->RedirectToURL("index.php");
    exit;
}

if(isset($_POST['submitted']))
{
   if($mimksite->ChangePassword())
   {
        $mimksite->RedirectToURL("changed-pwd.html");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
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
        <link rel="STYLESHEET" type="text/css" href="<?php echo $mimksite->sitename; ?>/style/pwdwidget.css" />
        <script type='text/javascript' src='<?php echo $mimksite->sitename; ?>/scripts/gen_validatorv31.js'></script>
        <script type="text/javascript" src="<?php echo $mimksite->sitename; ?>/scripts/pwdwidget.js" ></script>       
</head>
<body>

       <div id='main' class='rounded'><center></br>
                <div class ='container'>
                    <div class='logo aligncenter'>
                        <img src="img/logo5.png" alt="Portall" />
                    </div>
                    </br><div id="no-title"></div>
                    </br>
        <form id='changepwd' action='<?php echo $mimksite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
        <fieldset >
        <legend>Wijzigen Wachtwoord</legend>

        <input type='hidden' name='submitted' id='submitted' value='1'/>

        <div class='short_explanation'>* verplichte velden</div>

        <div><span class='error'><?php echo $mimksite->GetErrorMessage(); ?></span></div>
        <div class='container'>
            <label for='oldpwd' >Oud Wachtwoord*:</label><br/>
            <div class='pwdwidgetdiv' id='oldpwddiv' ></div><br/>
            <noscript>
            <input type='password' name='oldpwd' id='oldpwd' maxlength="50" />
            </noscript>    
            <span id='changepwd_oldpwd_errorloc' class='error'></span>
        </div>

        <div class='container'>
            <label for='newpwd' >Nieuw Wachtwoord*:</label><br/>
            <div class='pwdwidgetdiv' id='newpwddiv' ></div>
            <noscript>
            <input type='password' name='newpwd' id='newpwd' maxlength="50" /><br/>
            </noscript>
            <span id='changepwd_newpwd_errorloc' class='error'></span>
        </div>

        <br/><br/><br/>
        <div class='container'>
            <input type='submit' name='Submit' value='Opslaan' />
        </div>

        </fieldset>
        </form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('oldpwddiv','oldpwd');
    pwdwidget.enableGenerate = false;
    pwdwidget.enableShowStrength=false;
    pwdwidget.enableShowStrengthStr =false;
    pwdwidget.MakePWDWidget();
    
    var pwdwidget = new PasswordWidget('newpwddiv','newpwd');
    pwdwidget.MakePWDWidget();
    
    
    var frmvalidator  = new Validator("changepwd");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("oldpwd","req","Please provide your old password");
    
    frmvalidator.addValidation("newpwd","req","Please provide your new password");

// ]]>
</script>

<p>
<a href='login-home.php'>Terug</a>
</p>

                </div></div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</html>