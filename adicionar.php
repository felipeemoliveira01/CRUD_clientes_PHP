<?php require_once('requests/header.php'); ?>

<div class="row">
    <div class="col s12 m6 push-m3">
        <h3 class="light">NOVOS CLIENTES</h3>
        <form action="php_action/criar.php" method="post">
         <form action="">
                <div class="input-field col s12">
                    <input type="text" name="nome" id="nome">
                    <label for="nome">NOME</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" name="sobrenome" id="sobrenome">
                    <label for="sobrenome">SOBRENOME</label>
                </div>
                <div class="input-field col s12">
                    <input type="number" name="idade" id="idade">
                    <label for="idade">IDADE</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" name="email" id="email">
                    <label for="email">EMAIL</label>
                </div>
                <div class="center-align" style="margin-top: 20px;">
                    <button type="submit" name="btn_cadastrar" class="btn red darken-4">CADASTRAR</button>
                    <a href="index.php" class="btn purple darken-3">LISTA DOS CLIENTES</a>
                </div>
         </form>
    </div>
</div>

<?php require_once('requests/footer.php'); ?>
