<?php
  // Script responsável por inserir os dados no banco de dados.

  include "includes/conexao.php";
  include "includes/header.php";

  $nome = $_POST['nome'];
  $endereco = $_POST['endereco'];
  $telefone = $_POST['telefone'];
  $email = $_POST['email'];
  $dataNascimento = $_POST['dataNascimento'];

  $foto = $_FILES['foto'];
  $foto_nome = mover_foto($foto);

  function mover_foto($vetor_foto) {

    if (!$vetor_foto['error'] && $vetor_foto['size'] <= 5000000) {
       $nome_arquivo = date('ymdhms') . ".jpg";
        move_uploaded_file($vetor_foto['tmp_name'], "img/cadastros/". $nome_arquivo);
        return $nome_arquivo;
    } else {
      return 0;
    }
  }

  // Função que retorna a mensagem se o cadastro foi realizado ou não.
  function mensagemCadastro($texto, $tipo) {
    echo "<div class='alert alert-$tipo' role='alert'>
            $texto
          </div>";
  }

  $stmt = $conn->prepare("INSERT INTO pessoas(nome, endereco, telefone, email, data_nascimento, foto) VALUES (?, ?, ?, ?, ?, ?)");
  //Ultilizando a passagem de parâmetros por posição
  $stmt->bindParam(1, $nome);
  $stmt->bindParam(2, $endereco);
  $stmt->bindParam(3, $telefone);
  $stmt->bindParam(4, $email);
  $stmt->bindParam(5, $dataNascimento);
  $stmt->bindParam(6, $foto_nome);
  
  if ($stmt->execute()) {
    mensagemCadastro("O cadastro de $nome foi realizado com sucesso", "success");
  } else {
      mensagemCadastro("Não foi possível cadastrar $nome", "danger");
  }
  
  echo "<a href='cadastro.php' class='btn btn-primary'>Novo cadastro</a>";
  echo "<a href='index.php' class='btn btn-primary'>Voltar para a página inicial</a>";

  include "includes/footer.php";
  
