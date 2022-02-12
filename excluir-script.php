<?php

  include "includes/conexao.php";
  include "includes/header.php";

  $id = $_POST['id'];
  $nome = $_POST['nome'];
  
  // Função que retorna a mensagem se o cadastro foi excluído ou não.
  function mensagemCadastro($texto, $tipo) {
    echo "<div class='alert alert-$tipo' role='alert'>
            $texto
          </div>";
  }
  // Excluir dados na tabela
  $stmt = $conn->prepare("DELETE from pessoas WHERE cod_pessoa = '$id'");
  
  if ($stmt->execute()) {
    mensagemCadastro("O cadastro de $nome foi excluído com sucesso!", "success");
  } else {
      mensagemCadastro("Não foi excluir o cadastro de $nome!", "danger");
  }
  
  echo "<a href='cadastro.php' class='btn btn-primary'>Novo cadastro</a>\n";
  echo "<a href='index.php' class='btn btn-primary'>Voltar para a página inicial</a>";

  include "includes/footer.php";

