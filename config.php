<?php

/** define = permite definir uma constante (nunca se altera)*/

/** Aqui definimos que DB_NAME será o nome da constante do banco de dados. No caso do professor o banco de dados chama wda_crud*/
define('DB_NAME', 'controleeasy');

/** Aqui definimos que DB_USER será nome da constante do usuarioo do banco de dados. No caso do professor o usuario do banco de dados chama root*/
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'Dodgef80206');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** O operador . faz a união de duas Strings em PHP  */
/** dirname(__FILE__) - comando especial - "hadouken" - que recebe a pasta que contem o arquivo config.php  */
/** ! - interrogacao operador negação php, no caso if (!defined('ABSPATH')) esta verificando se a constante ABSPATH não esta definida */

/** Caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');
    
/** caminho no servidor para o sistema **/
if ( !defined('BASEURL') )
    define('BASEURL','/easytec/');
    
/** caminho do arquivo de banco de dados **/
if ( !defined('DBAPI') )
    define('DBAPI', ABSPATH . 'controle/banco.php');

/** caminhos dos templates de header e footer - VAMOS USAR DEPOIS **/
define('HEADER_TEMPLATE', ABSPATH . 'includes/header.php');
define('FOOTER_TEMPLATE', ABSPATH . 'includes/footer.php');