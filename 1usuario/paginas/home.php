

<div class="wrapper">
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Escolha uma de nossas acomodações</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Acomodações disponíveis</h3>
              </div>

              <div class="card-body">
                <div class="row">
                  <?php
                    try {
                      $stmt = $conect->prepare("SELECT * FROM quartos WHERE status = 'disponivel' ORDER BY id_quarto DESC");
                      $stmt->execute();
                      $quartos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                      if (count($quartos) === 0) {
                        echo "<div class='col-12'><p class='text-muted'>Nenhum quarto disponível no momento.</p></div>";
                      }

                      foreach ($quartos as $quarto) {
                        $imagem = !empty($quarto['imagem']) ? "../img/imgQuartos/" . $quarto['imagem'] : "dist/img/default.jpg";
                        $preco = number_format($quarto['preco_diaria'], 2, ',', '.');
                  ?>
                  <div class="col-sm-4 mb-4">
                    <div class="card shadow-sm">
                      <div class="position-relative">
                        <img src="<?= $imagem ?>" alt="Quarto <?= htmlspecialchars($quarto['numero_quarto']) ?>" class="card-img-top" style="height: 180px; object-fit: cover; width: 100%;">
                        <div class="ribbon-wrapper ribbon-lg">
                          <div class="ribbon bg-success text-lg">
                            R$ <?= $preco ?>/noite
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($quarto['tipo_quarto']) ?> - Quarto <?= htmlspecialchars($quarto['numero_quarto']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($quarto['descricao'])) ?></p>
                        <a href="index.php?acao=reservar&id=<?= $quarto['id_quarto'] ?>" class="btn btn-primary btn-sm">Reservar agora</a>
                      </div>
                    </div>
                  </div>
                  <?php
                      }
                    } catch (PDOException $e) {
                      echo "<div class='col-12'><p class='text-danger'>Erro ao buscar quartos: " . $e->getMessage() . "</p></div>";
                    }
                  ?>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

