<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reservas Feitas</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lista de Reservas</h3>
            </div>

            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Usuário</th>
                    <th>Quarto</th>
                    <th>Tipo do Quarto</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Status</th>
                    <th style="width: 80px">Deletar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  try {
                    $stmt = $conect->prepare("
                      SELECT r.id_reserva, u.nome AS usuario, q.numero_quarto, q.tipo_quarto, 
                             r.data_checkin, r.data_checkout, r.status
                      FROM reservas r
                      INNER JOIN usuarios u ON r.id_usuario = u.id_usuario
                      INNER JOIN quartos q ON r.id_quarto = q.id_quarto
                      ORDER BY r.criada_em DESC
                    ");
                    $stmt->execute();
                    $reservas = $stmt->fetchAll(PDO::FETCH_OBJ);

                    $cont = 1;
                    if(count($reservas) > 0){
                      foreach($reservas as $reserva){
                        ?>
                        <tr>
                          <td><?= $cont++; ?></td>
                          <td><?= htmlspecialchars($reserva->usuario) ?></td>
                          <td><?= htmlspecialchars($reserva->numero_quarto) ?></td>
                          <td><?= htmlspecialchars($reserva->tipo_quarto) ?></td>
                          <td><?= htmlspecialchars($reserva->data_checkin) ?></td>
                          <td><?= htmlspecialchars($reserva->data_checkout) ?></td>
                          <td><?= ucfirst(htmlspecialchars($reserva->status)) ?></td>
                          <td>
                            <div class="btn-group">
                              
                              </a>
                              <a href="conteudo/del_reserva.php?idDel=<?= $reserva->id_reserva ?>" onclick="return confirm('Deseja remover esta reserva?')" class="btn btn-danger" title="Excluir Reserva">
                                <i class="fas fa-trash-alt"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                        <?php
                      }
                    } else {
                      echo '<tr><td colspan="8" class="text-center">Nenhuma reserva encontrada.</td></tr>';
                    }
                  } catch(PDOException $e) {
                    echo '<tr><td colspan="8" class="text-danger">Erro: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
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
