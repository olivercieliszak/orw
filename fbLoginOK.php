<?php
    require('./lib/fb/http.php');
    require('./lib/fb/oauth_client.php');

	$client = new oauth_client_class;
	$client->debug = false;
	$client->debug_http = true;
	$client->server = 'Facebook';
	$client->redirect_uri = 'http://'.$_SERVER['HTTP_HOST'].
		dirname(strtok($_SERVER['REQUEST_URI'],'?')).'/fbLoginOK.php';

	$client->client_id = '134526290051121';
	$application_line = __LINE__;
	$client->client_secret = '8aef0e23031a9964381d8035fdf966c4';

	if(strlen($client->client_id) == 0
	|| strlen($client->client_secret) == 0)
		die('Please go to Facebook Apps page https://developers.facebook.com/apps , '.
			'create an application, and in the line '.$application_line.
			' set the client_id to App ID/API Key and client_secret with App Secret');

	/* API permissions
	 */
	$client->scope = 'email,publish_actions,user_friends';
	if(($success = $client->Initialize()))
	{
		$success = $client->Process();
		$success = $client->Finalize($success);
	}
	if($client->exit)
		exit;
	if($success)
	{
		header('Location: index.html');
		echo 'OK';
	}
	else
	{
		?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
		<title>OAuth client error</title>
		</head>
		<body>
		<h1>OAuth client error</h1>
		<pre>Error: <?php echo HtmlSpecialChars($client->error); ?></pre>
		</body>
		</html>
		<?php
	}

?>