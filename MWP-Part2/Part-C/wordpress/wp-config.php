<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ITUFILM');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'E`;/ln<vnI7Qtaaj-g<K7udU{!{hd8f,8.tbRCv*1Av:Z|C-X0zcqJp7v0!fcIm|');
define('SECURE_AUTH_KEY',  '3.(1hsRux1S9eA+5}w<[ig*T9o N%#x?+:PF--dk{RlN_.AS*ZSpS4%kS`hFM#G+');
define('LOGGED_IN_KEY',    '.G-w|Y@mXff]Chz56+#VeG#>ci,+-i5z+j#amCv3xV%j|<@N^w#oL{!+rkMFnofW');
define('NONCE_KEY',        '2|S6+zZ z}oIR+DV-]/`#Dm-SuFppoV$_WwWA3Q/.F%N uhpVBXYsA(/Z7-+l+&I');
define('AUTH_SALT',        '[u1T-WEN]q9~#xKVUk1=+A$+o^&_VOX3+?*Hp#F?PzuhBT$J{^4uk uO[`qfG|VP');
define('SECURE_AUTH_SALT', 't-WCEtj=m;%S2&{!BK&m1D%kG.]{u<}~V+1k9&u rg8xs?yS/GbKf2YOQ| ^VGQ%');
define('LOGGED_IN_SALT',   'K-0G|g*{3J6 9g|@P)p*6,+3FEgE*M2^.v%@r!T32tQO`}f_cFFZZf+/ScRr4B6-');
define('NONCE_SALT',       '5LIM^c,UCl*?(g_D^G|`Y|+VX^lf&+ U[1k5%ODl!m_^VM(]9k`b}T~<[Q!A-[XU');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
