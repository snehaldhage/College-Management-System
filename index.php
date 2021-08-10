<?php
require_once 'includes/config.php';
$page = 'login'; //default page
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
 include "pages/$page/inhead.php";
 if($page!='login' && $page!='register' && $page!='404_htm' && $page!='forgot_password'){ 
  include_once('pages/template/header.php'); 
  include_once('pages/template/navbar.php'); 
  include_once('pages/template/sidebar.php');
 }
 include_once("pages/$page/inbody.php");
 //echo $obj->base_url(); 
 