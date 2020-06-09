<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="contactStyle.css">

	<title>Piersilvio | a computer science's student</title>
</head>
<body>
	<header>
		<h1>Here i am!</h1>
		<p>Fill out the form if you are interested in contacting me!</p>
	</header>

	<main>
		<article>
			<center>
			<h3>Form</h3>
			<!--form-->

<?php

$action = "";
if(isset($_POST['action'])) $action = $_POST['action'];

if($action == ""){

	print"<form action='contact.php' method='post'>";
	print"<input type='text' name='name' placeholder='Full name'>";
	print"<br><br>";
	print"<input type='text' name='mail' placeholder='E-mail'>";
	print"<br><br>";
	print"<input type='text' name='subject' placeholder='subject'>";
	print"<br><br>";
	print"<textarea name='msg' placeholder='Message...'></textarea>";
	print"<br><br>";
	print"<input type='hidden' name='action' value='work'>";

	print"<input type='submit' value='Send!'>";
	print"</form>";

}

if($action == "work"){

	$myemail = 'funkiergroose@gmail.com';

	$name = $_POST['name']; 
	$mail_address = $_POST['mail']; 
	$msg = $_POST['msg']; 

	//convalida mail e form
	if(empty($_POST['name'])||empty($_POST['mail'])||empty($_POST['subject'])||empty($_POST['msg']))
	{
		echo"\n Errore: tutti i campi devono essere compilati!";
	}

	if (!preg_match(
	"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
	$mail_address))
	{
		echo"\n Errore: indirizzo non valido!";
	}

	$to = $myemail;
	$subject = $_POST['subject'];

	$headers = "Content type: text/html; \r\n";
	$headers = "From: $mail_address";
	#smtp.gmail.com

	mail($to, $subject, $msg, $headers);
	echo"<p>Grazie per il tuo messaggio, lo visualizzarò al più presto</p>";


}

?>
		</center>	      
		</article>
	</main>

	<footer>
	<p>Copyright &copy; <script>document.write(new Date().getFullYear());</script>, Spicoli Piersilvio</p>
	</footer>
</body>
</html>
