<?php
$app_url = taoh_parse_url(0);
switch ($app_url) {
    case 'login':
        include_once('login.php');
        break;
    case 'logout':
        include_once('logout.php');
        break;
    case 'action':
        include_once('action.php');
        break;
    case 'student_list':
        include_once('student_list.php');
        break;
    default: 
        include_once('login.php');
        break;
}