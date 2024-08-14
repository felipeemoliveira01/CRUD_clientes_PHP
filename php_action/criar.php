<?php
require_once('db_link.php');
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

// Verifica se o botão 'Cadastrar' foi clicado
if (isset($_POST['btn_cadastrar'])) {
    // Limpa os dados do formulário para segurança
    $nome = _limpar($_POST['nome']);
    $sobrenome = _limpar($_POST['sobrenome']);
    $idade = _limpar($_POST['idade']);
    $email = _limpar($_POST['email']);

    // Verifica se todos os campos estão preenchidos corretamente
    if (!empty($nome) && !empty($sobrenome) && isset($idade) && !empty($email)) {
        // Verifica se o e-mail é válido
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Verifica se o e-mail já existe no banco de dados
            $sql_email_check = "SELECT id FROM clientes WHERE email = '$email'";
            $sql_email_result = mysqli_query($conect, $sql_email_check);

            if (mysqli_num_rows($sql_email_result) > 0) {
                // Se o e-mail já existir, define uma mensagem de erro e redireciona
                $_SESSION['msg'] = "Erro: Email já cadastrado para outro cliente";
                header('Location: ../index.php?error');
            } else {
                // Monta a query SQL para inserir os dados no banco de dados
                $sql = "INSERT INTO clientes (nome, sobrenome, idade, email) VALUES ('$nome', '$sobrenome', '$idade', '$email')";
                
                // Executa a query e verifica se a inserção foi bem-sucedida
                if (mysqli_query($conect, $sql)) {
                    // Define mensagem de sucesso na sessão
                    $_SESSION['msg'] = "Cadastro feito com sucesso";
                    // Redireciona para a página inicial com parâmetro de sucesso
                    header('Location: ../index.php?sucesso');
                } else {
                    // Define mensagem de erro na sessão
                    $_SESSION['msg'] = "Erro ao cadastrar";
                    // Redireciona para a página inicial com parâmetro de erro
                    header('Location: ../index.php?error');
                }
            }
        } else {
            // Define mensagem de erro de e-mail inválido na sessão
            $_SESSION['msg'] = "E-mail inválido";
            // Redireciona para a página inicial com parâmetro de erro de e-mail
            header('Location: ../index.php?error_email');
        }
    } else {
        // Define mensagem de erro de campos não preenchidos corretamente na sessão
        $_SESSION['msg'] = "Algum dos campos não foi preenchido corretamente!";
        // Redireciona para a página inicial com parâmetro de erro de campos
        header('Location: ../index.php?error_fields');
    }
}
?>
