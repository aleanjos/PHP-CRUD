<?php

  include "includes/conexao.php";
  include "includes/header.php";
  
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $endereco = $_POST['endereco'];
  $telefone = $_POST['telefone'];
  $email = $_POST['email'];
  $dataNascimento = $_POST['dataNascimento'];

  // Função que retorna a mensagem se o cadastro foi alterado ou não.
  function mensagemCadastro($texto, $tipo) {
    echo "<div class='alert alert-$tipo' role='alert'>
            $texto
          </div>";
  }
  // Atualizar dados no banco de dados
  $stmt = $conn->prepare("UPDATE pessoas set nome = '$nome', endereco = '$endereco', telefone = '$telefone',
    email = '$email', data_nascimento = '$dataNascimento' WHERE cod_pessoa = '$id'");
    
  $stmt->bindParam(1, $nome);
  $stmt->bindParam(2, $endereco);
  $stmt->bindParam(3, $telefone);
  $stmt->bindParam(4, $email);
  $stmt->bindParam(5, $dataNascimento);
  
  if ($stmt->execute()) {
    mensagemCadastro("O cadastro de $nome foi alterado com sucesso!", "success");
  } else {
      mensagemCadastro("Não foi possível alterar o cadastro de $nome!", "danger");
  }
  
  echo "<a href='cadastro.php' class='btn btn-primary'>Novo cadastro</a>\n";
  echo "<a href='index.php' class='btn btn-primary'>Voltar para a página inicial</a>";

  include "includes/footer.php";

