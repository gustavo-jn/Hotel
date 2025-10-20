<?php include_once('../config/tinymce.php'); ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="d-flex justify-content-between align-items-center">
            <h1>Gerenciar FAQ</h1>
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
              <h4>Adicionar / Editar Pergunta</h4>
            </div>

            <!-- Formulário FAQ -->
            <form role="form" method="post">
              <div class="card-body">
                
                <div class="form-group">
                  <label for="pergunta">Pergunta</label>
                  <input type="text" class="form-control" name="pergunta" id="pergunta" required placeholder="Digite a pergunta">
                </div>

                <div class="form-group">
                  <label for="resposta">Resposta</label>
                  <textarea class="form-control" name="resposta" id="resposta" rows="4" required placeholder="Digite a resposta"></textarea>
                </div>

              </div>

              <div class="card-footer">
                <button type="submit" name="cadastrar" class="btn btn-success">Adicionar</button>
              </div>
            </form>

            <?php
            // ADICIONAR NOVA PERGUNTA
            if (isset($_POST['cadastrar'])) {
              $pergunta = $_POST['pergunta'];
              $resposta = $_POST['resposta'];

              $sql = "INSERT INTO faq (pergunta, resposta) VALUES (:pergunta, :resposta)";
              try {
                $stmt = $conect->prepare($sql);
                $stmt->bindParam(':pergunta', $pergunta);
                $stmt->bindParam(':resposta', $resposta);
                $stmt->execute();

                echo '<div class="alert alert-success mt-2">Pergunta adicionada com sucesso!</div>';
              } catch (PDOException $e) {
                echo '<div class="alert alert-danger mt-2">Erro: ' . $e->getMessage() . '</div>';
              }
            }

            // REMOVER PERGUNTA
            if (isset($_GET['del'])) {
              $id = $_GET['del'];
              try {
                $del = $conect->prepare("DELETE FROM faq WHERE id_faq = :id");
                $del->bindParam(':id', $id, PDO::PARAM_INT);
                $del->execute();
                echo '<div class="alert alert-warning mt-2">Pergunta removida com sucesso!</div>';
              } catch (PDOException $e) {
                echo '<div class="alert alert-danger mt-2">Erro ao excluir: ' . $e->getMessage() . '</div>';
              }
            }

            // EDITAR PERGUNTA
            if (isset($_POST['editar'])) {
              $id = $_POST['id_faq'];
              $pergunta = $_POST['pergunta'];
              $resposta = $_POST['resposta'];

              $sql = "UPDATE faq SET pergunta = :pergunta, resposta = :resposta WHERE id_faq = :id";
              try {
                $stmt = $conect->prepare($sql);
                $stmt->bindParam(':pergunta', $pergunta);
                $stmt->bindParam(':resposta', $resposta);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                echo '<div class="alert alert-success mt-2">Pergunta atualizada com sucesso!</div>';
              } catch (PDOException $e) {
                echo '<div class="alert alert-danger mt-2">Erro: ' . $e->getMessage() . '</div>';
              }
            }
            ?>

          </div>

          <!-- LISTA DE FAQ -->
          <div class="card card-secondary">
            <div class="card-header">
              <h4>Perguntas Cadastradas</h4>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Pergunta</th>
                    <th>Resposta</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $select = "SELECT * FROM faq ORDER BY id_faq DESC";
                  try {
                    $result = $conect->prepare($select);
                    $result->execute();
                    $count = $result->rowCount();

                    if ($count > 0) {
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo "
                        <tr>
                          <td>$id_faq</td>
                          <td>$pergunta</td>
                          <td>" . substr($resposta, 0, 80) . "...</td>
                          <td>
                            <a href='?acao=faq&edit=$id_faq' class='btn btn-sm btn-warning'>Editar</a>
                            <a href='?acao=faq&del=$id_faq' class='btn btn-sm btn-danger' onclick=\"return confirm('Tem certeza que deseja excluir esta pergunta?')\">Excluir</a>
                          </td>
                        </tr>";
                      }
                    } else {
                      echo "<tr><td colspan='4'>Nenhuma pergunta cadastrada.</td></tr>";
                    }
                  } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <?php
          // FORMULÁRIO DE EDIÇÃO
          if (isset($_GET['edit'])) {
            $idEdit = $_GET['edit'];
            $busca = $conect->prepare("SELECT * FROM faq WHERE id_faq = :id");
            $busca->bindParam(':id', $idEdit, PDO::PARAM_INT);
            $busca->execute();
            $faq = $busca->fetch(PDO::FETCH_ASSOC);

            if ($faq) {
          ?>
              <div class="card card-warning mt-4">
                <div class="card-header">
                  <h4>Editar Pergunta ID #<?= $faq['id_faq'] ?></h4>
                </div>
                <form method="post">
                  <div class="card-body">
                    <input type="hidden" name="id_faq" value="<?= $faq['id_faq'] ?>">

                    <div class="form-group">
                      <label>Pergunta</label>
                      <input type="text" class="form-control" name="pergunta" value="<?= $faq['pergunta'] ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Resposta</label>
                      <textarea class="form-control" name="resposta" rows="4" required><?= $faq['resposta'] ?></textarea>
                    </div>
                  </div>

                  <div class="card-footer">
                    <button type="submit" name="editar" class="btn btn-warning">Salvar Alterações</button>
                  </div>
                </form>
              </div>
          <?php
            }
          }
          ?>

        </div>
      </div>
    </div>
  </section>
</div>
