<?php
	require(dirname(__FILE__).'/../fb/http.php');
    require(dirname(__FILE__).'/../fb/oauth_client.php');

    $client = new oauth_client_class;
    $client->debug = false;
    $client->debug_http = false;
    $client->server = 'Facebook';
    $client->redirect_uri = 'http://v2.l4g.pl/lab/fbLoginOK.php';
		
	$client->client_id = '134526290051121';
	$application_line = __LINE__;
    $client->client_secret = '8aef0e23031a9964381d8035fdf966c4';
	
	$client->scope = 'email,publish_actions,user_friends,user_posts';
    if(($success = $client->Initialize()))
    {
        if(($success = $client->Process()))
        {
            if(strlen($client->access_token))
            {
                $success = $client->CallAPI(
                    'https://graph.facebook.com/v2.3/me', 
                    'GET', array(), array('FailOnAccessError'=>true), $user);
				$client->CallAPI(
                    'https://graph.facebook.com/v2.5/naglowki/feed?fields=message,full_picture', 
                    'GET', array(), array('FailOnAccessError'=>true), $fanpageData);
					
			}
		}
	}
	$data = array();
	$data['source'] = 'Facebook';
	if($success)
    {
		
		$data['status'] = 'OK';
		if($user -> gender == 'male'){
			$user -> genderPL = 'Mężczyzna';
		}
		else{
			$user -> genderPL = 'Kobieta';
		}
		$data['userData'] = $user;
		$fanpageData = $fanpageData -> data[0];
		$data['fanpageData'] = $fanpageData;
		
		// print_r($data);
	}
	else{		
		$data['status'] = 'Error';
		$data['data'] = 'Musisz się zalogować';
		// print_r($data);	
	}
		