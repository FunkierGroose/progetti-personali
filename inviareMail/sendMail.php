<?php
    define('EMAIL', 'YourMail');
    define('PASS', 'YourPwGmailOrOther');

	/*
	Web application che consente di gestire l'invio delle tue mail
	attraverso web application esterne come queste

	per accedere ai servizi dei serverMail usiamo la libreria open source PHPmailer

	inanzitutto creamo una pagina e il suo form, cosichè da chiamare in action=sendMail.php
	e prelevare $_post i dati da form

	per usare questa web application, bisogna abbassare i firewall dei server di posta, per verificare la corretta funzionalità
	*/
		require 'PHPMailerAutoload.php';

		$mail = new PHPMailer; //crea l'istanza

		$mail->SMTPDebug = 4;                               // abilita il codice output di debug

		$mail->isSMTP();              // in base al proprio server, impostiamo la connessione, in questo caso ho gmail, quindi ho usato smtp.google.com
		$mail->Host = 'smtp.gmail.com';  // settiamo il nome dell'host, in caso gmail lasciare cosi com'è
		$mail->SMTPAuth = true;                               // abilitiamo l'autenticazione
		$mail->Username = EMAIL;                 // SMTP username
		$mail->Password = PASS;                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // abilitiamo la 'tls' di encriptazione oppure 'ssl'
		$mail->Port = 587;                                    // settiamo la porta del host

		$mail->setFrom(EMAIL, 'Mailer');		//impostiamo le costanti definite all'inizio
		$mail->addAddress($_POST['mail']);     

		$mail->addReplyTo(EMAIL);		//abilita la risposta in cambio di connessione

		#$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // opzionale, se si sceglie di condividere file 
		$mail->isHTML(true);                                  // settiamo un eventuale messaggio html

		$mail->Subject = $_POST['subject']; // impostiamo oggetto e body con i POST del form
		$mail->Body    = $_POST['msg'];;

		if(!$mail->send()) {

			echo 'Messaggio non inviato.';
			echo 'Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Messaggio appena inviato';
		}
?>