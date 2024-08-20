<?php
// Inclui o arquivo de conexão com o banco de dados
require_once('db_link.php');  

// Obtém a palavra de busca enviada via POST, se existir
$palavra = isset($_POST['campo']) ? $_POST['campo'] : '';

// Se a palavra de busca não estiver vazia, realiza a consulta com filtro
if (!empty($palavra)) {
    $sql = "SELECT * FROM clientes WHERE nome LIKE '%$palavra%' OR sobrenome LIKE '%$palavra%' OR email LIKE '%$palavra%'";
} else {
    // Se a palavra de busca estiver vazia, retorna todos os registros
    $sql = "SELECT * FROM clientes";
}

// Executa a consulta SQL
$result = mysqli_query($conect, $sql);

// Verifica se houve erro na consulta
if (!$result) {
    die('Erro na consulta SQL: ' . mysqli_error($conect));
}

// Inicia a geração da tabela HTML
echo '
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
    <tbody>';

// Verifica se há registros retornados pela consulta
if (mysqli_num_rows($result) > 0) {
    // Loop para exibir cada registro
    while ($data = mysqli_fetch_array($result)) {
        echo '
        <tr>
            <td>' . htmlspecialchars($data['nome']) . '</td>
            <td>' . htmlspecialchars($data['sobrenome']) . '</td>
            <td>' . htmlspecialchars($data['idade']) . '</td>
            <td>' . htmlspecialchars($data['email']) . '</td>
            <td>
                <a href="editar.php?id=' . $data['id'] . '" class="btn-floating orange darken-3"><i class="material-icons">edit</i></a>
                <a href="#modal' . $data['id'] . '" class="btn-floating red darken-4 modal-trigger"><i class="material-icons">delete</i></a> 
                <div id="modal' . $data['id'] . '" class="modal">
                    <div class="modal-content">
                        <h4>Calma lá</h4>
                        <p>Você realmente tem certeza que deseja excluir este usuário?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="php_action/deletar.php" method="post"> 
                            <input type="hidden" name="id" value="' . $data['id'] . '">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                            <button type="submit" name="btn_deletar" class="btn red darken-4">Sim, tenho certeza</button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>';
    }
} else {
    // Caso não haja registros, exibe uma mensagem informativa
    echo '
    <tr>
        <td colspan="5">Nenhum cliente encontrado.</td>
    </tr>';
}

// Finaliza a tabela HTML
echo '
    </tbody>
</table>';
?>
