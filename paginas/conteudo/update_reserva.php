<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar Reserva</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <?php
        include_once('../config/conexao.php');

        if(!isset($_GET['id_reserva'])){
          header("Location: home.php");
          exit;
        }
        $id_reserva = filter_input(INPUT_GET, 'id_reserva', FILTER_VALIDATE_INT);

        // Pega dados da reserva atual
        $select = "SELECT * FROM reservas WHERE id_reserva = :id_reserva";
        try {
          $result = $conect->prepare($select);
          $result->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);
          $result->execute();

          if ($result->rowCount() > 0) {
            $reserva = $result->fetch(PDO::FETCH_OBJ);
          } else {
            echo '<div class="alert alert-warning">Reserva não encontrada.</div>';
            exit;
          }
        } catch(PDOException $e) {
          echo '<div class="alert alert-danger">Erro ao buscar reserva: ' . $e->getMessage() . '</div>';
          exit;
        }

        // Puxa lista de usuários para select
        $usuarios = [];
        try {
          $sqlUsers = $conect->query("SELECT id_usuario, nome FROM usuarios ORDER BY nome");
          $usuarios = $sqlUsers->fetchAll(PDO::FETCH_OBJ);
        } catch(PDOException $e) {
          echo '<div class="alert alert-danger">Erro ao buscar usuários: ' . $e->getMessage() . '</div>';
        }

        // Puxa lista de quartos para select
        $quartos = [];
        try {
          $sqlRooms = $conect->query("SELECT id_quarto, numero_quarto, tipo_quarto FROM quartos ORDER BY numero_quarto");
          $quartos = $sqlRooms->fetchAll(PDO::FETCH_OBJ);
        } catch(PDOException $e) {
          echo '<div class="alert alert-danger">Erro ao buscar quartos: ' . $e->getMessage() . '</div>';
        }
      ?>

      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Editar Reserva</h3>
            </div>

            <form role="form" action="" method="post">
              <div class="card-body">

                <div class="form-group">
                  <label for="id_usuario">Usuário</label>
                  <select name="id_usuario" id="id_usuario" class="form-control" required>
                    <option value="">Selecione um usuário</option>
                    <?php foreach($usuarios as $user): ?>
                      <option value="<?= $user->id_usuario ?>" <?= ($user->id_usuario == $reserva->id_usuario) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($user->nome) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="id_quarto">Quarto</label>
                  <select name="id_quarto" id="id_quarto" class="form-control" required>
                    <option value="">Selecione um quarto</option>
                    <?php foreach($quartos as $quarto): ?>
                      <option value="<?= $quarto->id_quarto ?>" <?= ($quarto->id_quarto == $reserva->id_quarto) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($quarto->numero_quarto . " - " . $quarto->tipo_quarto) ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="data_checkin">Data Check-in</label>
                  <input type="date" name="data_checkin" id="data_checkin" class="form-control" required
                         value="<?= htmlspecialchars($reserva->data_checkin) ?>">
                </div>

                <div class="form-group">
                  <label for="data_checkout">Data Check-out</label>
                  <input type="date" name="data_checkout" id="data_checkout" class="form-control" required
                         value="<?= htmlspecialchars($reserva->data_checkout) ?>">
                </div>

                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control" required>
                    <option value="pendente" <?= ($reserva->status == 'pendente') ? 'selected' : '' ?>>Pendente</option>
                    <option value="confirmada" <?= ($reserva->status == 'confirmada') ? 'selected' : '' ?>>Confirmada</option>
                    <option value="cancelada" <?= ($reserva->status == 'cancelada') ? 'selected' : '' ?>>Cancelada</option>
                  </select>
                </div>

                <input type="hidden" name="id_reserva" value="<?= $id_reserva ?>">

              </div>

              <div class="card-footer">
                <button type="submit" name="updateReserva" class="btn btn-primary">Atualizar Reserva</button>
              </div>
            </form>

            <?php
              if (isset($_POST['updateReserva'])) {
                $id_reserva_post = $_POST['id_reserva'];
                $id_usuario = $_POST['id_usuario'];
                $id_quarto = $_POST['id_quarto'];
                $data_checkin = $_POST['data_checkin'];
                $data_checkout = $_POST['data_checkout'];
                $status = $_POST['status'];

                // Validação básica: check-out maior que check-in
                if ($data_checkout <= $data_checkin) {
                  echo '<div class="alert alert-warning">A data de check-out deve ser maior que a de check-in.</div>';
                } else {
                  $update = "UPDATE reservas SET 
                              id_usuario = :id_usuario,
                              id_quarto = :id_quarto,
                              data_checkin = :data_checkin,
                              data_checkout = :data_checkout,
                              status = :status
                            WHERE id_reserva = :id_reserva";

                  try {
                    $stmt = $conect->prepare($update);
                    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $stmt->bindParam(':id_quarto', $id_quarto, PDO::PARAM_INT);
                    $stmt->bindParam(':data_checkin', $data_checkin, PDO::PARAM_STR);
                    $stmt->bindParam(':data_checkout', $data_checkout, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                    $stmt->bindParam(':id_reserva', $id_reserva_post, PDO::PARAM_INT);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                      echo '<div class="alert alert-success">✅ Reserva atualizada com sucesso!</div>';
                    } else {
                      echo '<div class="alert alert-info">⚠️ Nenhuma alteração feita.</div>';
                    }
                  } catch (PDOException $e) {
                    echo '<div class="alert alert-danger">Erro ao atualizar reserva: ' . $e->getMessage() . '</div>';
                  }
                }
              }
            ?>

          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detalhes da Reserva</h3>
            </div>

            <div class="card-body">
              <p><strong>Usuário ID:</strong> <?= htmlspecialchars($reserva->id_usuario) ?></p>
              <p><strong>Quarto ID:</strong> <?= htmlspecialchars($reserva->id_quarto) ?></p>
              <p><strong>Check-in:</strong> <?= htmlspecialchars($reserva->data_checkin) ?></p>
              <p><strong>Check-out:</strong> <?= htmlspecialchars($reserva->data_checkout) ?></p>
              <p><strong>Status:</strong> <?= htmlspecialchars($reserva->status) ?></p>
              <p><strong>Criada em:</strong> <?= htmlspecialchars($reserva->criada_em) ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
