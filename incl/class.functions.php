<?php

// De phpmailer class voor e-mail invoegen. Aangepast voor de sender/from e-mail adrs
require_once(__DIR__ .'/class.phpmailer.php');
// Incidenteel gebruikt bij  wachtwoord. Uitfaseren.
require_once(__DIR__ .'/FormValidator.php');

//de naam van de Class
class MimkSite 
{
    // variabelen voor gebruik binnen de class
    var $admin_email;
    var $from_address;
    
    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
    var $rightstable;
    var $praktijkentable; 
    var $relatietable;
    var $meldingtable;
    public $error_message;
    
    //-----Initialisatie -------
    function Minksite()
    {
        $this->sitename = "https://confrawebapp1.azurewebsites.net/";
        $this->rand_key = '0iQx5oBk66oVZep';
    }
    
    function InitDB($host,$uname,$pwd,$database,$tablename,$rightstable,$praktijkentable,$relatietable,$meldingtable)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
        $this->rightstable = $rightstable;
        $this->praktijkentable = $praktijkentable;
        $this->relatietable = $relatietable;
        $this->meldingtable = $meldingtable;

        
    }
    
    function SetAdminEmail($email)
    {
        $this->admin_email = $email;
    }
    
    function SetServiceDeskEmail($email)
    {
        $this->from_address = $email;
    }
    
    function SetWebsiteName($sitename)
    {
        $this->sitename = $sitename;
    }
    
    function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    
    //-------Hoofd Functies ----------------------
    function RegisterUser()
    {
        // controleer of het form is verstuurd met submit
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        // Maak een Array
        $formvars = array();
        
        if(!$this->ValidateRegistrationSubmission())
        {
            return false;
        }
        
        $this->CollectRegistrationSubmission($formvars);
        
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
        
        if(!$this->SendUserConfirmationEmail($formvars))
        {
            return false;
        }

        $this->SendAdminIntimationEmail($formvars);
        
        return true;
    }
    
    function RegisterPerson()
    {
        // controleer of het form is verstuurd met submit
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        // Maak een Array
        $formvars = array();
        
        $this->CollectRegistrationSubmissionPerson($formvars);
       
              
        if(!$this->SaveToDatabasePerson($formvars))
        {
            return false;
        }
             
        return true;
    }
    
    function RegisterPraktijk()
    {
        // controleer of het form is verstuurd met submit
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        // Maak een Array
        $formvars = array();
        
        $this->CollectRegistrationSubmissionPraktijk($formvars);
        
        if(!$this->SaveToDatabasePraktijk($formvars))
        {
            return false;
        }
    return true;
    }
    
    
    function RegisterMelding()
    {
        // controleer of het form is verstuurd met submit
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        // Maak een Array
        $formvars = array();
        
        $this->CollectRegistrationSubmissionMelding($formvars);
        
        if(!$this->SaveToDatabaseMelding($formvars))
        {
            return false;
        }
             
        return true;
    }
    
    function EditPerson()
    {
        // controleer of het form is verstuurd met submit
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        // Maak een Array
        $formvars = array();
               
        $this->CollectRegistrationSubmissionPerson($formvars);
        
        $formvars['edit'] = "1";
               
        if(!$this->SaveToDatabasePerson($formvars))
        {
            return false;
        }
             
        return true;
    }
    
    function EditPraktijk()
    {
        // controleer of het form is verstuurd met submit
        if(!isset($_POST['submitted']))
        {
           return false;
        }
        
        // Maak een Array
        $formvars = array();
               
        $this->CollectRegistrationSubmissionPraktijk($formvars);
        
        $formvars['edit'] = "1";
               
        if(!$this->SaveToDatabasePraktijk($formvars))
        {
            return false;
        }
             
        return true;
    }

    function ConfirmUser()
    {
        if(empty($_GET['code'])||strlen($_GET['code'])<=10)
        {
            $this->HandleErrors("Geef de juiste bevestigingscode");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmation($user_rec))
        {
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        
        $this->SendAdminIntimationOnRegComplete($user_rec);
        
        return true;
    }    
    
    function Login()
    {
        if(empty($_POST['username']))
        {
            $this->HandleErrors("Gebruikersnaam is leeg!");
            return false;
        }
        
        if(empty($_POST['password']))
        {
            $this->HandleErrors("Wachtwoord is leeg!");
            return false;
        }
        
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->CheckLoginInDB($username,$password))
        {
            return false;
        }
        
        $_SESSION[$this->GetLoginSessionVar()] = $username;
        
        return true;
    }
    
    function CheckLogin()
    {
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar]))
         {
            return false;
         }
         return true;
    }
    
    function UserFullName()
    {
        return isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:'';
    }
    
    function UserEmail()
    {
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }
    
    function LogOut()
    {
        session_start();
        
        $sessionvar = $this->GetLoginSessionVar();
        
        $_SESSION[$sessionvar]=NULL;
        
        unset($_SESSION[$sessionvar]);
    }
    
    function EmailResetPasswordLink()
    {
        if(empty($_POST['email']))
        {
            $this->HandleErrors("Email is leeg!");
            return false;
        }
        $user_rec = array();
        if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
        {
            return false;
        }
        if(false === $this->SendResetPasswordLink($user_rec))
        {
            return false;
        }
        return true;
    }
    
    function ResetPassword()
    {
        if(empty($_GET['email']))
        {
            $this->HandleErrors("Email is leeg!");
            return false;
        }
        if(empty($_GET['code']))
        {
            $this->HandleErrors("Reset code is leeg!");
            return false;
        }
        $email = trim($_GET['email']);
        $code = trim($_GET['code']);
        
        if($this->GetResetPasswordCode($email) != $code)
        {
            $this->HandleErrors("Foutieve reset code!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($email,$user_rec))
        {
            return false;
        }
        
        $new_password = $this->ResetUserPasswordInDB($user_rec);
        if(false === $new_password || empty($new_password))
        {
            $this->HandleErrors("Fout bij updaten nieuw wachtwoord");
            return false;
        }
        
        if(false == $this->SendNewPassword($user_rec,$new_password))
        {
            $this->HandleErrors("Fout bij sturen nieuw wachtwoord");
            return false;
        }
        return true;
    }
    
    function ChangePassword()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleErrors("Niet aangemeld!");
            return false;
        }
        
        if(empty($_POST['oldpwd']))
        {
            $this->HandleErrors("Oud Wachtwoord is leeg!");
            return false;
        }
        if(empty($_POST['newpwd']))
        {
            $this->HandleErrors("Nieuw Wachtwoord is leeg!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
        
        $pwd = trim($_POST['oldpwd']);
        
        if($user_rec['password'] != md5($pwd))
        {
            $this->HandleErrors("Het oude wachtwoord komt niet overeen!");
            return false;
        }
        $newpwd = trim($_POST['newpwd']);
        
        if(!$this->ChangePasswordInDB($user_rec, $newpwd))
        {
            return false;
        }
        return true;
    }
    
    function OptionOrganisations()
        {
        if(!$this->DBLogin())
        {
            $this->HandleErrors("Database aanmelden afgebroken!");
            return false;
        }

        if($_SESSION['adminright'] == 1) {
        
            $qry = "SELECT id, naam FROM $this->praktijkentable";

        } else {
            $praktijk_id = $_SESSION['praktijk'];
            $qry = "SELECT id, naam FROM $this->praktijkentable WHERE $this->praktijkentable.id = $praktijk_id";

        }    
        
        $result = mysqli_query($this->connection,$qry);
        
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleErrors("Fout. Geen Praktijken gevonden.");
            return false;
        }
        
        $Options = "<option value=0>---Kies Praktijk---</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            
            if($row['id']==$_SESSION['praktijk']) {
                $Options .= "<option value='" . $row['id'] . "' selected>" . $row['naam'] . "</option>";
            } else {
                $Options .= "<option value='" . $row['id'] . "'>" . $row['naam'] . "</option>";
            }
        }   
 
        return $Options;
        }
        
    function DisplayOrganisations($Praktijk)
        {
        if(!$this->DBLogin())
        {
            $this->HandleErrors("Database aanmelden afgebroken!");
            return false;
        }          
        $qry = "Select * from $this->praktijkentable WHERE id = $Praktijk";
        
        $result = mysqli_query($this->connection,$qry);
        
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleErrors("Fout. Geen Praktijken gevonden.");
            return false;
        }

        while ($row = mysqli_fetch_assoc($result)) {
// ingebouwd voor toekomstig gebruik            
//            $PraktijkData['id'] = $row['id'];
//            $PraktijkData['praktijknummer'] = $row['praktijknummer'];
//            $PraktijkData['praktijkvolgnummer'] = $row['praktijkvolgnummer'];
            $PraktijkData['organisatie'] = $row['naam'];
            $PraktijkData['telefoonnummer'] = $row['telefoonnummer'];
            $PraktijkData['straat'] = $row['straat'];
            $PraktijkData['huisnummer'] = $row['huisnummer'];
            $PraktijkData['huisnummer_toev'] = $row['huisnummer_toev'];
            $PraktijkData['postcode'] = $row['postcode'];
            $PraktijkData['plaatsnaam'] = $row['plaatsnaam'];
        }   
 
        return $PraktijkData;
        }
            
    function OptionPersons($Praktijk)
        {        
        
        if(!$this->DBLogin())
        {
            $this->HandleErrors("Database aanmelden afgebroken!");
            return false;
        }  
                
        $qry="SELECT users.name, users.id_user FROM users LEFT JOIN relatie ON users.id_user = relatie.id_users WHERE relatie.id_praktijken = $Praktijk"; 
        
        $result = mysqli_query($this->connection,$qry);
        
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleErrors("Fout. Geen Medewerkers gevonden.");
            return false;
        }
        $OptionPersons = "<option value=0>---Kies Persoon---</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $OptionPersons .= "<option value='" . $row['id_user'] . "'>" . $row['name'] . "</option>";
        }   
 
        return $OptionPersons;       

        }
        
    function DisplayPersons($Person)
        {
        if(!$this->DBLogin())
        {
            $this->HandleErrors("Database aanmelden afgebroken!");
            return false;
        }  
                
        $qry="SELECT users.name, users.id_user, users.email, users.phone_number, users.username, users.zorgverlenersnummer, users.password, rights.export FROM users LEFT JOIN rights ON rights.user = users.id_user WHERE users.id_user = $Person"; 
        
        $result = mysqli_query($this->connection,$qry);
        
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleErrors("Fout. Geen Medewerkers gevonden.");
            return false;
        }

        while($row = mysqli_fetch_assoc($result)) {
            $OptionPersons1['id_user'] = $row['id_user'];
            $OptionPersons1['name'] = $row['name'];
            $OptionPersons1['username'] = $row['username'];
            $OptionPersons1['email'] = $row['email'];
            $OptionPersons1['phone_number'] = $row['phone_number'];
            $OptionPersons1['zorgverlenersnummer'] = $row['zorgverlenersnummer'];
            $OptionPersons1['export'] = $row['export'];

            }   
 
        return $OptionPersons1;       

        }
                
    
    //-------Algemene Hulp Functies -------------
    function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    }    
    
    function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }
    
    function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
    
    function GetSpamTrapInputName()
    {
        return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
    }
    
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }    
    //-------Prive Hulp functies-----------
    
    function HandleErrors($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleErrors($err."\r\n mysqlerror:".  mysqli_connect_errno());
        die();
    }
    
    function GetFromAddress()
    {
        if(!empty($this->from_address))
        {
            return $this->from_address;
        }

        $host = $_SERVER['SERVER_NAME'];

        $from ="nobody@$host";
        return $from;
    } 
    
    function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
    
    function CheckLoginInDB($username,$password)
    {
        if(!$this->DBLogin())
        {
            $this->HandleErrors("Database aanmelden afgebroken!");
            return false;
        }          
        $username2 = $this->SanitizeForSQL($username);
        $pwdmd5 = md5($password);
        $qry = "Select id_user, name, email from $this->tablename where username='$username2' and password='$pwdmd5'";
        
        $result = mysqli_query($this->connection,$qry);
        
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleErrors("Fout bij aanmelden. De gebruikersnaam en wachtwoord zijn niet geldig.");
            return false;
        }
        
        $row = mysqli_fetch_assoc($result);
               
        $_SESSION['name_of_user']  = $row['name'];
        $_SESSION['email_of_user'] = $row['email'];
        $_SESSION['user_id'] = $row['id_user'];
        $userid = $row['id_user'];
               
        $rights_qry = "SELECT * FROM $this->rightstable WHERE user = $userid";
        $rights_result = mysqli_query($this->connection,$rights_qry);

        $rights_row = mysqli_fetch_assoc($rights_result);
       
        $_SESSION['adminright']  = $rights_row['admin'];
        $_SESSION['exportright']  = $rights_row['export'];
        
        $relatie_qry = "SELECT * FROM $this->relatietable WHERE id_users = $userid";
        $relatie_result = mysqli_query($this->connection,$relatie_qry);

        $relatie_row = mysqli_fetch_assoc($relatie_result);
       
        $_SESSION['praktijk']  = $relatie_row['id_praktijken'];
        
        return true;
    }
    
    function UpdateDBRecForConfirmation(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleErrors("Database login failed!");
            return false;
        }   
        $confirmcode = $this->SanitizeForSQL($_GET['code']);
        
        $result = mysqli_query($this->connection,"Select name, email from $this->tablename where confirmcode='$confirmcode'");   
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleErrors("Foutieve bevestigingscode.");
            return false;
        }
        $row = mysqli_fetch_assoc($result);
        $user_rec['name'] = $row['name'];
        $user_rec['email']= $row['email'];
        
        $qry = "Update $this->tablename Set confirmcode='y' Where  confirmcode='$confirmcode'";
        
        if(!mysqli_query($this->connection,$qry))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$qry");
            return false;
        }      
        return true;
    }
    
    function ResetUserPasswordInDB($user_rec)
    {
        $new_password = substr(md5(uniqid()),0,10);
        
        if(false == $this->ChangePasswordInDB($user_rec,$new_password))
        {
            return false;
        }
        return $new_password;
    }
    
    function ChangePasswordInDB($user_rec, $newpwd)
    {
        $newpwd2 = $this->SanitizeForSQL($newpwd);
        
        $qry = "Update $this->tablename Set password='".md5($newpwd2)."' Where  id_user=".$user_rec['id_user']."";
        
        if(!mysqli_query( $this->connection, $qry ))
        {
            $this->HandleDBError("Fout bij updaten wachtwoord \nquery:$qry");
            return false;
        }     
        return true;
    }
    
    function GetUserFromEmail($email,&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleErrors("Database inlog mislukt!");
            return false;
        }   
        $email2 = $this->SanitizeForSQL($email);
        
        $result = mysqli_query($this->connection,"Select * from $this->tablename where email='$email2'");  

        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleErrors("Er is geen gebruiker met e-mail: $email2");
            return false;
        }
        $user_rec = mysqli_fetch_assoc($result);

        
        return true;
    }
    
    function SendUserWelcomeEmail(&$user_rec)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'],$user_rec['name']);
        
        $mailer->Subject = "Welkom bij ".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $mailer->Body ="Hello ".$user_rec['name']."\r\n\r\n".
        "Welkom! Uw registratie bij ".$this->sitename." is afgerond.\r\n".
        "\r\n".
        "Met vriendelijke groet,\r\n".
        "Webmaster\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleErrors("Versturen welkom e-mail afgebroken.");
            return false;
        }
        return true;
    }
    
    function SendAdminIntimationOnRegComplete(&$user_rec)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Registratie Afgerond: ".$user_rec['name'];

        $mailer->From = "servicedesk@magikmeekijken.nl";
        $mailer->FromName = "Servicedesk";
        
        $mailer->Body ="Een nieuwe gebruiker is geregisteerd bij ".$this->sitename."\r\n".
        "Naam: ".$user_rec['name']."\r\n".
        "E-mail adres: ".$user_rec['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function GetResetPasswordCode($email)
    {
       return substr(md5($email.$this->sitename.$this->rand_key),0,10);
    }
    
    function SendResetPasswordLink($user_rec)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Uw aanvraag voor een nieuw wachtwoord van http:".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $link = $this->GetAbsoluteURLFolder().
                '/resetpwd.php?email='.
                urlencode($email).'&code='.
                urlencode($this->GetResetPasswordCode($email));

        $mailer->Body ="Goedendag ".$user_rec['name']."\r\n\r\n".
        "Wij hebben een aanvraag ontvangen voor een nieuw wachtwoord op http:".$this->sitename.
        "\r\n".
        "Klik op de link om een nieuw wachtwoord in te stellen: \r\n".$link."\r\n".
        "\r\n".
        "Met vriendelijke groet,\r\n".
        "Servicedesk\r\n".
        "http:" .$this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SendNewPassword($user_rec, $new_password)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['name']);
        
        $mailer->Subject = "Uw nieuwe wachtwoord voor ".$this->sitename;

        $mailer->From = $this->GetFromAddress();
        
        $mailer->Body ="Goedendag ".$user_rec['name']."\r\n\r\n".
        "Uw wachtwoord is succesvol hersteld. ".
        "\r\n".                
        "Hierbij uw inlog gegevens:\r\n".
        "gebruikersnaam:".$user_rec['username']."\r\n".
        "wachtwoord:$new_password\r\n".
        "\r\n".
        "Meld u hier aan: ".$this->GetAbsoluteURLFolder()."/index.php\r\n".
        "\r\n".
        "Met vriendelijke groet,,\r\n".
        "Servicedesk\r\n".
        "http:".$this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }    
    // Functie wordt niet meer gebruikt, fout worden afgehandeld via Jquery
    function ValidateRegistrationSubmission()
   
    {
        
        $validator = new FormValidator();
        $validator->addValidation("name","req","Please fill in Name");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
        $validator->addValidation("email","req","Please fill in Email");
        $validator->addValidation("username","req","Please fill in UserName");
        $validator->addValidation("password","req","Please fill in Password");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleErrors($error);
            return false;
        }        
        return true;
    }
       // Functie wordt niet meer gebruikt, fout worden afgehandeld via Jquery
    function ValidateRegistrationSubmissionPerson()
    {
        
        $validator = new FormValidator();
        $validator->addValidation("naam","req","Vul een naam in");
        $validator->addValidation("emailadres","email","De invoer meot bestaan uit een gelding e-mail adres");
        $validator->addValidation("emailadres","req","Vul een e-mail adres in");
        $validator->addValidation("gebruikersnaam","req","Vul een gebruikersnaam in ");
        $validator->addValidation("wachtwoord","req","Vul een wachtwoord in");
        $validator->addValidation("telefoon","req","Vul een telefoonnummer in");
        $validator->addValidation("zorgverlenersnummer","req","Vul een zorgnummer in");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleErrors($error);
            return false;
        }        
        return true;
    }
       // Functie wordt niet meer gebruikt, fout worden afgehandeld via Jquery
    function ValidateRegistrationSubmissionPraktijk()
    {

        $validator = new FormValidator();
        $validator->addValidation("naam","req","Vul een naam in");
        $validator->addValidation("emailadres","email","De invoer meot bestaan uit een gelding e-mail adres");
        $validator->addValidation("emailadres","req","Vul een e-mail adres in");
        $validator->addValidation("gebruikersnaam","req","Vul een gebruikersnaam in ");
        $validator->addValidation("wachtwoord","req","Vul een wachtwoord in");
        $validator->addValidation("telefoon","req","Vul een telefoonnummer in");
        $validator->addValidation("zorgverlenersnummer","req","Vul een zorgnummer in");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleErrors($error);
            return false;
        }        
        return true;
    }
    
    function CollectRegistrationSubmission(&$formvars)
    {
        $formvars['name'] = $this->Sanitize($_POST['name']);
        $formvars['email'] = $this->Sanitize($_POST['email']);
        $formvars['username'] = $this->Sanitize($_POST['username']);
        $formvars['password'] = $this->Sanitize($_POST['password']);
    }
    
    function CollectRegistrationSubmissionPerson(&$formvars)
    {
        $formvars['name'] = $this->Sanitize($_POST['naam']);
        $formvars['email'] = $this->Sanitize($_POST['emailadres']);
        $formvars['username'] = $this->Sanitize($_POST['gebruikersnaam']);
        $formvars['password'] = $this->Sanitize($_POST['wachtwoord']);
        $formvars['phone_number'] = $this->Sanitize($_POST['telefoonnummer']);
        $formvars['id_praktijken'] = $this->Sanitize($_POST['CarryOrganisatie']);
        $formvars['id_users'] = $this->Sanitize($_POST['CarryPerson']);
        $formvars['zorgverlenersnummer'] = $this->Sanitize($_POST['zorgverlenersnummer']);
        $formvars['export'] = $this->Sanitize($_POST['export']);
        $formvars['organisatie'] = $this->Sanitize($_POST['organisatie']);
        $formvars['delete'] = $this->Sanitize($_POST['delete']);
    }
    
   
    function CollectRegistrationSubmissionMelding(&$formvars)
    {
        $formvars['organisatie'] = $this->Sanitize($_POST['Organisatie']);
        $formvars['zorgverlener'] = $this->Sanitize($_POST['Zorgverlener']);
        $formvars['geslacht'] = $this->Sanitize($_POST['Geslacht']);
        $formvars['geboortedatum'] = $this->Sanitize($_POST['Geboortedatum']);
        $formvars['ingangsklacht'] = $this->Sanitize($_POST['Ingangsklacht']);
        $formvars['ikanders'] = $this->Sanitize($_POST['IKAnders']);
        $formvars['toegevwaarde'] = $this->Sanitize($_POST['ToegevWaarde']);
        $formvars['toelichting'] = $this->Sanitize($_POST['Toelichting']);

    }
    
    function CollectRegistrationSubmissionPraktijk(&$formvars)
    {
//          ingebouwd voor toekomstig gebruik        
//        $formvars['praktijknummer'] = $this->Sanitize($_POST['praktijknummer']);
//        $formvars['praktijkvolgnummer'] = $this->Sanitize($_POST['praktijkvolgnummer']);
        $formvars['id'] = $this->Sanitize($_POST['CarryOrganisatie']);
        $formvars['naam'] = $this->Sanitize($_POST['organisatie']);
        $formvars['telefoonnummer'] = $this->Sanitize($_POST['telefoonnummer']);
        $formvars['straat'] = $this->Sanitize($_POST['straat']);
        $formvars['huisnummer'] = $this->Sanitize($_POST['huisnummer']);
        $formvars['huisnummer_toev'] = $this->Sanitize($_POST['huisnummer_toev']);
        $formvars['postcode'] = $this->Sanitize($_POST['postcode']);
        $formvars['plaatsnaam'] = $this->Sanitize($_POST['plaatsnaam']);
        $formvars['delete'] = $this->Sanitize($_POST['delete']);
    }
    
    function SendUserConfirmationEmail(&$formvars)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'],$formvars['name']);
        
        $mailer->Subject = "Uw registratie op http:".$this->sitename;

        $mailer->From = $this->GetFromAddress();        
        
        $confirmcode = $formvars['confirmcode'];
        
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?code='.$confirmcode;
        
        $mailer->Body ="Goedendag, ".$formvars['name']."\r\n\r\n".
        "Bedankt voor uw aanmelding bij http:".$this->sitename."\r\n".
        "Klik op de onderstaande link om uw registratie te bevestigen.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Met vriendelijke groet,\r\n".
        "Servicedesk\r\n".
        "http:".$this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleErrors("Fout bij verzenden van de registratie bevestigings e-mail.");
            return false;
        }
        return true;
    }
    function GetAbsoluteURLFolder()
    {
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
        $scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
        return $scriptFolder;
    }
    
    function SendAdminIntimationEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Nieuwe registratie: ".$formvars['name'];

        $mailer->From = $this->GetFromAddress();         
        
        $mailer->Body ="Een nieuwe gebruiker bij http:".$this->sitename."\r\n".
        "Naam: ".$formvars['name']."\r\n".
        "E-mail adres: ".$formvars['email']."\r\n".
        "Gebruikersnaam: ".$formvars['username'];
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SaveToDatabasePerson($formvars) 
    {
        if(!$this->DBLogin())
        {
            $this->HandleErrors("Database inlog mislukt!");
            return false;
        }
        
        if($formvars['delete']=='1') 
        {
            if(!$this->DeleteFromDBPerson($formvars))
            {
                $this->HandleErrors("Toevoegen in de database mislukt!");
                return false;
            } else {
                return true;
            }           
        }
        
        if($formvars['edit']=='1') 
        {
            if(!$this->UpdateIntoDBPerson($formvars))
            {
                $this->HandleErrors("Toevoegen in de database mislukt!");
                return false;
            } else {
                return true;
            }           
        }
       

        if(!$this->IsFieldUnique($formvars,'email' ))
        {
            $this->HandleErrors("Dit e-mailadres is al geregistreerd.");
            return false;
        }
        
        if(!$this->IsFieldUnique($formvars,'username'))
        {
            $this->HandleErrors("Deze gebruikersnaam is al gebruikt. Gebruik een andere naam.");
            return false;
        }        
        if(!$this->InsertIntoDBPerson($formvars))
        {
            $this->HandleErrors("Toevoegen in de database mislukt!");
            return false;
        }
        return true;
    }

    
    function SaveToDatabasePraktijk($formvars) 
    {
        if(!$this->DBLogin())
        {
            $this->HandleErrors("Database inlog mislukt!");
            return false;
        }
        
        if($formvars['delete']=='1') 
        {
            if(!$this->DeleteFromDBPraktijk($formvars))
            {
                $this->HandleErrors("Toevoegen in de database mislukt!");
                return false;
            } else {
                return true;
            }           
        }        
       
        if($formvars['edit']=='1') 
        {
            if(!$this->UpdateIntoDBPraktijk($formvars))
            {
                $this->HandleErrors("Toevoegen in de database mislukt!");
                return false;
            } else {
                return true;
            }           
        }
   
        if(!$this->InsertIntoDBPraktijk($formvars))
        {
            $this->HandleErrors("Toevoegen in de database mislukt!");
            return false;
        }
        return true;
    }
    
    function SaveToDatabaseMelding($formvars) 
    {
        if(!$this->DBLogin())
        {
            $this->HandleErrors("Database inlog mislukt!");
            return false;
        }
        
        if(!$this->InsertIntoDBMelding($formvars))
        {
            $this->HandleErrors("Toevoegen in de database mislukt!");
            return false;
        }
        return true;
    }    
    
    function IsFieldUnique($formvars,$fieldname)
    {
        $field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $qry = "select username from $this->tablename where $fieldname='".$field_val."'";
        $result = mysqli_query($this->connection,$qry);   
        if($result && mysqli_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }
    
    function IsPraktijkUnique($formvars,$postcode, $huisnummer)
    {
        $postcode_val = $this->SanitizeForSQL($formvars[$postcode]);
        $huisnummer_val = $this->SanitizeForSQL($formvars[$huisnummer]);
        $qry = "select naam from $this->praktijktable where $postcode = '".$postcode_val."' AND $huisnummer = '".$huisnummer_val."'";
        $result = mysqli_query($this->connection,$qry);   
        if($result && mysqli_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }
       
    function DBLogin()
    {

        $this->connection = mysqli_connect($this->db_host,$this->username,$this->pwd,$this->database);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login mislukt! Controleer de Database inlog gegevens.");
            return false;
        }

        if(!mysqli_query($this->connection, "SET NAMES 'UTF8'"))
        {
            $this->HandleDBError('Fout bij instellen utf8 encoding');
            return false;
        }
        return true;
    }    
    //Functie wordt niet gebruikt
    function Ensuretable()
    {
        $result = mysqli_query("SHOW COLUMNS FROM $this->tablename");   
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            return $this->CreateTable();
        }
        return true;
    }
    // Functie wordt niet gebruikt
    function CreateTable()
    {
        $qry = "Create Table $this->tablename (".
                "id_user INT NOT NULL AUTO_INCREMENT ,".
                "name VARCHAR( 128 ) NOT NULL ,".
                "email VARCHAR( 64 ) NOT NULL ,".
                "phone_number VARCHAR( 16 ) NOT NULL ,".
                "username VARCHAR( 16 ) NOT NULL ,".
                "password VARCHAR( 32 ) NOT NULL ,".
                "confirmcode VARCHAR(32) ,".
                "PRIMARY KEY ( id_user )".
                ")";
                
        if(!mysqli_query($this->connection, $qry))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database \nquery was\n $qry");
            return false;
        }
        return true;
    }
    
    function InsertIntoDBPerson(&$formvars)
    {
        
        $insert_query = 'insert into '.$this->tablename.'(
                name,
                email,
                phone_number,
                username,
                password,
                zorgverlenersnummer
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['name']) . '",
                "' . $this->SanitizeForSQL($formvars['email']) . '",
                "' . $this->SanitizeForSQL($formvars['phone_number']) . '",
                "' . $this->SanitizeForSQL($formvars['username']) . '",
                "' . md5($formvars['password']) . '",
                "' . $this->SanitizeForSQL($formvars['zorgverlenersnummer']) . '"    
                )';    
        
        if(!mysqli_query( $this->connection,$insert_query ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query");
            return false;
        }      
        
        $get_personid_query = 'SELECT id_user FROM ' .$this->tablename. ' WHERE username = "'. $this->SanitizeForSQL($formvars['username']). '"';
        
        
        $result = mysqli_query($this->connection,$get_personid_query);
        while ($row = mysqli_fetch_assoc($result)) {
            $personid = $row['id_user'];
        } 
        
        $insert_query_relatie = 'insert into '.$this->relatietable.'(
        id_users,
        id_praktijken
        )
        values
        (
        "' . $personid . '",
        "' . $this->SanitizeForSQL($formvars['organisatie']) . '"    
        )'; 
        
        if(!mysqli_query($this->connection, $insert_query_relatie ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query_relatie");
            return false;
        }
        
        if($formvars['export'] == "1") {
          $insert_query_export = 'insert into '.$this->rightstable.'(
          user,
          export
          )
          values
           (
            "' . $personid . '",
            "' . $this->SanitizeForSQL($formvars['export']) . '"    
          )'; 
        
        if(!mysqli_query($this->connection, $insert_query_export ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query_export");
            return false;
        }
        }
        
        return true;
    }
    
    function InsertIntoDBPraktijk(&$formvars)
    {
        $insert_query = 'insert into '.$this->praktijkentable.'(
                naam,
                telefoonnummer,
                straat,
                huisnummer,
                huisnummer_toev,
                postcode,
                plaatsnaam
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['naam']) . '",
                "' . $this->SanitizeForSQL($formvars['telefoonnummer']) . '",
                "' . $this->SanitizeForSQL($formvars['straat']) . '",
                "' . $this->SanitizeForSQL($formvars['huisnummer']) . '",
                "' . $this->SanitizeForSQL($formvars['huisnummer_toev']) . '",
                "' . $this->SanitizeForSQL($formvars['postcode']) . '",
                "' . $this->SanitizeForSQL($formvars['plaatsnaam']) . '"    
                )';    
        
        if(!mysqli_query( $this->connection,$insert_query ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query");
            return false;
        }      
        
        return true;
    }

    function InsertIntoDBMelding(&$formvars)
    {
        $insert_query = 'INSERT INTO '.$this->meldingtable.'(
                organisatie,
                zorgverlener,
                geslacht,
                geboortedatum,
                ingangsklacht,
                ikanders,
                toegevwaarde,
                toelichting,
                timestamp
                )
                VALUES
                (
                "' . $this->SanitizeForSQL($formvars['organisatie']) . '",
                "' . $this->SanitizeForSQL($formvars['zorgverlener']) . '",
                "' . $this->SanitizeForSQL($formvars['geslacht']) . '",
                "' . $this->SanitizeForSQL($formvars['geboortedatum']) . '",
                "' . $this->SanitizeForSQL($formvars['ingangsklacht']) . '",
                "' . $this->SanitizeForSQL($formvars['ikanders']) . '",
                "' . $this->SanitizeForSQL($formvars['toegevwaarde']) . '",
                "' . $this->SanitizeForSQL($formvars['toelichting']) . '",
                now()    
                )';    
        
        if(!mysqli_query($this->connection, $insert_query ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query");
            return false;
        }     
        return true;
    }
    
    function UpdateIntoDBPerson(&$formvars)
    {
        
    if(strlen($formvars['password']) > 0) {
        
        $insert_query = 'UPDATE '.$this->tablename.' SET 
                name = "' . $this->SanitizeForSQL($formvars['name']) . '",
                email = "' . $this->SanitizeForSQL($formvars['email']) . '",
                phone_number = "' . $this->SanitizeForSQL($formvars['phone_number']) . '",
                username = "' . $this->SanitizeForSQL($formvars['username']) . '",
                password = "' . md5($formvars['password']) . '",
                zorgverlenersnummer = "' . $this->SanitizeForSQL($formvars['zorgverlenersnummer']) . '"
                WHERE id_user = ' . $this->SanitizeForSQL($formvars['id_users']);
              
    } else {
        
        $insert_query = 'UPDATE '.$this->tablename.' SET 
                name = "' . $this->SanitizeForSQL($formvars['name']) . '",
                email = "' . $this->SanitizeForSQL($formvars['email']) . '",
                phone_number = "' . $this->SanitizeForSQL($formvars['phone_number']) . '",
                username = "' . $this->SanitizeForSQL($formvars['username']) . '",
                zorgverlenersnummer = "' . $this->SanitizeForSQL($formvars['zorgverlenersnummer']) . '"
                WHERE id_user = ' . $this->SanitizeForSQL($formvars['id_users']);
    }
      
        if(!mysqli_query($this->connection, $insert_query ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query");
            return false;
        }   
        
    if($formvars['export'] == "0") {
          $insert_query_export = 'UPDATE '.$this->rightstable.' SET 
          export = "' . $this->SanitizeForSQL($formvars['export']) . '"    
           WHERE user = ' . $this->SanitizeForSQL($formvars['id_users']); 

        if(!mysqli_query($this->connection, $insert_query_export ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query_export");
            return false;
        }
        }
        
    if($formvars['export'] == "1") {
          $insert_query_export = 'UPDATE '.$this->rightstable.' SET 
          export = "' . $this->SanitizeForSQL($formvars['export']) . '"    
           WHERE user = ' . $this->SanitizeForSQL($formvars['id_users']); 
        
         
        if(!mysqli_query($this->connection, $insert_query_export ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query_export");
            return false;
        }
        }
    
        return true;
    }
    
    function DeleteFromDBPerson(&$formvars)
    {
        
    $insert_query = 'DELETE FROM '.$this->tablename.' WHERE id_user = ' . $this->SanitizeForSQL($formvars['id_users']);
      
        if(!mysqli_query($this->connection, $insert_query ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query");
            return false;
        }           
        return true;
    }
    

    function DeleteFromDBPraktijk(&$formvars)
    {
        
    $insert_query = 'DELETE FROM '.$this->praktijkentable.' WHERE id = ' . $this->SanitizeForSQL($formvars['id']);
      
        if(!mysqli_query($this->connection, $insert_query ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query");
            return false;
        }           
        return true;
    }    
    
    function UpdateIntoDBPraktijk(&$formvars)
    {
        $insert_query = 'UPDATE '.$this->praktijkentable.' SET 
                naam = "' . $this->SanitizeForSQL($formvars['naam']) . '",
                telefoonnummer = "' . $this->SanitizeForSQL($formvars['telefoonnummer']) . '",
                straat = "' . $this->SanitizeForSQL($formvars['straat']) . '",
                huisnummer = "' . $this->SanitizeForSQL($formvars['huisnummer']) . '",
                huisnummer_toev = "' . $this->SanitizeForSQL($formvars['huisnummer_toev']) . '",
                postcode = "' . $this->SanitizeForSQL($formvars['postcode']) . '",
                plaatsnaam = "' . $this->SanitizeForSQL($formvars['plaatsnaam']) . '"
                WHERE id = ' . $this->SanitizeForSQL($formvars['id']);
        
        var_dump($insert_query);
        
        if(!mysqli_query($this->connection, $insert_query ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query");
            return false;
        }      
              
        return true;
    }    

    function InsertIntoDB(&$formvars)
    {
    
        $confirmcode = $this->MakeConfirmationMd5($formvars['email']);
        
        $formvars['confirmcode'] = $confirmcode;
        
        $insert_query = 'insert into '.$this->tablename.'(
                name,
                email,
                username,
                password,
                confirmcode
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['name']) . '",
                "' . $this->SanitizeForSQL($formvars['email']) . '",
                "' . $this->SanitizeForSQL($formvars['username']) . '",
                "' . md5($formvars['password']) . '",
                "' . $confirmcode . '"
                )';      
        if(!mysqli_query($this->connection,$insert_query ))
        {
            $this->HandleDBError("Fout bij toevoegen van de data in de database\nquery:$insert_query");
            return false;
        }        
        return true;
    }
    
    function MakeConfirmationMd5($email)
    {
        $randno1 = rand();
        $randno2 = rand();
        return md5($email.$this->rand_key.$randno1.''.$randno2);
    }
    
    function SanitizeForSQL($str)
    {
        if( function_exists( "mysqli_real_escape_string" ) )
        {
              $ret_str = mysqli_real_escape_string($this->connection, $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
    
 /*
    Sanitize() functien verwijderd een potentiele bedreiging die via de
  * verstuurde data word gestuurd. Het voorkomt e-mail injecties en hackers
  * pogingen. Als $remove_nl waar is, worden ook newline verwijderd van de input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str_stripped = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str_replaced = preg_replace($injections,'',$str_stripped);
        }

        return $str_replaced;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    }    
    
    function Export()
    {
        
            if(!$this->DBLogin())
        {
            $this->HandleErrors("Database login niet gelukt!");
            return false;
        }
        
    $praktijk = $_SESSION['praktijk'];
    $filename = "data_export_" . date("Y-m-d");

    $qry = "SELECT * from $this->meldingtable WHERE organisatie = $praktijk";
    
    $result = mysqli_query($this->connection,$qry);
   

    header("Content-Type: application/xls");    
    header("Content-Disposition: attachment; filename=$filename.xls");  
    header("Pragma: no-cache"); 
    header("Expires: 0");

    $sep = "\t";
  
    while($finfo = $result->fetch_field())
    {
     printf($finfo->name . $sep);
    } 
    
    print("\n");    

        while($row = mysqli_fetch_row($result))
        {
            $schema_insert = "";
            for($j=0; $j<mysqli_num_fields($result);$j++)
            {
                if(!isset($row[$j]))
                    $schema_insert .= "NULL".$sep;
                elseif ($row[$j] != "")
                    $schema_insert .= "$row[$j]".$sep;
                else
                    $schema_insert .= "".$sep;
            }
            $schema_insert = str_replace($sep."$", "", $schema_insert);
            $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
            $schema_insert .= "\t";
            print(trim($schema_insert));
            print "\n";
        }  
    }
    
}

?>