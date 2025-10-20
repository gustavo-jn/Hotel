<?php
  session_start();

  if (!isset($_SESSION['id_usuario'])) {
      header("Location: ../login.php");
      exit;
  }

  if (isset($_GET['sair'])) {
      session_unset();
      session_destroy();
      header("Location: ../index.php");
      exit;
  }

  if (isset($_SESSION['id_usuario'])) {
      $id_usuario = $_SESSION['id_usuario'];

      $stmt = $conect->prepare("SELECT nome, foto FROM usuarios WHERE id_usuario = :id LIMIT 1");
      $stmt->bindValue(':id', $id_usuario, PDO::PARAM_INT);
      $stmt->execute();

      $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

      $nome = $usuario['nome'] ?? 'Usuário';
      $foto = $usuario['foto'] ?? 'default.jpg';
  } else {
      $nome = 'Usuário';
      $foto = 'default.jpg';
  }
?>



<!DOCTYPE html>
<html lang="pt_br">
<head >
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel X</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="../dist/css/estilo.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="Perfil e saída">
          <i class="fas fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          
          <a href="?sair" class="dropdown-item">
            <i class=" fas fa-sign-out-alt mr-2"></i> Sair
          </a>
          
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">Hotel X</span>
    </a>

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../img/imgPessoas/<?= htmlspecialchars($foto)?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= htmlspecialchars($nome) ?></a>
      </div>
    </div>



      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="index.php?acao=minhasReservas" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Minhas reservas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?acao=inicio" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Lista de acomodações
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
    </div>
  </aside>