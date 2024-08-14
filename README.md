# CRUD_clientes_PHP
Este projeto é um CRUD (Create, Read, Update, Delete) simples de gerenciamento de clientes, desenvolvido em PHP e MySQL. O sistema permite adicionar, visualizar, editar e excluir registros de clientes, com funcionalidades como verificação de e-mail duplicado e sistema de mensagens para feedback ao usuário.

##Requisitos
- Servidor Web: Apache ou Nginx.
- PHP: Versão 7.4 ou superior.
- Banco de Dados: MySQL ou MariaDB.
- Extensões PHP: mysqli, mbstring.

##Instalação
Clone o repositório:
´´´git clone https://github.com/felipeemoliveira01/CRUD_clientes_PHP.git
Importe o arquivo clintes.sql no seu banco de dados MySQL.
Configure a conexão com o banco de dados no arquivo db_link.php.
Coloque o projeto na pasta raiz do seu servidor web.
Acesse o sistema via navegador.

##Funcionalidades
-Cadastro de clientes com validação de e-mail.
-Edição e exclusão de registros.
-Sistema de busca para localizar clientes por nome.
-Feedback ao usuário para ações como sucesso, erro e validação.
