<div class="content-wrapper">
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1>Seção Contato</h1>
          <div>
              <a href="home.php?acao=paginaInicial" class="btn btn-sm btn-primary">Hero</a>
              <a href="home.php?acao=sobre" class="btn btn-sm btn-primary">Sobre</a>
              <a href="home.php?acao=equipe" class="btn btn-sm btn-primary">Equipe</a>
              <a href="home.php?acao=faq" class="btn btn-sm btn-primary">FAQ</a>
              <a href="home.php?acao=contato" class="btn btn-sm btn-primary">Contato</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- Tabela de contatos recebidos -->
      <div class="col-md-12 mb-4">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Mensagens Recebidas</h4>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Mensagem</th>
                  <th>Data de Envio</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $conect->query("SELECT * FROM contato ORDER BY data_envio DESC");
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr>";
                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['nome']."</td>";
                  echo "<td>".$row['email']."</td>";
                  echo "<td>".$row['mensagem']."</td>";
                  echo "<td>".$row['data_envio']."</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Formulário para atualizar imagem/banner -->
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h4>Atualizar Banner da Seção Contato</h4>
          </div>

          <form role="form" action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <label for="banner">Escolher nova imagem</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="banner" id="banner" required>
                    <label class="custom-file-label" for="banner">Escolher arquivo de imagem</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" name="botao" class="btn btn-primary">Atualizar Banner</button>
            </div>
          </form>

          <?php
          if(isset($_POST['botao'])){
              $extensao = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
              $pasta="../img/imgHotel/";
              $temporario = $_FILES['banner']['tmp_name'];
              $novoNome = uniqid().".$extensao";

              if(move_uploaded_file($temporario, $pasta.$novoNome)){

                  // Verificar se já existe um registro de banner
                  $verifica = $conect->query("SELECT COUNT(*) FROM imagem");
                  $total = $verifica->fetchColumn();

                  if($total == 0){
                      // Insere um registro apenas com a imagem
                      $sql = "INSERT INTO imagem (imagem) VALUES (:imagem)";
                  } else {
                      // Atualiza o primeiro registro (ou ajustar WHERE se quiser atualizar específico)
                      $sql = "UPDATE imagem SET imagem = :imagem ORDER BY id ASC LIMIT 1";
                  }

                  try{
                      $stmt = $conect->prepare($sql);
                      $stmt->bindParam(':imagem', $novoNome, PDO::PARAM_STR);
                      $stmt->execute();

                      if($stmt->rowCount() > 0){
                          echo '<div class="alert alert-success alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
                                  Banner atualizado com sucesso.
                                </div>';
                      } else {
                          echo '<div class="alert alert-danger alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-ban"></i> Erro!</h5>
                                  Nenhuma alteração foi feita.
                                </div>';
                      }

                  } catch(PDOException $e){
                      echo "Erro de PDO: ".$e->getMessage();
                  }
              }
          }
          ?>

        </div>
      </div>

    </div>
  </div>
</section>
</div>
