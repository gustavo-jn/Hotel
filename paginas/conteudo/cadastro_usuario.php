
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cadastro de Pessoas</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        
        <!-- Left column -->
        <div class="col-md-4">
          <!-- General form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Incluir Contato</h3>
            </div>

            <!-- Form start -->
            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                
                <div class="form-group">
                  <label for="inputNome">Nome</label>
                  <input type="text" class="form-control" name="nome" id="nome"  required placeholder="Digite o nome">
                </div>

                <div class="form-group">
                  <label for="inputTelefone">Telefone</label>
                  <input type="text" class="form-control" name="telefone" id="telefone" required placeholder="(00) 00000-0000">
                </div>

                <div class="form-group">
                  <label for="inputEmail">Endereço de Email</label>
                  <input type="email" class="form-control" name="email" id="email" required placeholder="Digite um email">
                </div>

                <div class="form-group">
                  <label for="inputSenha">Senha</label>
                  <input type="password" class="form-control" name="senha" id="senha" required placeholder="Digite uma senha">
                </div>

                <div class="form-group">
                  <label for="inputFoto">Foto do Contato</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="foto" id="foto" required>
                      <label class="custom-file-label" for="inputFoto">Escolher arquivo de imagem</label>
                    </div>
                  </div>
                </div>

                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="checkAutorizacao" name="tipo">
                  <label class="form-check-label" for="checkAutorizacao">
                    Cadastrar como usuário administrador.
                  </label>
                </div>

              </div>

              <!-- Card footer -->
              <div class="card-footer">
                <button type="submit" name="botao" class="btn btn-primary">Cadastrar Contato</button>
              </div>
            </form>

            <?php
                if(isset($_POST['botao'])){
                  $nome = $_POST['nome'];
                  $telefone = $_POST['telefone'];
                  $email = $_POST['email'];
                  $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                  $tipo = isset($_POST['tipo']) ? 'admin' : 'user';

                  $formatP = array("png", "jpg", "jpeg", "gif");
                  $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

                  if(in_array($extensao, $formatP)){
                    $pasta = "../img/imgPessoas/";
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

          </div>
        </div>

        <!-- Right column -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lista de usuários</h3>
            </div>

            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>

                <tr>
                    <th style="width: 10px">#</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Tipo</th>
                    <th style="width: 40px">Acões</th>
                  </tr>

                <?php
                  $select = "SELECT*FROM usuarios ORDER BY id_usuario DESC";
                  try{
                    $result = $conect->prepare($select);
                    $cont = 1;
                    $result->execute();

                    $contar = $result->rowCount();
                    if($contar>0){
                      while($show = $result->FETch(PDO::FETCH_OBJ)){
                ?>

                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $cont++;?></td>
                    <td><?php echo $show->nome;?></td>
                    <td><?php echo $show->telefone;?></td>
                    <td><?php echo $show->email;?></td>
                    <td><?php echo $show->tipo;?></td>
                    <td><div class="btn-group">
                        <a href="home.php?acao=editar&id=<?php echo $show->id_usuario;?>" class="btn btn-success"> <title>"Editar Contato</title><i class="fas fa-user-edit"></i></a>
                        <a href="conteudo/del_usuario.php?idDel=<?php echo $show->id_usuario;?>" onclick="return confirm('Deseja remover o contato?')" class="btn btn-danger"><i class="fas fa-trash-alt"><title>Remover contato</title></i></a>
                      </div>
                    </td>
                  </tr>

                  <?php
                     }
                    }else{
                      
                    }
                  }catch(PDOException $e){
                    echo "Erro de PDO". $e->getMessage();
                  }
                  ?>

                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>
