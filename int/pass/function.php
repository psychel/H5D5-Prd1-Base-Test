<?php

function checkUser($email)
{
	global $db;
	$query = mysqli_query($db, "SELECT id FROM login WHERE email = '$email'");
	if(mysqli_num_rows($query) > 0)
	{
		return 'true';
	}else
	{
		return 'false';
	}
}
function UserID($email)
{
	global $db;
	$query = mysqli_query($db, "SELECT id FROM login WHERE email = '$email'");
	$row = mysqli_fetch_assoc($query);
	return $row['id'];
}

function generateRandomString($length = 20) {
	// This function has taken from stackoverflow.com
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return md5($randomString);
}

function send_mail($to, $token)
{
	require 'PHPMailer/PHPMailerAutoload.php';
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = 'mail.uk2.net';
	$mail->SMTPAuth = true;
	$mail->Username = 'conc@darbus.co.uk';
	$mail->Password = 'D8rbu51234';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	
	$mail->From = 'conc@darbus.co.uk';
	$mail->FromName = 'HPC Integrated Platform password reset';
	$mail->addAddress($to);
	$mail->addReplyTo('conc@darbus.co.uk', 'Reply');
	
	//$mail->isHTML(true);
	
	$mail->Subject = 'HPC Password Recovery Instruction';
	//here to put the link of the webpage
	$link = 'https://demo.darbus.co.uk/int/pass/forget.php?email='.$to.'&token='.$token;
	$mail->Body    = "<b>Hello</b><br><br>You have requested for your password recovery. <a href='$link' target='_blank'>Click here</a> to reset your password. If you are unable to click the link then copy the below link and paste in your browser to reset your password.<br><i>". $link."</i>";
	
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		return 'fail';
	} else {
		return 'success';
	}
}

function verifytoken($userID, $token)
{	
	global $db;
	
	$query = mysqli_query($db, "SELECT valid FROM recovery_keys WHERE userID = $userID AND token = '$token'");
	$row = mysqli_fetch_assoc($query);
	
	if(mysqli_num_rows($query) > 0)
	{
		if($row['valid'] == 1)
		{
			return 1;
		}else
		{
			return 0;
		}
	}else
	{
		return 0;
	}
	
}
?>