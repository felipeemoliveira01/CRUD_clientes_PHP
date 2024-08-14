<?php
// Inclui o arquivo de conexão com o banco de dados
require_once('db_link.php');

// Inicia a sessão
session_start();

// Verifica se o botão "btn_deletar" foi clicado
if(isset($_POST['btn_deletar'])){
    
    // Escapa o valor de 'id' para prevenir SQL injection
    $id = mysqli_escape_string($conect, $_POST['id']);
    
    // Monta a query para deletar o cliente com o ID fornecido
    $sql = "DELETE FROM clientes WHERE id = $id";

    // Executa a query
    if(mysqli_query($conect, $sql)){
        // Se a exclusão for bem-sucedida, define uma mensagem de sucesso na sessão e redireciona para a página principal
        $_SESSION['msg'] = "Deletado com sucesso";
        header('Location: ../index.php?sucesso');
    }else{
        // Se ocorrer um erro ao deletar, define uma mensagem de erro na sessão e redireciona para a página principal
        $_SESSION['msg'] = "Erro ao deletar";
        header('Location: ../index.php?error');
    }
}
