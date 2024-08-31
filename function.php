<?php
function taoh_parse_url($level = 0, $caselower = 1)
{
    $full_url = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $pre_url = TAOH_SITE_URL_ROOT;
    //echo " $full_url  $pre_url ";exit();
    list($pre, $post) = explode($pre_url, $full_url);
    $url = explode('/', trim($post, '/'));
    if (is_array($url)) {
        $d = $url;
        $d = array_filter($d); //remove empty
        //print_r($d);die();
        if ($caselower) {
            if (isset($d[$level])) {
                if (str_contains($d[$level], '?')) {
                    $d[$level] = explode('?', $d[$level])[0];
                }
                //return strtolower($d[$level]);
                return strtolower($d[$level]);
            } else {
                return '';
            }
        }
        return $d[$level];
    }
    return '';
}

function createDatabaseConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "tailwebs_project";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

?>