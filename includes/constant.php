<?php
defined('__site_title') or define('__site_title', 'College Management System');
$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url .= "://" . $_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
defined('__site_url') or define('__site_url', $base_url);
defined('__document_root') or define('__document_root', 'http://localhost/college_management_system/');



