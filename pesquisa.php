<?php

   include "includes/header.php";

     // Verifica se a variável está atribuída
     $busca = $_POST['busca'] ?? '';
   
     include "includes/conexao.php";

     // Consulta a ser realizada no banco de dados e filtrar de acordo com o que o usuário escrever na busca.
     $stmt = $conn->prepare("SELECT * FROM pessoas WHERE nome LIKE '%$busca%'");

     $stmt->execute();

   ?>
   
   <h1>Pesquisar</h1>
   <nav class="navbar navbar-light bg-ligh">
      <form class="form-inline" action="pesquisa.php" method="post">
         <input class="form-control mr-sm-2" type="search" name="busca" placeholder="Buscar nome" aria-label="Buscar" autofocus required>
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
         <th scope="col">Funções</th>
       </tr>
     </thead>
     <tbody>
       
       <?php
          // Formatar data no padrão brasileiro.
          function formatarData($data) {
            $d = explode('-', $data);
            $novaData = $d[2] . "/" . $d[1] . "/" . $d[0];
            return $novaData;
} 
         // Realiza a busca por completo na tabela e mostra o resultado na tela organizado por tabelas
         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
         if (!$rows) {

            echo "<tr>
               <td colspan='5'>Não foram encontrados resultados referente a <strong> \"$busca\"</strong></th></tr>";
               
            }  else if ($busca=="") {

                  echo "<tr>
                  <td colspan='5'>Digite um nome para pesquisar</th></tr>";

                } else {
            
                     foreach ($rows as $row) {
      
                     $codPessoa = $row['cod_pessoa'];
                     $nome = $row['nome'];
                     $endereco = $row['endereco'];
                     $telefone = $row['telefone'];
                     $email = $row['email'];
                     $data = $row['data_nascimento'];
                     $data = formatarData($data);

                    // Verifica se a foto do usuário existe no banco de dados
                     if (!$row['foto']) {
                       $foto = "img/cadastros/default.png";
                     } else {
                       $foto = "img/cadastros/" . $row['foto'];
                     }
               
                     echo "<tr>
                     <th><img src='$foto' class='foto_usuario'</th>
                     <th scope='row'>$nome</th>
                     <td>$endereco</td>
                     <td>$telefone</td>
                     <td>$email</td>
                     <td>$data</td>
                     <td width='160px'>
                      <a href='editar.php?id=$codPessoa' class='btn btn-primary btn-sm'>Editar</a>
                      <a href='#' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modal_confirmar'
                      onclick=" . '"' . "pegarDados($codPessoa, '$nome')" . '"' .">Excluir</a>
                     </td>
                     </tr>";
      
                     }
                  }
       ?>
       
     </tbody>
   </table>
   
   <a href="index.php" class="btn btn-primary">Voltar para a página inicial</a>

   <!-- Modal -->
    <div class="modal fade" id="modal_confirmar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="excluir-script.php" method="POST">
              <p>Deseja realmente excluir <b id="nome_pessoa"></b>?</p>
              
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
              <input type="hidden" name="id" id="cod_pessoa" value="">
              <input type="hidden" name="nome" id="nome_pessoa1" value="">
              <input type="submit" class="btn btn-danger" value="Sim">
            </form>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      function pegarDados(id, nome) {
        document.getElementById('nome_pessoa').innerHTML = nome;
        document.getElementById('nome_pessoa1').value = nome;
        document.getElementById('cod_pessoa').value = id;
      }
    </script>  

<?php
   include "includes/footer.php";