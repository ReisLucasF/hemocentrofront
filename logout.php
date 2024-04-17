<?php
global $domain;
$siteUrl = $_SERVER['HTTP_HOST'];
$domain = "http://{$siteUrl}";

session_start();
session_unset();
session_destroy();
header("Location: {$domain}");
exit;
?>
