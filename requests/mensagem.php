<?php 
session_start(); // Inicia a sessão

// Verifica se há alguma mensagem armazenada na sessão
if(isset($_SESSION['msg'])){ ?>
    <script>
        // Quando a página carregar, exibe um toast com a mensagem armazenada na sessão
        window.onload = function(){
            M.toast({html: "<?php echo $_SESSION['msg']; ?>"});
        }
    </script>
    <?php 
}

// Limpa todas as variáveis de sessão, removendo a mensagem após a exibição
session_unset();
?>
