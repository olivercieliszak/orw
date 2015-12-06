<?php
/*
 * login_with_facebook.php
 *
 * @(#) $Id: login_with_facebook.php,v 1.4 2015/04/08 23:28:52 mlemos Exp $
 *
 */

    /*
     * Get the http.php file from http://www.phpclasses.org/httpclient
     */
    require('./lib/fb/http.php');
    require('./lib/fb/oauth_client.php');

    $client = new oauth_client_class;
    $client->debug = false;
    $client->debug_http = true;
    $client->server = 'Facebook';
    $client->redirect_uri = 'http://v2.l4g.pl/lab/fbLoginOK.php';

    $client->client_id = '134526290051121'; $application_line = __LINE__;
    $client->client_secret = '8aef0e23031a9964381d8035fdf966c4';

    /* API permissions
     */
    $client->scope = 'email,publish_actions,user_friends';
    if(($success = $client->Initialize()))
    {
        if(($success = $client->Process()))
        {
            if(strlen($client->access_token))
            {
                $success = $client->CallAPI(
                    'https://graph.facebook.com/v2.3/me', 
                    'GET', array(), array('FailOnAccessError'=>true), $user);

			}
		}
	}
	
?> 