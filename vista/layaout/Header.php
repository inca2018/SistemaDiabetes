<?php
session_start();

require_once ('../../config/conexion.php');


/* indentifiacion del usuario */
if(isset($_SESSION['idUsuario'])){

}else{
   header("Location: ../../../index.php");

}

$conexionConfig = new Conexion();

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="System ">
   <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
   <title>Sistema</title>
   <!-- =============== VENDOR STYLES ===============-->
   <!-- FONT AWESOME-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/font-awesome/css/all.min.css">
   <!-- SIMPLE LINE ICONS-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/simple-line-icons/css/simple-line-icons.css">
   <!-- ANIMATE.CSS-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/animate.css/animate.css">
   <!-- WHIRL (spinners)-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/whirl/dist/whirl.css">
   <!-- =============== PAGE VENDOR STYLES ===============-->
   <!-- TAGS INPUT-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
   <!-- SLIDER CTRL-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/bootstrap-slider/dist/css/bootstrap-slider.css">
   <!-- CHOSEN-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/chosen-js/chosen.css">
   <!-- DATETIMEPICKER-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
   <!-- COLORPICKER-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css">
   <!-- SELECT2-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/select2/dist/css/select2.css">
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/select2-bootstrap-theme/dist/select2-bootstrap.css">
   <!-- WYSIWYG-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/bootstrap-wysiwyg/css/style.css">
   <!-- SWEET ALERT-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/sweetalert/dist/sweetalert.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>vendor/datatable/Responsive-2.2.2/css/responsive.bootstrap4.min.css">

   <!-- =============== BOOTSTRAP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>css/bootstrap.css" id="bscss">
   <!-- =============== APP STYLES ===============-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>css/app.css" id="maincss">
   <link rel="stylesheet" href="<?php echo $conexionConfig->ruta(); ?>css/theme-g.css" id="maincss">
   <!-- =============== APP STYLES PERSONAL ===============-->
   <link rel="stylesheet" href="<?php echo $conexionConfig->rutaOP(); ?>assets/css/style.css" id="maincss">
</head>
