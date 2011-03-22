 <?php defined('SYSPATH') OR die('No Direct Script Access');

	Class Controller_User extends Controller
	{
		
		
		public function action_index()
	{
		$config = Config::instance();
		$cc=$config->load('config');
        $sendGridCrd=$cc->get('sendGrid');

		include Kohana::find_file('vendor','Swift/lib/swift_required');

		
		$view = View::factory('user');
		$view->errors='';
		if ($_POST)
		{
			
			if ($_POST['uemail']=='')
			{
				//Request::current()->redirect('user');
				$view->errors = "Invalid email or password";
			}
			else
				{
					// Login credentials
					$host		= $sendGridCrd['sendgridHost'];	
					$username	= $sendGridCrd['sendgridUser']; //'karamveer@impingeonline.com ';
					$password	= $sendGridCrd['sendgridPassword'];//'Impinge250';

					//'smtp.sendgrid.net'


					$transport = Swift_SmtpTransport::newInstance($host, 25);
					$transport->setUsername($username);
					$transport->setPassword($password);
					$swift = Swift_Mailer::newInstance($transport);

					// Create a message (subject)
					$subject="Testing SendGrid Mail";
					$message = new Swift_Message($subject);

					// attach the body of the email
					$from="karamveer@impingeonline.com";

					$message->setFrom($from);
					$html ="<html><head></head>	<body><p>Hi!<br>How are you?<br></p></body>	</html>";
					
					$to=$_POST['uemail'];
					
					$text = "Hi!\nHow are you?\n";




					$message->setBody($html, 'text/html');
					$message->setTo($to);
					$message->addPart($text, 'text/plain');

					// send message 

					$recipients = $swift->send($message, $failures);


						
					if ($recipients = $swift->send($message, $failures))
					{
					// This will let us know how many users received this message
					$view->errors = 'Message sent out to '.$recipients.' users';
					}
					// something went wrong =(
					else
					{
					$view->errors = "Something went wrong - ";
					print_r($failures);
					
					}
				  
				}

		
		}

		$this->response->body($view);
	}


	} // End User