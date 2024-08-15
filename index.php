<?php
require_once('php_action/db_link.php');  // Inclui o arquivo de conexão com o banco de dados 
require_once('requests/header.php');     // Inclui o cabeçalho da página 
require_once('requests/mensagem.php');   // Inclui o arquivo de mensagens para exibição de feedback ao usuário

// Verifica se há uma palavra de pesquisa
$palavra = isset($_GET['palavra']) ? $_GET['palavra'] : '';

// Consulta SQL para filtrar resultados com base na palavra de pesquisa
if (!empty($palavra)) {
    $sql = "SELECT * FROM clientes WHERE nome LIKE '%$palavra%' OR sobrenome LIKE '%$palavra%' OR email LIKE '%$palavra%'";
} else {
    $sql = "SELECT * FROM clientes";
}

$result = mysqli_query($conect, $sql);  // Executa a consulta e armazena o resultado
?>

<div class="container">
    <div class="row">
        <div class="col s12 m8 push-m2">
            <h3 class="light center-align">CLIENTES</h3> 
            <div class="input-field col s12">
                <form action="" method="get">
                    <input type="text" name="palavra" id="palavra" placeholder="Digite o nome, sobrenome ou email">
                    <button type="submit" class="btn red darken-4">Procurar</button>
                </form>
            </div>
            <table class="striped centered">
                <thead>
                    <tr>
                        <th>NOME</th>
                        <th>SOBRENOME</th>
                        <th>IDADE</th>
                        <th>EMAIL</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verifica se há registros no banco de dados
                    if(mysqli_num_rows($result) > 0){

                        // Loop para exibir cada registro encontrado
                        while($data = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><?php echo $data['nome']?></td>
                        <td><?php echo $data['sobrenome']?></td>
                        <td><?php echo $data['idade']?></td>
                        <td><?php echo $data['email']?></td>
                        <td>
                            <!-- Link para editar o registro, passando o ID do cliente via GET -->
                            <a href="editar.php?id=<?php echo $data['id']?>" class="btn-floating orange darken-3"><i class="material-icons">edit</i></a>
                            
                            <!-- Botão para excluir o registro, abre um modal de confirmação -->
                            <a href="#modal<?php echo $data['id']?>" class="btn-floating red darken-4 modal-trigger"><i class="material-icons">delete</i></a> 
                            <div id="modal<?php echo $data['id']?>" class="modal">
                                <div class="modal-content">
                                    <h4>Calma lá</h4>
                                    <p>Você realmente tem certeza que deseja excluir este usuário?</p>
                                </div>
                                <div class="modal-footer">
                                    <!-- Formulário de exclusão, o ID do cliente é passado via POST -->
                                    <form action="php_action/deletar.php" method="post"> 
                                        <input type="hidden" name="id" value="<?php echo $data['id']?>">
                                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                                        <button type="submit" name="btn_deletar" class="btn red darken-4">Sim, tenho certeza</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } 
                    }else{ ?>
                    <!-- Exibe uma linha vazia se não houver registros no banco de dados -->
                    <tr>
                        <td colspan="5">Nenhum cliente encontrado.</td>
                    </tr>
                        <?php    
                    }
                    ?>
                </tbody>
            </table>
            <!-- Botão para adicionar um novo cliente -->
            <div class="center-align" style="margin-top: 20px;">
                <a href="adicionar.php" class="btn red darken-4"><i class="material-icons left">person_add</i>ADICIONAR CLIENTE</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('requests/footer.php'); // Inclui o rodapé da página ?>
