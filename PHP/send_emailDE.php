<?php
if(isset($_POST['email'])) {
 
    $email_to = "kri9are@gmail.com";
    $email_subject = "Anfrage von SIAS-Webseite";
 
    function died($error) {
        echo "Wir entschuldigen uns, aber es gibt Fehler bei dem Formular, das sie senden wollten.";
        echo "Diese Fehler sehen Sie unten.<br /><br />";
        echo $error."<br /><br />";
        echo "Bitte korrigieren Sie diese Fehler<br /><br />";
        die();
    }
 
 
    if(!isset($_POST['name'])||
        !isset($_POST['email']) ||
        !isset($_POST['betreff']) ||
        !isset($_POST['nachricht'])) {
        died('Wir entschuldigen uns, aber es gibt ein Problem bei dem zu sendenden Formular.');       
    }
 
     
 
    $name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $betreff = $_POST['betreff']; // not required
    $nachricht = $_POST['nachricht']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Die E-Mail Adresse die Sie eingegeben haben scheint nicht gültig zu sein.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'Der Name den Sie eingegeben haben scheint nicnt gültig zu sein.<br />';
  }

 
  if(strlen($nachricht) < 10) {
    $error_message .= 'Die Nachricht die Sie eingegeben haben scheint nicnt gültig zu sein.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Formular-Details sehen Sie unten.\n/n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Betreff: ".clean_string($betreff)."\n";
    $email_message .= "Nachricht: ".clean_string($nachricht)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r/n".
'Reply-To: '.$email_from."\r/n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- Falls es funktioniert -->
 
Vielen Dank für Ihre Nachricht, wir versuchen Ihnen so schnell wie möglich zu antworten!
 
<?php
 
}
?>