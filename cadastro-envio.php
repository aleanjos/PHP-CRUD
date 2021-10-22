<?php
  // Script responsável por inserir os dados no banco de dados.

  include "includes/conexao.php";
  include "includes/header.php";
  // Atribuir os valores dos campos postados pelo usuário as variáveis.
  $nome = $_POST['nome'];
  $endereco = $_POST['endereco'];
  $telefone = $_POST['telefone'];
  $email = $_POST['email'];
  $dataNascimento = $_POST['dataNascimento'];

  // Função que retorna a mensagem se o cadastro foi realizado ou não.
  function mensagemCadastro($texto, $tipo) {
    echo "<div class='alert alert-$tipo' role='alert'>
            $texto
          </div>";
  }
  // Query para inserir dados na tabela
  $stmt = $conn->prepare("INSERT INTO pessoas(nome, endereco, telefone, email, data_nascimento) VALUES (?, ?, ?, ?, ?)");
  //Ultilizando a passagem de parâmetros por posição
  $stmt->bindParam(1, $nome);
  $stmt->bindParam(2, $endereco);
  $stmt->bindParam(3, $telefone);
  $stmt->bindParam(4, $email);
  $stmt->bindParam(5, $dataNascimento);
  // Condição se o cadastro foi realizado com sucesso.
  if ($stmt->execute()) {
    mensagemCadastro("$nome cadastrado com sucesso!", "success");
  } else {
      mensagemCadastro("Não foi possível cadastrar $nome!", "danger");
  }
  
  echo "<a href='cadastro.php' class='btn btn-primary'>Novo cadastro</a>\n";
  echo "<a href='index.php' class='btn btn-primary'>Voltar para a página inicial</a>";

  include "includes/footer.php";

?>

