<?php
session_start();
if ( ! defined( 'TAOH_SITE_URL_ROOT' ) ) define( 'TAOH_SITE_URL_ROOT', sprintf( "%s://%s%s", isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] != 'off' ? 'https' : 'http', $_SERVER[ 'HTTP_HOST' ], dirname( $_SERVER[ 'SCRIPT_NAME' ] ) ) ); // Only enable this if your website is not reachable by search engines
//print_r(TAOH_SITE_URL_ROOT);die;
//require_once('helper_functions.php');  //This file should not dependant on any files
require_once('function.php'); //this file is depends on config and helper functions
include_once('main.php');
exit();

