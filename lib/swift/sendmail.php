<?php

/* 		basic check if submission is from correct address [not solid but added security layer] */

	if (isset($_SERVER['HTTP_ORIGIN'])) {
        $address = 'http://'.$_SERVER['SERVER_NAME'];
        if (strpos($address, $_SERVER['HTTP_ORIGIN']) !== 0) {
			exit('error 72');
        }
    }
	
/* 		check submission form send button value as hidden value [not solid but added security layer] */

	if ($_POST['send'] != 'Share') {
		exit('error 2.5');
	};	
	
/* 		get data from POST object	 */

		if (!empty($_POST['name-to'])) {
	$toname = strip_tags($_POST['name-to']);
		}
		if (!empty($_POST['email-to'])) {
	$toemail = strip_tags($_POST['email-to']);
		}
		if (!empty($_POST['name-from'])) {
	$fromname = strip_tags($_POST['name-from']);
		}
		if (!empty($_POST['email-from'])) {
	$fromemail = strip_tags($_POST['email-from']);
		}
		if (!empty($_POST['message'])) {
	$message = strip_tags($_POST['message']);
		}
		
	$url = strip_tags($_POST['url']);
	
		
/* 		build email body */

	$emailbody = '
	
	<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

</head>
<body style="font-family: Georgia, serif;background-color: white;font-size: 18px;color: #392A1C;"><table width="580" border="0">
		<tr>
			<td style="font-size: 18px;color: #392A1C;"></td><td width="85%" style="font-size: 18px;color: #392A1C;"><p><br>
A message via the Gresford Architects website;<br>
<br>
</p></td><td style="font-size: 18px;color: #392A1C;"></td>
		</tr>
		<tr>
			<td style="font-size: 18px;color: #392A1C;"></td><td width="85%" style="font-size: 18px;color: #392A1C;">
				<p>' . $message .'</p>
				<p>You might be interested in this project:<br>
 ' . $url .'</p>
				<p><br>
<br>
From ' . $fromname .'<br>
<br>
</p>
			</td><td style="font-size: 18px;color: #392A1C;"></td>
		</tr>
		<tr>
		  <td style="font-size: 18px;color: #392A1C;"></td>
		  <td style="font-size: 18px;color: #392A1C;">&nbsp;</td>
		  <td style="font-size: 18px;color: #392A1C;"></td>
  </tr>
		<tr>
		  <td style="font-size: 18px;color: #392A1C;"></td>
		  <td class="footer" style="font-size: 14px;color: #392A1C;border-top: 1px dotted #4D4D4D;"><br>		    <br>
            <a href="www.gresfordarchitects.co.uk" target="_blank"><img src="http://www.gresfordarchitects.co.uk/wp-content/themes/ma-ga-dev/img/masterG_78px.gif" width="78" height="240" alt="" border="0"></a><br>
		    <br>
		    Gresford Architects<br>
		    Unit B13 · 3 Bradbury St<br>
		    London · N16 8JN<br>
	      T +44(0)20 7249 1855</td>
		  <td style="font-size: 18px;color: #392A1C;"></td>
  </tr>
</table>
</body>
	
	</html>
	
	
	
	';
	
/* 		require swift */

	require_once 'swiftlib/swift_required.php';
	
/* 		create the mail transport  */

	$transport = Swift_SmtpTransport::newInstance('mail.gresfordarchitects.com', 25)
		->setUsername('mailer@gresfordarchitects.com')
		->setPassword('X7HTb659HMihR33');

/* 		create the mailer */

	$mailer = Swift_Mailer::newInstance($transport);

/* 		create a simple message */
		
		if (!empty($fromname)) {
			$from = array($fromemail => $fromname);
		} else {
			$from = $fromemail;
		};
		
		if (!empty($toname)) {
			$to = array($toemail => $toname);
		} else {
			$to = $toemail;
		};

	$message = Swift_Message::newInstance()

		->setSubject('A project from Gresford Architects that you might find interesting...')
		->setFrom($from)
		->setTo($to)
		->setBcc('tom.gresford@googlemail.com')
		->setBody($emailbody, 'text/html');

/* 		send the email message */

	if (!$mailer->send($message, $failures)) {
		var_dump($failures);
	} else {	
		header( 'Location: ' . $_SERVER['HTTP_REFERER'] . '#mailsent' ) ;
	}

?>