<?PHP
require_once(__DIR__ .'/incl/config.php'); 

$Message = 'Om terug te keren, klik op het logo.';
if(!$mimksite->CheckLogin())
{
    $mimksite->RedirectToURL("index.php");
    exit;
}

if(isset($_POST['submitted']))
{
    if (!$_POST['Organisatie'] == '0') 
        {
        if($mimksite->RegisterMelding())
            {
            $mimksite->RedirectToURL("melding.php?success");
            }
        $mimksite->RedirectToURL("melding.php?failed");
        }
    $mimksite->RedirectToURL("melding.php?failed");
}

if(isset($_GET['failed']))  {
    $Message = "Helaas is er iets mis gegaan. Neem Contact op met de Servicedesk op servicedesk@WilroffReitsma.nl.  Onze excuses voor het ongemak.</br></br> Klik <a href=login-home.php>hier</a> om terug te keren.";   

}

if(isset($_GET['success']))  {
    $Message= "Offerte is toegevoegd. </br>Klik <a href=login-home.php>hier</a> om terug te keren.";

}
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <title>Portall Calculator</title>
        <meta charset='UTF-8'/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="img/favicon.png" />
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
<body>
<div id='main' class='rounded'>
    <center><br />
    <div class='container'>
        
                    <div class='logo aligncenter'>
                        <a href='login-home.php'><img src="img/logo5.png" alt="Offerte Tool" /></a>
                    </div><br /><br />
                    <div><?php echo $Message; ?></div>
<form action='<?php echo $mimksite->GetSelfScript(); ?>' method='post' class="wpcf7-form" novalidate="novalidate" id="submitFrm">

<div id="no-title"></div>
<h2>Invoeren Offerte</h2>
<div id="no-title"></div>
<br /><br />
<input type='hidden' name='submitted' id='submitted' value='1'/>
<table width="100%">
<tr>
    <td width="50%" valign="top"><strong><label for ='Organisatie' >Selecteer Klant</label></strong></td>
<td width="50%">
    <span class="wpcf7-form-control-wrap Organisatie">
        <select name="Organisatie" id='Organisatie' class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required required" aria-required="true" aria-invalid="false">
            <?php echo $mimksite->OptionOrganisations(); ?>
        </select>
    </span>
</td>
</tr>
<tr>
    <td width="50%" valign="top"><strong><label for ='Zorgverlener'>Naam zorgverlener (max. 40 tekens)</label></strong></td>
<td width="50%">
    <span class="wpcf7-form-control-wrap Zorgverlener">
        <input type="text" id="Zorgverlener" name="Zorgverlener" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required required" aria-required="true" aria-invalid="false" maxlength="40" />
    </span>
</td>
</tr>
<tr>
    <td width="50%" valign="top"><strong><label for ='Geslacht'>Geslacht patiënt</label></strong></td>
<td width="50%">
    <span class="wpcf7-form-control-wrap Geslacht">
        <select name="Geslacht" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required required" aria-required="true" aria-invalid="false">
            <option value="Man">Man</option>
            <option value="Vrouw">Vrouw</option>
        </select>
    </span></td>
</tr>
<tr>
<td width="50%" valign="top"><strong><label for ='Geboortedatum' >Geboortedatum patiënt</label></strong></td>
<td width="50%">
    <span class="wpcf7-form-control-wrap Geboortedatum">
        <input type="text" name="Geboortedatum" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required required" aria-required="true" aria-invalid="false" placeholder="DD - MM - JJJJ" maxlength="10"/></span></td>
</tr>
<tr>
<td width="50%" valign="top"><strong><label for ='Ingangsklacht'>Ingangsklacht</label></strong></td>
<td width="50%">
    <span class="wpcf7-form-control-wrap Ingangsklacht">
        <select name="Ingangsklacht" class="required" aria-required="true" aria-invalid="false">
            <option value="Huid">Huid</option>
            <option value="Brandwond">Brandwond</option>
            <option value="Wond">Wond</option>
            <option value="Oogklachten">Oogklachten</option>
            <option value="Oorklachten">Oorklachten</option>
            <option value="Trauma extremiteiten">Trauma extremiteiten</option>
            <option value="Anders">Anders</option>
        </select>
        </span><br>Anders? Vul hier de ingangsklacht in. (max. 40 tekens) 
        <span class="wpcf7-form-control-wrap IKAnders">
            <input type="text" name="IKAnders" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" maxlength="40" />
        </span>
    </br> </td>
</tr>
<tr>
<td width="50%" valign="top"><strong><label for ='ToegevWaarde' >Toegevoegde waarde?</label></strong></td>
<td width="50%">
    <span class="wpcf7-form-control-wrap ToegevWaarde">
        <select name="ToegevWaarde" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required required" aria-required="true" aria-invalid="false">
            <option value="">---</option>
            <option value="Ja - Consult voorkomen">Ja - Consult voorkomen</option>
            <option value="Ja - Visite voorkomen">Ja - Visite voorkomen</option>
            <option value="Ja - Betere diagnose">Ja - Betere diagnose</option>
            <option value="Ja - Door beeld toch hogere urgentie">Ja - Door beeld toch hogere urgentie</option>
            <option value="Ja - Overige (Toelichting in opmerkingen veld)">Ja - Overige (Toelichting in opmerkingen veld)</option>
            <option value="-----------------------------------------------------------------">-----------------------------------------------------------------</option>
            <option value="Nee - Consult toch noodzakelijk">Nee - Consult toch noodzakelijk</option>
            <option value="Nee - Niet voldoende zichtbaar">Nee - Niet voldoende zichtbaar</option>
            <option value="Nee - Bij patiënt komt de verbinding niet tot stand">Nee - Bij patiënt komt de verbinding niet tot stand</option>
            <option value="Nee - Bij zorgverlener komt de verbinding niet tot stand">Nee - Bij zorgverlener komt de verbinding niet tot stand</option>
            <option value="Nee - Overige (Toelichting in opmerkingen veld)">Nee - Overige (Toelichting in opmerkingen veld)</option>
        </select>
    </span></td>
</tr>
<tr>
<td width="50%" valign="top"><strong>Toelichting / Opmerkingen (max. 500 tekens)</strong></td>
<td width="50%">
    <span class="wpcf7-form-control-wrap Toelichting">
        <textarea name="Toelichting" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea " aria-invalid="false" maxlength="500"></textarea>
    </span></td>
</tr>
<tr>
<td width="50%" valign="top"></td>
<td width="50%" align="right"><BR></BR>
            <input type="submit" value="Opslaan" class="wpcf7-form-control wpcf7-submit" /></td>
</tr>
</table>
</form>
   

	<div id="copyright" class="clearfix">
		<div class="container wrap-table">
			
			<div class="copyright-text cell nine columns">
                            © WilroffReitsma B.V. <br></br>
Vragen of opmerkingen?<br/>
Mail ons via <a href="mailto:servicedesk@WilroffReitsma.nl">Servicedesk@WilroffReitsma.nl</a>							</div>
			
						
		</div>
	</div><!-- end copyright -->
                
</div>
</center>
</div>

    
</body>
</html>