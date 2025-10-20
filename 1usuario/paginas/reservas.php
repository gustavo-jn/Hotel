<?php
$id_usuario_logado = $_SESSION['id_usuario'];

try {
    $stmt = $conect->prepare("
        SELECT r.id_reserva, u.nome AS usuario, q.numero_quarto, q.tipo_quarto, 
               r.data_checkin, r.data_checkout, r.status
        FROM reservas r
        INNER JOIN usuarios u ON r.id_usuario = u.id_usuario
        INNER JOIN quartos q ON r.id_quarto = q.id_quarto
        WHERE r.id_usuario = :id_usuario
        ORDER BY r.criada_em DESC
    ");
    $stmt->bindValue(':id_usuario', $id_usuario_logado, PDO::PARAM_INT);
    $stmt->execute();
    $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erro ao buscar reservas: {$e->getMessage()}</div>";
    $reservas = [];
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Minhas Reservas</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lista de Reservas</h3>
                </div>
                <div class="card-body table-responsive p-0" style="max-height: 500px;">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Quarto</th>
                                <th>Tipo de Quarto</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($reservas) === 0): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Nenhuma reserva encontrada.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($reservas as $reserva): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($reserva['usuario']) ?></td>
                                        <td><?= htmlspecialchars($reserva['numero_quarto']) ?></td>
                                        <td><?= htmlspecialchars($reserva['tipo_quarto']) ?></td>
                                        <td><?= htmlspecialchars($reserva['data_checkin']) ?></td>
                                        <td><?= htmlspecialchars($reserva['data_checkout']) ?></td>
                                        <td><?= htmlspecialchars($reserva['status']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once('includes/footer.php'); ?>
