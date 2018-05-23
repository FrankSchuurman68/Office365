<?PHP
require_once(__DIR__ .'/incl/config.php'); 

$Message = 'Om terug te keren, klik op het logo.';
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
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='shortcut icon' href='img/favicon.png'>
        <link rel='stylesheet' id='fontello-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/fontello.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='stylesheet-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/style.css?ver=1.0' type='text/css' media='all' />
        <link rel='stylesheet' id='skeleton-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/skeleton.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='responsive-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/responsive.css?ver=1' type='text/css' media='all' />
        <link rel='stylesheet' id='contact-form-7-css'  href='<?php echo $mimksite->sitename; ?>/style/contact-form.css?ver=4.3.1' type='text/css' media='all' />
        <link rel='stylesheet' id='js_composer_front-css'  href='<?php echo $mimksite->sitename; ?>/style/js_composer.css?ver=4.7.4' type='text/css' media='all' />
        <link rel='stylesheet' id='mink-style-css'  href='<?php echo $mimksite->sitename; ?>/style/stylesheet.css' type='text/css' media='all' />
        <script type="text/javascript" src="<?php echo $mimksite->sitename; ?>/libs/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $mimksite->sitename; ?>/libs/jquery.validate.min.js"></script>
        <script type="text/javascript"> 
            $(document).ready(function(){ 
                $("#submitFrm").validate(); 
            }); 
        </script>
        </head>
  
<?php  

if(isset($_GET['add'])) {
    echo " 
        <body>
<div id='main' class='rounded'>
    <center></br>
    <div class='container'>
                    <div class='logo aligncenter'>
                        <a href='medewerkers.php'><img src='img/logo5.png' alt='Portall' /></a>
                    </div></br></br>
                    <div>"; echo $Message; echo "</div>
<form action='medewerkers.php?addcommit' method='post' class='wpcf7-form' novalidate='novalidate' id=\"submitFrm\">
<div id='no-title'></div>
<h2>Toevoegen gebruiker</h2>
<div id='no-title'></div>
</br></br>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<div><span class='error'>"; echo $mimksite->GetErrorMessage(); echo "</span></div>
<table width='100%'>
<td width='50%' valign='top'><strong>Selecteer Relatie</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap organisatie'>
        <select name='organisatie' id='organisatie' class='wpcf7-form-control wpcf7-select wpcf7-validates-as-required' aria-required='true' aria-invalid='false'>";
    echo $mimksite->OptionOrganisations();
echo "        </select>
    
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Volledige Naam</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap naam'>
    <input type='text' name='naam' id='naam' value='' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Gebruikersnaam</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Gebruikersnaam'>
        <input type='text' name='gebruikersnaam' id='gebruikersnaam' value='' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>E-mail adres</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap emailadres'>
        <input type='text' name='emailadres' value='' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required email' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Telefoonnummer</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Telefoonnummer'>
        <input type='text' name='telefoonnummer' value='' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Autotask Relatienummer</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Zorgverlenersnummer'>
        <input type='text' name='zorgverlenersnummer' value='' size='6' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>

<tr>
<td width='50%' valign='top'><strong>Wachtwoord</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Wachtwoord'>
        <input type='password' name='wachtwoord' value='' size='6' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Export Rechten</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap export'>
        <input type='hidden' name='export' value='0'>
        <input type='checkbox' name='export' value='1' size='6' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'></td>
<td width='50%' align='right'><BR><BR>
            <input type='submit' value='Opslaan' class='wpcf7-form-control wpcf7-submit' /></td>
</tr>
</table>
</form>

   ";
}

if(isset($_GET['addcommit']))  {
    
        if(isset($_POST['submitted']))
            {
            if ($_POST['organisatie'] == '0') 
                {
                   
                    if($mimksite->RegisterPerson())
                        {
                        $mimksite->HandleErrors("Toevoegen niet gelukt");
                    }
                $mimksite->HandleErrors("Geen Praktijk gekozen");
                }

            }
    }

if(isset($_GET['edit'])) {
    
    
    echo "
        <body>
<div id='main' class='rounded'>
    <center></br>
    <div class='container'>
                    <div class='logo aligncenter'>
                        <a href='medewerkers.php'><img src='img/logo5.png' alt='Portall' /></a>
                    </div></br></br>
                    <div>"; echo $Message; echo "</div>
<form action='medewerkers.php?edit2' method='POST' class='wpcf7-form' novalidate='novalidate'>
<div id='no-title'></div>
<h2>Wijzigen gebruiker</h2>
<div id='no-title'></div>
</br></br>
<table width='100%'>
<td width='50%' valign='top'><strong>Selecteer Relatie</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Organisatie'>
        <select name='organisatieNaam' id='organisatieNaam' class='wpcf7-form-control wpcf7-select wpcf7-validates-as-required' aria-required='true' aria-invalid='false'>";
            echo $mimksite->OptionOrganisations();
echo "
        </select>
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'></td>
<td width='50%' align='right'><BR><BR>
            <input type='submit' value='Volgende' class='wpcf7-form-control wpcf7-submit' /></td>
</tr>
</table>
</form>
   ";
} 

if(isset($_GET['edit2'])) {
    
    if(!isset($_POST['organisatieNaam'])) {
        $mimksite->RedirectToURL("$mimksite->sitename/medewerkers.php");
    }
    
    if($_POST['organisatieNaam']=='0') {
        $mimksite->RedirectToURL("$mimksite->sitename/medewerkers.php");
    }
        
    $InputOrganisatie = $_POST['organisatieNaam'];
    $PraktijkData = $mimksite->DisplayOrganisations($InputOrganisatie);
    
    echo "
        <body>
<div id='main' class='rounded'>
    <center></br>
    <div class='container'>
                    <div class='logo aligncenter'>
                        <a href='medewerkers.php'><img src='img/logo5.png' alt='Portall' /></a>
                    </div></br></br>
                    <div>"; echo $Message; echo "</div>
<form action='medewerkers.php?edit3' method='post' class='wpcf7-form' novalidate='novalidate' id='submitFrm'>
<input type='hidden' name='CarryOrganisatie' value=$InputOrganisatie>
<div id='no-title'></div>
<h2>Wijzigen gebruiker "; echo $InputOrganisatie; echo "</h2>
<div id='no-title'></div>
</br></br>
<table width='100%'>
<td width='50%' valign='top'><strong>Selecteer Relatie</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Organisatie'>
        <input type='text' name='organisatie' value='";
    echo $PraktijkData['organisatie'];
    echo "' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' disabled/>
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Volledige Naam</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap naam'>
        <select name='naam' id='volledigenaam' class='wpcf7-form-control wpcf7-select wpcf7-validates-as-required' aria-required='true' aria-invalid='false'>";
    echo $mimksite->OptionPersons($InputOrganisatie);
echo "        </select></span>
</td>
</tr>

<tr>
<td width='50%' valign='top'></td>
<td width='50%' align='right'><BR><BR>
            <input type='submit' value='Volgende' class='wpcf7-form-control wpcf7-submit' /></td>
</tr>
</table>
</form>
   ";
} 

if(isset($_GET['edit3'])) {
    
    
    if(!isset($_POST['naam'])) {
        $mimksite->RedirectToURL("$mimksite->sitename/medewerkers.php?edit");
    }
    
    $InputOrganisatie = $_POST['CarryOrganisatie'];
    $InputPerson = $_POST['naam'];
    
    $PersonData = $mimksite->DisplayPersons($InputPerson);
    $PraktijkData = $mimksite->DisplayOrganisations($InputOrganisatie);
    
    if($PersonData['export'] == "1") {
        $export_checked = "checked"; 
    }
    
    echo " <body>
<div id='main' class='rounded'>
    <center></br>
    <div class='container'>
     <div><span class='error'>"; echo $mimksite->GetErrorMessage(); echo"</span></div>
                    <div class='logo aligncenter'>
                        <a href='medewerkers.php'><img src='img/logo5.png' alt='Portall' /></a>
                    </div></br></br>
                    <div>"; echo $Message; echo "</div>
<form action='medewerkers.php?editcommit' method='post' class='wpcf7-form' novalidate='novalidate' id='submitFrm'>
<input type='hidden' name='CarryOrganisatie' value=$InputOrganisatie>
<input type='hidden' name='CarryPerson' value=$InputPerson>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<div id='no-title'></div>
<h2>Wijzigen gebruiker</h2>
<div id='no-title'></div>
</br></br>
<table width='100%'>
<td width='50%' valign='top'><strong>Selecteer Reletie</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Organisatie'>
        <input type='text' name='organisatie' value='";
            echo $PraktijkData['organisatie']; echo "' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' disabled/>
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Volledige Naam</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap naam'>
        <input type='text'name='naam' id='volledigenaam' value='"; echo $PersonData['name']; echo "' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false'/>
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Gebruikersnaam</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap gebruikersnaam'>
        <input type='text' name='gebruikersnaam' value='"; echo $PersonData['username']; echo "' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>E-mail adres</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap emailadres'>
        <input type='text' name='emailadres' value='"; echo $PersonData['email']; echo "' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Telefoonnummer</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Telefoonnummer'>
        <input type='text' name='telefoonnummer' value='"; echo $PersonData['phone_number']; echo "' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Autotask relatienummer</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Zorgverlenersnummer'>
        <input type='text' name='zorgverlenersnummer' value='"; echo $PersonData['zorgverlenersnummer']; echo "' size='6' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Wachtwoord</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Wachtwoord'>
        <input type='text' name='wachtwoord' value='' size='6' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>

<tr>
<td width='50%' valign='top'><strong>Export</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap export'>
        <input type='hidden' name='export' value='0'>
        <input type='checkbox' name='export' value='1' "; echo $export_checked; echo " size='6' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>

<tr>
<td width='50%' valign='top'><strong>Verwijderen</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap delete'>
        <input type='hidden' name='delete' value='0'>
        <input type='checkbox' name='delete' value='1' size='6' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>

<tr>
<td width='50%' valign='top'></td>
<td width='50%' align='right'><BR><BR>
            <input type='submit' value='Opslaan' class='wpcf7-form-control wpcf7-submit' /></td>
</tr>
</table>
</form>
   ";
} 

if(isset($_GET['editcommit'])) {
        if(isset($_POST['submitted']))
            {
            if ($_POST['CarryOrganisatie'] <> '0') 
                {
                    if($mimksite->EditPerson())
                        {                    
                        $mimksite->RedirectToURL("login-home.php");
                    }
                    $err = "Geen relatie gekozen";
                $mimksite->RedirectToURL("medewerkers.php");
                }

            }
    }

if(!isset($_GET['add'])&& !isset($_GET['edit'])&& !isset($_GET['edit2'])&& !isset($_GET['edit3'])) {
    //* Default 
    echo "<body>
<div id=\"main\" class=\"rounded\">
    <center></br>
    <div class=\"container\">
        <div class=\"logo aligncenter\">
            <img src=\"img/logo5.png\" alt=\"Portall\" />
        </div></br>
        <h2>Medewerkers</h2>
        <div id=\"no-title\"></div
    <p>
        <div id=\"\" class=\"wpb_row row-fluid  \" style=\"margin-bottom: 0px;\">
            <div class=\"container\">
               <!-- verkleind de ruimte tussen de grijze kaders --><div class=\"wpb_column vc_column_container vc_col-sm-12\">
                <div><span class='error'>"; echo $mimksite->GetErrorMessage(); echo "</span></div>
                    <div class=\"wpb_wrapper\">
                            <h2 class=\"wpb_call_text\"> </h2>
                            <a class=\"wpb_button_a\" href=\"medewerkers.php?add\">
                                <span class=\"wpb_button  wpb_btn-danger wpb_regularsize wpb_arrow\">Toevoegen 
                                    <i class=\"icon\"> </i>
                                </span>
                            </a>
                                                        <h2 class=\"wpb_call_text\"> </h2>
                            <a class=\"wpb_button_a\" href=\"medewerkers.php?edit\">
                                <span class=\"wpb_button  wpb_btn-danger wpb_regularsize wpb_arrow\">Wijzigen
                                    <i class=\"icon\"> </i>
                                </span>
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </p>     
        <div id=\"no-title\"></div>
    <p>
        <div id=\"\" class=\"wpb_row row-fluid  \" style=\"margin-bottom: 0px;\">
            <div class=\"container\">
                <div class=\"wpb_column vc_column_container vc_col-sm-12\">
                    <div class=\"wpb_wrapper\">
                            <h2 class=\"wpb_call_text\"> </h2>
                            <a class=\"wpb_button_a\" href=\"admin.php\">
                                <span class=\"wpb_button  wpb_btn-danger wpb_regularsize wpb_arrow\">Terug
                                    <i class=\"icon\"> </i>
                                </span>
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </p>
            ";
                
} 


echo "    
<div id=\"copyright\" class=\"clearfix\">
    <div class=\"container wrap-table\">
        <div class=\"copyright-text cell nine columns\">
            © WilroffReitsma <br>
            Vragen of opmerkingen?<br>
            Mail ons via <a href=\"mailto:servicedesk@WilroffReitsma.nl\">Servicedesk@WilroffReitsma.nl</a>
        </div>
    </div>
</div><!-- end copyright -->


</div>
</center>
</div>
</body>
</html>";
    
