<?php

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './vendor/autoload.php';

function isValidDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of
    // digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}


$msg = '';
//Don't run this unless we're handling a form submission
if (array_key_exists('email', $_POST)) {
  date_default_timezone_set('Etc/UTC');

  //print_r($_POST);
  
  if (!array_key_exists('name', $_POST) or empty($_POST['name'])) {
    $msg = 'Name not specified, message ignored.';
  } elseif (!array_key_exists('arrival_date', $_POST) or !isValidDate($_POST['arrival_date'])) {
    $msg = 'Invalid arrival date specified, message ignored.';
  } elseif (!array_key_exists('departure_date', $_POST) or !isValidDate($_POST['departure_date'])) {
    $msg = 'Invalid departure date specified, message ignored.';
  } else {
    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    $mail->isSMTP();
    //Enable SMTP debugging
    //SMTP::DEBUG_OFF = off (for production use)
    //SMTP::DEBUG_CLIENT = client messages
    //SMTP::DEBUG_SERVER = client and server messages
    /* $mail->SMTPDebug = SMTP::DEBUG_SERVER; */
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->Host = 'mail.co-n.de';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->Username   = 'booking@ferienwohnung-armbruster.de';
    $mail->Password   = '';
    $mail->CharSet = PHPMailer::CHARSET_UTF8;

    $mail->setFrom('booking@ferienwohnung-armbruster.de', 'Buchungsanfrage Ferienwohnung');

    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {

      //Set who the message is to be sent to
      $mail->addAddress('k-a.armbruster@gmx.de', 'Andrea Armbruster');

      //Set the subject line
      $mail->Subject = 'Buchungsanfrage Ferienwohnung ('. $_POST['arrival_date'] . ' - ' . $_POST['departure_date'] . ')';
      $mail->isHTML(false);


      $mail->Body = <<<EOT
Buchungsanfrage:
----------------
Name: {$_POST['name']}
Email: {$_POST['email']}
Ankunft: {$_POST['arrival_date']}
Abreise: {$_POST['departure_date']}
Anzahl Personen: {$_POST['number_of_persons']} (davon Kinder: {$_POST['number_of_children']})

Mitteilung: {$_POST['message']}
EOT;

      //send the message, check for errors
      if (!$mail->send()) {
         $msg = 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
         $msg = 'Message sent! Thanks for contacting us.';
          //Section 2: IMAP
          //Uncomment these to save your message in the 'Sent Mail' folder.
          #if (save_mail($mail)) {
          #    echo "Message saved!";
          #}
      }
    } else {
      $msg = 'Invalid email address, message ignored.';
    }
  }
}

echo $msg;
header( "refresh:5;url=index.html" );

?>
