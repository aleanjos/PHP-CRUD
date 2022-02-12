<?php

  include "includes/header.php";
  include "includes/conexao.php";

  $id = $_GET['id'] ?? '';

  $stmt = $conn->prepare("SELECT * FROM pessoas WHERE cod_pessoa = '$id'");
  $stmt->execute();
  $linha = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<h1>Alteração de cadastro</h1>
  <form action="editar-script.php" method="post">
    <div class="form-group">
      <label for="nome">Nome completo</label>
        <input type="text" class="form-control" name="nome" required value="<?php echo $linha['nome']; ?>">
    </div>
    <div class="form-group">
      <label for="endereco">Endereço</label>
        <input type="text" class="form-control" name="endereco" required value="<?php echo $linha['endereco']; ?>">
    </div>
    <div class="form-group">
      <label for="telefone">Telefone</label>
        <input type="text" class="form-control" name="telefone" required value="<?php echo $linha['telefone']; ?>">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
        <input type="email" class="form-control" name="email" required value="<?php echo $linha['email']; ?>">
    </div>
    <div class="form-group">
      <label for="dataNascimento">Data de nascimento</label>
        <input type="date" class="form-control" name="dataNascimento" required value="<?php echo $linha['data_nascimento']; ?>">
    </div><br>
    <div class="form-group">
      <input type="submit" class="btn btn-success" value="Salvar Alterações">
      <input type="hidden" name="id" value="<?php echo $linha['cod_pessoa']; ?>">
        <a href="index.php" class="btn btn-primary">Voltar para a tela inicial</a>
    </div>
                  
  </form>
    </div>
  </div>
</div>

<?php
  include "includes/footer.php";
?>
