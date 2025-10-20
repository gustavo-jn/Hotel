<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar Quarto</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <?php
        include_once('../config/conexao.php');

        if (!isset($_GET['id'])) {
          header("Location: home.php");
          exit;
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);

        $select = "SELECT * FROM quartos WHERE id_quarto = :id";
        try {
          $resultado = $conect->prepare($select);
          $resultado->bindParam(':id', $id, PDO::PARAM_INT);
          $resultado->execute();

          $contar = $resultado->rowCount();
          if ($contar > 0) {
            while ($show = $resultado->fetch(PDO::FETCH_OBJ)) {
              $idQuarto = $show->id_quarto;
              $numero_quarto = $show->numero_quarto;
              $tipo_quarto = $show->tipo_quarto;
              $preco_diaria = $show->preco_diaria;
              $descricao = $show->descricao;
              $imagem = $show->imagem;
              $status = $show->status;
            }
          } else {
            echo '❌ Quarto não encontrado.';
          }
        } catch (PDOException $e) {
          echo 'Erro de SELECT no PDO: ' . $e->getMessage();
        }
      ?>

      <div class="row">
        <!-- Formulário -->
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Editar Quarto</h3>
            </div>

            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <div class="form-group">
                  <label>Número do Quarto</label>
                  <input type="text" class="form-control" name="numero_quarto" required value="<?= htmlspecialchars($numero_quarto); ?>">
                </div>

                <div class="form-group">
                  <label>Tipo do Quarto</label>
                  <input type="text" class="form-control" name="tipo_quarto" required value="<?= htmlspecialchars($tipo_quarto); ?>">
                </div>

                <div class="form-group">
                  <label>Preço da Diária (R$)</label>
                  <input type="number" step="0.01" class="form-control" name="preco_diaria" required value="<?= htmlspecialchars($preco_diaria); ?>">
                </div>

                <div class="form-group">
                  <label>Descrição</label>
                  <textarea class="form-control" name="descricao" rows="3"><?= htmlspecialchars($descricao); ?></textarea>
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="disponivel" <?= $status == 'disponivel' ? 'selected' : '' ?>>Disponível</option>
                    <option value="ocupado" <?= $status == 'ocupado' ? 'selected' : '' ?>>Ocupado</option>
                    <option value="manutencao" <?= $status == 'manutencao' ? 'selected' : '' ?>>Manutenção</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Nova Imagem (opcional)</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="imagem">
                      <label class="custom-file-label">Escolher arquivo</label>
                    </div>
                  </div>
                </div>

                <input type="hidden" name="id" value="<?= $idQuarto; ?>">

              </div>

              <div class="card-footer">
                <button type="submit" name="editar_quarto" class="btn btn-primary">Salvar Alterações</button>
              </div>
            </form>

            <?php
              if (isset($_POST['editar_quarto'])) {
                $id = $_POST['id'];
                $numero = $_POST['numero_quarto'];
                $tipo = $_POST['tipo_quarto'];
                $preco = $_POST['preco_diaria'];
                $descricao = $_POST['descricao'];
                $status = $_POST['status'];

                $novoNomeImagem = $imagem; // Imagem antiga por padrão

                if (!empty($_FILES['imagem']['name'])) {
                  $formatosPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
                  $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

                  if (in_array(strtolower($ext), $formatosPermitidos)) {
                    $pasta = "../img/imgQuartos/";
                    $temporario = $_FILES['imagem']['tmp_name'];
                    $novoNomeImagem = uniqid() . "." . $ext;

                    if (!move_uploaded_file($temporario, $pasta . $novoNomeImagem)) {
                      echo "<div class='alert alert-danger'>Erro ao fazer upload da nova imagem!</div>";
                      exit;
                    }
                  } else {
                    echo "<div class='alert alert-warning'>Formato de imagem inválido!</div>";
                    exit;
                  }
                }

                $update = "UPDATE quartos SET 
                            numero_quarto = :numero, 
                            tipo_quarto = :tipo, 
                            preco_diaria = :preco, 
                            descricao = :descricao, 
                            imagem = :imagem, 
                            status = :status 
                          WHERE id_quarto = :id";

                try {
                  $result = $conect->prepare($update);
                  $result->bindParam(':numero', $numero);
                  $result->bindParam(':tipo', $tipo);
                  $result->bindParam(':preco', $preco);
                  $result->bindParam(':descricao', $descricao);
                  $result->bindParam(':imagem', $novoNomeImagem);
                  $result->bindParam(':status', $status);
                  $result->bindParam(':id', $id);
                  $result->execute();

                  if ($result->rowCount() > 0) {
                    echo "<div class='alert alert-success'>✅ Quarto atualizado com sucesso!</div>";
                  } else {
                    echo "<div class='alert alert-warning'>⚠️ Nenhuma alteração realizada.</div>";
                  }
                } catch (PDOException $e) {
                  echo "Erro de PDO: " . $e->getMessage();
                }
              }
            ?>

          </div>
        </div>

        <!-- Exibição do quarto -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Visualização do Quarto</h3>
            </div>

            <div class="card-body text-center">
              <img src="../img/imgQuartos/<?= $imagem; ?>" alt="Imagem do Quarto" style="width: 100%; max-width: 300px; height: auto; object-fit: cover; border-radius: 10px;">
              <h3><?= htmlspecialchars($numero_quarto); ?> - <?= htmlspecialchars($tipo_quarto); ?></h3>
              <p><strong>Preço:</strong> R$ <?= number_format($preco_diaria, 2, ',', '.'); ?></p>
              <p><strong>Status:</strong> <?= ucfirst($status); ?></p>
              <p><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($descricao)); ?></p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>
