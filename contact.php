<?php 
	define("TITLE", "Reef Rox | Contact");
	include('includes/header.php'); 
?>


	<div class="container">

		<h1>Contact</h1>

	<?php 

		if(isset($_POST['contact-submit'])) {

			// Check for header injections
			function has_header_injection($str) {
				return preg_match("/[\r\n]/", $str);
			}

			$name =  trim($_POST['name']);
			$email = trim($_POST['email']);
			$msg = 	 isset($_POST['message']);

			// Check to see if $name or $email have header injections
			if (has_header_injection($name) || has_header_injection($email)) {
				die(); //If true, kill script
			}

			if (!$name || !$email || !$msg) {
				echo '<h4 class="error">All fields required.</h4><a href="contact.php" class="button block">Go back.</a>';
				exit();
			}

			// Add recipient email to a variable
			$to = "reefrox@gmail.com";

			// Create a subject
			$subject = "$name sent you a message via your contact form.";

			// Contstruct the message
			$message  = "Name: $name\r\n";
			$message .= "Email: $email\r\n";
			$message .= "Message:\r\n$msg";
			
			$message = wordwrap($message, 72);

			// Set the mail headers into a variable
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
			$headers .= "From: $name <$email>\r\n";
			$headers .= "X-Priority: 1\r\n";
			$headers .= "X-MSMail-Priority: High\r\n\r\n";

			// Send the email
			mail($to, $subject, $message, $headers);

	?>

			<!--Success message after email sent -->
			<h5>Thanks for contacting me!</h5>


	<?php } else { ?>


		<form method="post" action="" id="contact-form">

			<label for="name">Name</label>
			<input type="text" id="name" name="name">

			<label for="email">Email</label>
			<input type="email" id="email" name="email">

			<label for="subject">Subject</label>
			<input type="subject" id="subject" name="subject">

			<label for="message">Message</label>
			<textarea id="message" name="messge"></textarea><br/>

			<input type="submit" class="button" name="contact-submit" value="Send">

		</form>

	</div>

	<?php } ?>


<?php 
	include('includes/footer.php'); 
?>