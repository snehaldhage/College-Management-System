<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $obj->base_url("assets/imgs/favicon.ico"); ?>">
  <title><?=__site_title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/jquery-ui/jquery-ui.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?php echo $obj->base_url("assets/theme_assets/plugins/toastr/toastr.css"); ?>">
  <link rel="stylesheet" href="<?php echo $obj->base_url("assets/theme_assets/plugins/toastr/toastr.min.css"); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $obj->base_url(); ?>assets/theme_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $obj->base_url("assets/theme_assets/dist/css/custom_style.css"); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }
    .example-modal .modal {
      background: transparent !important;
    }
    .color-palette {
      height: 35px;
      line-height: 35px;
      text-align: center;
    }

    .color-palette-set {
      margin-bottom: 15px;
    }

    .color-palette span {
      display: none;
      font-size: 12px;
    }

    .color-palette:hover span {
      display: block;
    }

    .color-palette-box h4 {
      position: absolute;
      top: 100%;
      left: 25px;
      margin-top: -40px;
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
      display: block;
      z-index: 7;
    }
    html {
    position: relative;  /*for sticky footer*/
    min-height: 100%;/* // for sticky footer*/
    }
    body {
    margin-bottom: 109px; /*// height of your footer, use breakpoints if your footer stacks*/
    background-color: #ecf0f5;
    }
    footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index:1000;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-fixed">
<div class="wrapper">