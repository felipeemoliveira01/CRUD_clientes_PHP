<?php
require_once('php_action/db_link.php'); // Inclui o arquivo de conexão com o banco de dados
require_once('requests/header.php');    // Inclui o cabeçalho da página

// Verifica se um ID foi passado via GET para editar um cliente específico
if(isset($_GET['id'])){
    // Previne SQL Injection limpando o ID recebido
    $id = mysqli_escape_string($conect, $_GET['id']);
    
    // Consulta SQL para buscar os dados do cliente pelo ID
    $sql = "SELECT * FROM clientes WHERE id = '$id'";
    $result = mysqli_query($conect, $sql);  // Executa a consulta
    $data = mysqli_fetch_array($result);    // Armazena os dados do cliente em um array
}
?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h3 class="light">EDITAR CLIENTES</h3> <!-- Título da página -->
        
        <!-- Formulário de edição, envia os dados para 'php_action/update.php' via POST -->
        <form action="php_action/update.php" method="post">
            <!-- Campo oculto que armazena o ID do cliente -->
            <input type="hidden" name="id" value="<?php echo $data['id'];?>">

            <!-- Campo para editar o nome do cliente -->
            <div class="input-field col s12">
                <input type="text" name="nome" id="nome" value="<?php echo $data['nome'];?>">
                <label for="nome">NOME</label>
            </div>

            <!-- Campo para editar o sobrenome do cliente -->
            <div class="input-field col s12">
                <input type="text" name="sobrenome" id="sobrenome" value="<?php echo $data['sobrenome'];?>">
                <label for="sobrenome">SOBRENOME</label>
            </div>

            <!-- Campo para editar a idade do cliente -->
            <div class="input-field col s12">
                <input type="number" name="idade" id="idade" value="<?php echo $data['idade'];?>">
                <label for="idade">IDADE</label>
            </div>

            <!-- Campo para editar o email do cliente -->
            <div class="input-field col s12">
                <input type="text" name="email" id="email" value="<?php echo $data['email'];?>">
                <label for="email">EMAIL</label>
            </div>

            <!-- Botões de ação: Atualizar ou Voltar para a lista de clientes -->
            <div class="center-align" style="margin-top: 20px;">
                <button type="submit" name="btn_atualizar" class="btn red darken-4">ATUALIZAR</button>
                <a href="index.php" class="btn purple darken-3">LISTA DOS CLIENTES</a>
            </div>
        </form>
    </div>
</div>

<?php require_once('requests/footer.php'); // Inclui o rodapé da página ?>
