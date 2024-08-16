<?php
// Inclui o arquivo de conexão com o banco de dados
require_once('db_link.php');

// Inicia a sessão
session_start();

// Função para prevenir XSS e SQL Injection
function _limpar($input){
    global $conect;
    // Evita SQL Injection escapando caracteres especiais
    $var = mysqli_escape_string($conect, $input);
    // Evita XSS convertendo caracteres especiais em entidades HTML
    $var = htmlspecialchars($var);

    return $var;
}

// Verifica se o botão "btn_atualizar" foi clicado
if (isset($_POST['btn_atualizar'])) {

    // Escapa os valores dos campos para prevenir SQL Injection
    $nome = _limpar($_POST['nome']);
    $sobrenome = _limpar($_POST['sobrenome']);
    $idade = _limpar($_POST['idade']);
    $email = _limpar($_POST['email']);

    // Escapa o valor do ID do cliente
    $id = mysqli_escape_string($conect, $_POST['id']);

    // Verifica se todos os campos obrigatórios foram preenchidos e se o email é válido
    if (!empty($nome) && !empty($sobrenome) && isset($idade) && !empty($email)) {
        if(ctype_alpha($nome) && ctype_alpha($sobrenome)){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Verifica se o e-mail já está registrado para outro cliente
            $sql_email_check = "SELECT id FROM clientes WHERE id != '$id' AND email = '$email'";
            $sql_email_result = mysqli_query($conect, $sql_email_check);

            if (mysqli_num_rows($sql_email_result) > 0) {
                // Se o e-mail já existir, define uma mensagem de erro e redireciona
                $_SESSION['msg'] = "Erro: Email já cadastrado para outro cliente";
                header('Location: ../index.php?error');
            } else {
                // Monta a query SQL para atualizar os dados do cliente com o ID fornecido
                $sql = "UPDATE clientes SET nome = '$nome', sobrenome = '$sobrenome', idade = '$idade', email = '$email' WHERE id = '$id'";

                // Executa a query e verifica se foi bem-sucedida
                if (mysqli_query($conect, $sql)) {
                    // Se a atualização for bem-sucedida, define uma mensagem de sucesso na sessão e redireciona para a página principal
                    $_SESSION['msg'] = "Update feito com sucesso";
                    header('Location: ../index.php?sucesso');
                } else {
                    // Se ocorrer um erro na atualização, define uma mensagem de erro na sessão e redireciona para a página principal
                    $_SESSION['msg'] = "Erro ao atualizar";
                    header('Location: ../index.php?error');
                }
            }
        } else {
            // Se o email for inválido, define uma mensagem de erro na sessão e redireciona para a página principal
            $_SESSION['msg'] = "Erro ao atualizar, email inválido";
            header('Location: ../index.php?error');
        }
        }else{
             // Se o nome ou sobrenome forem inválidos, define uma mensagem de erro na sessão e redireciona para a página principal
            $_SESSION['msg'] = "Erro ao atualizar, nome ou sobrenome inválido";
            header('Location: ../index.php?error');
        }
    } else {
        // Se algum campo estiver vazio ou inválido, define uma mensagem de erro na sessão e redireciona para a página principal
        $_SESSION['msg'] = "Erro ao atualizar, algum campo está vazio/inválido";
        header('Location: ../index.php?error');
    }
}
?>
