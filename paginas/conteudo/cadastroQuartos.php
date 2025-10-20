<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cadastro de Quartos</h1>
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
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Incluir Quarto</h3>
            </div>

            <!-- Form start -->
            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <div class="form-group">
                  <label for="numero_quarto">Número do Quarto</label>
                  <input type="text" class="form-control" name="numero_quarto" id="numero_quarto" required placeholder="Ex: 101">
                </div>

                <div class="form-group">
                  <label for="tipo_quarto">Tipo do Quarto</label>
                  <input type="text" class="form-control" name="tipo_quarto" id="tipo_quarto" required placeholder="Ex: Solteiro, Casal">
                </div>

                <div class="form-group">
                  <label for="preco_diaria">Preço da Diária (R$)</label>
                  <input type="number" step="0.01" class="form-control" name="preco_diaria" id="preco_diaria" required placeholder="Ex: 150.00">
                </div>

                <div class="form-group">
                  <label for="descricao">Descrição</label>
                  <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Descreva o quarto"></textarea>
                </div>

                <div class="form-group">
                  <label for="imagem">Imagem do Quarto</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="imagem" id="imagem" required>
                      <label class="custom-file-label" for="imagem">Escolher arquivo de imagem</label>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control">
                    <option value="disponivel" selected>Disponível</option>
                    <option value="ocupado">Ocupado</option>
                    <option value="manutencao">Manutenção</option>
                  </select>
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" name="cadastrar_quarto" class="btn btn-primary">Cadastrar Quarto</button>
              </div>
            </form>

            <?php
              if (isset($_POST['cadastrar_quarto'])) {
                $numero = $_POST['numero_quarto'];
                $tipo = $_POST['tipo_quarto'];
                $preco = $_POST['preco_diaria'];
                $descricao = $_POST['descricao'];
                $status = $_POST['status'];

                $formatosPermitidos = array("png", "jpg", "jpeg", "gif");
                $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

                if (in_array($extensao, $formatosPermitidos)) {
                  $pasta = "../img/imgQuartos/";
                  $temporario = $_FILES['imagem']['tmp_name'];
                  $nomeImagem = uniqid() . ".$extensao";

                  if (move_uploaded_file($temporario, $pasta . $nomeImagem)) {
                    $insert = "INSERT INTO quartos (numero_quarto, tipo_quarto, preco_diaria, descricao, imagem, status)
                               VALUES (:numero, :tipo, :preco, :descricao, :imagem, :status)";
                    try {
                      $result = $conect->prepare($insert);
                      $result->bindParam(':numero', $numero, PDO::PARAM_STR);
                      $result->bindParam(':tipo', $tipo, PDO::PARAM_STR);
                      $result->bindParam(':preco', $preco, PDO::PARAM_STR);
                      $result->bindParam(':descricao', $descricao, PDO::PARAM_STR);
                      $result->bindParam(':imagem', $nomeImagem, PDO::PARAM_STR);
                      $result->bindParam(':status', $status, PDO::PARAM_STR);
                      $result->execute();
                      echo "<div class='alert alert-success'>Quarto cadastrado com sucesso!</div>";
                    } catch (PDOException $e) {
                      echo "Erro de PDO: " . $e->getMessage();
                    }
                  } else {
                    echo "<div class='alert alert-danger'>Erro ao fazer upload da imagem.</div>";
                  }
                } else {
                  echo "<div class='alert alert-warning'>Formato de imagem inválido!</div>";
                }
              }
            ?>
          </div>
        </div>

        <!-- Right column -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lista de Quartos</h3>
            </div>

            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Número</th>
                    <th>Tipo</th>
                    <th>Preço</th>
                    <th>Status</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $select = "SELECT * FROM quartos ORDER BY id_quarto DESC";
                    try {
                      $result = $conect->prepare($select);
                      $result->execute();
                      $cont = 1;

                      if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                  ?>
                  <tr>
                    <td><?= $cont++; ?></td>
                    <td><?= $row->numero_quarto; ?></td>
                    <td><?= $row->tipo_quarto; ?></td>
                    <td>R$ <?= number_format($row->preco_diaria, 2, ',', '.'); ?></td>
                    <td><?= ucfirst($row->status); ?></td>
                    <td>
                      <div class="btn-group">
                        <a href="home.php?acao=updateQuarto&id=<?= $row->id_quarto; ?>" class="btn btn-success" title="Editar Quarto">
                          <i class="fas fa-edit"></i>
                        </a>
                        <a href="conteudo/del_quarto.php?idDel=<?= $row->id_quarto; ?>" onclick="return confirm('Deseja remover este quarto?')" class="btn btn-danger" title="Remover Quarto">
                          <i class="fas fa-trash-alt"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <?php
                        }
                      } else {
                        echo "<tr><td colspan='6'>Nenhum quarto cadastrado.</td></tr>";
                      }
                    } catch (PDOException $e) {
                      echo "Erro de PDO: " . $e->getMessage();
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
