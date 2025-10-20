<?php
ini_set('session.gc_maxlifetime', 86400);
session_set_cookie_params(86400);

session_start();
include('config/conexao.php');

$erro = "";

if (isset($_POST['botao'])) {
    $emailDigitado = $_POST['email'];
    $senhaDigitada = $_POST['senha'];

    $stmt = $conect->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $emailDigitado);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashDoBanco = $usuario['senha'];

        if (password_verify($senhaDigitada, $hashDoBanco)) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['tipo'] = $usuario['tipo'];

            if ($_SESSION['tipo'] === 'admin') {
                header("Location: paginas/home.php?acao=bemvindo");
            } else if ($_SESSION['tipo'] === 'user') {
                header("Location: 1usuario/index.php?acao=inicio");
            } else {
                header("Location: paginas/home.php?acao=bemvindo");
            }
            exit;
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}

if (isset($_SESSION['id_usuario'])) {
    if ($_SESSION['tipo'] === 'admin') {
        header("Location: paginas/home.php?acao=bemvindo");
    } else if ($_SESSION['tipo'] === 'user') {
        header("Location: 1usuario/index.php");
    } else {
        header("Location: paginas/home.php?acao=bemvindo");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hotel X</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php">Hotel Paraiso</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Para acessar entre com E-mail e senha</p>

      <?php if ($erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
      <?php endif; ?>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8"></div>
          <div class="col-12">
            <button type="submit" name="botao" class="btn btn-primary btn-block">Acessar hotel</button>
          </div>
        </div>
      </form>

      <p style="text-align: center; padding-top: 25px">
        <a href="cadUser.php" class="text-center">Se ainda não tiver cadastro, clique aqui!</a>
      </p>
    </div>
  </div>
</div>

<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>
