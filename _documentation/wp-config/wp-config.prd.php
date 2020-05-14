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
define('DB_NAME', 'storms_theme_prd');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'sts_theme_prd');

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
define('AUTH_KEY',         '(Io[:%GKJK9/A=lc[A}j9uV;x,Xv/CQ vyke~nb%KvfZZy-oVaAy:Q&|{0%.[ JL');
define('SECURE_AUTH_KEY',  '5NEztJ]k22-3,%Zv{wu2]l6|tm4I#] tN;59Dj$BsZL`jNYB*{R|VDm>[6{wwFK6');
define('LOGGED_IN_KEY',    'rXz.6i1ta-Xi)qQk@r81&Osmx2(+w68&r}UB_HxCUF ]X|9P?P-Lu.y4cc~wh(BO');
define('NONCE_KEY',        'lMUrmPrr+mrZi8}1eB.Fh[NQ=KC+reEbFnRvighenF<tX/+pYcnM o+Gku4%jt}d');
define('AUTH_SALT',        ']f3M9-7#|Xy3@V9%%4A)tAP/O{md/)vE|1aH-5P-hwF~mC+pu6a;mbNZx=_gK-jP');
define('SECURE_AUTH_SALT', 'EMe1|KFef|&Ix},W0qEy ]J*Zm;Vgdhu|Pf5P[EFU_rV:bZhUb{|g`zz$%EP24Y5');
define('LOGGED_IN_SALT',   '+<|NNNKM-eEI&kUo.L9+VX0K&&Fh`C>$/MExq&-nQnpNK|Pvx#rT5*U~@&N$a(dj');
define('NONCE_SALT',       '%:w*OxYW)4rG6<_s!K^Z|T~nhi-l|m$z!Ryy.p9}Mfs+cjekJtdLZu<)|-H:t/.@');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'ststhemeMMYY_';


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
define( 'WP_ENV', 'production' );
define( 'SF_ENV', 'PRD' );

// This sets the maximum amount of memory in bytes that a script is allowed to allocate
define( 'WP_MEMORY_LIMIT', '256M' );

// Bigger execution time
ini_set( 'max_execution_time', 1200 ); // 1200 seconds = 20 minutes

// Avoid WordPress to consult the database only to get this info
define( 'WP_HOME', 'https://storms.com.br/' );
define( 'WP_SITEURL', 'https://storms.com.br/' );

// Add SSL and HTTPS on your WordPress multi-site admin area or login pages
//define('FORCE_SSL_ADMIN', true);

if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 
	$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
