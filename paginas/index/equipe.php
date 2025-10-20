<?php
// ===== Membro 1 =====
if(isset($_POST['botaoEquipe1'])){
    $id = 1;
    $nome = $_POST['nome1'];
    $cargo = $_POST['cargo1'];
    $facebook = $_POST['facebook1'] ?? '';
    $twitter = $_POST['twitter1'] ?? '';
    $linkedin = $_POST['linkedin1'] ?? '';

    $pasta = "../img/imgHotel/";
    if(!is_dir($pasta)){
        mkdir($pasta, 0755, true); // cria a pasta se não existir
    }

    $novoNome = null;
    if(!empty($_FILES['imagem1']['name'])){
        $ext = pathinfo($_FILES['imagem1']['name'], PATHINFO_EXTENSION);
        $novoNome = uniqid().".$ext";
        move_uploaded_file($_FILES['imagem1']['tmp_name'], $pasta.$novoNome);
    }

    // Verifica se já existe
    $stmtCheck = $conect->prepare("SELECT COUNT(*) FROM equipe WHERE id = :id");
    $stmtCheck->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtCheck->execute();
    $existe = $stmtCheck->fetchColumn();

    if($existe){
        // UPDATE
        $sql = "UPDATE equipe SET nome=:nome, cargo=:cargo, facebook=:facebook, twitter=:twitter, linkedin=:linkedin";
        if($novoNome) $sql .= ", imagem=:imagem";
        $sql .= " WHERE id=:id";

        $stmt = $conect->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':facebook', $facebook);
        $stmt->bindParam(':twitter', $twitter);
        $stmt->bindParam(':linkedin', $linkedin);
        if($novoNome) $stmt->bindParam(':imagem', $novoNome);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        // INSERT
        $sql = "INSERT INTO equipe (id, nome, cargo, facebook, twitter, linkedin, imagem)
                VALUES (:id, :nome, :cargo, :facebook, :twitter, :linkedin, :imagem)";
        $stmt = $conect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':facebook', $facebook);
        $stmt->bindParam(':twitter', $twitter);
        $stmt->bindParam(':linkedin', $linkedin);
        $stmt->bindParam(':imagem', $novoNome);
        $stmt->execute();
    }
}

// ===== Membro 2 =====
if(isset($_POST['botaoEquipe2'])){
    $id = 2;
    $nome = $_POST['nome2'];
    $cargo = $_POST['cargo2'];
    $facebook = $_POST['facebook2'] ?? '';
    $twitter = $_POST['twitter2'] ?? '';
    $linkedin = $_POST['linkedin2'] ?? '';

    $pasta = "../img/imgHotel/";
    if(!is_dir($pasta)){
        mkdir($pasta, 0755, true); // cria a pasta se não existir
    }

    $novoNome = null;
    if(!empty($_FILES['imagem2']['name'])){
        $ext = pathinfo($_FILES['imagem2']['name'], PATHINFO_EXTENSION);
        $novoNome = uniqid().".$ext";
        move_uploaded_file($_FILES['imagem2']['tmp_name'], $pasta.$novoNome);
    }

    // Verifica se já existe
    $stmtCheck = $conect->prepare("SELECT COUNT(*) FROM equipe WHERE id = :id");
    $stmtCheck->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtCheck->execute();
    $existe = $stmtCheck->fetchColumn();

    if($existe){
        // UPDATE
        $sql = "UPDATE equipe SET nome=:nome, cargo=:cargo, facebook=:facebook, twitter=:twitter, linkedin=:linkedin";
        if($novoNome) $sql .= ", imagem=:imagem";
        $sql .= " WHERE id=:id";

        $stmt = $conect->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':facebook', $facebook);
        $stmt->bindParam(':twitter', $twitter);
        $stmt->bindParam(':linkedin', $linkedin);
        if($novoNome) $stmt->bindParam(':imagem', $novoNome);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        // INSERT
        $sql = "INSERT INTO equipe (id, nome, cargo, facebook, twitter, linkedin, imagem)
                VALUES (:id, :nome, :cargo, :facebook, :twitter, :linkedin, :imagem)";
        $stmt = $conect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':facebook', $facebook);
        $stmt->bindParam(':twitter', $twitter);
        $stmt->bindParam(':linkedin', $linkedin);
        $stmt->bindParam(':imagem', $novoNome);
        $stmt->execute();
    }
}
// ===== Membro 3 =====
// Repita a mesma lógica, mudando apenas os campos para nome3, cargo3, facebook3, twitter3, linkedin3, imagem3 e id=3
if(isset($_POST['botaoEquipe3'])){
    $id = 3;
    $nome = $_POST['nome3'];
    $cargo = $_POST['cargo3'];
    $facebook = $_POST['facebook3'] ?? '';
    $twitter = $_POST['twitter3'] ?? '';
    $linkedin = $_POST['linkedin3'] ?? '';

    $pasta = "../img/imgHotel/";
    if(!is_dir($pasta)){
        mkdir($pasta, 0755, true); // cria a pasta se não existir
    }

    $novoNome = null;
    if(!empty($_FILES['imagem3']['name'])){
        $ext = pathinfo($_FILES['imagem3']['name'], PATHINFO_EXTENSION);
        $novoNome = uniqid().".$ext";
        move_uploaded_file($_FILES['imagem3']['tmp_name'], $pasta.$novoNome);
    }

    // Verifica se já existe
    $stmtCheck = $conect->prepare("SELECT COUNT(*) FROM equipe WHERE id = :id");
    $stmtCheck->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtCheck->execute();
    $existe = $stmtCheck->fetchColumn();

    if($existe){
        // UPDATE
        $sql = "UPDATE equipe SET nome=:nome, cargo=:cargo, facebook=:facebook, twitter=:twitter, linkedin=:linkedin";
        if($novoNome) $sql .= ", imagem=:imagem";
        $sql .= " WHERE id=:id";

        $stmt = $conect->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':facebook', $facebook);
        $stmt->bindParam(':twitter', $twitter);
        $stmt->bindParam(':linkedin', $linkedin);
        if($novoNome) $stmt->bindParam(':imagem', $novoNome);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        // INSERT
        $sql = "INSERT INTO equipe (id, nome, cargo, facebook, twitter, linkedin, imagem)
                VALUES (:id, :nome, :cargo, :facebook, :twitter, :linkedin, :imagem)";
        $stmt = $conect->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':facebook', $facebook);
        $stmt->bindParam(':twitter', $twitter);
        $stmt->bindParam(':linkedin', $linkedin);
        $stmt->bindParam(':imagem', $novoNome);
        $stmt->execute();
    }
}
?>


<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="d-flex justify-content-between align-items-center">
            <h1>Edição da Seção Equipe</h1>
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

        <!-- ====== Membro 1 ====== -->
        <div class="col-md-4">
          <div class="card card-primary">
            <div class="card-header"><h4>Membro 1</h4></div>
            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <input type="hidden" name="id" value="1">
                <div class="form-group">
                  <label for="nome1">Nome</label>
                  <input type="text" class="form-control" name="nome1" id="nome1" required>
                </div>
                <div class="form-group">
                  <label for="cargo1">Cargo</label>
                  <input type="text" class="form-control" name="cargo1" id="cargo1" required>
                </div>
                <div class="form-group">
                  <label for="facebook1">Facebook</label>
                  <input type="url" class="form-control" name="facebook1" id="facebook1">
                </div>
                <div class="form-group">
                  <label for="twitter1">Twitter</label>
                  <input type="url" class="form-control" name="twitter1" id="twitter1">
                </div>
                <div class="form-group">
                  <label for="linkedin1">LinkedIn</label>
                  <input type="url" class="form-control" name="linkedin1" id="linkedin1">
                </div>
                <div class="form-group">
                  <label for="imagem1">Foto</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="imagem1" id="imagem1">
                      <label class="custom-file-label" for="imagem1">Escolher arquivo</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" name="botaoEquipe1" class="btn btn-primary">Salvar Membro 1</button>
              </div>
            </form>
          </div>
        </div>

        <!-- ====== Membro 2 ====== -->
        <div class="col-md-4">
          <div class="card card-primary">
            <div class="card-header"><h4>Membro 2</h4></div>
            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <input type="hidden" name="id" value="2">
                <div class="form-group">
                  <label for="nome2">Nome</label>
                  <input type="text" class="form-control" name="nome2" id="nome2" required>
                </div>
                <div class="form-group">
                  <label for="cargo2">Cargo</label>
                  <input type="text" class="form-control" name="cargo2" id="cargo2" required>
                </div>
                <div class="form-group">
                  <label for="facebook2">Facebook</label>
                  <input type="url" class="form-control" name="facebook2" id="facebook2">
                </div>
                <div class="form-group">
                  <label for="twitter2">Twitter</label>
                  <input type="url" class="form-control" name="twitter2" id="twitter2">
                </div>
                <div class="form-group">
                  <label for="linkedin2">LinkedIn</label>
                  <input type="url" class="form-control" name="linkedin2" id="linkedin2">
                </div>
                <div class="form-group">
                  <label for="imagem2">Foto</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="imagem2" id="imagem2">
                      <label class="custom-file-label" for="imagem2">Escolher arquivo</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" name="botaoEquipe2" class="btn btn-primary">Salvar Membro 2</button>
              </div>
            </form>
          </div>
        </div>

        <!-- ====== Membro 3 ====== -->
        <div class="col-md-4">
          <div class="card card-primary">
            <div class="card-header"><h4>Membro 3</h4></div>
            <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="card-body">
                <input type="hidden" name="id" value="3">
                <div class="form-group">
                  <label for="nome3">Nome</label>
                  <input type="text" class="form-control" name="nome3" id="nome3" required>
                </div>
                <div class="form-group">
                  <label for="cargo3">Cargo</label>
                  <input type="text" class="form-control" name="cargo3" id="cargo3" required>
                </div>
                <div class="form-group">
                  <label for="facebook3">Facebook</label>
                  <input type="url" class="form-control" name="facebook3" id="facebook3">
                </div>
                <div class="form-group">
                  <label for="twitter3">Twitter</label>
                  <input type="url" class="form-control" name="twitter3" id="twitter3">
                </div>
                <div class="form-group">
                  <label for="linkedin3">LinkedIn</label>
                  <input type="url" class="form-control" name="linkedin3" id="linkedin3">
                </div>
                <div class="form-group">
                  <label for="imagem3">Foto</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="imagem3" id="imagem3">
                      <label class="custom-file-label" for="imagem3">Escolher arquivo</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" name="botaoEquipe3" class="btn btn-primary">Salvar Membro 3</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>
