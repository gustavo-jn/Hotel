<?php
// Inclui o arquivo de conexão
include_once('../../config/conexao.php');

try {
    // Busca todos os FAQs ordenados pelo campo 'ordem'
    $stmt = $conect->prepare("SELECT * FROM faq ORDER BY ordem ASC");
    $stmt->execute();
    $faqs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<strong>Erro ao buscar FAQs:</strong> " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>FAQ - Hotelaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<section id="faq" class="content py-5">
    <div class="container">
        <div class="mb-3">
            <a href="../../index.php" class="btn btn-secondary"> Voltar</a>
        </div>

        <h2 class="section-title mb-4 text-center">Perguntas Frequentes</h2>
        <div class="accordion" id="faqAccordion">
            <?php if(!empty($faqs)): ?>
                <?php foreach($faqs as $index => $faq): ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading<?= $faq['id_faq'] ?>">
                            <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $faq['id_faq'] ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="collapse<?= $faq['id_faq'] ?>">
                                <?= htmlspecialchars($faq['pergunta']) ?>
                            </button>
                        </h2>
                        <div id="collapse<?= $faq['id_faq'] ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" aria-labelledby="heading<?= $faq['id_faq'] ?>" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <?= nl2br(htmlspecialchars($faq['resposta'])) ?>
                                <?php if(!empty($faq['imagem'])): ?>
                                    <img src="img/faq/<?= htmlspecialchars($faq['imagem']) ?>" alt="Imagem relacionada" class="img-fluid mt-3">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Nenhuma pergunta encontrada.</p>
            <?php endif; ?>
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
