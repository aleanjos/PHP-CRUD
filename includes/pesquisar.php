<!-- Script responsável por realizar a consulta no banco de dados e apresentar os dados na tela organizado por tabelas -->
<?php
  // Verifica se a variável está atribuída
  $search = $_POST['busca'] ?? '';

  include "includes/conexao.php";
  // Consulta a ser realizada no banco de dados, selecionando a tabela "pessoas" e buscar de acordo com o que o usuário escrever na busca.
  $stmt = $conn->prepare("SELECT * FROM pessoas WHERE nome LIKE '%$search%'");
  // executa a query
  $stmt->execute();
?>

<h1>Pesquisar</h1>
<nav class="navbar navbar-light bg-ligh">
   <form class="form-inline" action="pesquisa.php" method="post">
      <input class="form-control mr-sm-2" type="search" name="busca" placeholder="Buscar nome" aria-label="Buscar" autofocus>
      <button class="btn btn-outline-success my-2 my sm-0" type="submit">Buscar</button>
   </form>
</nav>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Endereço</th>
      <th scope="col">Telefone</th>
      <th scope="col">Email</th>
      <th scope="col">Data de nascimento</th>
    </tr>
  </thead>
  <tbody>
    
    <?php
      // Realiza a busca por completo na tabela pessoas e mostra na tela organizado por tabelas
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($rows as $row) {

        $codPessoa = $row['cod_pessoa'];
        $nome = $row['nome'];
        $endereco = $row['endereco'];
        $telefone = $row['telefone'];
        $email = $row['email'];
        $data = $row['data_nascimento'];

        echo "<tr>
        <th scope='row'>$nome</th>
        <td>$endereco</td>
        <td>$telefone</td>
        <td>$email</td>
        <td>$data</td>
      </tr>";

      }

    ?>
    
  </tbody>
</table>

<a href="index.php" class="btn btn-primary">Voltar para a página inicial</a>