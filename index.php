<?php
session_start();
include_once('config/conexao.php');
include_once('config/hero.php');
include_once('config/sobre.php');
include_once('config/equipe.php');
include_once('config/contato.php');
include_once('config/imagem.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Hotel Paraíso | Bem-vindo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS externo -->
  

  <!-- Dependências -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
  <link rel="stylesheet" href="paginas/index/css/estilo.css">
  
</head>

<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark bg-primary">

    <div class="container">
      <a href="index.php" class="navbar-brand">
        <span class="brand-text font-weight-light">Hotel Paraíso</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="index.php" class="nav-link">Início</a></li>
          <li class="nav-item"><a href="login.php" class="nav-link">Acomodações</a></li>
          <li class="nav-item"><a href="#sobre" class="nav-link">Sobre</a></li>
          <li class="nav-item"><a href="#contato" class="nav-link">Contato</a></li>
          <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Banner principal -->
<!-- Hero principal -->
<section class="hero" style="background-image: url('img/imgHotel/<?php echo $hero['imagem']; ?>')">
  <div class="container text-center hero-content">
    <h1><?php echo $hero['titulo']; ?></h1>
    <p><?php echo $hero['subtitulo']; ?></p>
    <a href="login.php" class="btn btn-primary btn-lg mt-3">Veja nossas acomodações</a>
  </div>
</section>


    <!-- Seção de Serviços -->
  <section class="content bg-light">
    <div class="container">
      <h2 class="section-title">Nossos Serviços</h2>
      <div class="row text-center">
        <div class="col-md-4">
          <i class="fas fa-bed feature-icon"></i>
          <h5>Suítes Confortáveis</h5>
          <p>Ambientes modernos, climatizados e equipados para garantir seu descanso.</p>
        </div>
        <div class="col-md-4">
          <i class="fas fa-utensils feature-icon"></i>
          <h5>Restaurante Exclusivo</h5>
          <p>Culinária local e internacional, com pratos preparados por chefs renomados.</p>
        </div>
        <div class="col-md-4">
          <i class="fas fa-swimmer feature-icon"></i>
          <h5>Área de Lazer</h5>
          <p>Piscina, academia, spa e muito mais para você relaxar durante sua estadia.</p>
        </div>
      </div>
    </div>
  </section>

<!-- Seção Sobre / Introdução -->
  <section id="sobre" class="content py-5">
    <div class="container">
      <h2 class="section-title text-center mb-5">Sobre Nós</h2>
      <div class="row align-items-center">
        
        <!-- Texto -->
        <!-- Texto -->
        <div class="col-md-6 d-flex align-items-center">
          <p class="text-muted" style="line-height: 3; font-size: 1.1rem;">
            <?php echo $sobre['texto']; ?>
          </p>
        </div>

        
        <!-- Imagem -->
        <div class="col-md-6">
          <img src="img/imgHotel/<?php echo $sobre['imagem']; ?>" 
              alt="Imagem do Hotel Paraíso" 
              class="img-fluid rounded shadow sobre-img">
        </div>
        
      </div>
    </div>
  </section>

    <!-- Seção Equipe -->
  <section id="equipe" class="content bg-light py-5">
    <div class="container">
      <h2 class="section-title text-center mb-5">Nossa Equipe</h2>
      <div class="row text-center">
        <div class="row text-center">
    <!-- Membro 1 -->
    <div class="col-md-4 mb-4">
      <div class="team-member card border-0">
        <img src="img/imgHotel/<?php echo $membro1['imagem']; ?>" class="card-img-top" alt="<?php echo $membro1['nome']; ?>">
        <div class="card-body">
          <h5 class="card-title"><?php echo $membro1['nome']; ?></h5>
          <p class="card-text text-muted"><?php echo $membro1['cargo']; ?></p>
          <div class="social-links">
            <?php if($membro1['facebook']): ?><a href="<?php echo $membro1['facebook']; ?>"><i class="fab fa-facebook-f mx-1"></i></a><?php endif; ?>
            <?php if($membro1['twitter']): ?><a href="<?php echo $membro1['twitter']; ?>"><i class="fab fa-twitter mx-1"></i></a><?php endif; ?>
            <?php if($membro1['linkedin']): ?><a href="<?php echo $membro1['linkedin']; ?>"><i class="fab fa-linkedin-in mx-1"></i></a><?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Membro 2 -->
    <div class="col-md-4 mb-4">
      <div class="team-member card border-0">
        <img src="img/imgHotel/<?php echo $membro2['imagem']; ?>" class="card-img-top" alt="<?php echo $membro2['nome']; ?>">
        <div class="card-body">
          <h5 class="card-title"><?php echo $membro2['nome']; ?></h5>
          <p class="card-text text-muted"><?php echo $membro2['cargo']; ?></p>
          <div class="social-links">
            <?php if($membro2['facebook']): ?><a href="<?php echo $membro2['facebook']; ?>"><i class="fab fa-facebook-f mx-1"></i></a><?php endif; ?>
            <?php if($membro2['twitter']): ?><a href="<?php echo $membro2['twitter']; ?>"><i class="fab fa-twitter mx-1"></i></a><?php endif; ?>
            <?php if($membro2['linkedin']): ?><a href="<?php echo $membro2['linkedin']; ?>"><i class="fab fa-linkedin-in mx-1"></i></a><?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Membro 3 -->
    <div class="col-md-4 mb-4">
      <div class="team-member card border-0">
        <img src="img/imgHotel/<?php echo $membro3['imagem']; ?>" class="card-img-top" alt="<?php echo $membro3['nome']; ?>">
        <div class="card-body">
          <h5 class="card-title"><?php echo $membro3['nome']; ?></h5>
          <p class="card-text text-muted"><?php echo $membro3['cargo']; ?></p>
          <div class="social-links">
            <?php if($membro3['facebook']): ?><a href="<?php echo $membro3['facebook']; ?>"><i class="fab fa-facebook-f mx-1"></i></a><?php endif; ?>
            <?php if($membro3['twitter']): ?><a href="<?php echo $membro3['twitter']; ?>"><i class="fab fa-twitter mx-1"></i></a><?php endif; ?>
            <?php if($membro3['linkedin']): ?><a href="<?php echo $membro3['linkedin']; ?>"><i class="fab fa-linkedin-in mx-1"></i></a><?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
      </div>
    </div>
  </section>

<!-- Seção FAQ -->
<section id="faq" class="content py-5">
  <div class="container">
    <h2 class="section-title text-center mb-4">Perguntas Frequentes</h2>
    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="accordion" id="faqAccordion">
          <!-- Exemplo de item FAQ -->
          <div class="card">
            <div class="card-header" id="heading1">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                  Qual é o horário de atendimento?
                </button>
              </h5>
            </div>
            <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
              <div class="card-body">
                Nosso horário de atendimento é de segunda a sexta, das 9h às 18h.
              </div>
            </div>
          </div>
        </div>

        <!-- Botão centralizado abaixo da accordion -->
        <div class="text-center mt-4">
          <a href="paginas/index/listadeFaq.php" class="btn btn-primary btn-lg">Ver mais perguntas Frequentes</a>
        </div>

      </div>
    </div>
  </div>
</section>



<!-- Seção Contato -->
 
<section id="contato" class="content bg-light py-5">
   <h2 class="section-title">Entre em contato conosco</h2>
  <div class="container">

    <div class="row">
      <!-- Imagem do local / badge -->
      <div class="col-md-6 mb-4">
        <img src="img/imgHotel/<?php echo $imagem['imagem']; ?>" class="img-fluid rounded shadow">
      </div>
      
      <!-- Formulário de contato -->
      <div class="col-md-6">
        <form action="" method="post">
          <div class="form-group mb-3">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" placeholder="Seu nome" required>
          </div>

          <div class="form-group mb-3">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Seu e-mail" required>
          </div>

          <div class="form-group mb-3">
            <label for="mensagem">Mensagem</label>
            <textarea id="mensagem" name="mensagem" class="form-control" rows="5" placeholder="Escreva sua mensagem" required></textarea>
          </div>

          <button type="submit" name="enviar_contato" class="btn btn-primary btn-block">Enviar</button>
        </form>

      </div>
    </div>
  </div>
</section>


  <!-- Rodapé -->
  <footer class="main-footer bg-primary text-white">
    <div class="container text-center">
      <strong>© 2025 Hotel Paraíso</strong>
    </div>
  </footer>


</div>

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
