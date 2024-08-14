<?php
// Configurações de conexão com o banco de dados
$serverName = "localhost"; // Nome do servidor (geralmente "localhost" para ambientes locais)
$userName = "root";        // Nome de usuário do banco de dados
$userSenha = "";           // Senha do banco de dados (em ambientes locais, muitas vezes é vazia)
$dbName = "crud";          // Nome do banco de dados que deseja acessar

// Estabelecendo conexão com o banco de dados
$conect = mysqli_connect($serverName, $userName, $userSenha, $dbName);

// Definindo o charset para garantir que a comunicação com o banco use UTF-8
mysqli_set_charset($conect, "utf8");

// Verifica se houve algum erro na conexão
if(mysqli_connect_error()){
    // Exibe a mensagem de erro caso a conexão falhe
    echo "Erro: " . mysqli_connect_error();
}
?>
