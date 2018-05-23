<?php
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
        <meta charset='UTF-8' />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="img/favicon.png">
        <link rel='stylesheet' id='fontello-css'  href='<?php echo $mimksite->sitename; ?>/style/energy/fontello.css?ver=1' type='text/css' media='all' />
        <!-- <link rel='stylesheet' id='FontAwesome-css'  href='http://localhost/mimk/style/wp-content/themes/energy/framework/css/font-icons/awesome-font/css/font-awesome.min.css?ver=4.1' type='text/css' media='all' /> -->
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
                        <a href='praktijken.php'><img src='img/logo5.png' alt='Portall' /></a>
                    </div></br></br>
                    <div>"; echo $Message; echo "</div>
<form id='submitFrm' action='praktijken.php?addcommit' method='post' class='wpcf7-form' novalidate='novalidate'>
<div id='no-title'></div>
<h2>Toevoegen Relatie</h2>
<div id='no-title'></div>
</br></br>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<div><span class='error'>"; echo $mimksite->GetErrorMessage(); echo "</span></div>
<table width='100%'>
<td width='50%' valign='top'><strong>Relatie naam</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap organisatie'>
        <input type='text' name='organisatie' id='organisatie' value='' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false'/>
    </span>
    <span id='praktijkadd_organisatie_errorloc' class='error'></span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Adres</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Straat'>
    <input type='text' name='straat' id='straat' value='' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false' />
    </span>
    <span id='praktijkdd_straat_errorloc' class='error'></span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Huisnummmer</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap huisnummer'>
        <input type='text' name='huisnummer' id='huisnummer' value='' size='10' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false' />
    </span>
    <span id='praktijkadd_huisnummer_errorloc' class='error'></span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Huisnummer Toevoeging</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap huisnummer_toev'>
        <input type='text' name='huisnummer_toev' value='' size='10' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
    <span id='praktijkadd_huisnummer_toev_errorloc' class='error'></span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Postcode</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap postcode'>
        <input type='text' name='postcode' id='postcode' value='' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false' />
    </span>
    <span id='praktijkadd_postcode_errorloc' class='error'></span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Plaats</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap plaatsnaam'>
        <input type='text' name='plaatsnaam' value='' size='6' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false' />
    </span>
    <span id='praktijkadd_plaatsnaam_errorloc' class='error'></span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Telefoonnummer</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap telefoonnummer'>
        <input type='text' name='telefoonnummer' value='' size='6' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
    <span id='praktijkadd_telefoonnummer_errorloc' class='error'></span>
</td>
</tr>
<tr>
<td width='50%' valign='top'></td>
<td width='50%' align='right'><BR><BR>
            <input type='submit' value='Opslaan' class='wpcf7-form-control wpcf7-submit' /></td>
</tr>
</table>
</form>   ";
}

if(isset($_GET['addcommit']))  {

        if(isset($_POST['submitted']))
            {
                    if($mimksite->RegisterPraktijk())
                        {
                        $mimksite->HandleError("Inserting to Database OK!");
                        $mimksite->RedirectToURL("praktijken.php");
                    }
                    $mimksite->HandleError("Inserting to Database failed!");
                    $mimksite->RedirectToURL("praktijken.php");
            }
            $mimksite->HandleError("Inserting to Database failed!");
            $mimksite->RedirectToURL("praktijken.php");
    }

if(isset($_GET['edit'])) {
    
    echo "
        <body>
<div id='main' class='rounded'>
    <center></br>
    <div class='container'>
                    <div class='logo aligncenter'>
                        <a href='praktijken.php'><img src='img/logo5.png' alt='Portall' /></a>
                    </div></br></br>
                    <div>"; echo $Message; echo "</div>
<form action='praktijken.php?edit2' method='POST' class='wpcf7-form' novalidate='novalidate'>
<div id='no-title'></div>
<h2>Wijzigen Relatie</h2>
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
      
    $InputOrganisatie = $_POST['organisatieNaam'];
    $PraktijkData = $mimksite->DisplayOrganisations($InputOrganisatie);
    
    echo " <body>
<div id='main' class='rounded'>
    <center></br>
    <div class='container'>
     <div><span class='error'>"; echo $mimksite->GetErrorMessage(); echo"</span></div>
                    <div class='logo aligncenter'>
                        <a href='praktijken.php'><img src='img/logo5.png' alt='Portall' /></a>
                    </div></br></br>
                    <div>"; echo $Message; echo "</div>
<form id='submitFrm' action='praktijken.php?editcommit' method='post' class='wpcf7-form' novalidate='novalidate'>
<input type='hidden' name='CarryOrganisatie' value=$InputOrganisatie>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<div id='no-title'></div>
<h2>Wijzigen Relatie</h2>
<div id='no-title'></div>
</br></br>
<table width='100%'>
<td width='50%' valign='top'><strong>Selecteer Relatie</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap organisatie'>
        <input type='text' name='organisatie' value='"; echo  $PraktijkData['organisatie']; echo "' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Adres</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap straat'>
        <input type='text'name='straat' id='straat' value='"; echo $PraktijkData['straat']; echo "' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false'/>
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Huisnummer</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap Huisnummer'>
        <input type='text' name='huisnummer' value='"; echo $PraktijkData['huisnummer']; echo "' size='10' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Huisnummer Toevoeging</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap huisnummer_toev'>
        <input type='text' name='huisnummer_toev' value='"; echo $PraktijkData['huisnummer_toev']; echo "' size='10' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Postcode</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap postcode'>
        <input type='text' name='postcode' value='"; echo $PraktijkData['postcode']; echo "' size='40' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Plaats</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap plaatsnaam'>
        <input type='text' name='plaatsnaam' value='"; echo $PraktijkData['plaatsnaam']; echo "' size='6' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>
<tr>
<td width='50%' valign='top'><strong>Telefoon</strong></td>
<td width='50%'>
    <span class='wpcf7-form-control-wrap telefoonnummer'>
        <input type='text' name='telefoonnummer' value='"; echo $PraktijkData['telefoonnummer']; echo "' size='6' class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' aria-invalid='false' />
    </span>
</td>
</tr>

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
                if($mimksite->EditPraktijk())
                    {                    
                    $mimksite->RedirectToURL("praktijken.php");
                }
            }
    }

if(!isset($_GET['add'])&& !isset($_GET['edit'])&& !isset($_GET['edit2'])) {
    //* Default 
    echo "<body>
<div id=\"main\" class=\"rounded\">
    <center></br>
    <div class=\"container\">
        <div class=\"logo aligncenter\">
            <img src=\"img/logo5.png\" alt=\"Portall\" />
        </div></br>
        <h2>Relaties</h2>
        <div id=\"no-title\"></div
    <p>
        <div id=\"\" class=\"wpb_row row-fluid  \" style=\"margin-bottom: 0px;\">
            <div class=\"container\">
               <!-- verkleind de ruimte tussen de grijze kaders --><div class=\"wpb_column vc_column_container vc_col-sm-12\">
                <div><span class='error'>"; echo $mimksite->GetErrorMessage(); echo $errormessage; echo "</span></div>
                    <div class=\"wpb_wrapper\">
                            <h2 class=\"wpb_call_text\"> </h2>
                            <a class=\"wpb_button_a\" href=\"praktijken.php?add\">
                                <span class=\"wpb_button  wpb_btn-danger wpb_regularsize wpb_arrow\">Toevoegen 
                                    <i class=\"icon\"> </i>
                                </span>
                            </a>
                                                        <h2 class=\"wpb_call_text\"> </h2>
                            <a class=\"wpb_button_a\" href=\"praktijken.php?edit\">
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
    
