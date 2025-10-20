<?php include_once('../config/tinymce.php'); ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="d-flex justify-content-between align-items-center">
            <h1>Edição do Sobre</h1>
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

        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h4>Editar Introdução</h4>
            </div>

            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <div class="form-group">
                  <label for="titulo">Título (opcional)</label>
                  <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Digite o título da seção">
                </div>

                <div class="form-group">
                  <label for="texto">Texto curto</label>
                  <textarea class="form-control" name="texto" id="texto" rows="4" placeholder="Digite o texto curto da seção" required></textarea>
                </div>

                <div class="form-group">
                  <label for="imagem">Imagem</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="imagem" id="imagem" required>
                      <label class="custom-file-label" for="imagem">Escolher arquivo de imagem</label>
                    </div>
                  </div>
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" name="botao" class="btn btn-primary">Atualizar Seção Sobre</button>
              </div>
            </form>

            <?php
              if(isset($_POST['botao'])){
                  $titulo = $_POST['titulo'] ?? 'Sobre Nós';
                  $texto = $_POST['texto'];

                  $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
                  $pasta="../img/imgHotel/";
                  $temporario = $_FILES['imagem']['tmp_name'];
                  $novoNome = uniqid().".$extensao";

                  if(move_uploaded_file($temporario, $pasta.$novoNome)){

                      // Verificar se já existe algum registro
                      $verifica = $conect->query("SELECT COUNT(*) FROM sobre");
                      $total = $verifica->fetchColumn();

                      if($total == 0){
                          // INSERT se não existir
                          $sql = "INSERT INTO sobre (titulo, texto, imagem) 
                                  VALUES (:titulo, :texto, :imagem)";
                      } else {
                          // UPDATE no primeiro registro existente
                          $sql = "UPDATE sobre SET titulo = :titulo, texto = :texto, imagem = :imagem LIMIT 1";
                      }

                      try{
                          $stmt = $conect->prepare($sql);
                          $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                          $stmt->bindParam(':texto', $texto, PDO::PARAM_STR);
                          $stmt->bindParam(':imagem', $novoNome, PDO::PARAM_STR);
                          $stmt->execute();

                          if($stmt->rowCount() > 0){
                              echo '<div class="alert alert-success alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
                                      Seção Sobre atualizada com sucesso.
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

