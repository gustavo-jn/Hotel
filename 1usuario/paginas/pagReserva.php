<?php
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>Nenhum quarto selecionado!</div>";
    exit;
}

$id_quarto = $_GET['id'];

$stmt = $conect->prepare("SELECT * FROM quartos WHERE id_quarto = :id");
$stmt->bindParam(':id', $id_quarto);
$stmt->execute();
$quarto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$quarto) {
    echo "<div class='alert alert-danger'>Quarto não encontrado!</div>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    // Validação simples
    if (empty($checkin) || empty($checkout)) {
        echo "<div class='alert alert-warning mt-3'>Preencha todas as datas.</div>";
    } elseif ($checkout < $checkin) {
        echo "<div class='alert alert-warning mt-3'>A data de check-out não pode ser anterior à de check-in.</div>";
    } else {
        try {
            // Inserir reserva
            $stmt = $conect->prepare("
                INSERT INTO reservas (id_usuario, id_quarto, data_checkin, data_checkout, status)
                VALUES (:id_usuario, :id_quarto, :checkin, :checkout, 'pendente')
            ");
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':id_quarto', $id_quarto);
            $stmt->bindParam(':checkin', $checkin);
            $stmt->bindParam(':checkout', $checkout);
            $stmt->execute();

            echo "<div class='alert alert-success mt-3'>Reserva realizada com sucesso!</div>";
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger mt-3'>Erro ao reservar: {$e->getMessage()}</div>";
        }
    }
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h2>Reserva do Quarto <?= htmlspecialchars($quarto['numero_quarto']) ?> - <?= htmlspecialchars($quarto['tipo_quarto']) ?></h2>
    </div>
  </section>

  <section class="content">
    <div class="container">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Preencha os dados da reserva</h3>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="form-group">
              <label>Data de Check-in:</label>
              <input type="date" name="checkin" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Data de Check-out:</label>
              <input type="date" name="checkout" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Confirmar Reserva</button>
            <a href="index.php?acao=inicio" class="btn btn-secondary">Voltar</a>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

