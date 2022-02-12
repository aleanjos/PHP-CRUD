<?php
  include "includes/header.php";
?>

<h1>Cadastro</h1>
  <form action="cadastro-script.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="nome">Nome completo</label>
        <input type="text" class="form-control" name="nome" required autofocus>
    </div>
    <div class="form-group">
      <label for="endereco">Endereço</label>
        <input type="text" class="form-control" name="endereco" required>
    </div>
    <div class="form-group">
      <label for="telefone">Telefone</label>
        <input type="text" class="form-control" name="telefone" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
      <label for="dataNascimento">Data de nascimento</label>
        <input type="date" class="form-control" name="dataNascimento" required>
    </div>
    <div class="form-group">
      <label for="foto">Foto</label>
        <input type="file" class="form-control" name="foto" accept=".jpg">
    </div><br>
    <div class="form-group">
      <input type="submit" class="btn btn-success" value="Cadastrar">
        <a href="index.php" class="btn btn-primary">Voltar para a tela inicial</a>
    </div>
                  
  </form>
    </div>
  </div>
</div>

<?php
  include "includes/footer.php";
?>
