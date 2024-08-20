<?php
// Inclui o arquivo de conexão com o banco de dados
require_once('php_action/db_link.php');  
// Inclui o cabeçalho da página
require_once('requests/header.php');  
?>

<div class="container">
    <div class="row">
        <div class="col s12 m8 push-m2">
            <h3 class="light center-align">CLIENTES</h3> 
            <div class="input-field col s12">
                <!-- Formulário para busca de clientes -->
                <form id="search-form">
                    <input type="text" name="palavra" id="palavra" placeholder="Digite o nome, sobrenome ou email">
                    <!-- O botão de pesquisa foi removido pois a busca é acionada pelo evento keyup -->
                </form>
            </div>
            <!-- Div para exibir os resultados da pesquisa -->
            <div id="produtos"></div>
            <div class="center-align" style="margin-top: 20px;">
                <a href="adicionar.php" class="btn red darken-4"><i class="material-icons left">person_add</i>ADICIONAR CLIENTE</a>
            </div>
        </div>
    </div>
</div>

<!-- Inclui jQuery para manipulação do DOM e requisições AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Função de busca que envia uma requisição AJAX para obter os resultados
        function buscar(palavra) {
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: 'php_action/processo.php', // URL para onde a requisição será enviada
                beforeSend: function() {
                    // Exibe uma mensagem de carregamento enquanto os dados são buscados
                    $("#produtos").html("Carregando...");
                },
                data: {
                    campo: palavra // Envia a palavra de busca para o servidor
                },
                success: function(msg) {
                    // Exibe a resposta do servidor no elemento #produtos
                    console.log(msg); // Mostra a resposta no console para depuração
                    $("#produtos").html(msg);
                }
            });
        }

        // Evento keyup no campo de pesquisa
        $('#palavra').keyup(function() {
            var palavra = $(this).val();
            
            // Se a palavra de busca estiver vazia, busca todos os dados
            if (palavra.length < 1) {
                buscar(""); // Chama a função de busca com uma string vazia para retornar todos os dados
            } else {
                buscar(palavra); // Chama a função de busca com a palavra digitada
            }
        });

        // Carrega todos os dados inicialmente
        buscar(""); // Inicialmente carrega todos os dados
    });
</script>

<?php
// Inclui o rodapé da página
require_once('requests/footer.php'); 
?>
