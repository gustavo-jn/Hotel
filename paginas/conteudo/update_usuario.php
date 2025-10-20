<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar usuário</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <?php
        include_once('../config/conexao.php');
        if(!isset($_GET['id'])){
          header("Location: home.php");
          exit;
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

        $select = "SELECT * FROM usuarios WHERE id_usuario=:id";
        try{
          $resultado = $conect->prepare($select);
          $resultado->bindParam(':id', $id, PDO::PARAM_INT);
          $resultado->execute();

          $contar = $resultado->rowCount();
          if($contar>0){
            while($show = $resultado->FETCH(PDO::FETCH_OBJ)){
              $idCont = $show->id_usuario;
              $nome = $show->nome;
              $email = $show->email;
              $senha = $show->senha;
              $telefone = $show->telefone;
              $foto = $show->foto;
            }
          }else{
            echo 'Não há dados com o id informado';
          }
        }catch(PDOException $e){
          echo 'Erro de select no PDO: '.$e->getMessage();
        }
      ?>
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Editar Contato</h3>
            </div>

            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                
                <div class="form-group">
                  <label for="inputNome">Nome</label>
                  <input type="text" class="form-control" name="nome" id="nome" required value="<?php echo htmlspecialchars($nome); ?>">
                </div>

                <div class="form-group">
                  <label for="inputTelefone">Telefone</label>
                  <input type="text" class="form-control" name="telefone" id="telefone" required value="<?php echo htmlspecialchars($telefone); ?>">
                </div>

                <div class="form-group">
                  <label for="inputEmail">Endereço de Email</label>
                  <input type="email" class="form-control" name="email" id="email" required value="<?php echo htmlspecialchars($email); ?>">
                </div>

                <div class="form-group">
                  <label for="inputFoto">Foto do Contato</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="foto" id="foto">
                      <label class="custom-file-label" for="inputFoto">Escolher arquivo de imagem</label>
                    </div>
                  </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $idCont; ?>">

              </div>

              <div class="card-footer">
                <button type="submit" name="upContato" class="btn btn-primary">Finalizar edição do usuário</button>
              </div>
            </form>

            <?php
              if (isset($_POST['upContato'])) {
                  $id = $_POST['id'];
                  $nome = $_POST['nome'];
                  $telefone = $_POST['telefone'];
                  $email = $_POST['email'];

                  $novoNome = $foto; 

                  if (!empty($_FILES['foto']['name'])) {
                      $formatP = array("png", "jpg", "jpeg", "gif");
                      $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

                      if (in_array(strtolower($extensao), $formatP)) {
                          $pasta = "../img/imgPessoas/";
                          $temporario = $_FILES['foto']['tmp_name'];
                          $novoNome = uniqid() . "." . $extensao;

                          if (!move_uploaded_file($temporario, $pasta . $novoNome)) {
                              echo "Erro, não foi possível fazer o upload do arquivo!";
                              exit;
                          }
                      } else {
                          echo "Formato inválido!";
                          exit;
                      }
                  }

                  $update = "UPDATE usuarios 
                            SET nome = :nome, email = :email, telefone = :telefone, foto = :foto 
                            WHERE id_usuario = :id";

                  try {
                      $result = $conect->prepare($update);
                      $result->bindParam(':id', $id, PDO::PARAM_INT);
                      $result->bindParam(':nome', $nome, PDO::PARAM_STR);
                      $result->bindParam(':email', $email, PDO::PARAM_STR);
                      $result->bindParam(':telefone', $telefone, PDO::PARAM_STR);
                      $result->bindParam(':foto', $novoNome, PDO::PARAM_STR);
                      $result->execute();

                      $contar = $result->rowCount();
                      if ($contar > 0) {
                          echo "✅ Dados editados com sucesso!";
                      } else {
                          echo "⚠️ Nenhuma alteração feita (dados iguais ou erro)";
                      }
                  } catch (PDOException $e) {
                      echo "Erro de PDO: " . $e->getMessage();
                  }
              }
              ?>


          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Dados do usuário</h3>
            </div>

            <div class="card-body p-0" style="text-align: center">
              <img src="../img/imgPessoas/<?php echo $foto; ?>" alt="<?php echo htmlspecialchars($foto); ?>" style="width: 200px; height: 200px; border-radius: 100%; object-fit: cover;">
              <h1><?php echo htmlspecialchars($nome); ?></h1>
              <strong><?php echo htmlspecialchars($telefone); ?></strong>
              <p><?php echo htmlspecialchars($email); ?></p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>
