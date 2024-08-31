<?php
unset($_SESSION);
session_destroy();
header('Location: login?logout=1');
?>