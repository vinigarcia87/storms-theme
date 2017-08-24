<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

/**
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'storms_theme_lcl');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'b}P3%D9dUtK^j7!~+a%dvfuwZTAww3vmT&Jdg,z/!.#:TM2G{xE_oHcm.`+S}h^~');
define('SECURE_AUTH_KEY',  '_9:}a0BrDz{@tSz12DV#?yum^:s1h i_ka^D39T7hN#UNrV)D1.K_zp=j7YiNd%B');
define('LOGGED_IN_KEY',    'AUKT<,1t=c]y-J&n>dJEL0U2oi/Hv0&M,eMzY;0|JcT+f{^~UA}]O#z8a/#v+u4U');
define('NONCE_KEY',        '7pcKr{Ne:alL!09m7ofUbeg@v<Lv<;g&Iq@L?0%~e}3doAl0o;;K?_CiEwE,=+S=');
define('AUTH_SALT',        'nsbuM-/W;e0<a[!o{hUO7t&q/HB m;EgI~`-Quep~y5kV.#2;| }MRtnAS0-<r2L');
define('SECURE_AUTH_SALT', 'of@pZcmLVv eti])gLR@p/WF4tML{{Wuk7N_6e4o>scuN]NY}*zmd<p*_rPDk6p:');
define('LOGGED_IN_SALT',   '%+Tx$TnG}dA]$^;>E7pBLR3(NeNgSx)]l,N_+I/yv|yue+tOfH)k]`ie0!?vk*y]');
define('NONCE_SALT',       '&,xctI?a2*:Nb6?qBnL#?eeBW-r7$WSC,Ab?0dVCl<l1t,p:?x]b8y.$Hi96C9y0');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'ststhemeddMM_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
//define('WP_DEBUG', false);

/**
 * Storms Websolutions Configurations
 * Add the following configuration on wp-config.php file
 */

// Turns WordPress debugging on
define('WP_DEBUG', true );
// Tells WordPress to log everything to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );
// Doesn't force the PHP 'display_errors' variable to be on
define( 'WP_DEBUG_DISPLAY', false ); // Set it back to false!
// Hides errors from being displayed on-screen
@ini_set( 'display_errors', 0 );

// Enable the new WooCommerce logging system
define( 'WC_LOG_HANDLER', 'WC_Log_Handler_DB' );

// Define environment of this project
define( 'WP_ENV', 'development' );
define( 'SF_ENV', 'DEV' );

// This sets the maximum amount of memory in bytes that a script is allowed to allocate
define( 'WP_MEMORY_LIMIT', '256M' );

// Bigger execution time
ini_set( 'max_execution_time', 1200 ); // 1200 seconds = 20 minutes

// Avoid WordPress to consult the database only to get this info
define( 'WP_HOME', 'http://storms.dev.br/' );
define( 'WP_SITEURL', 'http://storms.dev.br/' );

// Add SSL and HTTPS on your WordPress multi-site admin area or login pages
//define('FORCE_SSL_ADMIN', true);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
