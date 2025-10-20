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
    <a href="">Cadastre-se para ter acesso</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Preencha com os seus dados para se cadastrar</p>

      <form action="" method="post" enctype="multipart/form-data">

        <div class="input-group mb-3">
          <input type="text" name="nome" class="form-control" placeholder="Digite seu Nome">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" name="telefone" class="form-control" placeholder="Digite seu telefone">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="senha" class="form-control" placeholder="Digite sua senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="form-group">
            <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="foto" id="foto" required>
                <label class="custom-file-label" for="inputFoto">Escolher arquivo de imagem</label>
            </div>
            </div>
        </div>

        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" name="botao" class="btn btn-primary btn-block">Finalizar cadastro</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

        <?php
            include('config/conexao.php');
            if(isset($_POST['botao'])){
                $nome = $_POST['nome'];
                $telefone = $_POST['telefone'];
                $email = $_POST['email'];
                $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $tipo = 'user';

                $formatP = array("png", "jpg", "jpeg", "gif");
                $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

                if(in_array($extensao, $formatP)){
                $pasta = "img/imgPessoas/";
                $temporario = $_FILES['foto']['tmp_name'];
                $novoNome = uniqid().".$extensao";

                if(move_uploaded_file($temporario, $pasta.$novoNome)){
                    $cadastro = "INSERT INTO usuarios (nome, email, senha, telefone, tipo, foto) VALUES (:nome, :email, :senha, :telefone, :tipo, :foto)";
                    try{
                    $result = $conect->prepare($cadastro);
                    $result->bindParam(':nome', $nome,PDO::PARAM_STR);
                    $result->bindParam(':email', $email,PDO::PARAM_STR);
                    $result->bindParam(':senha', $senha,PDO::PARAM_STR);
                    $result->bindParam(':telefone', $telefone,PDO::PARAM_STR);
                    $result->bindParam(':tipo', $tipo,PDO::PARAM_STR);
                    $result->bindParam(':foto', $novoNome,PDO::PARAM_STR);
                    $result->execute();
                    echo "Usuário cadastrado com sucesso!";
                    }catch(PDOException $e){
                    echo "Erro de PDO".$e->getMessage();
                    }
                }else{
                    echo "Erro, não foi possível fazer o upload do arquivo!";
                }

                }else{
                echo "Formato Inválido";
                }
            }
        ?>
            

      <p style="text-align: center; padding-top: 25px">
        <a href="login.php" class="text-center">Se já possui uma conta, clique aqui!</a>
      </p>
    </div>

  </div>
</div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>
