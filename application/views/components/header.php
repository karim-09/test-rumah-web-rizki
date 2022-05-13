<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= isset($title) ? $title : 'Dashboard'; ?></title>
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/adminlte/css/adminlte.min.css">
  <link href="<?php echo base_url('assets'); ?>/plugins/sweetalert/sweetalert.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/style.css">
  <style type="text/css">
    #wait {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url('<?php echo base_url(); ?>assets/img/ajax-loader.gif') 50% 50% no-repeat rgb(0, 0, 0, 0.36);
    }
  </style>
</head>