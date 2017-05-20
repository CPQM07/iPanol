<?php
	header('Content-type: application/json');
	$status = array(
		'type'=>'success',
		'message'=>'Gracias por contáctarnos. Responderemos a la brevedad.'
	);

    $name       = @trim(stripslashes($_POST['name'])); 
    $email      = @trim(stripslashes($_POST['email'])); 
    $subject    = @trim(stripslashes($_POST['subject'])); 
    $message    = @trim(stripslashes($_POST['message'])); 

    $email_from = $email;
    $email_to = 'shormazabal@inacap.cl';//remplazar por el email del destinatario

    $body = 'Nombre: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Asunto: ' . $subject . "\n\n" . 'Mensaje: ' . $message;

    $success = @mail($email_to, $subject, $body, 'Desde: <'.$email_from.'>');

    echo json_encode($status);
    die;