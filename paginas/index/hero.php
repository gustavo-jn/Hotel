
<div class="content-wrapper">
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <div class="d-flex justify-content-between align-items-center">
          <h1>Edição da Página inicial</h1>
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
              <h4>Edição do Hero</h4>
            </div>

            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                
                <div class="form-group">
                  <label for="inputNome">Titulo</label>
                  <input type="text" class="form-control" name="titulo" id="titulo"  required placeholder="Digite o título">
                </div>

                <div class="form-group">
                  <label for="inputTelefone">Sub-titulo</label>
                  <input type="text" class="form-control" name="subtitulo" id="subtitulo" required placeholder="Digite o sub-titulo">
                </div>

                <div class="form-group">
                  <label for="inputFoto">Banner</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="banner" id="banner" required>
                      <label class="custom-file-label" for="inputFoto">Escolher arquivo de imagem</label>
                    </div>
                  </div>
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" name="botao" class="btn btn-primary">Atualizar Seção Hero</button>
              </div>
            </form>

            <?php
              if(isset($_POST['botao'])){
                  $titulo = $_POST['titulo'];
                  $subtitulo = $_POST['subtitulo'];
                  $extensao = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION); // PEGA A EXTENSÃO DO ARQUIVO

                  $pasta="../img/imgHotel/";
                  $temporario = $_FILES['banner']['tmp_name'];
                  $novoNome = uniqid().".$extensao";

                  if(move_uploaded_file($temporario, $pasta.$novoNome)){

                      // Verificar se já existe algum registro
                      $verifica = $conect->query("SELECT COUNT(*) FROM hero");
                      $total = $verifica->fetchColumn();

                      if($total == 0){
                          // Se não existir, faz INSERT
                          $sql = "INSERT INTO hero (titulo, subtitulo, imagem) 
                                  VALUES (:titulo, :subtitulo, :imagem)";
                      } else {
                          // Se existir, faz UPDATE no primeiro registro (ou ajustar WHERE se tiver id)
                          $sql = "UPDATE hero SET titulo = :titulo, subtitulo = :subtitulo, imagem = :imagem LIMIT 1";
                      }

                      try{
                          $stmt = $conect->prepare($sql);
                          $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
                          $stmt->bindParam(':subtitulo', $subtitulo, PDO::PARAM_STR);
                          $stmt->bindParam(':imagem', $novoNome, PDO::PARAM_STR);
                          $stmt->execute();

                          if($stmt->rowCount() > 0){
                              echo '<div class="alert alert-success alert-dismissible">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
                                      Dados atualizados com sucesso.
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