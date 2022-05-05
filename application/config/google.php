<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = config('google_client_id');
$config['google']['client_secret']    = config('google_client_secret');
$config['google']['redirect_uri']     = config('redirect_uri').'google_login';
$config['google']['application_name'] = config('application_name');
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();