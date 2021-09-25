<?php 

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/SMTP.php');
require('PHPMailer/src/Exception.php');

function clear_input($input_data)
{
    return htmlspecialchars(stripslashes(trim($input_data)));
}


$response['msg'] = 'Something went wrong while sending email.' ;
$response['status'] = False ;

if( empty( $_POST['allData'] ) || empty( $_POST['name'] ) || empty( $_POST['email'] ) ) 
{
	$response['msg'] = 'Data not found.' ;
	exit( json_encode($response) );
}

$allDataObj = $_POST['allData'];
$name = clear_input( $_POST['name'] ) ;
$email = clear_input( $_POST['email'] ) ;

$allDataObj = json_decode($allDataObj);

$mail_body = '<div>';

$mail_body .= '<div >
  <h4 style="text-align: center; margin: 30px 0px">
    <span style="font-weight: 600; margin-right: 15px">Name:</span>'.$name.'
   </h4>
  <h4 style="text-align: center; margin: 30px 0px">
    <span style="font-weight: 600; margin-right: 15px">Mail:</span>'.$email.'
  </h4>
</div> <div >';

// green cards
$mail_body .= '<div > <p style=" text-align: center; margin: 40px; background-color: #9a9d70; color: white; padding: 10px;">Green Cards</p>';
		  $arr =$allDataObj->green;
          foreach ($arr as $value) 
          {
          	$mail_body .='<img style=" display: block; width: 35%; margin: 15px auto; border-radius: 4px;" src='.$value.' alt="Green Card" />';
          }

$mail_body .='</div>';
// end green cards

//brown cards
$mail_body .= '<div > <p style=" text-align: center; margin: 40px; background-color: #a77947; color: white; padding: 10px;">Brown Cards</p>';
		  $arr=$allDataObj->brown;
          foreach ($arr as $value) 
          {
          	$mail_body .='<img style=" display: block; width: 35%; margin: 15px auto; border-radius: 4px;" src="'.$value.'" alt="Brown Card" />';
          }

$mail_body .='</div>';
//end brown cards

// yellow card
$mail_body .= '<div > <p style=" text-align: center; margin: 40px; background-color: #dfc479; color: white; padding: 10px;">Yellow Cards</p>';
		  $arr = $allDataObj->yellow;
          foreach ($arr as $value) 
          {
          	$mail_body .='<img style=" display: block; width: 35%; margin: 15px auto; border-radius: 4px;" src="'.$value.'" alt="Yellow Card" />';
          }

$mail_body .='</div>';
//end yellow cards

//selected cards
$mail_body .= '<div > <p style=" text-align: center; margin: 40px; background-color: orange; color: white; padding: 10px;">Selected Cards</p>';
		  $arr =$allDataObj->resultCards;
          foreach ($arr as $value) 
          {
          	$mail_body .='<img style=" display: block; width: 35%; margin: 15px auto; border-radius: 4px;" src="'.$value.'" alt="Selected Card" />';
          }

$mail_body .='</div>';
//end selected cards

$mail_body .= '</div> </div>';
// exit( $mail_body );
try
{
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
    // $mail->Host       = '172.16.7.57';
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'b3710ca1faebff';                     // SMTP username
    $mail->Password   = '957cc8bbfa26e1';                               // SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption;   `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 2525;
    // $mail->Port       = 25; 

    $mail->SetFrom('noreply@example.com', 'example.com'); //Name is optional
    $mail->isHTML(true); 
    $mail->Subject = 'Email Update for ( '. $name .' )';
    $mail->AddAddress( 'to@example.com' );
    $mail->addCC('imranashik50@gmail.com');

    $mail->Body = $mail_body;

    // $mail->Send();
    $response['msg'] = 'Thanks! An email has been sent successfully.' ;
    $response['status'] = True ;
}


catch (Exception $e) 
{
    $response['msg'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}" ;
    $response['status'] = False ;
}


echo(json_encode($response));

 ?>