<?php // Define constants
define( "RECIPIENT_NAME", "p3week.ru" );
define( "RECIPIENT_EMAIL", "info@p3week.ru" ); // where to send email
define( "EMAIL_SUBJECT", "[p3week.ru]" );

// Read the form values
$success = false;

$input_fio			= $_POST['input_fio'];
$input_org			= $_POST['input_org'];
$input_status		= $_POST['input_status'];
$input_email		= isset( $_POST['input_email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['input_email'] ) : "";
$input_site			= $_POST['input_site'];

$message = "
	<html>
		<body>
			<strong>ФИО:</strong>$input_fio<br/>
			<strong>Организация:</strong>$input_org<br/>
			<strong>Должность:</strong>$input_status<br/>
			<strong>E-mail</strong>$input_email<br/>
			<strong>Сайт компании</strong>$input_site<br />
		</body>
	</html>
";

// If all values exist, send the email
if ($input_fio && $input_org && $input_status && $input_email && $input_site) {
	$recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
	$headers = "Content-type: text/html; charset = utf-8 \r\n";
	$headers .= "From: " . $input_fio . " <" . $input_email . ">";
	$success = mail($recipient, EMAIL_SUBJECT, $message, $headers);
}

// Return an appropriate response to the browser
if (isset($_GET["ajax"])) {
	echo $success ? "success" : "error";
}
else { ?>
	<html>
		<head>
			<title>Thank you!</title>
		</head>

		<body>
			<?php if ($success) {
				echo "<p>Thank you for your message!</p>";
			}
			else {
				echo "<p>Error while sendind, try again please</p>";
			} ?>

			<a href="/">To home page</a>
		</body>
	</html>
<?php } ?>


